<!DOCTYPE html>
<html>
<head>
	<title>Email to Admin</title>
</head>
<body>
	<p>Dear {{ $user->name_en }}</p>
	<p>You have been granted Admin access to MMIA.</p>
	<p>You can login to the admin panel with the folllwing link.</p><br>
	<a href="http://myanmarmia.org/admin/login">http://myanmarmia.org/admin/login</a>
	<p>Login Email : {{ $user->email }}</p>
	<p>Passwrod    : {{ $user->password }}</p>
	<br>
	Thanks,<br>
	{{ config('app.name') }}<br>
	office@myanmarmia.org <br>
	09 777779180 <br>
	myanmarmia.org <br>

</body>
</html>