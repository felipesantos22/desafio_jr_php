<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sick extends Model
{
    use HasFactory;

    protected $table = "sick";

    protected $fillable = [
        'name',
        'cpf',
    ];

    public $timestamps = false;

    public function consultation(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }
}
