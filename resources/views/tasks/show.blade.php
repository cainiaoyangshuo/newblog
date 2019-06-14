@extends('app')
@section('content')
    <h1>{{$article->title}}</h1>
    <hr>
        <article>
            <div class="body">
                {{$article->content}}
            </div>
            <hr/>
            <div class="footer">
                <span>发布于：</span>
                {{$article->published_at->diffForHumans()}}
            </div>
        </article>

@endsection
