@extends('layout')

@section('content')
<p>
    <a href="/category/{{$post->category->id}}">
                   {{$post->category->name}}
    </a>   
</p>
    <article>
        {{ $post->body }}
    </article>
    <a href="/">Go Back</a>
@endsection