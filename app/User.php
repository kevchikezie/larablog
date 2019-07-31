<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'display_name', 'email', 'password',
        'last_login', 'last_login_api', 'is_active', 'email_verified_at', 'bio', 
        'public_email', 'phone', 'whatsapp', 'facebook', 'twitter', 'instagram', 
        'linkedin', 'image_url', 'image_name',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
        'last_login_api' => 'datetime',
        'is_active' => 'boolean',
    ];

    //Accessors
    public function getStatusAttribute()
    {
        return ($this->is_active) ? 'Active' : 'Deactivated';
    }

    public function getFullnameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Checks if User has access to $permissions.
     *
     * @param  $permissions  array
     * @return boolean
     */
    public function hasAccess(array $permissions) : bool
    {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if ($role->hasAccess($permissions) === true) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if the user belongs to role.
     *
     * @param  $roleSlug  string
     * @return mixed
     */
    /*public function inRole(string $roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }*/

    // Table relationships
    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'role_users');
    }
}
