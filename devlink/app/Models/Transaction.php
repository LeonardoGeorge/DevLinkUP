<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // ►►► STATUS DAS TRANSAÇÕES
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

    // ►►► TIPOS DE TRANSAÇÕES
    const TYPE_SUBSCRIPTION = 'subscription';
    const TYPE_PROJECT_FEE = 'project_fee';

    // ►►► MÉTODOS DE PAGAMENTO
    const METHOD_CREDIT_CARD = 'credit_card';
    const METHOD_PIX = 'pix';
    const METHOD_BOLETO = 'boleto';

    protected $fillable = [
        'user_id',
        'amount',
        'payment_method',
        'status',
        'type',
        'description'
    ];

    protected $casts = [
        'amount' => 'decimal:2'
    ];

    // ►►► RELAÇÃO: Transação PERTENCE a um Usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ►►► ESCOPO: Transações Completadas
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    // ►►► ESCOPO: Transações de Assinatura
    public function scopeSubscription($query)
    {
        return $query->where('type', self::TYPE_SUBSCRIPTION);
    }

    // ►►► MÉTODO: Marcar como Completa
    public function markAsCompleted()
    {
        $this->status = self::STATUS_COMPLETED;
        return $this->save();
    }

    // ►►► MÉTODO: Marcar como Falha
    public function markAsFailed()
    {
        $this->status = self::STATUS_FAILED;
        return $this->save();
    }

    // ►►► VERIFICAR se está Completa
    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }
}
