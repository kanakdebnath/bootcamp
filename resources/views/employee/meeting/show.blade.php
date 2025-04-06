@extends('layouts.employee')
@section('title', __('Show Meeting'))
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('employee.meeting') }}">{{ __('Meetings') }}</a></li>
        <li class="breadcrumb-item">{{ __('Show Meeting') }}</li>
    </ul>
@endsection

@section('content')

        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
            <div class="row">
                <div class="section-body">
                    <div class="col-md-8 m-auto">
                        <div class="card ">
                            <div class="card-header d-flex justify-content-between">
                                <h5> {{ __('Show Meeting') }}</h5>
                                <div class="float-end">
                                    <a href="{{ route('employee.meeting') }}" class="btn btn-secondary mb-3">{{ __('Back') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Topics:</strong>
                                            {{ $meeting->topics }}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Batch:</strong>
                                            {{ $meeting->batch->title }}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Member:</strong>
                                            {{ $meeting->user->name }}
                                        </div>
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Link:</strong>
                                            {{ $meeting->link }}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Date:</strong>
                                            {{ \Carbon\Carbon::parse($meeting->main_date_time)->format('F j, Y h:i A') }}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Status:</strong>
                                            {{ $meeting->status }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection


