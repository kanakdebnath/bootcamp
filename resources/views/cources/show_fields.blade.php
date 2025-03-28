<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $cources->id }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $cources->title }}</p>
</div>

<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', 'Photo:') !!}
    <p>
        <img src='{{asset(Storage::url($cources->photo))}}' alt='Photo' style='width: 50px; height: 50px; border-radius: 5px;'>
    </p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $cources->description }}</p>
</div>

<!-- Short Description Field -->
<div class="form-group">
    {!! Form::label('short_description', 'Short Description:') !!}
    <p>{{ $cources->short_description }}</p>
</div>

<!-- Class One Date Field -->
<div class="form-group">
    {!! Form::label('class_one_date', 'Class One Date:') !!}
    <p>{{ $cources->class_one_date }}</p>
</div>

<!-- Class One Link Field -->
<div class="form-group">
    {!! Form::label('class_one_link', 'Class One Link:') !!}
    <p>{{ $cources->class_one_link }}</p>
</div>

<!-- Class Two Date Field -->
<div class="form-group">
    {!! Form::label('class_two_date', 'Class Two Date:') !!}
    <p>{{ $cources->class_two_date }}</p>
</div>

<!-- Class Two Link Field -->
<div class="form-group">
    {!! Form::label('class_two_link', 'Class Two Link:') !!}
    <p>{{ $cources->class_two_link }}</p>
</div>

<!-- Class Three Date Field -->
<div class="form-group">
    {!! Form::label('class_three_date', 'Class Three Date:') !!}
    <p>{{ $cources->class_three_date }}</p>
</div>

<!-- Class Three Link Field -->
<div class="form-group">
    {!! Form::label('class_three_link', 'Class Three Link:') !!}
    <p>{{ $cources->class_three_link }}</p>
</div>

<!-- Class Four Date Field -->
<div class="form-group">
    {!! Form::label('class_four_date', 'Class Four Date:') !!}
    <p>{{ $cources->class_four_date }}</p>
</div>

<!-- Class Four Link Field -->
<div class="form-group">
    {!! Form::label('class_four_link', 'Class Four Link:') !!}
    <p>{{ $cources->class_four_link }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $cources->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $cources->updated_at }}</p>
</div>

