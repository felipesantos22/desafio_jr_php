<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    use HasFactory;

    protected $table = "doctor";

    protected $fillable = [
        'name',
        'crm',
    ];

    public $timestamps = false;

    public function consultation(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }
}
