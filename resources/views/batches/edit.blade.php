@extends('layouts.admin')

@section('title', __('Edit Batch'))
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('batches.index') }}">{{ __('Batches') }}</a></li>
        <li class="breadcrumb-item">{{ __('Edit Batch') }}
        </li>
    </ul>
@endsection
@push('style')
<style>
    .select2-container .select2-selection--multiple {
        min-height: 38px;
        border: 1px solid #ced4da;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background-color: #333 !important;
    }

</style>
<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">


@endpush
@section('content')

    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="section-body">
            <div class="col-md-8 m-auto">
                <div class="card ">
                    <div class="card-header">
                        <h5> {{ __('Edit Batch') }}</h5>
                    </div>
                    {!! Form::model($batch, ['method' => 'PATCH', 'route' => ['batches.update', $batch->id]]) !!}
                    <div class="card-body">

                        <div class="form-group">
                            {{ Form::label('name', __('Name'),['class' => 'col-form-label']) }}
                            {!! Form::text('title', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {{ Form::label('user', __('Assign User'),['class' => 'col-form-label']) }}
                            {!! Form::select('users[]', $users, $selectedusers, ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                        </div>
                        <!-- Class One Date Field -->
                        <div class="form-group">
                            {!! Form::label('end_date', 'End Date:') !!}
                            {!! Form::date('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('status', 'Update Status') !!}

                            {!! Form::select('status', [
                                    'Pending' => 'Pending',
                                    'Active' => 'Active',
                                    'InActive' => 'InActive'
                                ], $batch->status, ['class' => 'form-select', 'id' => 'statusSelect', 'aria-label' => 'Default select example']) !!}

                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control summernote']) !!}
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="float-end">
                            <a href="{{ route('batches.index') }}" class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
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

@push('scripts')
<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Users",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,  // Set editor height
            minHeight: 200, // Set minimum height
            maxHeight: 500, // Set maximum height
            focus: false,    // Focus the editor on load
            placeholder: 'Write your description here...',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>


@endpush
