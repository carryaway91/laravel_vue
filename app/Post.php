<?php

namespace App;

use App\User;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

  //v url adrese bude namiesto IDcka slug postu z databazy
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // prepajanie tabuliek (vztahy)

    // instancia triedy Post, cize vytvoreny post, patri jednemu userovi
    public function user() {
      return $this->belongsTo('App\User');
    }

    // instancii triedy Post patri viacero komentarov 
    public function comments() {
        return $this->hasMany('App\Comment')->latest();
    }
}
