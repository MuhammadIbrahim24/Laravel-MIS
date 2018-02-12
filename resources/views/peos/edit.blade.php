@extends('layouts.navapp')

@section('content')
<h1>{{ $prog_name }}</h1>
<h2>Edit PEO</h2>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($peo, array('route' => array('peos.update', $peo->id), 'method' => 'PUT')) }}

    
    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description', Input::old('description'), array('class' => 'form-control', 'style'=>'margin-left:25px;')) }}
    </div>

    <div class="form-group">
        {{ Form::label('effective_date', 'Effective Date') }}
        {{ Form::date('effective_date', Input::old('effective_date'), array('class' => 'form-control', 'style'=>'margin-left:25px;')) }}
    </div>

    <div class="form-group">
        {{ Form::hidden('programme_id', $prog_id ,Input::old('programme_id'), array('class' => 'form-control', 'style'=>'margin-left:25px;')) }}
    </div>

    {{ Form::submit('Edit the PEO!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@endsection