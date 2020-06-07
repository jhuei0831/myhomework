@extends('layouts.home.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-info">
                    <h4><i class="fas fa-list-ul"></i> {{ trans('homework.list') }}</h4>
                </div>

                <div class="card-body bg-light">
                    <div id="accordion" class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr class="table-info active">
                                    <th>{{ trans('homework.subject') }}</th>
                                    <th>{{ trans('homework.description') }}</th>
                                    <th>{{ trans('homework.end_time') }}</th>
                                    <th>{{ trans('homework.hand_in_time') }}</th>
                                    <th>{{ trans('homework.grade') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    @foreach ($student->homeworks as $homework)
                                        <tr>
                                            <td>{{ $homework->subject }}</td>
                                            <td>
                                                <a href="#" data-toggle="collapse" data-target="#{{ $homework->subject }}" aria-expanded="true" aria-controls="collapseOne"><i class="fas fa-chevron-circle-down"></i></a>
                                            </td>
                                            <td>{{ $homework->deadline }}</td>
                                            @foreach ($student->uploads as $upload)
                                                @if ($upload->homework_id == $homework->id)
                                                    <td>{{ $upload->updated_at }}</td>
                                                    <td>{{ $upload->grade }}</td>
                                                @endif 
                                            @endforeach 
                                        </tr>
                                        <tr id="{{ $homework->subject }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <td align="left" colspan="6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        {!! $homework->description !!}
                                                    </div>
                                                    <div class="card-footer text-center">
                                                        <form method="POST" action="{{ route('homework.upload' , [$homework->id, $student->id]) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('POST')
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                                                                    <span class='input-group-text'>
                                                                        @if($config->background)
                                                                        <a target='_blank' href="{{ asset('storage/uploads/images/'.$config->background) }}"><i class="far fa-image"></i>&nbsp;觀看檔案</a>
                                                                        @else
                                                                        <a href="#"><i class="fas fa-times-circle"></i>&nbsp;目前沒有檔案</a>
                                                                        @endif
                                                                    </span>
                                                                    @error('file')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <input type="submit" class="btn btn-raised btn-primary" value="{{ trans('action.upload.upload') }}">
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>  
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@parent
<script>
    $('.btn-upload').on('click',function () {
        Swal.fire({
            title: '<strong>HTML <u>example</u></strong>',
            html:
                '<form></form>',
            showCloseButton: true,
            showCancelButton: false,
            showConfirmButton: false,
        })
    });
</script>
@show
