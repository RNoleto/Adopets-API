<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breeds extends Model
{
    use HasFactory;

    protected $fillable = ['breed', 'ref_id_specie', 'ref_id_user', 'lifespan', 'story', 'average_weight', 'origin'];

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_id_user');
    }

    public function specie()
    {
        return $this->belongsTo(Species::class, 'ref_id_specie');
    }
}
