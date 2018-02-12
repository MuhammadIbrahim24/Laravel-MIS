@extends('layouts.newapp')

@section('content')
<h1>Courses</h1>
@if(Auth::user())
    <a href="{{ URL::to('courses/create') }}">Create a course</a>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Code</td>
            <td>Title</td>
            <td>Credit Hours</td>
        </tr>
    </thead>
    <tbody>
    @foreach($courses as $key => $value)
        <tr>
            <td>{{ $value->code }}</td>
            <td>{{ $value->title }}</td>
            <td>{{ $value->theory_ch }} + {{ $value->lab_ch }}</td>

            @if(Auth::user())
                <!-- we will also add show, edit, and delete buttons -->
                <td style="border-bottom: 0px; border-right: 0px; border-top: 0px;">

                    <!-- delete the course (uses the destroy method DESTROY /courses/{id} -->
                    <!-- we will add this later since its a little more complicated than the other two buttons -->
                    {{ Form::open(array('url' => 'courses/' . $value->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                    {{ Form::close() }}
                    
                    <!-- edit this course (uses the edit method found at GET /courses/{id}/edit -->
                    <a class="btn btn-small btn-info" href="{{ URL::to('courses/' . $value->id . '/edit') }}">Edit</a>
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
@endsection