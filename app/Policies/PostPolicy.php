<?php

namespace App\Policies;

use App\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the post belongs to the user before viewing.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        return $user->hasAccess(['view-post']) && $user->id == $post->user_id;
    }

    /**
     * Determine if a user can view other user's posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewOthers(User $user)
    {
        return $user->hasAccess(['view-others-post']);
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['create-post']);
    }

    /**
     * Determine whether the user can update his/her own post.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $user->hasAccess(['update-post']) && $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can update other user's post.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function updateOthers(User $user)
    {
        return $user->hasAccess(['update-others-post']);
    }

    /**
     * Determine whether the user can delete his/her own post.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        return $user->hasAccess(['delete-post']) && $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can delete other user's posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function deleteOthers(User $user)
    {
        return $user->hasAccess(['delete-others-post']);
    }

    /**
     * Determine whether the user can public a post.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function publish(User $user)
    {
        return $user->hasAccess(['publish-post']);
    }
}
