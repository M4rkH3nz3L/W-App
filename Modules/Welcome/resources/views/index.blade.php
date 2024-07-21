@extends('layout.base')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('welcome.name') !!}</p>
@endsection
