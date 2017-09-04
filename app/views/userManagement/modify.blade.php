@extends('layout.main')

@section('title')
	Modify a user
@stop

@section('content')
	@foreach($errors->all() as $error)
		<p class="error">{{ $error }}</p>
	@endforeach
	
	{{ Form::open() }}
		<input type="text" name="name" value="{{ $user['name'] }}"><br>
		<input type="email" name="email" value="{{ $user['email'] }}"><br>
		<input type="submit" value="Modify">
	{{ Form::close()}}
@stop