@extends('layouts.layout')

@section('content')
    
    <section class="columns is-centered">
        <div class="column is-two-fifths">
            <ul class="has-text-centered">
                
                @foreach($posts as $post)
                    <li class="post">
                        @include('posts.article', [ 'type' => 'index'])
                    </li>
                @endforeach
            
            </ul>
        </div>
    </section>
@endsection

{{-- index, vypis vsetkych postov --}}