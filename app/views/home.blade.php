@extends('layout.main')

@section('title')
	Home
@stop

@section('head')
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
  	<link rel="stylesheet" href="{{ asset('/public/css/button.css') }}">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.1/jquery.min.js"></script>
  	<script type="text/javascript">
	  	function lockoutSubmit(button){
	  		var oldValue = button.value;
	  		button.setAttribute('disabled',true);
	  		button.value = 'Opening...';
	  		setTimeout(function(){
	  			button.value = oldValue;
	  			button.removeAttribute('disabled');
	  		},3000);
	      	$.ajax({
	      		url: 'http://localhost/OpenDoor/open-door',
	      		type: 'GET',
	      		async: true,
	      	});
	      	$.ajax({
	        	url: 'open.php',
	        	type: 'GET',
	        	async: true,
	      	});
	  	}
  	</script>
@stop

@section('content')
	<div class="container">
		<div class="col-md-4 col-md-offset-4 text-center">
			<input class="action-button shadow animate red animated pulse" type="submit" onclick="lockoutSubmit(this)" value="Open Door">
		</div>
	</div>
@stop