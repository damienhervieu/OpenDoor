@extends('layout.main')

@section('title')
	Add a user
@stop

@section('content')
	@foreach($errors->all() as $error)
		<p class="error">{{ $error }}</p>
	@endforeach
	
	{{ Form::open() }}
		<input type="text" name="name" placeholder="Name"><br>
		<input type="email" name="email" placeholder="Email"><br>
		<input type="radio" name="permission" value="admin">Administrator</input>
		<input type="radio" name="permission" value="member" checked>Member</input>
		<input type="submit" value="Add user">
	{{ Form::close()}}
@stop