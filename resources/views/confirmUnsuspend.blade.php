@extends('layout.achieveMaster')
@section('title', 'Confirm Suspend Page')

@section('content')
<div>
<h1>Would you like to UnSuspend? {{$id}}</h1>
<form action="processUnsuspend" method="post">
<input type="hidden" name = "_token" value = "{{csrf_token()}}" />
<input type="hidden" name = "id" value = "{{$id}}" />
<button type="submit" formaction="processUnsuspend">UnSuspend</button>
<button type="button" formaction="admin">Cancel</button>
</form>


</div>
@endsection
