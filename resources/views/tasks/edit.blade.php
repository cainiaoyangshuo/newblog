@extends('app')
@section('content')
{{--<h1>编写一篇新文章</h1>--}}
<h1>{{$article->title}}</h1>
{{--<form action=""></form>--}}

{!! Form::model($article,['method'=>'PATCH', 'url'=>'/articles/'.$article->id]) !!}
@include('articles.form')
{!! Form::close() !!}

@include('errors.list')

@endsection
