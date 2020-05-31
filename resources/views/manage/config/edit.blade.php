@extends('layouts.manage.app')
@section('title',trans('action.config.config').trans('action.edit'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ trans('action.config.config').trans('action.edit') }}</div>

                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>{{ App\Button::GoBack(route('config.index')) }}</li>
                    </ul>
                    <p>上次更新時間：{{ $config->updated_at }}</p><br>
                	<form method="POST" action="{{ route('config.update' , $config->id) }}" enctype="multipart/form-data">
                		@csrf
						@method('PUT')

                            <div class="form-group">
                                <label for="app_name">{{ trans('action.config.app_name')}}</label>
                                <input id="app_name" type="text" class="form-control @error('app_name') is-invalid @enderror" name="app_name" value="{{ $config->app_name }}" required autocomplete="{{ trans('action.config.app_name')}}" autofocus>
                                @error('app_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="is_open">{{ trans('action.config.is_open') }}</label>
                                <select class="form-control @error('is_open') is-invalid @enderror" name="is_open" required>
                                    <option value="1" {{ ($config->is_open=="1")? "selected" : "" }}>{{ trans('action.yes') }}</option>
                                    <option value="0" {{ ($config->is_open=="0")? "selected" : "" }}>{{ trans('action.no') }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="font_family">{{ trans('action.config.font_family') }}</label>
                                <select class="form-control @error('font_family') is-invalid @enderror" name="font_family" required>
                                    @foreach(App\Enum::config['font_family'] as $key => $value)
                                        @if($key == $config->font_family)
                                            <option value="{{ $key }}" style="font-family:{{ $key }};" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}" style="font-family:{{ $key }};">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('font_family')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="font_size">{{ trans('action.config.font_size') }}</label>
                                <select class="form-control @error('font_size') is-invalid @enderror" name="font_size" required>
                                    @foreach(App\Enum::config['font_size'] as $key => $value)
                                        @if($key == $config->font_size)
                                            <option value="{{ $key }}" style="font-size:{{ $key }};" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}" style="font-size:{{ $key }};">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('font_size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="font_weight">{{ trans('action.config.font_weight') }}</label>
                                <select class="form-control @error('font_weight') is-invalid @enderror" name="font_weight" required>
                                    @foreach(App\Enum::config['font_weight'] as $key => $value)
                                        @if($key == $config->font_weight)
                                            <option value="{{ $key }}" style="font-weight:{{ $key }};" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}" style="font-weight:{{ $key }};">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('font_size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="background">{{ trans('action.config.background') }}</label>
                                <div class="input-group">
                                    <input type="file" class="form-control @error('background') is-invalid @enderror" id="background" name="background" placeholder="{{ trans('action.config.background') }}" value="{{ $config->background }}">
                                    <img id="holder" style="margin-top:15px;max-height:100px;">
                                    <span class='input-group-text'>
                                        @if($config->background)
                                        <a target='_blank' href="{{ asset('storage/uploads/images/'.$config->background) }}"><i class="far fa-image"></i>觀看圖片</a>
                                        @else
                                        <a href="#"><i class="fas fa-times-circle"></i> 目前沒有背景</a>
                                        @endif
                                    </span>
                                    @error('background')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="background_color">{{ trans('action.config.background_color')}}</label>
                                <input id="background_color" class="form-control @error('background_color') is-invalid @enderror jscolor {required:false}" name="background_color" value="{{ $config->background_color }}"aria-describedby="bgcolorHelp">
                                <span id="bgcolorHelp" class="bmd-help">可輸入色碼或點選顏色。色碼HEX(如#2E070B)和RGB(如78,7,11，會轉成HEX)都能使用。主背景色有和白色做垂直線性漸層。</span>
                                @error('background_color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="navbar_bcolor">{{ trans('action.config.navbar_background_color')}}</label>
                                <input id="navbar_bcolor" class="form-control @error('navbar_bcolor') is-invalid @enderror jscolor {required:false}" name="navbar_bcolor" value="{{ $config->navbar_bcolor }}" required>
                                @error('navbar_bcolor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="navbar_wcolor">{{ trans('action.config.navbar_text_color')}}</label>
                                <input id="navbar_wcolor" class="form-control @error('navbar_wcolor') is-invalid @enderror jscolor {required:false}" name="navbar_wcolor" value="{{ $config->navbar_wcolor }}" required>
                                @error('navbar_wcolor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="navbar_size">{{ trans('action.config.navbar_text_size') }}</label>
                                <select class="form-control @error('navbar_size') is-invalid @enderror" name="navbar_size" required>
                                    @foreach(App\Enum::config['navbar_size'] as $key => $value)
                                        @if($key == $config->navbar_size)
                                            <option value="{{ $key }}" style="font-size:{{ $key }};" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}" style="font-size:{{ $key }};">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('navbar_size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

			                <div class="card-footer text-center">
                                <input type="submit" class="btn btn-raised btn-primary" value="{{ trans('action.submit') }}">
                            </div>
			            </div>
                	</form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
