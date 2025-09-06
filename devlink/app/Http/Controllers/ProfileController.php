<?php

namespace App\Http\Controllers;

use App\Models\Profile;  
use App\Models\User;     
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update,profile')->only(['edit', 'update', 'destroy']);
    }

    /**
     * Display the user's profile.
     */
    public function show(Profile $profile)
    {
        $profile->load('user.projects', 'user.proposals');

        return view('profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        return view('profiles.edit', compact('profile', 'user'));
    }

    /**
     * Update or create the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'bio' => 'required|string|min:50|max:1000',
            'skills' => 'required|string',
            'website' => 'nullable|url',
            'github' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'portfolio_url' => 'nullable|url',
            'hourly_rate' => 'nullable|numeric|min:0',
            'availability' => 'required|in:available,busy,unavailable',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Processar skills (string para array)
        $skillsArray = array_map('trim', explode(',', $validated['skills']));
        $validated['skills'] = json_encode($skillsArray);

        // Upload de avatar ✅ CORRIGIDO
        if ($request->hasFile('avatar')) {
            $avatarPath = $this->uploadAvatar($request->file('avatar'), $user->id);
            $validated['avatar'] = $avatarPath;
        }

        // Criar ou atualizar perfil
        if ($user->profile) {
            $user->profile->update($validated);
            $message = 'Perfil atualizado com sucesso!';
        } else {
            $user->profile()->create($validated);
            $message = 'Perfil criado com sucesso!';
        }

        return redirect()->route('profile.show', $user->profile)
            ->with('success', $message);
    }

        // Processar skills (string para array)
        $skillsArray = array_map('trim', explode(',', $validated['skills']));
        $validated['skills'] = json_encode($skillsArray);

        // Upload de avatar
        if ($request->hasFile('avatar')) {
            $avatarPath = $this->uploadAvatar($request->file('avatar'), $user->id);
            $validated['avatar'] = $avatarPath;
        }

        // Criar ou atualizar perfil
        if ($user->profile) {
            $user->profile->update($validated);
            $message = 'Perfil atualizado com sucesso!';
        } else {
            $user->profile()->create($validated);
            $message = 'Perfil criado com sucesso!';
        }

        return redirect()->route('profile.show', $user->profile)
            ->with('success', $message);
    }

    /**
     * Upload and process avatar image.
     */
    private function uploadAvatar($file, $userId)
    {
        // Criar diretório se não existir
        $directory = "avatars/{$userId}";
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        // Nome único para a imagem
        $filename = uniqid() . '.webp';
        $path = "{$directory}/{$filename}";

        // Processar imagem (redimensionar e converter para webp)
        $image = Image::make($file)
            ->fit(200, 200)
            ->encode('webp', 80);

        Storage::put($path, $image);

        return $path;
    }

    /**
     * Remove the user's avatar.
     */
    public function removeAvatar()
    {
        $user = Auth::user();

        if ($user->profile && $user->profile->avatar) {
            // Deletar arquivo do storage
            Storage::delete($user->profile->avatar);

            // Remover referência no banco
            $user->profile->update(['avatar' => null]);

            return back()->with('success', 'Avatar removido com sucesso!');
        }

        return back()->with('error', 'Nenhum avatar para remover.');
    }

    /**
     * Search freelancers by skills.
     */
    public function search(Request $request)
    {
        $validated = $request->validate([
            'skills' => 'nullable|string',
            'availability' => 'nullable|in:available,busy,unavailable',
            'min_rate' => 'nullable|numeric|min:0',
            'max_rate' => 'nullable|numeric|min:0'
        ]);

        $query = Profile::with('user')
            ->whereHas('user', function ($q) {
                $q->where('type', 'freelancer');
            });

        // Filtrar por skills
        if (!empty($validated['skills'])) {
            $searchSkills = array_map('trim', explode(',', $validated['skills']));
            $query->where(function ($q) use ($searchSkills) {
                foreach ($searchSkills as $skill) {
                    $q->orWhere('skills', 'like', '%"' . $skill . '"%');
                }
            });
        }

        // Filtrar por disponibilidade
        if (!empty($validated['availability'])) {
            $query->where('availability', $validated['availability']);
        }

        // Filtrar por faixa de preço
        if (!empty($validated['min_rate'])) {
            $query->where('hourly_rate', '>=', $validated['min_rate']);
        }

        if (!empty($validated['max_rate'])) {
            $query->where('hourly_rate', '<=', $validated['max_rate']);
        }

        $profiles = $query->paginate(12);

        return view('profiles.search', compact('profiles', 'validated'));
    }

    /**
     * Display current user's profile.
     */
    public function myProfile()
    {
        $user = Auth::user();

        if (!$user->profile) {
            return redirect()->route('profile.edit')
                ->with('info', 'Complete seu perfil primeiro!');
        }

        return view('profiles.my-profile', compact('user'));
    }
}
