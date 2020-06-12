@extends('layouts.manage.app')
@section('title', trans('action.student.student').trans('action.import.import'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('student.import') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-header text-white bg-info">
                        <h4><i class="fas fa-user-graduate"></i> {{ trans('action.student.student').trans('action.import.import') }}</h4>
                    </div>

                    <div class="card-body">

                        @if (isset($failures))
                            <div class="alert alert-danger" role="alert">
                                <strong><h4>{{ trans('action.import.some_errors') }}</h4></strong>
                                <ul>
                                    @foreach ($failures as $failure)
                                        @foreach ($failure->errors() as $error)
                                            <li>Row : {{ $failure->row() }}. {{ trans($error) }}</li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('student.index')) }}</li>
                        </ul>
                        @csrf
                        <div class="form-group">
                            {{-- <label for="file" class="bmd-label-floating"></label> --}}
                            <input type="file" class="form-control-file @error('file') is-invalid @enderror" name="file" id="file" required>

                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" class="btn btn-raised btn-primary" value="{{ trans('action.import.import') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
