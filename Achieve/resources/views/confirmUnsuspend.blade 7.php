@extends('layout.achieveMaster')
@section('title', 'Confirm Unsuspend Page')

@section('content')
<div>
<h1>Would you like to Unsuspend? {{$id}}</h1>
<form action="unSuspendProfile" method="post">
<input type="hidden" name = "_token" value = "{{csrf_token()}}" />
<button type="submit" formaction="processUnsuspend">Unsuspend</button>
<button type="button" formaction="admin">Cancel</button>
</form>


</div>
@endsection
