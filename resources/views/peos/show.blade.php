@extends('layouts.navapp')

@section('content')
<h1>{{ $prog_name }}</h1>
<br><br>
<label>PEO Description:</label>&nbsp&nbsp&nbsp<p style="display: inline;">{{ $peo->description }}</p>
<br>
<h3>Corresponding PLOs</h3>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Description</td>
            <td>Effective Date</td>
        </tr>
    </thead>
    <tbody>
    <?php $plo_rec = array(); ?>
    @foreach($peoplo as $key => $value)
        <?php array_push($plo_rec, $value->id); ?>
                <tr>
                    <td>{{ $value->description }}</td>
                    <td>{{ $value->effective_date }}</td>

                    @if(Auth::user())
                        <!-- we will also add show, edit, and delete buttons -->
                        <td style="border: 0px;">
                            <!-- edit this plo (uses the edit method found at GET /plos/{id}/edit -->
                            <a class="btn btn-small btn-warning" href="{{ URL::to('programme/' . $prog_id . '/peo/' . $peo->id . '/detach/' . $value->id) }}">Remove</a>
                        </td>
                    @endif        
                </tr>
    @endforeach
    </tbody>
</table>
<br>
@if(Auth::user())
    <h3>Add More</h3>
        <table class="table", style="border:0">
            <thead>
                <tr>
                    <td>Description</td>
                    <td>Effective Date</td>
                </tr>
            </thead>
            <tbody>
                @foreach($plos as $key => $value)
                    <?php 
                        $temp = 1;
                        foreach($plo_rec as $pl) {
                            if($value->id == $pl) {
                                $temp = 0;
                                break;
                            }
                        }
                    ?>
                    @if($temp == 1)
                        <tr>
                            <td>{{ $value->description }}</td>
                            <td>{{ $value->effective_date }}</td>
                            <td style="border: 0px;">
                                    <!-- edit this peo (uses the edit method found at GET /peos/{id}/edit -->
                                <a class="btn btn-small btn-info" href="{{ URL::to('programme/' . $prog_id . '/peo/' . $peo->id . '/attach/' . $value->id) }}">Add</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
    </table>

@endif

@endsection