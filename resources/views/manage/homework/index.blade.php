@extends('layouts.manage.app')
@section('title', trans('action.homework.homework').trans('action.manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book-open"></i> {{ trans('action.homework.homework').trans('action.manage') }}</h4>
                </div>

                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ trans('action.filter') }}</a></li>
					</ul>
                    {{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
	                    <div class="form-row">
                            <div id="filter_col2" data-column="1" class='form-group col-md-3'>
                                <label>{{ trans('action.homework.subject') }}</label>
                                <input type="text" class="form-control column_filter" id="col1_filter">
                            </div>
							<div id="filter_col1" data-column="0" class='form-group col-md-3'>
                                <label>{{ trans('action.homework.course') }}</label>
								<input type="text" class="form-control column_filter" id="col0_filter">
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table id="data" class="table table-hover table-bordered text-center">
		                	<thead>
		                		<tr class="table-info active">
									<th class="text-nowrap text-center">{{ trans('action.homework.course') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('action.homework.subject') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('action.homework.deadline') }}</th>
		                			<th class="text-nowrap text-center">{{ trans('action.action') }}</th>
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_homeworks as $homework)
									<tr>
										<td>{{ $homework->course }}</td>
										<td><a data-toggle="collapse" href="#{{ $homework->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">{{ $homework->subject }}</a></td>
                                        <td>{{ $homework->deadline }}</td>
										<td>
                                            <div class="dropdown">
                                                <button class="btn bmd-btn-icon dropdown-toggle" type="button" id="ex1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="ex1">
                                                    <form class="d-inline" action="{{ route('homework.edit',$homework->id) }}" method="GET">
                                                    @csrf
                                                    {{ App\Button::edit($homework->id) }}
                                                    </form>
                                                    <form class="d-inline" action="{{ route('homework.destroy',$homework->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    {{ App\Button::deleting($homework->id) }}
                                                    </form>
                                                </div>
                                            </div>
										</td>
									</tr>
                                    <tr class="collapse" id="{{ $homework->id }}">
                                        <td align="left" colspan="6">
                                            <div class="card">
                                                <div class="card-body">
                                                    {!! $homework->description !!}
                                                </div>
                                                <div class="card-footer">
                                                    123
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
					{!! $all_homeworks->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@parent
<script>

    // Swal.fire('Any fool can use a computer')
</script>
@show
