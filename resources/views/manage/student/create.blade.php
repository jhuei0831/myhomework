@extends('layouts.manage.app')
@section('title', trans('action.student.student').trans('action.create'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('student.store') }}" method="POST">
                    <div class="card-header">
                        <h4><i class="fas fa-user-graduate"></i> {{ trans('action.student.student').trans('action.create') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('student.index')) }}</li>
                        </ul>
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('action.student.name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="{{ trans('action.student.name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="student_id">{{ trans('action.student.student_id') }}</label>
                            <input type="text" class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" value="{{ old('student_id') }}" placeholder="{{ trans('action.student.student_id') }}">
                            @error('student_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="course">{{ trans('action.student.course') }}</label>
                            <select class="form-control @error('course') is-invalid @enderror" id="course" name='course' required aria-describedby="typeHelp" value="{{ old('course') }}" placeholder="{{ trans('action.user.course') }}">
                                <option value=''>{{ trans('action.choose')}}{{ trans('action.student.course')}}</option>
                                @foreach($all_courses as $course )
                                    <option value='{{ $course->name }}'>{{ $course->name }}</option>
                                @endforeach

                            </select>
                            @error('course')
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
