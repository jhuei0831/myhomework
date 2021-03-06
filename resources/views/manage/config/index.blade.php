@extends('layouts.manage.app')
@section('title',trans('action.config.config'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-info">
                    <h4><i class="fas fa-cog"></i> {{ trans('action.config.config') }}</h4>
                </div>

                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-info-circle"></i> {{ trans('action.config.notice1') }}<br>
                        <i class="fas fa-info-circle"></i> {{ trans('action.config.notice2') }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center">
                            <thead>
                                <tr class="table-info active">
                                    <th class="text-nowrap text-center">{{ trans('action.config.app_name') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.config.font_family') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.config.font_size') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.config.font_weight') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.config.background') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.config.background_color') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.config.navbar_hover_color') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.config.navbar_text_color') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.config.navbar_text_size') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.config.is_open') }}</th>
                                    <th class="text-nowrap text-center">{{ trans('action.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $config->app_name }}</td>
                                    <td style="font-family: {{ $config->font_family }}">{{ $config->font_family }}</td>
                                    <td style="font-size: {{ $config->font_size }}">{{ $config->font_size }}</td>
                                    <td style="font-weight: {{ $config->font_weight }}">{{App\Enum::config['font_weight'][$config->font_weight]}}</td>
                                    <td>
                                        @if($config->background)
                                        <a target='_blank' href="{{ asset('storage/uploads/images/'.$config->background) }}"><i class="far fa-images"></i></a>
                                        @else
                                        <a class="btn btn-primary disabled" href="#"><i class="fas fa-times-circle"></i> 尚無背景</a>
                                        @endif
                                    </td>
                                    <td style="background-color: #{{ $config->background_color }}"></td>
                                    <td style="background-color: #{{ $config->navbar_hcolor }}"></td>
                                    <td style="background-color: #{{ $config->navbar_wcolor }}"></td>
                                    <td style="font-weight: {{ $config->navbar_size }}">{{App\Enum::config['navbar_size'][$config->navbar_size]}}</td>
                                    <td>
                                        <font color="{{App\Enum::is_open['color'][$config->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$config->is_open]}}"></i></font>
                                        </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn bmd-btn-icon dropdown-toggle" type="button" id="ex1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">more_vert</i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="ex1">
                                                <form class="d-inline" action="{{ route('config.edit',$config->id) }}" method="GET">
                                                    @csrf
                                                    {{ App\Button::edit($config->id) }}
                                                </form>
                                                @isset ($config->background)
                                                    {{ App\Button::to(true,'delete_background',trans('action.delete').trans('action.config.background'),$config->id,'btn-danger dropdown-item','trash-alt',true) }}
                                                @endisset
                                            </div>
                                        </div>
                                        {{-- <form class="d-inline" action="{{ route('config.edit',$config->id) }}" method="GET">
                                        @csrf
                                        {{ App\Button::edit($config->id) }}
                                        </form>
                                        @isset ($config->background)
                                            {{ App\Button::to(true,'delete_background',trans('action.delete').trans('action.config.background'),$config->id,'btn-danger','trash-alt',true) }}
                                        @endisset --}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
