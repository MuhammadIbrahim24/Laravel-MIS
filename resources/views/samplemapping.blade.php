@extends('layouts.navapp')

@section('content')
	<h1>{{ $prog_name }}</h1>
	<h3>PEO PLO Mapping</h3>
	<?php $index = 1 ?>
	<p>
		@foreach($peos as $key => $value)
			<label>PEO {{ $index++ }}:</label>
			<div>{{ $value->description }}</div>
		@endforeach
	</p>

	<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>PEO/PLO</td>
            <?php for(i = 1; i <= index-1; i++) { ?>
            	<td>PEO {{ $i }}</td>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
    	<tr>
            <td>This is PEO 1 of SE</td>
            <td></td>
            <td>  *</td>
            <td>  *</td>
            <td></td>
        </tr>
        <tr>
            <td>This is PEO 2 of SE</td>
            <td>  *</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>This is PEO 3 of SE</td>
            <td></td>
            <td></td>
            <td>  *</td>
            <td>  *</td>
        </tr>
        <tr>
            <td>This is PEO 4 of SE</td>
            <td>  *</td>
            <td>  *</td>
            <td></td>
            <td>  *</td>
        </tr>
    </tbody>
</table>

@endsection