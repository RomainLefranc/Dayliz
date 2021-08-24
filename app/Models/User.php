<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastName',
        'firstName',
        'birthDay',
        'phoneNumber',
        'promotion_id',
        'role_id',
        'email',
        'password',
        'tokenRandom',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'tokenRandom',
        'email_verified_at',
        'created_at',
        'updated_at',
        'state',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The activities that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    /**
     * The role that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}

