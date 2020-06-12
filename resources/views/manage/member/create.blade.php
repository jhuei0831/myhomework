@extends('layouts.manage.app')
@section('title', trans('action.user.title').trans('action.create'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('member.store') }}" method="POST">
                    <div class="card-header text-white bg-info">
                        <h4><i class="fas fa-user-circle"></i> {{ trans('action.user.title').trans('action.create') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('member.index')) }}</li>
                        </ul>
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('action.user.name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="{{ trans('action.user.name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="student_id">{{ trans('action.user.student_id') }}</label>
                            <input type="text" class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" value="{{ old('student_id') }}" placeholder="{{ trans('action.user.student_id') }}">
                            @error('student_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">{{ trans('action.user.email') }}</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="{{ trans('action.user.email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="permission">{{ trans('action.user.permission') }}</label>
                            <select class="form-control @error('permission') is-invalid @enderror" id="permission" name='permission' required aria-describedby="typeHelp" value="{{ old('permission') }}" placeholder="{{ trans('action.user.permission') }}">
                                <option value=''>{{ trans('action.choose')}}{{ trans('action.user.permission')}}</option>
                                @foreach(App\Enum::permission as $key => $value)
                                    <option value='{{ $key }}'>{{ trans($value) }}</option>
                                @endforeach
                            </select>
                            @error('permission')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">{{ trans('action.user.password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="{{ trans('action.user.password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="content">{{ trans('action.user.confirm') }}</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ trans('action.user.confirm') }}">
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
