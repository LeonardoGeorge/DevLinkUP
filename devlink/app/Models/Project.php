<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    const STATUS_OPEN = 'open';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'skills_required',
        'budget',
        'deadline',
        'status',
        'category'
    ];

    protected $casts = [
        'skills_required' => 'array',
        'budget' => 'decimal:2',
        'deadline' => 'datetime'
        // ►►► CONVERSÕES AUTOMÁTICAS PARA TIPOS CORRETOS
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        // ►►► PROJETO PERTENCE A UM USUÁRIO (CLIENTE)
    }

    public function client() 
    {
        return $this->belongsTo(User::class, 'user_id');
        // ►►► ALIAS PARA user() - MAIS SEMÂNTICO
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
        // ►►► UM PROJETO PODE TER MÚLTIPLAS PROPOSTAS
    }

        public function scopeOpen($query)
    {
        return $query->where('status', self::STATUS_OPEN);
        // ►►► ESCOPO LOCAL: Project::open() -> retorna só projetos abertos
        // Facilita: Project::open()->get()
    }

    public function isOpen()
    {
        return $this->status === self::STATUS_OPEN;
        // ►►► VERIFICA SE O PROJETO ESTÁ ABERTO PARA PROPOSTAS
    }
}

