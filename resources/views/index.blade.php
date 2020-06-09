@extends('layouts.home.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4><i class="fas fa-info-circle"></i> {{ trans('action.news') }}</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">{{ trans('action.info.created_at') }}</th>
                                <th scope="col">{{ trans('action.info.title') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($info_stickys as $info_sticky)
                            <tr>
                                <td><span class="badge badge-pill badge-danger">TOP</span></td>
                                <td>{{ $info_sticky->updated_at->format('Y/m/d') }}</td>
                                <td><a href="{{ route('detail',$info_sticky->id) }}">{{ \Illuminate\Support\Str::limit($info_sticky->title,50,'...') }}</a></td>
                            </tr>
                            @endforeach
                            @foreach ($infos as $info)
                            <tr>
                                <td></td>
                                <td>{{ $info->updated_at->format('Y/m/d') }}</td>
                                <td><a href="{{ route('detail',$info->id) }}">{{ $info->title }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@parent
@show
