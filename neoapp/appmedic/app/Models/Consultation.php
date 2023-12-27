<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $table = "consultation";

    protected $fillable = [
        'data',
        'sick_id',
        'doctor_id'
    ];

    public $timestamps = false;

    public function sick()
    {
        return $this->belongsTo(Sick::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
