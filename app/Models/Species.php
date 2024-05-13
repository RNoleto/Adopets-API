<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    use HasFactory;

    protected $fillable = ['specie', 'ref_id_user'];

    // Se você quiser adicionar um relacionamento com a tabela de usuários, pode fazer assim:
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_id_user');
    }
}
