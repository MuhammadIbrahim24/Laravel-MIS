@extends('layouts.newapp')

@section('content')
<h1>Edit {{ $dept->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($dept, array('route' => array('courses.update', $dept->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control', 'style'=>'margin-left:25px;')) }}
    </div>

    {{ Form::submit('Edit the course!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@endsection