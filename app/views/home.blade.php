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
  			

  			function lockoutSubmit(){
		        var oldValue = $('#open').val();
				$('#open').attr('disabled',true);
			  	$('#open').val('Opening...');
			  	setTimeout(function(){
			  		$('#open').val('Open Door');
			  		$('#open').attr('disabled', false);
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

	  		function getDate(){
	  			var permission = '{{ Auth::user()->permission }}';
	  			var day = new Date().getDay();
	  			var hour = new Date().getHours();
	  			var minute = new Date().getMinutes();

	  			console.log(permission);
	  			console.log('N° day : ' + day);
	  			console.log('Time : ' + hour + ':' + minute);

	  			isAuthorized(day, hour, minute, permission);
	  		}

        	function isAuthorized (day, hour, minute, permission) {
        		if (permission = 'member' && day == 0 || day == 6 || hour < 9 || (hour >= 20 && minute > 0)) {
        			$('#open').prop('disabled', false);
        			alert('You can only open the door during work days (Mon - Fri) between 9:00 and 20:00 !');
			  	} else {
			  		lockoutSubmit();
			  	}
	        }
  	</script>
@stop

@section('content')
	<div class="container">
		<div class="col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 text-center">
			<input class="action-button shadow animate red animated pulse" id="open" onclick="getDate()" type="submit" value="Open Door">
		</div>
	</div>
@stop