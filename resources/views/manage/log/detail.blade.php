@extends('layouts.manage.app')
@section('title', __('Log').__('Detail'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Log').__('Detail') }}</div>
                <div class="card-body">
                	<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('log.index')) }}</li>
					</ul>
					<div class="table-responsive">
						<table class="table table-hover table-bordered">
							<thead>
								<tr class="table-info active">
									<th class="text-nowrap text-center">{{ __('Item') }}</th>
									<th class="text-nowrap text-center">{{ __('Data') }}</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{ __('Member') }}</td>
									<td>{{ $log->user }}</td>
								</tr>
								<tr>
									<td>{{ __('IP') }}</td>
									<td>{{ $log->ip }}</td>
								</tr>
								<tr>
									<td>{{ __('Operating system') }}</td>
									<td>{{ $log->os }}</td>
								</tr>
								<tr>
									<td>{{ __('Browser') }}</td>
									<td>{{ $log->browser }}</td>
								</tr>
								<tr>
									<td>{{ __('Browser').__('Detail') }}</td>
									<td>{{ $log->browser_detail }}</td>
								</tr>
								<tr>
									<td>{{ __('Action') }}</td>
									<td>{{ $log->action }}</td>
								</tr>
								<tr>
									<td>{{ __('Table') }}</td>
									<td>{{ $log->table }}</td>
								</tr>
								<tr>
									<td>{{ __('Data') }}</td>
									<td><pre>{{ $log->data }}</pre></td>
								</tr>
								<tr>
									<td>{{ __('Created_at') }}</td>
									<td>{{ $log->created_at }}</td>
								</tr>
							</tbody>
						</table>
					</div>
                </div>
                <div class="card-footer">

				</div>
            </div>
        </div>
    </div>
</div>
@endsection
