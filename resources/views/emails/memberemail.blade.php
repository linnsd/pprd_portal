<!DOCTYPE html>
<html>
<head>
	<title>Email to Admin</title>
</head>
<body>
	<p>User Registration awating approval.User {{ $user->name }} has registered and is on the waiting list.</p>
	<table>
		<tr>
			<td>Name:</td>
			<td>{{ $user->name }}</td>
		</tr>
		<tr>
			<td>NRC</td>
			<td> {{$user->nrc}} </td>
		</tr>
		<tr>
			<td>Email</td>
			<td>{{ $user->email }}</td>
		</tr>
		<tr>
			<td>Phone Number</td>
			<td>{{ $user->phone }}</td>
		</tr>
		<tr>
			<td>Shop/Company:</td>
			<td>{{ $user->business_name }}</td>
		</tr>
		
	</table>

</body>
</html>