@extends('layout.main')

@section('title')
	Reset a password
@stop

@section('head')
	<style type="text/css">
		a{
		    color: white;
		    text-decoration: none;
		}

		a:link{
			text-decoration: none;
		}

		a:hover{
			color: inherit;
		}

	</style>
@stop

@section('content')
	<div class="container-fluid">
		<h2 class="text-center">Do you really want to reset the password of {{ $user->email }} ?</h2>
		<hr class="separator">
		<div class="form-wrap text-center">
			{{ Form::open(array('class' => 'form-inline', 'method' => 'post')) }}
		  			<div class="form-group">
						<div class="col-sm-offset-2 col-sm-4">
			  				<button type="radio" name="reset" class="btn btn-primary" value="yes">Yes</button>
						</div>
		  			</div>
		  			<div class="form-group">
						<div class="col-sm-offset-2 col-sm-4">
			  				<button type="radio" name="reset" class="btn btn-primary" value="no">No</button>
						</div>
		  			</div>
			{{ Form::close() }}
    	</div>
    </div>
@stop