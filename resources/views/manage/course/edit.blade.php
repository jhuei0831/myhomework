@extends('layouts.manage.app')
@section('title', trans('action.course.title').trans('action.edit'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i> {{ trans('action.course.course').trans('action.edit') }}</h4>
                </div>

                <div class="card-body">
                	<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('course.index')) }}</li>
					</ul>
                	<form method="POST" action="{{ route('course.update' , $course->id) }}">
                		@csrf
						@method('PUT')

                        <div class="form-group">
                            <label for="name">{{ trans('action.course.name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $course->name }}" required autocomplete="{{ trans('action.course.name') }}" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="teacher">{{ trans('action.course.teacher') }}</label>
                            <input id="teacher" name="teacher" type="text" class="form-control @error('teacher') is-invalid @enderror" value="{{ $course->teacher }}" required autocomplete="{{ trans('action.course.teacher') }}" autofocus>

                            @error('teacher')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">{{ trans('action.course.description') }}</label>
                            <input id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $course->description }}" required autocomplete="{{ trans('action.course.description') }}" autofocus>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="text-center">
                            <input type="submit" class="btn btn-raised btn-primary" value="{{ trans('action.confirm') }}">
                        </div>
                	</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
