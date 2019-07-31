<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'slug', 'is_published', 'is_comment_allowed', 'uid',  
        'posted_on', 'user_id', 'image_url', 'image_name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_published' => 'boolean',
        'is_comment_allowed' => 'boolean',
        'posted_on' => 'datetime',
    ];

    // Table relationships
    public function owner()
    {
        return $this->belongsTo(\App\User::class);
    }
}
