@extends('layouts.newapp')

@section('content')
<h1>Edit Department</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($dept, array('route' => array('departments.update', $dept->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control', 'style'=>'margin-left:25px;')) }}
    </div>

    {{ Form::submit('Edit the department!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@endsection