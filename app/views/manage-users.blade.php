@extends('layout.main')

@section('title')
	Manage Users
@stop

@section('content')
	<a href="{{ URL::to('manage-users/add-user') }}"><button class="btn btn-primary">Add a user</button></a>
	<table class="table table-bordered table-responsive">
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Permission</th>
			<th>User's logs</th>
			<th>Modify</th>
			<th>Reset Password</th>
			<th>Delete</th>
		</tr>
		@foreach($users as $user)
			<tr>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->permission }}</td>
				<td><a href="{{ URL::to('user-logs', $user->id) }}">Logs</td>
				<td><a href="{{ URL::to('manage-users/modify', $user->id) }}">Modify</a></td>
				<td><a href="{{ URL::to('manage-users/reset-password', $user->id) }}">Reset Password</a></td>
				<td><a href="{{ URL::to('manage-users/delete', $user->id) }}">Delete</a></td>
			</tr>
		@endforeach
	</table>
@stop