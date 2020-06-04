@extends('layouts.manage.app')
@section('title', trans('action.course.course').trans('action.manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i> {{ trans('action.course.course').trans('action.manage') }}</h4>
                </div>

                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
					</ul>
					<div class="table-responsive">
						<table id="data" class="table table-hover table-bordered text-center">
		                	<thead>
		                		<tr class="table-info active">
		                			<th class="text-nowrap text-center">{{ trans('action.course.name') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.course.teacher') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('action.course.description') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('action.action') }}</th>
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_courses as $course)
									<tr>
										<td>{{ $course->name }}</td>
                                        <td>{{ $course->teacher }}</td>
										<td>{{ $course->description }}</td>
										<td>
                                            <div class="dropdown">
                                                <button class="btn bmd-btn-icon dropdown-toggle" type="button" id="ex1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="ex1">
                                                    <form action="{{ route('course.edit',$course->id) }}" method="GET">
                                                        @csrf
                                                        {{ App\Button::edit($course->id) }}
                                                    </form>
                                                    <form action="{{ route('course.destroy',$course->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        {{ App\Button::deleting($course->id) }}
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
                {{-- <div class="card-footer pagination justify-content-center">
					{!! $all_courses->links("pagination::bootstrap-4") !!}
				</div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
