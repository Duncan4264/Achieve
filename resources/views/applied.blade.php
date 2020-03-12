@extends('layout.achieveMaster')
@section('title', 'Show Job Page')

@section('content')

@if(Session::has('users'))

<h1>Congratulations! You have applied for {{$name}}</h1>

<form name="showAction" name="showHome" method="get">
<button formaction="profile" name="show">show Profile</button>
</form>

@endif



@endsection
