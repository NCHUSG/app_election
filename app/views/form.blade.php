@extends('layout')

@section('content')
    {{ Form::model($candidate, array('route' => array('step1', $type)),'method' => 'post') }}

    {{ Form::close() }}
@stop
