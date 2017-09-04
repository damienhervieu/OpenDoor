<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<h1>Here's your new password {{ $user->name }}!</h1>

	<p>Following your demand an administrator has reset your password.<br>
	Your temporary password is : {{ $random_password }}.<br>
	<a href="http://www.localhost/OpenDoor/login">Click here</a> to sign in to your account and change your password.<br>
	<br>
	Best regards.<br>
	The FM-Games Team
	</p>

</body>
</html>