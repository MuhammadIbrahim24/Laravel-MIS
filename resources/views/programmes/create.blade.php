@extends('layouts.newapp')

@section('content')
<h1>{{ $dept_name }}</h1>
<br>
<h2>Create a programme</h2>
<br>
<br>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'programmes')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'style'=>'margin-left:25px;')) }}
    </div>

    <div class="form-group">
        {{ Form::hidden('department_id', $dept_id ,Input::old('department_id'), array('class' => 'form-control', 'style'=>'margin-left:25px;')) }}
    </div>

    {{ Form::submit('Create the programme!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@endsection