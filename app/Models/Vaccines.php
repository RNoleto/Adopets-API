<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccines extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ref_id_animal'];

    public function animal()
    {
        return $this->belongsTo(Animals::class, 'ref_id_animal');
    }
}
