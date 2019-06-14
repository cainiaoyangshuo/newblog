@extends('app')
@section('content')
    <h1>发布一个任务</h1>
    {{--<form action=""></form>--}}

    <form class="form" role="form" method="POST" action="{{ url('/tasks') }}">
        {{ csrf_field() }}

        <fieldset>
            <div class="form-group">
                <div class="col-md-10 offset-md-1">
                    <label for="title" class="control-label">{{ lang('title') }}</label>
                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" placeholder="{{ lang('Input title') }}" required autofocus>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10 offset-md-1">
                    <label for="content" class="control-label">{{ lang('content') }}</label>
                    <input id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="{{ old('content') }}" placeholder="{{ lang('Input content') }}" required>

                    @if ($errors->has('content'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10 offset-md-1">
                    <label for="category" class="control-label">{{ lang('category') }}</label>
                    <select  id="category" name="category" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}">
                        @foreach($category_list as $key => $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10 offset-md-1">
                    <label for="sex" class="control-label">{{ lang('sex') }}</label>
                    <select  id="sex" name="sex" class="form-control{{ $errors->has('sex') ? ' is-invalid' : '' }}">
                        @foreach($sex_list as $key => $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('sex'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 offset-md-1">
                    <label for="min_age" class="control-label">{{ lang('min_age') }}</label>
                    <input id="min_age" type="number" class="form-control{{ $errors->has('min_age') ? ' is-invalid' : '' }}" name="min_age" value="{{ old('min_age') }}" placeholder="{{ lang('Input min_age') }}" required>
                    @if ($errors->has('min_age'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('min_age') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 offset-md-1">
                    <label for="max_age" class="control-label">{{ lang('max_age') }}</label>
                    <input id="max_age" type="number" class="form-control{{ $errors->has('max_age') ? ' is-invalid' : '' }}" name="max_age" value="{{ old('max_age') }}" placeholder="{{ lang('Input max_age') }}" required>
                    @if ($errors->has('max_age'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('max_age') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 offset-md-1">
                    <label for="valid_at" class="control-label">{{ lang('valid_at') }}</label>
                    <input id="valid_at" type="number" class="form-control{{ $errors->has('valid_at') ? ' is-invalid' : '' }}" name="valid_at" value="{{ old('valid_at') }}" placeholder="{{ lang('Input valid_at') }}" required>
                    <span>天</span>
                    @if ($errors->has('valid_at'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('valid_at') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 offset-md-1">
                    <button type="submit" class="btn btn-primary form-control">
                        {{ lang('submit') }}
                    </button>
                </div>
            </div>
        </fieldset>
    </form>

@endsection
