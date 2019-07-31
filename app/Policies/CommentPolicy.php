<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;
    
   
    public function create(User $user)
    {
    }


    public function update(User $user, Comment $comment)
    {
        return $comment->user_id == auth()->user()->id;
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->id == $comment->user_id;

    }

}
