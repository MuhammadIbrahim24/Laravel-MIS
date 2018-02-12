@extends('layouts.newapp')

@section('content')
<h1>Users</h1>
<a href="{{ URL::to('users/create') }}">Create a User</a>


<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Name</td>
            <td>Email</td>
            <td>Type</td>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $key => $value)
        <tr>
            <td>{{ $value->name }}</td>
            <td>{{ $value->email }}</td>
            @if($value->is_admin == 1)
                <td>Admin</td>
            @else
                <td>User</td>
            @endif

            <!-- we will also add show, edit, and delete buttons -->
            <td style="border-bottom: 0px; border-right: 0px; border-top: 0px;">
            @if(Auth::user()->email != $value->email)

                <!-- delete the user (uses the destroy method DESTROY /users/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'users/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
            @endif
                
                <!-- edit this user (uses the edit method found at GET /users/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('users/' . $value->id . '/edit') }}">Edit</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection