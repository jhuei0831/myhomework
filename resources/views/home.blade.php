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
                                    <th>{{ trans('homework.file') }}</th>
                                    <th>{{ trans('homework.grade') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    print_r($homeworks);
                                @endphp
                                {{-- @foreach ($students as $student)
                                    @foreach ($student->homeworks as $homework)
                                        <tr>
                                            <td>{{ $homework->subject }}</td>
                                            <td>
                                                <button data-toggle="collapse" class="btn btn-sm des" value="{!! $homework->description !!}" href="#{{ $homework->id }}" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-eye"></i></button>
                                            </td>
                                            <td>{{ $homework->deadline }}</td>
                                            @if (json_encode($homework->uploads) != '[]')
                                                @foreach ($homework->uploads as $upload)
                                                    @if ($upload->homework_id == $homework->id)
                                                        <td>{{ $upload->updated_at }}&nbsp;</td>
                                                        <td>
                                                            <a href="#" data-toggle="collapse" data-target="#{{ $homework->subject }}" aria-expanded="true" aria-controls="collapseOne"><i class="fas fa-file-upload"></i></a>
                                                            <a target='_blank' href="{{ asset('storage/uploads/homework/'.$homework->subject.'/'.$upload->file) }}"><i class="fas fa-file-alt"></i></a>
                                                        </td>
                                                        <td>{{ $upload->grade }}</td>                                                     
                                                    @endif 
                                                @endforeach     
                                            @else
                                                <td></td>
                                                <td><a href="#" data-toggle="collapse" data-target="#{{ $homework->subject }}" aria-expanded="true" aria-controls="collapseOne"><i class="fas fa-file-upload"></i></a>
                                                <td></td>    
                                            @endif  
                                        </tr>
                                        <tr id="{{ $homework->subject }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <td align="left" colspan="6">
                                                <div class="card">
                                                    <div class="card-body text-center">
                                                        <form method="POST" action="{{ route('homework.upload' , [$homework->id, $student->id]) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('POST')
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                                                                    @error('file')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <input type="submit" class="btn btn-raised btn-primary" value="{{ trans('action.upload.upload') }}" {{ ($homework->deadline <= now()) ? "disabled" : "" }}>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>  
                                    @endforeach
                                @endforeach --}}
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
    $('.des').on('click',function () {
        event.preventDefault();
        let description = $(this).val();
        Swal.fire({
            title: "{{ trans('action.homework.description') }}",
            html: description,
            width: '80%',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: '{{ trans('action.confirm') }}',
            })
    });
    // Swal.fire('Any fool can use a computer')
</script>
@show
