<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	@foreach($errors->all() as $error)
		<p class="error">{{ $error }}</p>
	@endforeach
	
	{{ Form::open(array('class' => 'form-horizontal')) }}
		<input type="email" name="email" placeholder="Email"><br>
		<input type="password" name="password" placeholder="Password"><br>
		<input type="checkbox" name="remember" value="true">Remember me
		<input type="submit" value="Sign In"><br>
	{{ Form::close() }}	
</body>
</html>