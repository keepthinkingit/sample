@extends('layouts.default')
@section('title', '主页')

@section('content')
    @if (Auth::check())
        <div class="row">
            <div class="col-md-8">
                <section class="status_form">
                    @include('shared._status_form')
                </section>
                <h3>微博列表</h3>
                @include('shared._feed')
            </div>
            <aside class="col-md-4">
                <section class="user_info">
                    @include('shared._user_info', ['user' => Auth::user()])
                </section>
                <section class="user_info">
                    @include('shared._stats', ['user' => Auth::user()])
                </section>
            </aside>
        </div>
     @else
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

            <p>
                <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
            </p>
        </div>
    @endif
@stop