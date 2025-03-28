@section('css')
    @include('layouts.datatables_css')
@endsection

<div class="table-responsive py-5 pb-4 dropdown_2">
    <div class="container-fluid">
        {!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}
    </div>
</div>

@push('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush
