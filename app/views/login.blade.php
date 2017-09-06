<!DOCTYPE html>
<html>
<head>
	<title>Login</title>	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="{{ asset('/public/css/form.css') }}">
</head>
<body>
	@foreach($errors->all() as $error)
		<p class="error">{{ $error }}</p>
	@endforeach
	
	
		<!-- <input type="email" name="email" placeholder="Email"><br>
		<input type="password" name="password" placeholder="Password"><br>
		<input type="checkbox" name="remember" value="true">Remember me
		<input type="submit" value="Sign In"><br> -->
	

	<div class="container">
		<h1 class="text-center">Open Door - Sign in</h1>
		<hr class="separator">
		<div class="form-wrap col-sm-4 col-md-10 col-md-offset-3 vcenter">
			{{ Form::open(array('class' => 'form-horizontal')) }}
	  			<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-4">
		  				<input type="email" class="form-control" name="email" id="email" placeholder="Email">
					</div>
	  			</div>
	  			<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-4">
		  				<input type="password" class="form-control" name="password" id="password" placeholder="Password">
					</div>
	  			</div>
	  			<div class="form-group">
					<div class="col-sm-offset-2 col-sm-4">
		  				<div class="checkbox">
							<label>
			  					<input type="checkbox" name="remember" value="true"> Remember me
							</label>
		  				</div>
					</div>
	  			</div>
	  			<div class="form-group">
					<div class="col-sm-offset-2 col-sm-4">
		  				<button type="submit" class="btn btn-primary">Sign in</button>
					</div>
	  			</div>
			{{ Form::close() }}
    	</div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</div>
</body>
</html>