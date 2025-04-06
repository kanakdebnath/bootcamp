<div class="dropdown dash-h-item">
    <button class="custom_btn btn btn-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Action') }}</button>

    <div class="dropdown-menu" x-placement="bottom-start">
        <a href="javascript:void(0)" onclick="change_status('{{ $class->id }}','{{ $class->status }}')" class="dropdown-item">
            <i class="ti ti-exchange action-btn"></i>Change Status
        </a>
    </div>
</div>

