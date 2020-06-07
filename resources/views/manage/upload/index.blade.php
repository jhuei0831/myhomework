@extends('layouts.manage.app')
@section('title', trans('action.upload.upload').trans('action.manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-clipboard-list"></i> {{ trans('action.upload.upload').' '.trans('action.manage') }}</h4>
                </div>
                <div class="card-body">
                	<form action="{{ route('upload.search') }}" method="post">
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
                                    <label>{{ trans('action.upload.student_id') }}</label>
                                    <input type="text" class="form-control" name="student_id">
                                </div>

                                <div class='form-group col-md-3'>
                                    <label>{{ trans('action.upload.homework') }}</label>
                                    <input type="text" class="form-control" name="homework">
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
									<th class="text-nowrap text-center">{{ trans('action.upload.id') }}</th>
									<th class="text-nowrap text-center">{{ trans('action.upload.student_id') }}</th>
									<th class="text-nowrap text-center">{{ trans('action.upload.homework') }}</th>
									<th class="text-nowrap text-center">{{ trans('action.upload.grade') }}</th>
									<th class="text-nowrap text-center">{{ trans('action.upload.updated_at') }}</th>
									<th class="text-nowrap text-center">*</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($uploads as $upload)
									<tr>
										<td>{{ $upload->id }}</td>
										<td>{{ $upload->student->student_id }}</td>
										<td>{{ $upload->homework->subject }}</td>
										<td>{{ $upload->grade }}</td>
										<td>{{ $upload->updated_at }}</td>
										<td>
											<form action="{{ route('upload.edit',$upload->id) }}" method="GET">
											@csrf
											{{ App\Button::edit($upload->id) }}
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
                </div>
                <div class="card-footer pagination justify-content-center table-responsive">
					{!! $uploads->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
