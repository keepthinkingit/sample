@extends('layouts.default')
@section('title', '主页')

@section('content')
    <div class="jumbotron">
        <h1>Hello Laravel</h1>
        <div class="lead">
            你现在看到的是 <a href="example.me"></a>
        </div>
        <p>
            From Now On.
        </p>
        <p>
            <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
        </p>
    </div>
@stop