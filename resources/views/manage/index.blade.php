@extends('layouts.manage.app')
@section('title', trans('action.backstage'))
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-white bg-info">
            <h4><i class="fas fa-gamepad"></i> {{ trans('action.backstage') }}</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs nav-justified bg-primary" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-course-tab" data-toggle="pill" href="#pills-course" role="tab" aria-controls="pills-course" aria-selected="true">{{ trans('action.course.course') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-student-tab" data-toggle="pill" href="#pills-student" role="tab" aria-controls="pills-student" aria-selected="false">{{ trans('action.student.student') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-homework-tab" data-toggle="pill" href="#pills-homework" role="tab" aria-controls="pills-homework" aria-selected="false">{{ trans('action.homework.homework') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-upload-tab" data-toggle="pill" href="#pills-upload" role="tab" aria-controls="pills-upload" aria-selected="false">{{ trans('action.upload.upload') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-info-tab" data-toggle="pill" href="#pills-info" role="tab" aria-controls="pills-info" aria-selected="false">{{ trans('action.info.info') }}</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-course" role="tabpanel" aria-labelledby="pills-course-tab">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Content</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-student" role="tabpanel" aria-labelledby="pills-student-tab">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Content</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-homework" role="tabpanel" aria-labelledby="pills-homework-tab">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Content</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-upload" role="tabpanel" aria-labelledby="pills-upload-tab">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Content</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-info" role="tabpanel" aria-labelledby="pills-info-tab">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Content</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
