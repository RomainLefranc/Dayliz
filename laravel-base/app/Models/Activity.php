<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        "beginAt",
        "endAt",
        "title",
        "description",
        "state"
    ];

    protected $table = "activities";

    /**
     * The roles that belong to the Activity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
