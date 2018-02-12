@extends('layouts.app')
@section('navbar')
<nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        
                        
                                
                        <li>
                            <a  href="/home"> Home </a>
                        </li>
                        @if(Auth::user() AND Auth::user()->is_admin == 1)
                            <li {{ Request::is('/url') ? ' class="active-menu"' : null }}>
                                <a  href="/users"> Manage Users </a>
                            </li>               
                        @endif
                        <li>
                            <a  href="/courses"> Courses </a>
                        </li>
                                       
                        <li>
                            <a href="/departments"> Departments </a>
                            @if($departments)
                                <ul class="nav nav-second-level">
                                @foreach($departments as $department)
                                    <li>
                                        <a href="\department/{{$department->id}}/programmes">{{$department->name}}</a>
                                        <ul class="nav nav-third-level">
                                            @foreach($programmes as $programme)
                                                @if($programme->department_id == $department->id)
                                                    <li>
                                                        <a href="\programme/{{$programme->id}}">{{$programme->name}}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                                </ul>
                            @endif
                        </li>   
                    </ul>
               
                </div>
                
            </nav>
            @endsection