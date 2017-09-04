@extends('layout.main')

@section('title')
	@if((Request::path()) == 'open-door-logs')
		Open Door Logs
	@elseif((Request::path()) == 'complete-logs')
		Complete Logs
	@endif
@stop

@section('content')
	<table class="table table-bordered table-responsive">
		<tr>
			<th>Date</th>
			<th>Name</th>
			<th>Email</th>
			<th>Action</th>
			<th>IP</th>
			<th>User Agent</th>
		</tr>
		@foreach($logs as $log)
			<tr>
				<td>{{ $log->created_at }}</td>
				<td>{{ $log->name }}</td>
				<td>{{ $log->email }}</td>
				<td>{{ $log->action }}</td>
				<td>{{ $log->ip }}</td>
				<td>{{ $log->user_agent }}</td>
			</tr>
		@endforeach
	</table>
@stop