<div class="row">
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file', 'File:') !!}
    {!! Form::file('file',['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-12">
    {{ Form::label('locked', __('Locked'),['class' => 'col-form-label']) }}
    {!! Form::select('locked', ['Active' => 'Active', 'InActive' => 'InActive'], null, ['class' => 'form-control', 'id' => 'locked']) !!}
</div>
</div>

<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('bonuses.index') }}" class="btn btn-secondary">Cancel</a>
</div>
