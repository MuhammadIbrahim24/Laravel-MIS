@extends('layouts.navapp')

@section('content')
<h1>{{ $prog_name }}</h1>
<h2>Programme Education Outcomes</h2>
@if(Auth::user())
    <a href="/programme/{{ $prog_id }}/peos/create">Create a PEO</a>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Description</td>
            <td>Effective Date</td>
        </tr>
    </thead>
    <tbody>
    @foreach($peos as $key => $value)

            <tr>
                <td>{{ $value->description }}</td>
                <td>{{ $value->effective_date }}</td>

                @if(Auth::user())
                    <!-- we will also add show, edit, and delete buttons -->
                    <td style="border: 0px;">
                        <!-- edit this peo (uses the edit method found at GET /peos/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('peos/' . $value->id . '/edit') }}">Edit</a>
                    </td>

                    <td style="border: 0px;">
                        <!-- edit this peo (uses the edit method found at GET /peos/{id}/edit -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('peos/' . $value->id) }}">Show</a>
                    </td>

                    <td style="border: 0px;">

                        <!-- delete the peo (uses the destroy method DESTROY /peos/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                        {{ Form::open(array('url' => 'peos/' . $value->id)) }}
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