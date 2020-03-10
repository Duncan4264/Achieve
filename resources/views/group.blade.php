@extends('layout.achieveMaster')
@section('title', 'Group Page')

@section('content')

@if(Session::has('users'))

<table>
@foreach ($groups as $group)
<tr>
<td>
<form action='groupAction' method="post">
<input type="hidden" name = "_token" value = "{{csrf_token()}}" />
    <h1>{{$group->getGroupname()}}</h1>
    <input type="hidden" name="id" value="{{$group->getId()}}">
    <input type="hidden" name="group" value="{{$group->getGroupName()}}"/>
    @if($id === $group->getUserID())
    <button type="submit" name="edit" formaction="displayeditgroup">Edit</button>
    <button type="submit" name="Delete" formaction="confirmgroupdelete">Delete</button>
    @endif
    <button type="submit" name="Show" formaction="showGroup">Show Group</button>
  
    </form>
    
    
</td>
</tr>
@endforeach
</table>
</br>

<form action='groupAction' method="get">
    <button type="submit" name="Create" formaction="createGroup">Create</button>
      <button type="submit" name="Cancel" formaction="profile">Cancel</button>
    </form>
@endif



@endsection
