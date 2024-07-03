<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaccines extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'local', 'date', 'ref_id_animal'];

    protected $dates = ['deleted_at'];

    public function animal()
    {
        return $this->belongsTo(Animals::class, 'ref_id_animal');
    }
}
