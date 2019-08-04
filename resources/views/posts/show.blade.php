@extends('layouts.layout')

@section('content')

    <section class="columns is-centered">
        <div class="column is-two-fifths has-text-centered">
            @include('posts.article', [ 'type' => 'show'])
        <comment-form :post-data="{{ $post }}"></comment-form>
        <comment-list slug="{{ $post->slug }}"></comment-list>
        </div>
    </section>

@endsection

    {{-- vypis jedneho postu a zoznam jeho komentarov --}}