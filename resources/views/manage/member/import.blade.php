@extends('layouts.manage.app')
@section('title', trans('action.user.title').trans('action.import'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('member.import') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-header">
                        <h4><i class="fas fa-user-circle"></i> {{ trans('action.user.title').trans('action.import') }}</h4>
                    </div>

                    <div class="card-body">
                        @if (isset($failures))
                            <div class="alert alert-danger" role="alert">
                                <strong>Errors:</strong>

                                <ul>
                                    @foreach ($failures as $failure)
                                        @foreach ($failure->errors() as $error)
                                            <li>{{ $failure->row() }}{{ $error }}</li>
                                        @endforeach
                                        {{-- <li>{{ $failure->row() }}</li>
                                        <li>{{ $failure->attribute() }}</li>
                                        <li>{{ $failure->errors() }}</li>
                                        <li>{{ $failure->values() }}</li> --}}
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('member.index')) }}</li>
                        </ul>
                        @csrf
                        <div class="form-group">
                            {{-- <label for="file" class="bmd-label-floating"></label> --}}
                            <input type="file" class="form-control-file @error('file') is-invalid @enderror" name="file" id="file">

                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" class="btn btn-raised btn-primary" value="{{ trans('action.import') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
