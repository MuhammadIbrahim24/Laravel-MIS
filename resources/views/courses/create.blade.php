@extends('layouts.newapp')

@section('content')
<h1>Create a course</h1>
<br>
<br>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'courses')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'style'=>'margin-left:25px;')) }}
    </div>

    {{ Form::submit('Create the course!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@endsection