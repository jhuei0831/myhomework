@extends('layouts.manage.app')
@section('title', trans('action.user.title').trans('action.create'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-user-circle"></i> {{ trans('action.user.title').trans('action.manage') }}</h4>
                </div>

                <div class="card-body">
                	<form action="{{ route('member.search') }}" method="post">
					@csrf
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ trans('Filter') }}</a></li>
						<li class="list-inline-item collapse" id="search"><button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-search"></i> {{ trans('Search') }}</button></li>
					</ul>
					{{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
	                    <div class="form-group">
							<label class='col-md-2 col-form-label text-md-right'>{{ trans('action.user.name') }}</label>
							<div class='col-md-3'>
								<input type="text" class="form-control" name="name">
							</div>
							<label class='col-md-2 col-form-label text-md-right'>{{ trans('action.user.email') }}</label>
							<div class='col-md-3'>
								<input type="text" class="form-control" name="email">
							</div>
						</div>
						<div class="form-group">
							{{-- 選擇隱藏爛位 --}}
							<label class='col-md-2 col-form-label text-md-right'>{{ trans('action.user.permission') }}</label>
							<div class='col-md-3'>
								<select class="form-control" name="permission">
									<option value="">{{ trans('All') }}</option>
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
		                			<th class="text-nowrap text-center">{{ trans('action.user.name') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.user.student_id') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('action.user.email') }}</th>
		                			<th class="text-nowrap text-center" style="display:none"></th>
		                			<th class="text-nowrap text-center">{{ trans('action.user.permission') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('action.action') }}</th>
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_users as $user)
									<tr>
										<td>{{ $user->name }}</td>
                                        <td>{{ $user->student_id }}</td>
										<td>{{ $user->email }}</td>
										<td style="display:none">{{ $user->permission }}</td>
										<td>{{ trans(App\Enum::permission[$user->permission]) }}</td>
										<td>
                                            <form action="{{ route('member.edit',$user->id) }}" method="GET">
                                                @csrf
                                                {{ App\Button::edit($user->id) }}
                                            </form>
                                            <form  action="{{ route('member.destroy',$user->id) }}" method="POST">
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
					{!! $all_users->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
