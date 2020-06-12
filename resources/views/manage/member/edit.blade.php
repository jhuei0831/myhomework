@extends('layouts.manage.app')
@section('title', trans('action.user.title').trans('action.edit'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-info">
                    <h4><i class="fas fa-user-circle"></i> {{ trans('action.user.title').trans('action.edit') }}</h4>
                </div>

                <div class="card-body">
                	<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('member.index')) }}</li>
					</ul>
                	<form method="POST" action="{{ route('member.update' , $user->id) }}">
                		@csrf
						@method('PUT')

                        <div class="form-group">
                            <label for="name">{{ trans('action.user.name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="{{ trans('action.user.name') }}" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="student_id">{{ trans('action.user.student_id') }}</label>
                            <input id="student_id" type="text" class="form-control" value="{{ $user->student_id }}" autocomplete="{{ trans('action.user.student_id') }}" autofocus readonly>
                        </div>

                        <div class="form-group">
                            <label for="email">{{ trans('action.user.email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="{{ trans('action.user.email') }}" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="permission">{{ trans('action.user.permission') }}</label>
                            <select class="form-control @error('permission') is-invalid @enderror" id="permission" name='permission' required>
                                @foreach(App\Enum::permission as $key => $value)
                                    @if ($key == $user->permission)
                                        <option value='{{ $key }}' selected>{{ trans($value) }}</option>
                                    @else
                                        <option value='{{ $key }}'>{{ trans($value) }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('permission')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ trans('action.user.password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ trans('action.user.confirm') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
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
