<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animals extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'gender', 'birth', 'specie', 'breed', 'chip_number', 'ref_id_user', 'status', 'ativo'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_id_user');
    }
}
