@extends('layouts.admin')

@section('title', __('Edit Live Class'))
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">{{ __('Live Class') }}</a></li>
        <li class="breadcrumb-item">{{ __('Edit Live Class') }}
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
<link href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/css/tempus-dominus.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
@endpush
@section('content')

    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="section-body">
            <div class="col-md-8 m-auto">
                <div class="card ">
                    <div class="card-header">
                        <h5> {{ __('Edit Live Class') }}</h5>
                    </div>
                    {!! Form::model($class, ['method' => 'PATCH', 'route' => ['classes.update', $class->id]]) !!}
                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::label('name', __('Topics'),['class' => 'col-form-label']) }}
                            {!! Form::text('topics', null, ['placeholder' => __('Class Topics'), 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('batch', __('Select Batch'), ['class' => 'col-form-label']) }}
                            {!! Form::select('batch', $batches, $class->batch_id, ['class' => 'form-control select2', 'id' => 'batchSelect', 'placeholder' => __('Select a Batch')]) !!}
                        </div>

                        <div class="form-group">
                            {{ Form::label('link', __('Class Link'),['class' => 'col-form-label']) }}
                            {!! Form::text('link', null, ['placeholder' => __('Class Link'), 'class' => 'form-control']) !!}
                        </div>

                        
                        <div class="form-group">
                            {{ Form::label('zoom_id', __('Zoom ID'),['class' => 'col-form-label']) }}
                            {!! Form::text('zoom_id', null, ['placeholder' => __('Zoom ID'), 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {{ Form::label('zoom_pass', __('Zoom Passcode'),['class' => 'col-form-label']) }}
                            {!! Form::text('zoom_pass', null, ['placeholder' => __('Zoom Passcode'), 'class' => 'form-control']) !!}
                        </div>

                        <!-- Class One Date Field -->

                        <div class="form-group">
                                    <label for="datetimepicker">Select Date and Time:</label>
                                    <div class="input-group" id="datetimepicker" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                        <input type="text" class="form-control"
                                        data-datetime="{{ old('datetime', $class->main_date_time ? \Carbon\Carbon::parse($class->main_date_time)->format('m/d/Y h:i') : '') }}"
             value="{{ old('datetime', $class->main_date_time ? \Carbon\Carbon::parse($class->main_date_time)->format('m/d/Y h:i') : '') }}" name="datetime" data-td-target="#datetimepicker"  />
                                        <span class="input-group-text" data-td-target="#datetimepicker" data-td-toggle="datetimepicker">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control summernote']) !!}
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="float-end">
                            <a href="{{ route('classes.index') }}" class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
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
<script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/js/tempus-dominus.min.js" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {

        $('#batchSelect').select2({
            placeholder: "Select a Batch",
            allowClear: true
        });


        $('.summernote').summernote({
            height: 300,  // Set editor height
            minHeight: 200, // Set minimum height
            maxHeight: 500, // Set maximum height
            focus: true,    // Focus the editor on load
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

<script>
        $(document).ready(function() {
            $('#datetimepicker').each(function() {

                const input = document.querySelector('#datetimepicker input');
                const datetime = input.dataset.datetime;

                // Ensure datetime is a valid string before creating a Date object
                const meetingDate = datetime && datetime !== '' 
                    ? new Date(datetime) 
                    : null;

                // Optional: Check if the date is valid
                const defaultDate = meetingDate && !isNaN(meetingDate) ? meetingDate : null;

                new tempusDominus.TempusDominus(document.getElementById('datetimepicker'), {
                    display: {
                        components: {
                            calendar: true,
                            date: true,
                            month: true,
                            year: true,
                            decades: true,
                            clock: true,
                            hours: true,
                            minutes: true,
                            seconds: false
                        },
                        sideBySide: true,
                        icons: {
                            time: 'fas fa-clock',
                            date: 'fas fa-calendar',
                            up: 'fas fa-arrow-up',
                            down: 'fas fa-arrow-down',
                            previous: 'fas fa-chevron-left',
                            next: 'fas fa-chevron-right',
                            today: 'fas fa-calendar-check',
                            clear: 'fas fa-trash',
                            close: 'fas fa-times'
                        }
                    },
                    localization: {
                        format: 'MM/dd/yyyy HH:mm',
                        hourCycle: 'h23'
                    },
                    defaultDate: defaultDate // Use the validated date or null
                });
            });
        });
    </script>


@endpush
