@extends('layouts.newapp')

@section('content')
<h1>Create a department</h1>
<br>
<br>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'departments')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'style'=>'margin-left:25px;')) }}
    </div>

    {{ Form::submit('Create the department!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@endsection