@extends('layouts.manage.app')
@section('title', __('Log').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Log').__('Manage') }}</div>
                <div class="card-body">
                	<form action="{{ route('log.search') }}" method="post">
					@csrf
                	<ul class="list-inline">
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ __('Filter') }}</a></li>
						<li class="list-inline-item">{{ App\Button::To(false,route('log.index'),__('Reset'),null,'btn-secondary','undo') }}</li>
						<li class="list-inline-item collapse" id="search"><button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-search"></i> {{ __('Search') }}</button></li>
					</ul>
					{{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
	                    <div class="form-group row">
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Member') }}</label>
							<div class='col-md-3'>
								<input type="text" class="form-control" name="user">
							</div>
							<label class='col-md-2 col-form-label text-md-right'>{{ __('IP') }}</label>
							<div id="filter_col2" data-column="1" class='col-md-3'>
								<input type="text" class="form-control" name="ip">
							</div>
						</div>
						<div class="form-group row">
							{{-- 選擇隱藏爛位 --}}
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Browser') }}</label>
							<div class='col-md-3'>
								<select class="form-control" name="browser">
									<option value="">{{ __('All') }}</option>
									@foreach (App\Enum::browser as $key => $value)
										<option value="{{ $value }}">{{ $value }}</option>
									@endforeach
								</select>
							</div>
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Action') }}</label>
							<div class='col-md-3'>
								<select class="form-control" name="action">
									<option value="">{{ __('All') }}</option>
									@foreach (App\Enum::action as $key => $value)
										<option value="{{ $value }}">{{ $value }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Table') }}</label>
							<div class='col-md-3'>
								<select class="form-control" name="table">
									<option value="">{{ __('All') }}</option>
									@foreach (App\Enum::table as $key => $value)
										<option value="{{ $value }}">{{ $value }}</option>
									@endforeach
								</select>
							</div>
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Created_at') }}</label>
							<div class="col-md-3">
								<div class="input-daterange input-group" id="datepicker">
								    <input type="text" class="form-control" name="start" />
								    <span class="input-group-addon">to</span>
								    <input type="text" class="form-control" name="end" />
								</div>
					        </div>
						</div>
					</div>
					</form>
					<div class="table-responsive">
						<table id="data" class="table table-hover table-bordered text-center">
							<thead>
								<tr class="table-info active">
									<th class="text-nowrap text-center">{{ __('Member') }}</th>
									<th class="text-nowrap text-center">{{ __('IP') }}</th>
									<th class="text-nowrap text-center">{{ __('Browser') }}</th>
									<th class="text-nowrap text-center">{{ __('Action') }}</th>
									<th class="text-nowrap text-center">{{ __('Table') }}</th>
									<th class="text-nowrap text-center">{{ __('Created_at') }}</th>
									<th class="text-nowrap text-center">*</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($logs_search as $log)
									<tr>
										<td>{{ $log->user }}</td>
										<td>{{ $log->ip }}</td>
										<td>{{ $log->browser }}</td>
										<td>{{ $log->action }}</td>
										<td>{{ $log->table }}</td>
										<td>{{ $log->created_at }}</td>
										<td>
											<form action="{{ route('log.show',$log->id) }}" method="GET">
											@csrf
											{{ App\Button::detail($log->id) }}
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
                </div>
                <div class="card-footer pagination justify-content-center table-responsive">
					{!! $logs_search->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
