<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevLinkUp - Conectando Devs e Clientes sem Taxas</title>
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
</head>
<body class="font-sans bg-white">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-pink-600">DevLinkUp</span>
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

    <!-- Hero Section -->
    <section class="hero-gradient text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold mb-6">Conectamos Devs e Clientes sem Taxas Abusivas</h1>
            <p class="text-xl mb-8 opacity-90">Plataforma gratuita para freelancers e com planos justos para clientes</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('register', ['type' => 'freelancer']) }}" class="bg-white text-pink-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100">
                    Sou Freelancer
                </a>
                <a href="{{ route('register', ['type' => 'client']) }}" class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-pink-600">
                    Sou Cliente
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="stat-card text-center p-6 bg-white rounded-lg shadow">
                    <div class="text-3xl font-bold text-pink-600">{{ $stats['freelancers'] }}+</div>
                    <p class="text-gray-600">Freelancers</p>
                </div>
                <div class="stat-card text-center p-6 bg-white rounded-lg shadow">
                    <div class="text-3xl font-bold text-pink-600">{{ $stats['clients'] }}+</div>
                    <p class="text-gray-600">Clientes</p>
                </div>
                <div class="stat-card text-center p-6 bg-white rounded-lg shadow">
                    <div class="text-3xl font-bold text-pink-600">{{ $stats['projects'] }}+</div>
                    <p class="text-gray-600">Projetos Ativos</p>
                </div>
                <div class="stat-card text-center p-6 bg-white rounded-lg shadow">
                    <div class="text-3xl font-bold text-pink-600">{{ $stats['completed_projects'] }}+</div>
                    <p class="text-gray-600">Projetos Concluídos</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works Section -->
    <section id="how-it-works" class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Como Funciona em 3 Passos</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">📝</span>
                    </div>
                    <h3 class="font-semibold mb-2">1. Crie seu Perfil</h3>
                    <p class="text-gray-600">Cadastre-se gratuitamente como freelancer ou cliente</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🔍</span>
                    </div>
                    <h3 class="font-semibold mb-2">2. Encontre ou Publique</h3>
                    <p class="text-gray-600">Busque projetos ou encontre freelancers qualificados</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🤝</span>
                    </div>
                    <h3 class="font-semibold mb-2">3. Conecte e Trabalhe</h3>
                    <p class="text-gray-600">Feche negócio sem taxas abusivas</p>
                </div>
            </div>
        </div>
    </section>

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
                <p>&copy; 2024 DevLinkUp. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>