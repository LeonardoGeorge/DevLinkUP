<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    // ►►► STATUS DAS ASSINATURAS
    const STATUS_ACTIVE = 'active';
    const STATUS_CANCELED = 'canceled';
    const STATUS_EXPIRED = 'expired';

    protected $fillable = [
        'user_id',
        'plan_id',
        'status',
        'starts_at',
        'ends_at'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime'
    ];

    // ►►► RELAÇÃO: Assinatura PERTENCE a um Usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ►►► RELAÇÃO: Assinatura PERTENCE a um Plano
    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'plan_id');
    }

    // ►►► ESCOPO: Assinaturas Ativas
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE)
            ->where('ends_at', '>', now());
    }

    // ►►► VERIFICAR se Assinatura está Ativa
    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE &&
            $this->ends_at->isFuture();
    }

    // ►►► MÉTODO: Ativar Assinatura
    public function activate()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->starts_at = now();
        $this->ends_at = now()->addDays($this->plan->validity_days);
        return $this->save();
    }

    // ►►► MÉTODO: Cancelar Assinatura
    public function cancel()
    {
        $this->status = self::STATUS_CANCELED;
        return $this->save();
    }
}
