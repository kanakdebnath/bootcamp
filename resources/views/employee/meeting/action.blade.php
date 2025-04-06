<div class="dropdown dash-h-item">
    <button class="custom_btn btn btn-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Action') }}</button>

    <div class="dropdown-menu" x-placement="bottom-start">

        <a href="{{ route('employee.meeting.show', $meeting->id) }}" class=" dropdown-item">
            <i class="ti ti-eye action-btn"></i>{{ __('Show') }}
        </a>

        <a href="javascript:void(0)" onclick="change_status('{{ $meeting->id }}','{{ $meeting->status }}')" class="dropdown-item">
            <i class="ti ti-exchange action-btn"></i>Change Status
        </a>
    </div>
</div>

