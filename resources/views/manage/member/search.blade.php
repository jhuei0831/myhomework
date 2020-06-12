@extends('layouts.manage.app')
@section('title', trans('action.user.title').trans('action.manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-info">
                    <h4><i class="fas fa-user-circle"></i> {{ trans('action.user.title').trans('action.manage') }}</h4>
                </div>

                <div class="card-body">
                	<form action="{{ route('member.search') }}" method="post">
					@csrf
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ trans('action.filter') }}</a></li>
						<li class="list-inline-item">{{ App\Button::To(false,route('member.index'),trans('action.reset'),null,'btn-secondary','undo') }}</li>
					</ul>
					{{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
                        <div class="form-row">
                            <div class='form-group col-md-3'>
                                <label for="name">{{ trans('action.user.name') }}</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class='form-group col-md-3'>
                                <label for="email">{{ trans('action.user.email') }}</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                            {{-- 選擇隱藏爛位 --}}
                            <div class='form-group col-md-3'>
                                <label for="permission">{{ trans('action.user.permission') }}</label>
                                <select class="form-control" name="permission" id="permission">
                                    <option value="">{{ trans('All') }}</option>
                                    @foreach (App\Enum::permission as $key => $value)
                                        <option value="{{ $key }}">{{ trans($value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class='form-group col-md-3'>
                                <label for="student_id">{{ trans('action.user.student_id') }}</label>
                                <input type="text" class="form-control" name="student_id" id="student_id">
                            </div>
                            <button type="submit" class="btn btn-sm btn-secondary">
                                <i class="fas fa-search"></i> {{ trans('action.search') }}
                            </button>
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
								@foreach ($users_search as $user)
									<tr>
										<td>{{ $user->name }}</td>
                                        <td>{{ $user->student_id }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td style="display:none">{{ $user->permission }}</td>
                                        <td>{{ trans(App\Enum::permission[$user->permission]) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn bmd-btn-icon dropdown-toggle" type="button" id="ex1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="ex1">
                                                    <form action="{{ route('member.edit',$user->id) }}" method="GET">
                                                        @csrf
                                                        {{ App\Button::edit($user->id) }}
                                                    </form>
                                                    <form action="{{ route('member.destroy',$user->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        {{ App\Button::deleting($user->id) }}
                                                    </form>
                                                </div>
                                            </div>
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
