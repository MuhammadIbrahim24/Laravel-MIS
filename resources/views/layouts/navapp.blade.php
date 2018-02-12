@extends('layouts.newapp')

@section('navtop')
<nav class="navbar navbartop" role="navigation">
		<ul class="navbartopul">
			<li class="navbartopli"><a href="\programme/{{ $prog_id }}/peos" class="navbartopa">PEOs</a></li>
			<li class="navbartopli"><a href="\programme/{{ $prog_id }}/plos" class="navbartopa">PLOs</a></li>
			<li class="navbartopli"><a href="\programme/{{ $prog_id }}/courses" class="navbartopa">Courses</a></li>
			<li class="navbartopli"><a href="\programme/{{ $prog_id }}/peoplo" class="navbartopa">PEO PLO Mapping</a></li>
			<li class="navbartopli"><a href="\programme/{{ $prog_id }}/courseplo" class="navbartopa">Course PLO Mapping</a></li>
		</ul>
</nav>
@endsection