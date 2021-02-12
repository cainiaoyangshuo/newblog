@extends('layouts.app')

@section('content')
    <div id="test">

        <form action="/pushMsg">
            请输入 ： <input name="input">
        </form>
    </div>


@endsection