@extends('layout.achieveMaster')
@section('title', 'Show Group Page')

@section('content')

@if(Session::has('users'))

<table>
<tr>

<td>
<br>
<h1>Group Name:</h1>
<h2>{{$group->getGroupName()}}</h2>
<br>
<h1>Group Discription:</h1>
<h3>{{$group->getGroupDescripton()}}</h3>
<br>
<h1>Members in the group:</h1>
    @foreach ($members as $member)
<h3>{{$member->getUserFirstName()}} {{$member->getUserLastName()}}</h3>
@endforeach

@if(Session::get('ID') != $group->getUserID())
<form action='groupAction' method="post">
<input type="hidden" name = "_token" value = "{{csrf_token()}}" />
<input type="hidden" name="id" value="{{$group->getId()}}">
<br>
     <button type="submit" name="Join" formaction="joinGroup">Join</button>
    <button type="submit" name="Leave" formaction="leaveGroup">Leave</button>
 
</form>
    @endif
    <form action='groupAction' method="get">
    <input type="hidden" name = "_token" value = "{{csrf_token()}}" />
       <button type="submit" name="Cancel" formaction="groups">Cancel</button>
       </form>
    </td>


</tr>
</table>
</br>
@endif



@endsection
