<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    // ►►► STATUS DAS PROPOSTAS
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'user_id',
        'project_id',
        'description',
        'bid_amount',
        'delivery_time', // dias para entrega
        'status'
    ];

    protected $casts = [
        'bid_amount' => 'decimal:2',
        'delivery_time' => 'integer'
    ];

    // ►►► RELAÇÃO: Proposta PERTENCE a um Freelancer (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ►►► RELAÇÃO: Proposta PERTENCE a um Projeto
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // ►►► ESCOPO: Propostas Pendentes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    // ►►► MÉTODO: Aceitar Proposta
    public function accept()
    {
        $this->status = self::STATUS_ACCEPTED;
        return $this->save();
    }

    // ►►► MÉTODO: Rejeitar Proposta
    public function reject()
    {
        $this->status = self::STATUS_REJECTED;
        return $this->save();
    }

    // ►►► VERIFICAR se está Pendente
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }
}
