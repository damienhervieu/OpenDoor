<!DOCTYPE html>
<html>
<head>
	  <title>@yield('title')</title>
	  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> 

	  <link rel="stylesheet" type="text/css" href="{{ asset('/public/css/navbar.css') }}">
  
    @section('head')
    @show

</head>
<body>

    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      	<div class="container">
        	  <div class="navbar-header">
          		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            		    <span class="sr-only">Toggle navigation</span>
            		    <span class="icon-bar top-bar"></span>
            		    <span class="icon-bar middle-bar"></span>
            		    <span class="icon-bar bottom-bar"></span>
          		  </button>
          		  <a class="navbar-brand" href="{{ URL::to('/') }}">Open Door</a>
        	  </div>
        	  <div id="navbar" class="navbar-collapse collapse">
          		  <ul class="nav navbar-nav">
					          @if ((Auth::user()->permission) == 'admin')
						            <li><a href="{{ URL::to('/manage-users') }}">Manage Users</a></li>
						            <li><a href="{{ URL::to('/open-door-logs') }}">Open Door Logs</a></li>
						            <li><a href="{{ URL::to('/complete-logs') }}">Complete Logs</a></li>
					          @endif
          		  </ul>
          		  <ul class="nav navbar-nav pull-right">
          			    <li><a href="{{ URL::to('/logout') }}">Logout</a></li>
          		  </ul>
        	  </div><!--/.nav-collapse -->
      	</div>
    </nav>

	@section('content')
	@show
    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    

	<!-- Latest compiled and minified JavaScript -->
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
    