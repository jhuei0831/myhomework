@extends('layouts.home.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>{{ trans('homework.list') }}</h4></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center">
                            <thead>
                                <tr class="table-info active">
                                    <th>{{ trans('homework.subject') }}</th>
                                    <th>{{ trans('homework.description') }}</th>
                                    <th>{{ trans('homework.end_time') }}</th>
                                    <th>{{ trans('homework.hand_in_time') }}</th>
                                    <th>{{ trans('homework.grade') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($homeworks as $homework)
                                    <tr>
                                        <td>{{ $homework->subject }}</td>
                                        <td>
                                            <a class="btn btn-primary" data-toggle="collapse" href="#{{ $homework->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">{{ $homework->subject }}</a>
                                        </td>
                                        <td>{{ $homework->deadline }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@parent
@show
