<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    /* Eager loading
        pri requeste volame niekolko queries so vztahmi (post, komentare a autora pod ktoreho spadaju)
        - na show stranke sa urobi query pre Post a pre komentare s autormi
        s lazy loading sa vysle kazda jedna query pre kazdy komentar a autora, co je neefektivne
        - s metodou with, ktoru volame na model Post, prikladame k Postu rovno aj jeho autora a komentare v 
        jednom volani, co nam zrychli stranku
    */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::with('user', 'comments')->get()
        ]);
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /* v show metode je model uz nacitany, cize nemozme pouzit with funkciu ...preto na 
        premennu, ktory nam vytvori laravel zavolame metodu load a tam zadame co chceme v jednej
        query zavolat ...bodkova notacia znamena nestovane volanie, cize volame komentare postu 
        a autora komentarov

        ak sa premenna kt. vytvarame v sablone a premenna ktoru tam zapisujeme volaju rovnako, tak mozme 
        pouzit metodu compact()
    */
    public function show(Post $post)
    {
        $post->load('comments', 'comments.user');
       
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
