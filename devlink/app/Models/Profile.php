<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio',
        'skills',
        'portfolio_url',
        'hourly_rate',
        'experience_level',
        'avatar'
        // ►►► INFORMAÇÕES PROFISSIONAIS DOS FREELANCERS
    ];

    protected $casts = [
        'skills' => 'array',
        'hourly_rate' => 'decimal:2'
        // ►►► CONVERTE 'SKILLS' PARA ARRAY AUTOMATICAMENTE
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        // ►►► PERTENCE A UM USUÁRIO (RELACIONAMENTO INVERSO)
    }

    public function addSkill($skill)
    {
        $skills = $this->skills ?? [];
        if (!in_array($skill, $skills)) {
            $skills[] = $skill;
            $this->skills = $skills;
        }
        return $this;
        // ►►► MÉTODO CONVÊNIENCE PARA ADICIONAR HABILIDADES
    }
}