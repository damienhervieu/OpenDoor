@extends('layout.main')

@section('title')
	Home
@stop

@section('content')
	{{ Form::open(array('method' => 'post', 'url' => '/open-door')) }}
		<input type="submit" value="Open Door">
	{{ Form::close() }}
@stop