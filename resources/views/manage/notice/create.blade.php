@extends('layouts.manage.app')
@section('title', __('Notice').__('Create'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('notice.store') }}" method="POST">
                    <div class="card-header">{{ __('Notice').__('Create') }}</div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('notice.index')) }}</li>
                        </ul>
                        @csrf
                        <div class="form-group row">
                            <label for="menu_id" class="col-md-4 col-form-label text-md-right">{{ __('Menu') }}</label>
                            <div class="col-md-6">
                                <select class='form-control' name='menu_id' aria-describedby="menuHelp">
                                    <option value=''>{{ __('Please choose').__('Menu') }}</option>
									@foreach($menus as $key => $value)
										<option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
									@endforeach
								</select>
			                    <span id="menuHelp" class="form-text text-muted">
			                        選擇要加入的選單項目。
			                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="{{ __('Title') }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="icon" class="col-md-4 col-form-label text-md-right">{{ __('Icon') }}</label>
                            <div class="col-md-6">
                                <select class='form-control' name='icon' aria-describedby="menuHelp">
                                    <option value=''>{{ __('Please choose').__('Menu') }}</option>
                                    @foreach(App\Enum::icon as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="width" class="col-md-4 col-form-label text-md-right">{{ __('Width') }}</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control @error('width') is-invalid @enderror" id="width" name="width" value="{{ old('width') }}" placeholder="{{ __('Width') }}">
                                @error('width')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
                            <div class="col-sm-12">
                                <textarea id="content" name="content" class="form-control" >{!! old('content') !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="is_open" class="col-md-4 col-form-label text-md-right">{{ __('Is_open') }}</label>
                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open1" value="1">
                                    <label class="custom-control-label" for="is_open1">{{ __('Yes') }}</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open2" value="0">
                                    <label class="custom-control-label" for="is_open2">{{ __('No') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" class="btn btn-primary" value="{{ __('Create') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
