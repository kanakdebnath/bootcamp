@extends('layouts.admin')
@section('title', __('Create Meeting'))
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">{{ __('Service Category') }}</a></li>
        <li class="breadcrumb-item">{{ __('Create Service Category') }}</li>
    </ul>
@endsection
@section('content')

        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
            <div class="row">
                <div class="section-body">
                    <div class="col-md-8 m-auto">
                        <div class="card ">
                            <div class="card-header">
                                <h5> {{ __('Create Service Category') }}</h5>
                            </div>
                            {!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::label('name', __('Service Category Name'),['class' => 'col-form-label']) }}
                                    {!! Form::text('name', null, ['placeholder' => __('Service Category Name'), 'class' => 'form-control']) !!}
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="float-end">
                                    <a href="{{ route('category.index') }}" class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
                                    <button type="submit" class="btn btn-primary mb-3">{{ __('Save') }}</button>
                                </div>
                            </div>

                            {!! Form::close() !!}
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

