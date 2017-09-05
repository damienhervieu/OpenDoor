@extends('layout.main')

@section('title')
	Delete a user
@stop

@section('content')
	<h1>Do you really want to delete the account of {{ $user->email }} ?</h1>
	{{ Form::open(array('method' => 'post')) }}
		<input type="submit" value="Yes">
	{{ Form::close() }}
	{{ Form::open(array('method' => 'get', 'url' => '/manage-users')) }}
		<input type="submit" value="No">
	{{ Form::close() }}

@stop