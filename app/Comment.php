<?php

namespace App;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /* protekcia pred mass asignment diere ..pouziva sa premenna fillable alebo guarded na tom modely
    do ktorej tabulky ideme zapisovat ..fillable urcuje, ktore stlpce v tabulke musia byt vyplnene/ resp
    kt $request file mozu byt vyplnene, a guarded urcuje ktore nesmu byt 

    ak by tato ochrana nebola, pouzivatel by mohol cez devtools vytvorit input s menom takym ako je v tabulke
    a doplnit novy udaj a poslat hodnoty ktore nie su ziaduce alebo nebezpecne
    */
    protected $fillable = [
        'text', 'post_id', 'likes'
    ];

    // Vztahy medzi db
    public function user() {
       return $this->belongsTo('App\User');
    }

    public function post() {
        return $this->belongsTo('App\Post');
    }

    //Autorizacia

    public function authorization($abilities = []) {
        return collect($abilities)->map(function($ability) { 
            return \Gate::allows($ability, $this);
        });
    }

    public function toArray() {
        return parent::toArray() + [
            'authorizations' => $this->authorization()
        ];
    }
}
