<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Hospital extends Model
{

    use HasFactory;

    public function doctors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(doctor::class,'doctor_id');
    }
    protected $fillable = [
        'name',
        'address',

    ];
}
