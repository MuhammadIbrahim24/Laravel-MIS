@extends('layouts.newapp')

@section('content')
<h1>Create a user</h1>
<br>
<br>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'users')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'style'=>'margin-left:25px;')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', Input::old('email'), array('class' => 'form-control', 'style'=>'margin-left:28px;')) }}
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', Input::old('password'), array('class' => 'form-control', 'style'=>'width:184px;')) }}
    </div>

    <div class="form-group">
        {{ Form::label('is_admin', 'Type') }}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        {{ Form::radio('is_admin', '1', false) }}&nbsp&nbsp&nbsp&nbspAdmin
        <br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        {{ Form::radio('is_admin', '0', true) }}&nbsp&nbsp&nbsp&nbspUser
    </div>


    {{ Form::submit('Create the user!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@endsection