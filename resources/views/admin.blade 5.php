@extends('layout.achieveMaster')
@section('title', 'Admin Page')

@section('content')

<table>
<tr>
<td>
@foreach ($profile as $profiles)
<form action='adminAction' method="post">
<input type="hidden" name = "_token" value = "{{csrf_token()}}" />
    <h1>{{$profiles->getFirstname()}} {{$profiles->getLastname()}}</h1>
    <input type="hidden" name="id" value="{{$profiles->getCountry()}}">
    <button type="submit" name="Suspend" formaction="confirmSuspend">Suspend</button>
    
    <button type="submit" name="Unsuspend" formaction="confirmUnsuspend">Unsuspend</button>

    <button type="submit" name="Delete" formaction="confirmDelete">Delete</button>
    </form>
@endforeach
</td>
</tr>
</table>



@endsection
