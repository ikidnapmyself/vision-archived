<?php

namespace App\Models;

use App\Traits\HasAvatar;
use App\Traits\HasRoles;
use App\Traits\HasUUID;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use CanResetPassword, HasAvatar, HasRoles, HasUUID, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get Gravatar.
     *
     * @param int $size
     * @return string
     */
    public function getAvatar($size = 64)
    {
        return $this->getGravatar($this->email, $size);
    }

    /**
     * Get avatar name key.
     *
     * @return string
     */
    public function getAvatarNameKey()
    {
        return 'full_name';
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }

    /**
     * Set the user's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }

    /**
     * Set the user's surname.
     *
     * @param  string  $value
     * @return void
     */
    public function setSurnameAttribute($value)
    {
        $this->attributes['surname'] = Str::title($value);
    }

    /**
     * Set the user's surname.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Str::lower($value);
    }

    /**
     * Get all of the teams for the user.
     */
    public function boards()
    {
        return $this->hasManyThrough('App\Models\Board', 'App\Models\User');
    }

    /**
     * Get all of the teams for the user.
     */
    public function teams()
    {
        return $this->hasManyThrough('App\Models\Team', 'App\Models\User');
    }
}
