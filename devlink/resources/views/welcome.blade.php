@extends('layouts.app')

@section('title', 'Bem-vindo ao DevLinkUp')

@section('content')
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
                    <div class="text-3xl font-bold text-pink-600">{{ $stats['freelancers'] ?? 0 }}+</div>
                    <p class="text-gray-600">Freelancers</p>
                </div>
                <div class="stat-card text-center p-6 bg-white rounded-lg shadow">
                    <div class="text-3xl font-bold text-pink-600">{{ $stats['clients'] ?? 0 }}+</div>
                    <p class="text-gray-600">Clientes</p>
                </div>
                <div class="stat-card text-center p-6 bg-white rounded-lg shadow">
                    <div class="text-3xl font-bold text-pink-600">{{ $stats['projects'] ?? 0 }}+</div>
                    <p class="text-gray-600">Projetos Ativos</p>
                </div>
                <div class="stat-card text-center p-6 bg-white rounded-lg shadow">
                    <div class="text-3xl font-bold text-pink-600">{{ $stats['completed_projects'] ?? 0 }}+</div>
                    <p class="text-gray-600">Projetos Concluídos</p>
                </div>
            </div>
        </div>
    </section>
@endsection
