@extends('layouts.manage.app')
@section('title', trans('action.homework.homework').trans('action.edit'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-info">
                    <h4><i class="fas fa-book-open"></i> {{ trans('action.homework.homework').trans('action.edit') }}</h4>
                </div>

                <div class="card-body">
                	<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('homework.index')) }}</li>
					</ul>
                	<form method="POST" action="{{ route('homework.update' , $homework->id) }}">
                		@csrf
						@method('PUT')

                        <div class="form-group">
                            <label for="subject">{{ trans('action.homework.subject') }}</label>
                            <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ $homework->subject }}" required autocomplete="{{ trans('subject') }}" autofocus readonly>

                            @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="course">{{ trans('action.homework.course') }}</label>
                            <select class="form-control @error('course') is-invalid @enderror" id="course" name='course' required aria-describedby="typeHelp" placeholder="{{ trans('action.user.course') }}">
                                <option value=''>{{ trans('action.choose')}}{{ trans('action.homework.course')}}</option>
                                @foreach($all_courses as $course )
                                    @if ($course->name == $homework->course)
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

                        <div class="form-group">
                            <label for="description">{{ trans('action.homework.description') }}</label><br>
                            <textarea id="content" name="description" class="form-control ckeditor" >{{ $homework->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="deadline">{{ trans('action.homework.deadline') }}</label>
                            <input id="datepicker1" type="text" class="form-control" name="deadline" value="{{ $homework->deadline }}" autocomplete="off" />
                            @error('deadline')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

		                <div class="card-footer text-center">
		                    <input type="submit" class="btn btn-raised btn-primary" value="{{ trans('action.submit') }}">
		                </div>
                	</form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
