@extends('layouts.admin')
@section('title', __('Show Member'))
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('members.index') }}">{{ __('Members') }}</a></li>
        <li class="breadcrumb-item">{{ __('Create User') }}</li>
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
                                <h5> {{ __('Show Member') }}</h5>
                                <div class="float-end">
                                    <a href="{{ route('members.index') }}" class="btn btn-secondary mb-3">{{ __('Back') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Name:</strong>
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Email:</strong>
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Phone:</strong>
                                            {{ $user->phone }}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Status:</strong>
                                            @php
                                                if($user->status == 'active'){
                                                    $status = 'Active';
                                                }elseif($user->status == 'upcoming'){
                                                    $status =  'Upcoming Course';   
                                                }elseif($user->status == 'expired'){
                                                    $status = '1st Course Complete';   
                                                }else{
                                                    $status = '-';
                                                }
                                            @endphp
                                            {{ $status }}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Password:</strong>
                                            {{ $user->user_password }}
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


