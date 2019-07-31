@extends('layouts.layout')

@section('content')

    <section class="columns is-centered">
            <div class="column is-two-fifths">
                <ul class="has-text-centered">
                    
                    <li class="post">
                        @include('posts.article', [ 'type' => 'show'])
                        @include('comments.index')
                    </li>
                
                </ul>
            </div>
        </section>

@endsection