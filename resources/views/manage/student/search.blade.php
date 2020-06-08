@extends('layouts.manage.app')
@section('title', trans('action.student.student').trans('action.search'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-user-graduate"></i> {{ trans('action.student.student').trans('action.search') }}</h4>
                </div>

                <div class="card-body">
                	<form action="{{ route('student.search') }}" method="post">
					@csrf
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ trans('action.filter') }}</a></li>
						<li class="list-inline-item">{{ App\Button::To(false,route('student.index'),trans('action.reset'),null,'btn-secondary','undo') }}</li>
					</ul>
					{{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
                        <div class="form-row">
                            <div class='form-group col-md-3'>
                                <label for="name">{{ trans('action.student.name') }}</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class='form-group col-md-3'>
                                <label for="student_id">{{ trans('action.student.student_id') }}</label>
                                <input type="text" class="form-control" name="student_id" id="student_id">
                            </div>
                            <div class='form-group col-md-3'>
                                <label for="course">{{ trans('action.student.course') }}</label>
                                <input type="text" class="form-control" name="course" id="course">
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
		                			<th class="text-nowrap text-center">{{ trans('action.student.name') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.student.student_id') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.student.course') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.action') }}</th>
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($students_search as $student)
									<tr>
										<td>{{ $student->name }}</td>
                                        <td>{{ $student->student_id }}</td>
                                        <td>{{ $student->course }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn bmd-btn-icon dropdown-toggle" type="button" id="ex1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="ex1">
                                                    <form action="{{ route('student.edit',$student->id) }}" method="GET">
                                                        @csrf
                                                        {{ App\Button::edit($student->id) }}
                                                    </form>
                                                    <form action="{{ route('student.destroy',$student->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        {{ App\Button::deleting($student->id) }}
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
					{!! $students_search->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
