<div class="dropdown dash-h-item">
    <button class="custom_btn btn btn-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Action') }}</button>

    <div class="dropdown-menu" x-placement="bottom-start">
       
        <a href="{{ route('supports.show', $support->id) }}" class=" dropdown-item">
            <i class="ti ti-eye action-btn"></i>{{ __('Show') }}
        </a>

        <a href="javascript:void(0)" onclick="change_status('{{ $support->id }}','{{ $support->status }}')" class="dropdown-item">
            <i class="ti ti-exchange action-btn"></i>Change Status
        </a>

        {{--  <div class="dropdown-divider"></div>  --}}
        <a href="{{ route('supports.index') }}" class="dropdown-item  text-danger" data-toggle="tooltip"
            data-original-title="{{ __('Delete') }}" onclick="delete_record('delete-form-{{ $support->id }}')"><i
                class="ti ti-trash action-btn"></i>{{ __('Delete') }}</a>
        {!! Form::open(['method' => 'DELETE', 'route' => ['supports.destroy', $support->id], 'id' => 'delete-form-' . $support->id]) !!}
        {!! Form::close() !!}
    </div>
</div>

