@extends('layout.main')

@section('title')
	@if((Request::path()) == 'open-door-logs')
		Open Door Logs
	@elseif ((Request::path()) == 'user-management-logs')
		User Management Logs
	@elseif((Request::path()) == 'complete-logs')
		Complete Logs
	@elseif ((Request::path()) == 'added-users-logs')
		Added Users Logs
	@elseif ((Request::path()) == 'modified-users-logs')
		Modified Users Logs
	@elseif ((Request::path()) == 'reset-users-logs')
		Reset Users Logs
	@elseif ((Request::path()) == 'deleted-users-logs')
		Deleted Users Logs
	@elseif((Request::path()) == $userUrl)
		User's logs
	@endif
@stop

@section('content')
	@if ((Request::path()) == 'complete-logs' || (Request::path()) == 'added-users-logs' || (Request::path()) == 'modified-users-logs' || (Request::path()) == 'reset-users-logs' || (Request::path()) == 'deleted-users-logs')
		<a href="{{ URL::to('/added-users-logs') }}"><button>Added Users Logs</button></a>
		<a href="{{ URL::to('/modified-users-logs') }}"><button>Modified Users Logs</button></a>
		<a href="{{ URL::to('/reset-users-logs') }}"><button>Reset Users Logs</button></a>
		<a href="{{ URL::to('/deleted-users-logs') }}"><button>Deleted Users Logs</button></a>
	@endif
	
	<table class="table table-bordered table-responsive">
		<tr>
			<th>Date</th>
			<th>Source</th>
			<th>Action</th>
			@if((Request::path()) == 'complete-logs' || (Request::path()) == 'user-management-logs' || (Request::path()) == 'modified-users-logs' || (Request::path()) == $userUrl)
				<th>Target</th>
				<th>Old Value</th>
				<th>New Value</th>
			@endif
			<th>IP</th>
			<th>User Agent</th>
		</tr>
		@foreach($logs as $log)
			<tr>
				<td>{{ $log->created_at }}</td>
				<td>{{ $log->changer->email }}</td>
				<td>{{ $log->action->action }}</td>
				@if((Request::path()) == 'complete-logs' || (Request::path()) == 'user-management-logs' || (Request::path()) == 'modified-users-logs' || (Request::path()) == $userUrl)
					<td>
						@if(($log->target) == null)
							{{ $log->target = 'Self' }}
						@elseif(($log->target) != null)
							{{ $log->target->email }}
						@endif
					</td>
					<td>
						{{ $log->old_value }}
					</td>
					<td>
						{{ $log->new_value }}
					</td>
				@endif
				<td>{{ $log->ip }}</td>
				<td>{{ $log->user_agent }}</td>
			</tr>
		@endforeach
	</table>

	{{ $logs->links() }}
@stop