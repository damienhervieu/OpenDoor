@extends('layout.main')

@section('title')
	Modify a user
@stop

@section('content')
	@foreach($errors->all() as $error)
		<p class="error">{{ $error }}</p>
	@endforeach

	<div class="container-fluid">
		<h1 class="text-center">Modify the user {{ $user['email'] }}</h1>
		<hr class="separator">
		<div class="form-wrap col-sm-4 col-md-10 col-md-offset-3">
			{{ Form::open(array('class' => 'form-horizontal')) }}
	  			<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-4">
		  				<input type="text" class="form-control" name="name" id="name" value="{{ $user['name'] }}">
					</div>
	  			</div>
	  			<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-4">
		  				<input type="email" class="form-control" name="email" id="email" value="{{ $user['email'] }}">
					</div>
	  			</div>
	  			<div class="form-group">
					<div class="col-sm-offset-2 col-sm-4">
		  				<button type="submit" class="btn btn-primary">Modify the user</button>
					</div>
	  			</div>
			{{ Form::close() }}
    	</div>
    </div>
@stop