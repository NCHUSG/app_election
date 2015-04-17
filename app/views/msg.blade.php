@extends('layout')

@section('content')
    <div class="alert alert-{{ $status }}" role="alert">{{ $msg }}</div>
    <a href="{{route('index')}}" class="btn btn-info btn-lg btn-block">回首頁</a>
@stop
