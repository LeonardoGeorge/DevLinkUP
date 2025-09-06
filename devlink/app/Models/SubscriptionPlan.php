<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserSubscription;

class SubscriptionPlan extends Model
{
    use HasFactory;

    // ►►► TIPOS DE PLANOS
    const TYPE_FREELANCER = 'freelancer';
    const TYPE_CLIENT = 'client';

    protected $fillable = [
        'name',
        'type', // 'freelancer' ou 'client'
        'price',
        'max_projects', // null = ilimitado
        'validity_days', // dias de validade
        'featured_listing',
        'priority_support'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'max_projects' => 'integer',
        'validity_days' => 'integer',
        'featured_listing' => 'boolean',
        'priority_support' => 'boolean'
    ];

    // ►►► RELAÇÃO: Plano TEM MUITAS Assinaturas
    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class, 'plan_id');
    }

    // ►►► ESCOPO: Planos para Clientes
    public function scopeForClients($query)
    {
        return $query->where('type', self::TYPE_CLIENT);
    }

    // ►►► ESCOPO: Planos para Freelancers
    public function scopeForFreelancers($query)
    {
        return $query->where('type', self::TYPE_FREELANCER);
    }

    // ►►► VERIFICAR se é Plano Gratuito
    public function isFree()
    {
        return $this->price == 0;
    }

    // ►►► VERIFICAR se é Plano Ilimitado
    public function isUnlimited()
    {
        return is_null($this->max_projects);
    }
}
