<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "token"
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function examens()
    {
        return $this->belongsToMany(Examen::class);
    }
}
