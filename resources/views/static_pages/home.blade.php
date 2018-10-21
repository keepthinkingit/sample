@extends('layouts.default')
@section('title', '主页')

@section('content')
    <div class="jumbotron">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <h1>Hello Laravel</h1>
        <div class="lead">
            你现在看到的是 <a href="example.me"></a>
        </div>
        <p>
            New Start.
        </p>

        @if (!Auth::check())
                <p>
                    <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
                </p>
        @endif

    </div>
@stop