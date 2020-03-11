@extends('layout.achieveMaster')
@section('title', 'Create Group Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>
@if(Session::has('users'))
<form action = "processCreateGroup" method="POST">
<input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
<h2>Create Group</h2>
@if($errors->count() != 0)
<h1>List of Errors</h1>
@foreach($errors->all() as $message)
	{{ $message }} <br/>
@endforeach
@endif
<table>
<tr>
  <td>Group Name: </td>
  <td><input type = "text" name = "GroupName" value="" maxlength=20/></td>
  </tr>
 <tr>
 	<td>Group Description: </td>
 	<td><input type = "text" name = "GroupDescription" value="" maxlength=50/></td>
 </tr>
 <tr>
    <td colspan = "2" align = "center">
        <input type = "submit" value = "Create Group" /> 
        </td>
 </tr>
</table>
</form>
@endif
@endsection
