<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description', 'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions' => 'array',
    ];

    // Mutators
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    //Accessors
    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description, 215, ' ...');
    }

    /**
     * Loops through a roles permission to see if access was granted.
     *
     * @param  array  $permissions
     * @return boolean
     */
    public function hasAccess(array $permissions) : bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission) === true) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if a role has a certain permission.
     *
     * @param  string  $permission
     * @return boolean
     */
    private function hasPermission(string $permission) : bool
    {
        return $this->permissions[$permission] ?? false;
    }

    // Table relationships
    public function users()
    {
        return $this->belongsToMany(\App\User::class, 'role_users');
    }
}
