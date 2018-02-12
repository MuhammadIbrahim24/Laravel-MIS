@extends('layouts.newapp')

@section('content')
<h1>Edit Programme</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($prog, array('route' => array('programmes.update', $prog->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control', 'style'=>'margin-left:25px;')) }}
    </div>

    <div class="form-group">
        {{ Form::hidden('department_id', Input::old('department_id'), array('class' => 'form-control', 'style'=>'margin-left:25px;')) }}
    </div>

    {{ Form::submit('Edit the programme!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@endsection