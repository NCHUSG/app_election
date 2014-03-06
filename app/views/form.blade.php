@extends('layout')

@section('content')
    {{ Form::model($candidate, array('route' => array('user.update', $user->id)),'method' => 'post') }}

    {{ Form::close() }}
@stop
