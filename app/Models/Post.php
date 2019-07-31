<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
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
        'title', 'content', 'slug', 'is_published', 'is_comment_allowed', 'uid',  
        'category_id', 'post_date', 'posted_by', 'image_url', 'image_name', 
        'modified_by', 'published_by', 'published_on',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_published' => 'boolean',
        'is_comment_allowed' => 'boolean',
        'post_date' => 'datetime',
        'published_on' => 'datetime',
    ];

    // Mutators
    public function setIsPublishedAttribute($value)
    {
        $this->attributes['is_published'] = boolval($value);
    }

    public function setIsCommentAllowedAttribute($value)
    {
        $this->attributes['is_comment_allowed'] = boolval($value);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    //Accessors
    public function getStatusAttribute()
    {
        return ($this->is_published) ? 'Published' : 'Draft';
    }

    public function getShortContentAttribute()
    {
        return str_limit($this->content, 215, ' ...');
    }

    // Table relationships
    public function postedBy()
    {
        return $this->belongsTo(\App\User::class, 'posted_by', 'uid')->withDefault();
    }

    public function modifiedBy()
    {
        return $this->belongsTo(\App\User::class, 'modified_by', 'uid')->withDefault();
    }

    public function publishedBy()
    {
        return $this->belongsTo(\App\User::class, 'published_by', 'uid')->withDefault();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'uid')->withDefault();
    }
}
