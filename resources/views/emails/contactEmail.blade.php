<!DOCTYPE html>
<html>
<head>
	<title>Email to Admin</title>
</head>
<body>
	<p>Informations received from Contact Page.</p>
	<table>
		<tr>
			<td>Name:</td>
			<td>{{ $user->name }}</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>{{ $user->email }}</td>
		</tr>
		<tr>
			<td>Subject:</td>
			<td>{{ $user->subject }}</td>
		</tr>
		<br>
		<tr>
			<td>Message:</td>
			<td><p>{{ $user->message }}</p></td>
		</tr>
	</table>

</body>
</html>