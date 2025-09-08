<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // ►►► POR QUE PRECISAMOS DISSO? ◄◄◄
    // 1. 'Authenticatable' torna este model capaz de autenticação
    // 2. 'HasFactory' permite criar dados falsos para testes
    // 3. 'Notifiable' permite enviar notificações por email, SMS, etc.

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
        // ►►► DEFINE QUAIS CAMPOS PODEM SER PREENCHIDOS EM MASSAS
    ];
    

    protected $hidden = [
        'password',
        'remember_token',
        // ►►► CAMPOS QUE NÃO DEVEM SER MOSTRADOS EM RESPOSTAS JSON
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // ►►► CONVERTE AUTOMATICAMENTE CAMPOS PARA TIPOS ESPECÍFICOS
    ];

    // ►►► RELAÇÕES COM OUTRAS TABELAS ◄◄◄
    public function profile()
    {
        return $this->hasOne(Profile::class);
        // ►►► UM USUÁRIO TEM UM PERFIL (1:1)
        // Isso permite: $user->profile->bio
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
        // ►►► UM USUÁRIO PODE TER MÚLTIPLOS PROJETOS (1:N)
        // Isso permite: $user->projects (lista todos projetos do usuário)
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
        // ►►► UM USUÁRIO PODE TER MÚLTIPLAS PROPOSTAS (1:N)
    }

    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class);
        // ►►► HISTÓRICO DE ASSINATURAS DO USUÁRIO
    }

    public function activeSubscription()
    {
        return $this->hasOne(UserSubscription::class)
            ->where('status', 'active')
            ->where('ends_at', '>', now());
        // ►►► ASSINATURA ATUAL E ATIVA DO USUÁRIO
        // Isso é crucial para verificar se o cliente pode postar projetos
    }

    public function isFreelancer()
    {
        return $this->role === 'freelancer';
        // ►►► VERIFICA SE O USUÁRIO É FREELANCER
    }

    public function isClient()
    {
        return $this->role === 'client';
        // ►►► VERIFICA SE O USUÁRIO É CLIENTE
    }

    public function canPostProject()
    {
        // ►►► VERIFICA SE UM CLIENTE PODE PUBLICAR PROJETOS
        if (!$this->isClient()) return false;

        if (!$this->activeSubscription) return false;

        // Se plano for ilimitado
        if ($this->activeSubscription->plan->max_projects === null) return true;

        // Contar projetos deste mês
        $projectsThisMonth = $this->projects()
            ->where('created_at', '>=', now()->startOfMonth())
            ->count();

        return $projectsThisMonth < $this->activeSubscription->plan->max_projects;
    }
}