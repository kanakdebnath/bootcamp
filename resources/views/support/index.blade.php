@extends('layouts.admin')
@section('title', __('Supports'))
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item">{{ __('Supports') }}
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
            
            <form action="{{ route('supports.status_change') }}" method="post">
                @csrf
            <!-- Modal Body -->
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <select class="form-select" name="status" id="statusSelect" aria-label="Default select example">
                        <option value="Open">Open</option>
                        <option value="Processing">Processing</option>
                        <option value="Complete">Complete</option>
                    </select>
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
    </script>
@endpush
