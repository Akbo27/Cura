<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
    use HasFactory;

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);;
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class,);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'name',
        'specialization',
        'hospital_id',
        ];
}
