<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
     * The users that belong to the Activities
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
