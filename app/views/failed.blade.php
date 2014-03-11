@extends('layout')

@section('content')
    <div class="alert alert-danger">{{ $message }}</div>
    <a href="{{ route('index'); }}" type="button" class="btn btn-primary btn-lg btn-block btn-sm">回首頁</a>
    <div class="row">　</div>
@stop
