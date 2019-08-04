
    <article class="{{ $type }}">
        
        <h2 class="is-size-3"><a href="{{ route( 'posts.show', $post->slug )}}">{{ $post->title }}</a></h2>

        <p>{{ $post->text }}</p>
            <a href="user/{{ $post->user->id }}">
            @<strong>{{ $post->user->name }}</strong>
        </a>
        <a href="{{ route('posts.show', $post->slug ).'#comment'}}">{{ $post->comments->count() }}
        <strong>{{ str_plural('comment', $post->comments->count()) }}</strong></a>
    </article>  

    {{-- jeden post v indexe --}}