@extends('layouts.manage.app')
@section('title', trans('action.homework.homework').trans('action.create'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('homework.store') }}" method="POST">
                    <div class="card-header">
                        <h4><i class="fas fa-book-open"></i> {{ trans('action.homework.homework').trans('action.create') }}</h4>
                        </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('homework.index')) }}</li>
                        </ul>
                        @csrf
                        <div class="form-group">
                            <label for="subject">{{ trans('action.homework.subject') }}</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" placeholder="{{ trans('action.homework.subject') }}" required>
                            @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="course">{{ trans('action.homework.course') }}</label>
                            <select class="form-control @error('course') is-invalid @enderror" id="course" name='course' required aria-describedby="typeHelp" value="{{ old('course') }}" placeholder="{{ trans('action.user.course') }}">
                                <option value=''>{{ trans('action.choose')}}{{ trans('action.homework.course')}}</option>
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

                        <div class="form-group">
                            <label for="description">{{ trans('action.homework.description') }}</label><br>
                            <textarea id="content" name="description" class="form-control" required>{!! old('description') !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="deadline">{{ trans('action.homework.deadline') }}</label>
                            <input id="datepicker1" type="text" class="form-control" name="deadline" autocomplete="off" />
                            @error('deadline')
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
