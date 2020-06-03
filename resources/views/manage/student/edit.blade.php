@extends('layouts.manage.app')
@section('title', trans('action.student.student').trans('action.edit'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-user-graduate"></i> {{ trans('action.student.student').trans('action.edit') }}</h4>
                </div>

                <div class="card-body">
                	<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('student.index')) }}</li>
					</ul>
                	<form method="POST" action="{{ route('student.update' , $student->id) }}">
                		@csrf
						@method('PUT')

                        <div class="form-group">
                            <label for="name">{{ trans('action.student.name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $student->name }}" required autocomplete="{{ trans('action.student.name') }}" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="student_id">{{ trans('action.student.student_id') }}</label>
                            <input id="student_id" name="student_id" type="text" class="form-control @error('student_id') is-invalid @enderror" value="{{ $student->student_id }}" required autocomplete="{{ trans('action.student.student_id') }}" autofocus>

                            @error('student_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="course">{{ trans('action.student.course') }}</label>
                            <select class="form-control @error('course') is-invalid @enderror" id="course" name='course' required aria-describedby="typeHelp" placeholder="{{ trans('action.user.course') }}">
                                <option value=''>{{ trans('action.choose')}}{{ trans('action.student.course')}}</option>
                                @foreach($all_courses as $course )
                                    @if ($course->name == $student->course)
                                        <option value='{{ $course->name }}' selected>{{ $course->name }}</option>
                                    @else
                                        <option value='{{ $course->name }}' >{{ $course->name }}</option>
                                    @endif
                                @endforeach

                            </select>
                            @error('course')
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
