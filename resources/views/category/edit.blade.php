@extends('layouts.admin')

@section('title', __('Edit Service Category'))
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">{{ __('Service Category') }}</a></li>
        <li class="breadcrumb-item">{{ __('Edit Service Category') }}
        </li>
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
                        <h5> {{ __('Edit Service Category') }}</h5>
                    </div>
                    {!! Form::model($category, ['method' => 'PATCH', 'route' => ['category.update', $category->id]]) !!}
                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::label('name', __('Service Category'),['class' => 'col-form-label']) }}
                            {!! Form::text('name', null, ['placeholder' => __('Service Category'), 'class' => 'form-control']) !!}
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
