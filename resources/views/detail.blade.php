@extends('layouts.home.app')
@section('title',trans('action.info.info').trans('action.detail'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-light" style="border: none;">
                    <div class="card-header bg-transparent">
                        <h4>{{ $info_detail->title }}</h4>
                    </div>
                    <div class="card-body">
                        @php
                            echo clean($info_detail->content);
                        @endphp
                    </div>
                    <div class="card-footer bg-transparent">
                        <p><span class="badge badge-pill badge-primary">
                            {{ trans('action.info.editor').' : '.$info_detail->editor }}
                        </span></p>
                        <p><span class="badge badge-pill badge-primary">
                            {{ trans('action.info.created_at').' : '.$info_detail->created_at }}
                        </span></p>
                        <p><span class="badge badge-pill badge-primary">
                            {{ trans('action.info.updated_at').' : '.$info_detail->updated_at }}
                        </span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
