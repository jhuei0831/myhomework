@extends('layouts.manage.app')
@section('title', __('Member').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Member').__('Manage') }}</div>

                <div class="card-body">
                	<form action="{{ route('member.search') }}" method="post">
					@csrf
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ __('Filter') }}</a></li>
						<li class="list-inline-item">{{ App\Button::To(false,route('member.index'),__('Reset'),null,'btn-secondary','undo') }}</li>
						<li class="list-inline-item collapse" id="search"><button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-search"></i> {{ __('Search') }}</button></li>
					</ul>
					{{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
	                    <div class="form-group row">
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Name') }}</label>
							<div class='col-md-3'>
								<input type="text" name="name" class="form-control">
							</div>
							<label class='col-md-2 col-form-label text-md-right'>{{ __('E-Mail Address') }}</label>
							<div class='col-md-3'>
								<input type="text" name="email" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							{{-- 選擇隱藏爛位 --}}
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Permission') }}</label>
							<div class='col-md-3'>
								<select class="form-control" name="permission">
									<option value="">{{ __('All') }}</option>
									@foreach (App\Enum::permission as $key => $value)
										<option value="{{ $key }}">{{ $value }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					</form>
					<div class="table-responsive">
						<table id="data" class="table table-hover table-bordered text-center">
		                	<thead>
		                		<tr class="table-info active">
		                			<th class="text-nowrap text-center">{{ __('Name') }}</th>
		                			<th class="text-nowrap text-center">{{ __('E-Mail Address') }}</th>
		                			<th class="text-nowrap text-center" style="display:none">{{ __('Permission') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Permission') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Action') }}</th>
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($users_search as $user)
									<tr>
										<td>{{ $user->name }}</td>
										<td>{{ $user->email }}</td>
										<td style="display:none">{{ $user->permission }}</td>
										<td>{{App\Enum::permission[$user->permission]}}</td>
										<td>
											<form action="{{ route('member.edit',$user->id) }}" method="GET">
											@csrf
											{{ App\Button::edit($user->id) }}
											</form>
											<form action="{{ route('member.destroy',$user->id) }}" method="POST">
											@method('DELETE')
											@csrf
											{{ App\Button::deleting($user->id) }}
											</form>
										</td>
									</tr>
		                		@endforeach
		                	</tbody>
	                    </table>
					</div>
                </div>
                <div class="card-footer pagination justify-content-center">
					{!! $users_search->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
