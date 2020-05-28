@extends('layouts.manage.app')
@section('title', trans('action.log.title').trans('action.detail'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ trans('action.log.title').trans('action.detail') }}</div>
                <div class="card-body">
                	<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('log.index')) }}</li>
					</ul>
					<div class="table-responsive">
						<table class="table table-hover table-bordered">
							<thead>
								<tr class="table-info active">
									<th class="text-nowrap text-center">{{ trans('action.log.item') }}</th>
									<th class="text-nowrap text-center">{{ trans('action.log.data') }}</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{ trans('action.log.user') }}</td>
									<td>{{ $log->user }}</td>
								</tr>
								<tr>
									<td>{{ trans('action.log.ip') }}</td>
									<td>{{ $log->ip }}</td>
								</tr>
								<tr>
									<td>{{ trans('action.log.os') }}</td>
									<td>{{ $log->os }}</td>
								</tr>
								<tr>
									<td>{{ trans('action.log.browser') }}</td>
									<td>{{ $log->browser }}</td>
								</tr>
								<tr>
									<td>{{ trans('action.log.browser') }} {{ trans('action.detail') }}</td>
									<td>{{ $log->browser_detail }}</td>
								</tr>
								<tr>
									<td>{{ trans('action.action') }}</td>
									<td>{{ $log->action }}</td>
								</tr>
								<tr>
									<td>{{ trans('action.log.table') }}</td>
									<td>{{ $log->table }}</td>
								</tr>
								<tr>
									<td>{{ trans('action.log.data') }}</td>
									<td><pre>{{ $log->data }}</pre></td>
								</tr>
								<tr>
									<td>{{ trans('action.log.create_at') }}</td>
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
