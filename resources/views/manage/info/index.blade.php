@extends('layouts.manage.app')
@section('title', trans('action.info.info').trans('action.manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ trans('action.info.info').trans('action.manage') }}</div>

                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item">{{ App\Button::To(true,'sort',trans('action.sort'),'','btn-primary') }}</li>
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ trans('action.filter') }}</a></li>
					</ul>
					<div class="alert alert-warning" role="alert">
                        {{ trans('action.info.notice') }}
                    </div>
                    {{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
	                    <div class="form-row">
							<div id="filter_col1" data-column="0" class='form-group col-md-3'>
                                <label>{{ trans('action.info.title') }}</label>
								<input type="text" class="form-control column_filter" id="col0_filter">
							</div>
							<div id="filter_col2" data-column="1" class='form-group col-md-3'>
                                <label>{{ trans('action.info.editor') }}</label>
								<input type="text" class="form-control column_filter" id="col1_filter">
							</div>
							{{-- 選擇隱藏爛位 --}}
							<div id="filter_col3" data-column="2" class='form-group col-md-3'>
                                <label>{{ trans('action.info.is_open') }}</label>
								<select class="form-control column_filter" id="col2_filter">
									<option value="">{{ trans('action.all') }}</option>
									<option value="1">{{ trans('action.yes') }}</option>
									<option value="0">{{ trans('action.no') }}</option>
								</select>
							</div>
							<div id="filter_col4" data-column="3" class='form-group col-md-3'>
                                <label>{{ trans('action.info.is_sticky') }}</label>
								<select class="form-control column_filter" id="col3_filter">
									<option value="">{{ trans('action.all') }}</option>
									<option value="1">{{ trans('action.yes') }}</option>
									<option value="0">{{ trans('action.no') }}</option>
								</select>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table id="data" class="table table-hover table-bordered text-center">
		                	<thead>
		                		<tr class="table-info active">
									<th class="text-nowrap text-center">{{ trans('action.info.title') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('action.info.editor') }}</th>
		                			{{-- 設置隱藏爛位提供篩選 --}}
		                			<th class="text-nowrap text-center" style="display:none"></th>
		                			<th class="text-nowrap text-center" style="display:none"></th>
		                			<th class="text-nowrap text-center">{{ trans('action.info.is_open') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('action.info.is_sticky') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('action.info.created_at') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('action.info.updated_at') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('action.action') }}</th>
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_infos as $info)
									<tr>
										<td>{{ $info->title }}</td>
										<td>{{ $info->editor }}</td>
										{{-- 設置隱藏爛位提供篩選 --}}
										<td style="display:none">{{ $info->is_open }}</td>
										<td style="display:none">{{ $info->is_sticky }}</td>
										<td>
											<font color="{{App\Enum::is_open['color'][$info->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$info->is_open]}}"></i></font>
										</td>
										<td>
											<font color="{{App\Enum::is_open['color'][$info->is_sticky]}}"><i class="fas fa-{{App\Enum::is_open['label'][$info->is_sticky]}}"></i></font>
										</td>
										<td>{{ $info->created_at }}</td>
										<td>{{ $info->updated_at }}</td>
										<td>
											<form class="d-inline" action="{{ route('info.edit',$info->id) }}" method="GET">
											@csrf
											{{ App\Button::edit($info->id) }}
											</form>
											<form class="d-inline" action="{{ route('info.destroy',$info->id) }}" method="POST">
											@method('DELETE')
											@csrf
											{{ App\Button::deleting($info->id) }}
											</form>
										</td>
									</tr>
		                		@endforeach
		                	</tbody>
	                    </table>
					</div>
                </div>
                {{-- <div class="card-footer pagination justify-content-center">
					{!! $all_infos->links("pagination::bootstrap-4") !!}
				</div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
