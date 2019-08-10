<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    /* 
        kontroller auth sluzi na to, aby uzivatel ktory pridava koment musel byt autentifikovny, resp
        prihlaseny ...samotna direktiva @auth sluzi ze sa formular na pridavanie komenut zobrazi len
        ked je uzivatel prihlaseny, no post udaje sa daju odosielat aj z ineho servera alebo cez 
        ine package napr Axios ...tymto middlewarom sa zabezpeci to, ze uzivatel je prihlaseny na 
        danom serveri
    */
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function getMainComments(Request $request) {
        return Comment::where('comment_id', null)->get();
    }

    public function getReplies(Request $request) {
        return Comment::whereNotNull('comment_id')->get();
    }

    public function store(Request $request)
    {
        /* 
        exists:post,id znamena ze kontrolujeme ci sa dana hodnota(post_id)
        nachadza v databaze ..kedze je to foreign key tak kontrolujeme,
        ci post_id je v tabulke posts vedeny ako jeho ID
        */

        $request->validate([
            'text' => 'required|max:1000',
            'post_id' => 'required|integer|exists:posts,id',
            
        ]);
        
        /* 
            vytvarame novy komentar, ktory sa ulozime do premennej comment,
            aby sme potom pri metode redirect mohli cez vztah vybrat slug postu
            pod ktory tento komentar patri
        */
        $comment = auth()->user()->comments()->create( 
            ['text' => $request->text,
            'post_id' => $request->post_id,
            'likes' => 0,
            'comment_id' => $request->comment_id
            ]
        );
        return redirect('/posts/'. $comment->post->slug . '#comments')
                ->with('flash', 'Comment added!');
    
    /* k redirectu funkciou with posleme do session data, ktore vydrzia jedno zobrazenie(request)
    - alternativa: pred redirect: session()->flash('key', 'value')
    */
    }

    public function update(Request $request, Comment $comment)
    {
       // $this->authorize('update', $comment);
        $comment->text = $request->text;
        $comment->save();
        session()->flash('flash', 'Comment Updated!');
        return $request;

    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        session()->flash('flash', 'Comment removed');
        return redirect()->back()->with('alert', 'Do you really want to remove the comment?');
    }
}
