<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "state",
        "duree",
        "order",
        "examen_id",
        "user_id"
    ];

    protected $table = "activities";

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The users that belong to the Activities
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
