<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    /**
     * Display the welcome page with platform statistics.
     */
    public function index()
    {
        try {
            // Estatísticas da plataforma (com fallback seguro)
            $stats = [
                'freelancers' => User::where('type', 'freelancer')->count() ?? 0,
                'clients' => User::where('type', 'client')->count() ?? 0,
                'projects' => Project::where('status', 'open')->count() ?? 0,
                'completed_projects' => Project::where('status', 'completed')->count() ?? 0,
            ];

            // Categorias em destaque (skills mais populares)
            $featuredCategories = $this->getFeaturedCategories();

            // Depoimentos (hardcoded por enquanto)
            $testimonials = $this->getTestimonials();

            return view('welcome', compact('stats', 'featuredCategories', 'testimonials'));
        } catch (\Exception $e) {
            // Fallback em caso de erro no banco
            $stats = [
                'freelancers' => 1250,
                'clients' => 350,
                'projects' => 89,
                'completed_projects' => 256,
            ];

            $featuredCategories = $this->getFeaturedCategories();
            $testimonials = $this->getTestimonials();

            return view('welcome', compact('stats', 'featuredCategories', 'testimonials'));
        }
    }

    /**
     * Get featured categories based on popular skills.
     */
    private function getFeaturedCategories()
    {
        try {
            return [
                [
                    'name' => 'Desenvolvimento Web',
                    'icon' => '💻',
                    'count' => Profile::where('skills', 'like', '%PHP%')
                        ->orWhere('skills', 'like', '%Laravel%')
                        ->count() ?? 42,
                ],
                [
                    'name' => 'Design UI/UX',
                    'icon' => '🎨',
                    'count' => Profile::where('skills', 'like', '%Figma%')
                        ->orWhere('skills', 'like', '%UI Design%')
                        ->count() ?? 28,
                ],
                [
                    'name' => 'Mobile Development',
                    'icon' => '📱',
                    'count' => Profile::where('skills', 'like', '%React Native%')
                        ->orWhere('skills', 'like', '%Flutter%')
                        ->count() ?? 35,
                ],
                [
                    'name' => 'DevOps',
                    'icon' => '⚙️',
                    'count' => Profile::where('skills', 'like', '%Docker%')
                        ->orWhere('skills', 'like', '%AWS%')
                        ->count() ?? 19,
                ],
            ];
        } catch (\Exception $e) {
            return [
                ['name' => 'Desenvolvimento Web', 'icon' => '💻', 'count' => 42],
                ['name' => 'Design UI/UX', 'icon' => '🎨', 'count' => 28],
                ['name' => 'Mobile Development', 'icon' => '📱', 'count' => 35],
                ['name' => 'DevOps', 'icon' => '⚙️', 'count' => 19],
            ];
        }
    }

    /**
     * Get testimonials.
     */
    private function getTestimonials()
    {
        return [
            [
                'name' => 'Carlos Silva',
                'role' => 'Desenvolvedor Full Stack',
                'avatar' => '👨‍💻',
                'text' => 'Consegui meus primeiros freelances através do DevLinkUp. Plataforma simples e direta!',
                'rating' => 5
            ],
            [
                'name' => 'Amanda Santos',
                'role' => 'Designer UI/UX',
                'avatar' => '👩‍🎨',
                'text' => 'Finalmente uma plataforma que não cobra taxas absurdas dos freelancers!',
                'rating' => 5
            ],
            [
                'name' => 'Ricardo Oliveira',
                'role' => 'Startup Founder',
                'avatar' => '👨‍💼',
                'text' => 'Contratei 3 desenvolvedores excelentes para meu projeto. Processo muito eficiente!',
                'rating' => 4
            ]
        ];
    }

    /**
     * Display about page.
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Display contact page.
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Display terms of service.
     */
    public function terms()
    {
        return view('terms');
    }

    /**
     * Display privacy policy.
     */
    public function privacy()
    {
        return view('privacy');
    }
}
