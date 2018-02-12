@extends('layouts.newapp')

@section('content')
<h1>Departments</h1>
@if(Auth::user())
    <a href="{{ URL::to('departments/create') }}">Create a department</a>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Name</td>
        </tr>
    </thead>
    <tbody>
    @foreach($departments as $key => $value)
        <tr>
            <td><a href='department/{{ $value->id }}/programmes' style='color: black'>{{ $value->name }}</a></td>

            @if(Auth::user())
                <!-- we will also add show, edit, and delete buttons -->
                <td style="border: 0px;">    
                    <!-- edit this department (uses the edit method found at GET /departments/{id}/edit -->
                    <a class="btn btn-small btn-info" href="{{ URL::to('departments/' . $value->id . '/edit') }}">Edit</a>
                </td>

                <td style="border: 0px;">

                    <!-- delete the department (uses the destroy method DESTROY /departments/{id} -->
                    <!-- we will add this later since its a little more complicated than the other two buttons -->
                    {{ Form::open(array('url' => 'departments/' . $value->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                    {{ Form::close() }}
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
@endsection