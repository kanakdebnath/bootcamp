@extends('layouts.employee')
@section('title', __('Live Class'))
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item">{{ __('Live Class') }}
        </li>
    </ul>
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive py-5 pb-4 dropdown_2">
                        <div class="container-fluid">
                            {{ $dataTable->table(['width' => '100%']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal structure -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Change Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form  id="statusForm" method="post">
                    @csrf
                <!-- Modal Body -->
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <div class="form-group">
                            {!! Form::label('status', 'Update Status') !!}

                            {!! Form::select('status', [
                                    'Not Started' => 'Not Started',
                                    'Started' => 'Started',
                                    'Complete' => 'Complete'
                                ], null, ['class' => 'form-select', 'id' => 'statusSelect', 'aria-label' => 'Default select example']) !!}

                        </div>
                        <div class="form-group">
                            {!! Form::label('note', 'Note') !!}
                            {!! Form::textarea('note', null, ['class' => 'form-control','required' => true]) !!}
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@push('style')
    @include('layouts.includes.datatable_css')

@endpush
@push('scripts')
    @include('layouts.includes.datatable_js')
    {{ $dataTable->scripts() }}


    <script>
        function change_status(id,status) {
            event.preventDefault();
            $('#id').val(id);

            // Set the selected option
            $('#statusSelect').val(status);

            $('#myModal').modal('show');
        }


        $(document).on('submit', '#statusForm', function(e) {
        e.preventDefault();

        let formData = new FormData($('#statusForm')[0]);

        $.ajax({
            url: "{{ route('classes.status_change') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#myModal').modal('hide');

                notifier.show(
                    'Success',
                    response.message || 'Status updated successfully!',
                    'success',
                    "{{ asset('assets/images/notification/ok-48.png') }}",
                    4000
                );
            },
            error: function(xhr) {
                let errorMessage = 'Something went wrong!';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                notifier.show(
                    'Error',
                    errorMessage,
                    'failed',
                    "{{ asset('assets/images/notification/high_priority-48.png') }}",
                    4000
                );
            }
        });
    });
    </script>
@endpush
