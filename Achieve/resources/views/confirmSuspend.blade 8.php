@extends('layout.achieveMaster')
@section('title', 'Confirm Suspend Page')

@section('content')
<div>
<h1>Would you like to Suspend? {{$id}}</h1>
<form action="processSuspend" method="post">
<input type="hidden" name = "_token" value = "{{csrf_token()}}" />
<input type="hidden" name = "id" value = "{{$id}}" />
<button type="submit" formaction="processSuspend">Suspend</button>
<button type="button" formaction="admin">Cancel</button>
</form>


</div>
@endsection
