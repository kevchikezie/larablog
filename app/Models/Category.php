<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uid';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'slug', 'is_enabled', 'created_by', 'modified_by',  
        'uid', 'image_url', 'image_name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    // Mutators
    public function setIsEnabledAttribute($value)
    {
        $this->attributes['is_enabled'] = boolval($value);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    //Accessors
    public function getStatusAttribute()
    {
        return ($this->is_enabled) ? 'Enabled' : 'Disabled';
    }

    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description, 215, ' ...');
    }

    // Scopes
    /**
     * Return a paginated result if the $perPage parameter is provided.
     * But returns a non-paginated result if parameter is not provided.
     *
     * @param mixed  $query
     * @param int  $perPage
     * @return mixed
     */
    public function scopePaginateOrNot($query, $perPage = 0, $columns = array('*'))
    {
        return ($perPage) ? $query->paginate($perPage, $columns) : $query->get($columns);
    }

    // Table relationships
    public function createdBy()
    {
        return $this->belongsTo(\App\User::class, 'created_by', 'uid')->withDefault();
    }

    public function modifiedBy()
    {
        return $this->belongsTo(\App\User::class, 'modified_by', 'uid')->withDefault();
    }
}
