@extends('layouts.manage.app')
@section('title', trans('action.info.info').trans('action.create'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('info.store') }}" method="POST">
                    <div class="card-header">{{ trans('action.info.info').trans('action.create') }}</div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('info.index')) }}</li>
                        </ul>
                        @csrf
                        <div class="form-group">
                            <label for="title">{{ trans('action.info.title') }}</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="{{ trans('action.info.title') }}" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">{{ trans('action.info.content') }}</label>
                            <textarea id="content" name="content" class="form-control" required>{!! old('content') !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="is_open">{{ trans('action.info.is_open') }}</label>
                            <select class="form-control @error('is_open') is-invalid @enderror" id="is_open" name='is_open' required aria-describedby="typeHelp" placeholder="{{ trans('action.info.is_open') }}">
                                <option value=''>{{ trans('action.choose')}}{{ trans('action.info.is_open')}}</option>
                                <option value='1' {{ (old('is_open')=="1")? "selected" : "" }}>{{ trans('action.yes') }}</option>
                                <option value='0' {{ (old('is_open')=="0")? "selected" : "" }}>{{ trans('action.no') }}</option>
                            </select>
                            @error('is_open')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="is_sticky">{{ trans('action.info.is_sticky') }}</label>
                            <select class="form-control @error('is_sticky') is-invalid @enderror" id="is_sticky" name='is_sticky' required aria-describedby="typeHelp" placeholder="{{ trans('action.info.is_sticky') }}">
                                <option value=''>{{ trans('action.choose')}}{{ trans('action.info.is_sticky')}}</option>
                                <option value='1' {{ (old('is_sticky')=="1")? "selected" : "" }}>{{ trans('action.yes') }}</option>
                                <option value='0' {{ (old('is_sticky')=="0")? "selected" : "" }}>{{ trans('action.no') }}</option>
                            </select>
                            @error('is_sticky')
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
