<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animals extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'gender', 'birth', 'specie', 'breed', 'chip_number', 'ref_id_user', 'status', 'ativo'];

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_id_user');
    }
}
