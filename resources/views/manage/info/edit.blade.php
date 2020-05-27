@extends('layouts.manage.app')
@section('title', __('Information').__('Edit'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Information').__('Edit') }}</div>

                <div class="card-body">
                	<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('info.index')) }}</li>
					</ul>
                	<form method="POST" action="{{ route('info.update' , $info->id) }}">
                		@csrf
						@method('PUT')

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $info->title }}" required autocomplete="{{ __('Title') }}" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                            <div class="col-md-12">
                                <textarea id="content" name="content" class="form-control ckeditor" >{{ $info->content }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is_open" class="col-md-4 col-form-label text-md-right">{{ __('Is_open') }}</label>
                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open1" value="1" {{ ($info->is_open=="1")? "checked" : "" }}>
                                    <label class="custom-control-label" for="is_open1">{{ __('Yes') }}</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open2" value="0" {{ ($info->is_open=="0")? "checked" : "" }}>
                                    <label class="custom-control-label" for="is_open2">{{ __('No') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is_sticky" class="col-md-4 col-form-label text-md-right">{{ __('Is_sticky') }}</label>
                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_sticky" id="is_sticky1" value="1" {{ ($info->is_sticky=="1")? "checked" : "" }}>
                                    <label class="custom-control-label" for="is_sticky1">{{ __('Yes') }}</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_sticky" id="is_sticky2" value="0" {{ ($info->is_sticky=="0")? "checked" : "" }}>
                                    <label class="custom-control-label" for="is_sticky2">{{ __('No') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
			                <div class="col-md-4">
			                    <input type="submit" class="btn btn-primary" value="送出">
			                </div>
			            </div>
                	</form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
