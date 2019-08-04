<section>
    
    @include('errors.errors')
    <ol>
       @auth
            <form action="/comments" method="POST">
                @csrf
                <textarea name="text" id="" cols="30" rows="10">
                </textarea>
            
                <button>Add comment</button>

                {{--su dva hidden inputy ktore sa posielaju kvoli vztahom medzi databazami: post_id a user_id
                urobit input hidden pre user_id by bolo nebezpecne, lebo v devtools by mohol hocikto prepisat toto idecko a 
                pridat komentar v svojom mene, preto tuto hodnotu posielame v samotnom CommentControllery cez: 
                
                auth()->user()->comments()->create( $request->all() )
                auth()->user() = prihlaseny user; ->comments = komentare ktore ma(urcili sme cez vztah v modely usera) 
                a do tychto komentarov uz len pridame vsetko, co prislo z requestu VRATANE jeho user_id
                
                --}}
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="likes" value="{{ $post->likes }}">

            </form>
        @endauth

        {{-- vytahujeme komenty vdaka vztahom, ktore su urcene v modely --}}
    </ol>
    
</section>