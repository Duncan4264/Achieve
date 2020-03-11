@extends('layout.achieveMaster')
@section('title', 'Confirm Delete Page')

@section('content')
<div>
<h1>Would you like to delete? {{$groupname}}</h1>
<form action="delete" method="post">
<input type="hidden" name = "_token" value = "{{csrf_token()}}" />
<input type="hidden" name="id" value="{{$id}}">
<button type="submit" formaction="deletegroup">Delete</button>
<button type="button" formaction="admin">Cancel</button>
</form>


</div>
@endsection
