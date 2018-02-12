@extends('layouts.newapp')

@section('content')
<h1>Edit {{ $user->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control', 'style'=>'margin-left:25px;')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, array('class' => 'form-control', 'style'=>'margin-left:28px;')) }}
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('is_admin', 'Type') }}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        {{ Form::radio('is_admin', '1', false) }}&nbsp&nbsp&nbsp&nbspAdmin
        <br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        {{ Form::radio('is_admin', '0', true) }}&nbsp&nbsp&nbsp&nbspUser
    </div>

    {{ Form::submit('Edit the user!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@endsection