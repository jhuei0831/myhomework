@extends('layouts.manage.app')
@section('title', trans('action.student.student').trans('action.manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-user-graduate"></i> {{ trans('action.student.student').trans('action.manage') }}</h4>
                </div>

                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
					</ul>
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
								@foreach ($all_students as $student)
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
					{!! $all_students->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
