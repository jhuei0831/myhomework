@extends('layouts.manage.app')
@section('title', __('Notice').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Notice').__('Manage') }}</div>

                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ __('Filter') }}</a></li>
					</ul>
					{{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
	                    <div class="form-group row">
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Title') }}</label>
							<div id="filter_col1" data-column="0" class='col-md-3'>
								<input type="text" class="form-control column_filter" id="col0_filter">
							</div>
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Menu') }}</label>
							<div id="filter_col2" data-column="1" class='col-md-3'>
								<input type="text" class="form-control column_filter" id="col1_filter">
							</div>
						</div>
						<div class="form-group row">
							{{-- 選擇隱藏爛位 --}}
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Is_open') }}</label>
							<div id="filter_col3" data-column="2" class='col-md-3'>
								<select class="form-control column_filter" id="col2_filter">
									<option value="">{{ __('All') }}</option>
									<option value="1">{{ __('Yes') }}</option>
									<option value="0">{{ __('No') }}</option>
								</select>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table id="data" class="table table-hover table-bordered text-center">
		                	<thead>
		                		<tr class="table-info active">
									<th class="text-nowrap text-center">{{ __('Title') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Menu') }}</th>
		                			{{-- 設置隱藏爛位提供篩選 --}}
		                			<th class="text-nowrap text-center" style="display:none">{{ __('Is_open') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Is_open') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Action') }}</th>
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_notices as $notice)
									<tr>
										<td>{{ $notice->title }}</td>
										<td>{{ App\Menu::where('id','=',$notice->menu_id)->first('name')['name'] }}</td>
										{{-- 設置隱藏爛位提供篩選 --}}
										<td style="display:none">{{ $notice->is_open }}</td>
										<td>
											<font color="{{App\Enum::is_open['color'][$notice->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$notice->is_open]}}"></i></font>
										</td>
										<td>
											<form action="{{ route('notice.edit',$notice->id) }}" method="GET">
											@csrf
											{{ App\Button::edit($notice->id) }}
											</form>
											<form action="{{ route('notice.destroy',$notice->id) }}" method="POST">
											@method('DELETE')
											@csrf
											{{ App\Button::deleting($notice->id) }}
											</form>
										</td>
									</tr>
		                		@endforeach
		                	</tbody>
	                    </table>
					</div>

                </div>
                {{-- <div class="card-footer pagination justify-content-center">
					{!! $all_notices->links("pagination::bootstrap-4") !!}
				</div> --}}
            </div>
        </div>
    </div>
</div>
@endsection


