<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevLinkUp - @yield('title', 'Conectando Devs e Clientes')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
        }
        .stat-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
    </style>
    @stack('styles') <!-- Para adicionar CSS extra em páginas específicas -->
</head>
<body class="font-sans bg-white">

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-pink-600">DevLinkUp</a>
                </div>
                
                <div class="hidden md:flex space-x-8">
                    <a href="#how-it-works" class="text-gray-600 hover:text-pink-600">Como Funciona</a>
                    <a href="#categories" class="text-gray-600 hover:text-pink-600">Categorias</a>
                    <a href="#testimonials" class="text-gray-600 hover:text-pink-600">Depoimentos</a>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-pink-600">Entrar</a>
                    <a href="{{ route('register') }}" class="bg-pink-600 text-white px-6 py-2 rounded-full hover:bg-pink-700 transition">
                        Cadastrar
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Conteúdo da página -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <span class="text-2xl font-bold text-pink-400">DevLinkUp</span>
                    <p class="mt-2 text-gray-400">Conectando talentos tech sem intermediários caros.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Links Rápidos</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white">Sobre</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white">Contato</a></li>
                        <li><a href="{{ route('terms') }}" class="text-gray-400 hover:text-white">Termos</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-gray-400 hover:text-white">Privacidade</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Para Freelancers</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Criar Perfil</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Buscar Projetos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Como Funciona</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Para Clientes</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Publicar Projeto</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Encontrar Devs</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Planos</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} DevLinkUp. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    @stack('scripts') <!-- Para adicionar JS extra em páginas específicas -->
</body>
</html>
