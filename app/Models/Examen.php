<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "beginAt",
        "endAt",
    ];

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }


}
