<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Password change</title>
</head>
<body>
	@foreach($errors->all() as $error)
		<p class="error">{{ $error }}</p>
	@endforeach

	{{ Form::open() }}
		<input type="password" name="password" placeholder="Password"><br>
		<input type="password" name="password2" placeholder="Password confirmation"><br>
		<input type="submit" value="Change my password">
	{{ Form::close() }}
</body>
</html>