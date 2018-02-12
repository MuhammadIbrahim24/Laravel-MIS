@extends('layouts.navapp')

@section('content')
<h1>{{ $prog_name }}</h1>
<h2>Programme Learning Outcomes</h2>
@if(Auth::user())
    <a href="/programme/{{ $prog_id }}/plos/create">Create a PLO</a>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Description</td>
            <td>Effective Date</td>
        </tr>
    </thead>
    <tbody>
    @foreach($plos as $key => $value)

            <tr>
                <td>{{ $value->description }}</td>
                <td>{{ $value->effective_date }}</td>

                @if(Auth::user())
                    <!-- we will also add show, edit, and delete buttons -->
                    <td style="border: 0px;">
                        <!-- edit this plo (uses the edit method found at GET /plos/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('plos/' . $value->id . '/edit') }}">Edit</a>
                    </td>

                    <td style="border: 0px;">

                        <!-- delete the plo (uses the destroy method DESTROY /plos/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                        {{ Form::open(array('url' => 'plos/' . $value->id)) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                        {{ Form::close() }}
                    </td>
                        
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
@endsection