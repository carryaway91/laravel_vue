    
<comment inline-template>
    <article id="comment" class="comment has-text-left">
        <p class="has-text-dark" contenteditable="true">{{ $comment->text }}</p>
        <a href="user/{{ $comment->user->id }}"><strong>&#64;</strong><strong>{{ $comment->user->name }}</strong></a>
        <small class="has-text-grey-light">{{ $comment->created_at->diffForHumans() }}</small>
        <like-counter totallikes="{{ $comment->likes }}"></like-counter>
        
        <div>
            @auth
                <span>
                    <ul class="comment-response">
                        <interaction-panel totallikes="{{ $comment->likes }}"></interaction-panel>
                    </ul>
                </span>
            @endauth
            
            @canany(['update', 'delete'], $comment)
               
                <form action="/comments/{{ $comment->id }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" value="{{ $comment->id }}">
                    <button>Update</button>
                </form>
                
                <span>
                    <form action="/comments/{{ $comment->id }}" method="POST" onsubmit="return confirm('really?')">
                        @csrf
                        @method('delete')
                        <input type="hidden" value="{{ $comment->id }}">
                        <button>X</button>
                    </form>
                </span>
            @endcanany
        </div>
    </article>
</comment>