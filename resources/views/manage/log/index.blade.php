@extends('layouts.manage.app')
@section('title', trans('action.log.title').trans('action.manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ trans('action.log.title').trans('action.manage') }}</div>
                <div class="card-body">
                	<form action="{{ route('log.search') }}" method="post">
					@csrf
                	<ul class="list-inline">
						<li class="list-inline-item">
                            <a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ trans('action.filter') }}</a>
                        </li>
					</ul>
					{{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
                        <div class="form-row">
                            <div class='form-group col-md-3'>
                                <label>{{ trans('action.user.title') }}</label>
                                <input type="text" class="form-control" name="user">
                            </div>

                            <div class='form-group col-md-3'>
                                <label>{{ trans('action.log.ip') }}</label>
                                <input type="text" class="form-control" name="ip">
                            </div>
                            {{-- 選擇隱藏爛位 --}}
                            <div class='form-group col-md-3'>
                                <label>{{ trans('action.log.browser') }}</label>
                                <select class="form-control" name="browser">
                                    <option value="">{{ trans('All') }}</option>
                                    @foreach (App\Enum::browser as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class='form-group col-md-3'>
                                <label>{{ trans('action.action') }}</label>
                                <select class="form-control" name="action">
                                    <option value="">{{ trans('All') }}</option>
                                    @foreach (App\Enum::action as $key => $value)
                                        <option value="{{ $value }}">{{ trans($value) }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class='form-group col-md-3'>
                                <label>{{ trans('action.log.table') }}</label>
                                <select class="form-control" name="table">
                                    <option value="">{{ trans('action.all') }}</option>
                                    @foreach (App\Enum::table as $key => $value)
                                        <option value="{{ $value }}">{{ trans($value) }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group col-md-6">
                                <label>{{ trans('action.log.create_at') }}</label>
                                <div class="input-daterange input-group" >
                                    <input id="datepicker1" type="text" class="form-control" name="start" autocomplete="off" />
                                    <span class="input-group-addon">-</span>
                                    <input id="datepicker2" type="text" class="form-control" name="end" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-secondary">
                            <i class="fas fa-search"></i> {{ trans('action.search') }}
                        </button>
					</div>
					</form>
					<div class="table-responsive">
						<table id="data" class="table table-hover table-bordered text-center">
							<thead>
								<tr class="table-info active">
									<th class="text-nowrap text-center">{{ trans('action.log.user') }}</th>
									<th class="text-nowrap text-center">{{ trans('action.log.ip') }}</th>
									<th class="text-nowrap text-center">{{ trans('action.log.browser') }}</th>
									<th class="text-nowrap text-center">{{ trans('action.action') }}</th>
									<th class="text-nowrap text-center">{{ trans('action.log.table') }}</th>
									<th class="text-nowrap text-center">{{ trans('action.log.create_at') }}</th>
									<th class="text-nowrap text-center">*</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($logs as $log)
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
					{!! $logs->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
