@extends('layout.main')

@section('title')
	Add a user
@stop

@section('content')
	@foreach($errors->all() as $error)
		<div class="alert alert-danger" role='alert'>{{ $error }}</p>
	@endforeach
	
	<div class="container-fluid">
		<h2 class="text-center">Add a user to Open Door</h2>
		<hr class="separator">
		<div class="form-wrap col-sm-4 col-md-10 col-md-offset-3 vcenter">
			{{ Form::open(array('class' => 'form-horizontal')) }}
	  			<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-4">
		  				<input type="text" class="form-control" name="name" id="name" placeholder="Name">
					</div>
	  			</div>
	  			<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-4">
		  				<input type="email" class="form-control" name="email" id="email" placeholder="Email">
					</div>
	  			</div>
	  			<div class="form-group">
					<div class="col-sm-offset-2 col-sm-4">
		  				<div class="radio-inline">
							<label><input type="radio" name="permission" value="admin"> Administrator</label>
						</div>
		  				<div class="radio-inline">
		  					<label><input type="radio" name="permission" value="member"> Member</label>
		  				</div>
					</div>
	  			</div>
	  			<div class="form-group">
					<div class="col-sm-offset-2 col-sm-4">
		  				<button type="submit" class="btn btn-primary">Add User</button>
					</div>
	  			</div>
			{{ Form::close() }}
    	</div>
    </div>
@stop