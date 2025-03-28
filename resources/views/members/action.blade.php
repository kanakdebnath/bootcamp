<div class="dropdown dash-h-item">
    <button class="custom_btn btn btn-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Action') }}</button>

    <div class="dropdown-menu" x-placement="bottom-start">
        <a href="{{ route('members.edit', $user->id) }}" class=" dropdown-item">
            <i class="ti ti-edit action-btn"></i>{{ __('Edit') }}
        </a>
        <a href="{{ route('members.show', $user->id) }}" class=" dropdown-item">
            <i class="ti ti-eye action-btn"></i>{{ __('Show') }}
        </a>
        <a href="{{ route('members.send_mail', $user->id) }}" class=" dropdown-item">
            <i class="ti ti-mail action-btn"></i>{{ __('Resend Email') }}
        </a>
        {{--  <div class="dropdown-divider"></div>  --}}
        <a href="{{ route('members.index') }}" class="dropdown-item  text-danger" data-toggle="tooltip"
            data-original-title="{{ __('Delete') }}" onclick="delete_record('delete-form-{{ $user->id }}')"><i
                class="ti ti-trash action-btn"></i>{{ __('Delete') }}</a>
        {!! Form::open(['method' => 'DELETE', 'route' => ['members.destroy', $user->id], 'id' => 'delete-form-' . $user->id]) !!}
        {!! Form::close() !!}
    </div>
</div>

