<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserActivity extends Pivot
{
    use HasFactory;

    protected $table = 'user_activity';

    protected $fillable = [
        "user_id",
        "activity_id"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }
}
