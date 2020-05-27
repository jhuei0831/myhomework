@extends('layouts.manage.app')
@section('title', __('Information').__('Sort'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{__('Information').__('Sort')}}</div>

                <div class="card-body">
					<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('info.index')) }}</li>
					</ul>
                    <div class="alert alert-warning" role="alert">
                        1. 請直接拖曳目標列進行排序。<br>
                        2. 調整完請點重新整理進行確認。
                    </div>
                	<table id="table" class="table table-hover table-bordered text-center">
	                	<thead>
	                		<tr class="table-info active">
	                			<th class="text-nowrap text-center">{{__('Information').__('Title')}}</th>
	                			<th class="text-nowrap text-center">{{ __('Created_at') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Sort') }}</th>
	                		</tr>
	                	</thead>
	                	<tbody id="tablecontents">
							@foreach ($info_stickys as $info)
								<tr class="row1" data-id="{{ $info->id }}">
									<td class="pl-3">{{ $info->title }}</td>
                                    <td>{{ $info->created_at }}</td>
									<td>{{ $info->sort }}</td>
								</tr>
	                		@endforeach
	                	</tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                	<h5><button class="btn btn-success btn-sm" onclick="window.location.reload()">{{ __('Refresh') }}</button></h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@parent
<script type="text/javascript">
    $(function () {
        // $("#table").DataTable();

        $("#tablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {
            var order = [];
            var token = $('meta[name="csrf-token"]').attr('content');
            $('tr.row1').each(function(index,element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('info-sortable') }}",
                data: {
                    order: order,
                    _token: token
                },
                success: function(response) {
                    if (response.status == "success") {
                      console.log(response);
                    } else {
                      console.log(response);
                    }
                }
            });
        }
    });
</script>
@show
