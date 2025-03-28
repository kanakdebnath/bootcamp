<div class="row">
<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', 'Photo:') !!}
    {!! Form::file('photo' ,['class' => 'form-control']) !!}
</div>

<div class="clearfix"></div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Short Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('short_description', 'Short Description:') !!}
    {!! Form::textarea('short_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Class One Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_one_date', 'Class One Date:') !!}
    {!! Form::date('class_one_date', null, ['class' => 'form-control','id'=>'class_one_date']) !!}
</div>


<!-- Class One Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_one_link', 'Class One Link:') !!}
    {!! Form::text('class_one_link', null, ['class' => 'form-control']) !!}
</div>

<!-- Class Two Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_two_date', 'Class Two Date:') !!}
    {!! Form::date('class_two_date', null, ['class' => 'form-control','id'=>'class_two_date']) !!}
</div>



<!-- Class Two Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_two_link', 'Class Two Link:') !!}
    {!! Form::text('class_two_link', null, ['class' => 'form-control']) !!}
</div>

<!-- Class Three Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_three_date', 'Class Three Date:') !!}
    {!! Form::date('class_three_date', null, ['class' => 'form-control','id'=>'class_three_date']) !!}
</div>


<!-- Class Three Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_three_link', 'Class Three Link:') !!}
    {!! Form::text('class_three_link', null, ['class' => 'form-control']) !!}
</div>

<!-- Class Four Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_four_date', 'Class Four Date:') !!}
    {!! Form::date('class_four_date', null, ['class' => 'form-control','id'=>'class_four_date']) !!}
</div>



<!-- Class Four Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_four_link', 'Class Four Link:') !!}
    {!! Form::text('class_four_link', null, ['class' => 'form-control']) !!}
</div>


</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('cources.index') }}" class="btn btn-secondary">Cancel</a>
</div>
