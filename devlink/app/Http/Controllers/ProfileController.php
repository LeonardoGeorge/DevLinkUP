<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Lista todos os perfis
    public function index()
    {
        $profiles = Profile::with('user')->paginate(10);
        return view('profiles.index', compact('profiles'));
        // Se fosse API: return response()->json($profiles);
    }

    // Mostra formulário de criação
    public function create()
    {
        return view('profiles.create');
    }

    // Salva novo perfil
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'bio'        => 'nullable|string',
            'location'   => 'nullable|string|max:100',
            'portfolio_url' => 'nullable|url',
            'skills'     => 'nullable|array',
            'skills.*'   => 'string|max:50',
            'hourly_rate' => 'nullable|numeric|min:0',
            'experience_level' => 'nullable|string|max:50',
            'avatar'     => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $data['user_id'] = auth()->id(); // pega usuário logado

        $profile = Profile::create($data);

        return redirect()->route('profiles.show', $profile)
            ->with('success', 'Perfil criado com sucesso!');
    }

    // Exibe um perfil
    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }

    // Mostra formulário de edição
    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    // Atualiza perfil
    public function update(Request $request, Profile $profile)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'bio'        => 'nullable|string',
            'location'   => 'nullable|string|max:100',
            'portfolio_url' => 'nullable|url',
            'skills'     => 'nullable|array',
            'skills.*'   => 'string|max:50',
            'hourly_rate' => 'nullable|numeric|min:0',
            'experience_level' => 'nullable|string|max:50',
            'avatar'     => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->update($data);

        return redirect()->route('profiles.show', $profile)
            ->with('success', 'Perfil atualizado com sucesso!');
    }

    // Deleta perfil
    public function destroy(Profile $profile)
    {
        if ($profile->avatar) {
            Storage::disk('public')->delete($profile->avatar);
        }

        $profile->delete();

        return redirect()->route('profiles.index')
            ->with('success', 'Perfil excluído com sucesso!');
    }
}
