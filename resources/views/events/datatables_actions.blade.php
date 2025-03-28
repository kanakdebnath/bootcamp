{!! Form::open(['route' => ['events.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('events.show', $id) }}" class='btn btn-success'>
       <i class="ti ti-eye"></i>
    </a>
    <a href="{{ route('events.edit', $id) }}" class='btn btn-info'>
       <i class="ti ti-pencil"></i>
    </a>
    {!! Form::button('<i class="ti ti-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
