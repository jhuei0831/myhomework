@extends('layouts.manage.app')
@section('title',__('Config'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Config') }}</div>

                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                        1. 此設定只針對前台。<br>
                        2. 背景圖案會蓋過背景顏色，若要顯示背景顏色(漸層)則要先刪除背景圖。
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center">
                            <thead>
                                <tr class="table-info active">
                                    <th class="text-nowrap text-center">{{ __('App name') }}</th>
                                    <th class="text-nowrap text-center">{{ __('Font family') }}</th>
                                    <th class="text-nowrap text-center">{{ __('Font size') }}</th>
                                    <th class="text-nowrap text-center">{{ __('Font weight') }}</th>
                                    <th class="text-nowrap text-center">{{ __('Background') }}</th>
                                    <th class="text-nowrap text-center">{{ __('Background color') }}</th>
                                    <th class="text-nowrap text-center">{{ __('Navbar background color') }}</th>
                                    <th class="text-nowrap text-center">{{ __('Navbar text color') }}</th>
                                    <th class="text-nowrap text-center">{{ __('Navbar text size') }}</th>
                                    <th class="text-nowrap text-center">{{ __('Is_open') }}</th>
                                    <th class="text-nowrap text-center">{{ __('Action') }}</th>
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
                                        <a target='_blank' href="{{ $config->background }}"><i class="far fa-images"></i></a>
                                        @else
                                        <a class="btn btn-primary disabled" href="#"><i class="fas fa-times-circle"></i> 尚無背景</a>
                                        @endif
                                    </td>
                                    <td style="background-color: #{{ $config->background_color }}"></td>
                                    <td style="background-color: #{{ $config->navbar_bcolor }}"></td>
                                    <td style="background-color: #{{ $config->navbar_wcolor }}"></td>
                                    <td style="font-weight: {{ $config->navbar_size }}">{{App\Enum::config['navbar_size'][$config->navbar_size]}}</td>
                                    <td>
                                        <font color="{{App\Enum::is_open['color'][$config->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$config->is_open]}}"></i></font>
                                        </td>
                                    <td>
                                        <form action="{{ route('config.edit',$config->id) }}" method="GET">
                                        @csrf
                                        {{ App\Button::edit($config->id) }}
                                        </form>
                                        @isset ($config->background)
                                            {{ App\Button::to('delete_background',__('Delete').__('Background'),$config->id,'btn-danger','trash-alt',true) }}
                                        @endisset
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
