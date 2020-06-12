@extends('layouts.manage.app')
@section('title', trans('action.course.course').trans('action.create'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('course.store') }}" method="POST">
                    <div class="card-header text-white bg-info">
                        <h4><i class="fas fa-book"></i> {{ trans('action.course.course').trans('action.create') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('course.index')) }}</li>
                        </ul>
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('action.course.name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="{{ trans('action.course.name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="teacher">{{ trans('action.course.teacher') }}</label>
                            <input type="text" class="form-control @error('teacher') is-invalid @enderror" id="teacher" name="teacher" value="{{ old('teacher') }}" placeholder="{{ trans('action.course.teacher') }}">
                            @error('teacher')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('action.course.description') }}</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" placeholder="{{ trans('action.course.description') }}">
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" class="btn btn-raised btn-primary" value="{{ trans('action.create') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
