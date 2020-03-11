@extends('layout.achieveMaster')
@section('title', 'Edit Skill Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>
@if(Session::has('users'))
<form action = "editGroup" method="post">
<input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
<input type="hidden" name="id" value="{{$group->getId()}}">
<h2>Edit Groups</h2>
@if($errors->count() != 0)
<h1>List of Errors</h1>
@foreach($errors->all() as $message)
	{{ $message }} <br/>
@endforeach
@endif
<table>
<tr>
  <td>Group Name: </td>
  <td><input type = "text" name = "groupname" value="{{$group->getGroupName()}}" maxlength=20/></td>
  </tr>
 <tr>
 	<td>Group Description: </td>
 	<td><input type = "text" name = "groupdescription" value="{{$group->getGroupDescripton()}}" maxlength=50/></td>
 </tr>
 <tr>
    <td colspan = "2" align = "center">
        <input type = "submit" value = "Edit group" /> 
        </td>
 </tr>
</table>
</form>
@endif
@endsection
