@extends('layouts.newapp')

@section('content')
<h1>{{ $dept_name }}</h1>
@if(Auth::user())
    <a href="/department/{{ $dept_id }}/programmes/create">Create a programme</a>
@endif


<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Programmes</td>
        </tr>
    </thead>
    <tbody>
    @foreach($programmes as $key => $value)
        @if($value->department_id == $dept_id)
            <tr>
                <td><a href="\programme/{{$value->id}}" style='color: black'>{{ $value->name }}</a></td>

                @if(Auth::user())
                    <!-- we will also add show, edit, and delete buttons -->
                    <td style="border: 0px;">
                        <!-- edit this programme (uses the edit method found at GET /programmes/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('programmes/' . $value->id . '/edit') }}">Edit</a>
                    </td>

                    <td style="border: 0px;">

                        <!-- delete the programme (uses the destroy method DESTROY /programmes/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                        {{ Form::open(array('url' => 'programmes/' . $value->id)) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                        {{ Form::close() }}
                    </td>
                        
                    
                @endif
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
@endsection