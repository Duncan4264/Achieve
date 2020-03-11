@extends('layout.achieveMaster')
@section('title', 'Profile Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>
@if(Session::has('users'))
<form action = "processOrigination" method="post">
<input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
<h2>Create Profile</h2>
<table>
<tr>
  <td>First Name: </td>
  <td><input type = "text" name = "firstname" /></td>
  </tr>
 <tr>
 	<td>Last Name: </td>
 	<td><input type = "text" name = "lastname" /></td>
 </tr>
 <tr>
  <td>Country: </td>
  <td><input type = "text" name = "country" /></td>
  </tr>
 <tr>
 	<td>State: </td>
 	<td><input type = "text" name = "state" /></td>
 </tr>
  <tr>
  <td>City: </td>
  <td><input type = "text" name = "city" /></td>
  </tr>
 <tr>
 	<td>Street: </td>
 	<td><input type = "text" name = "street" /></td>
 </tr>
  <tr>
 	<td>Zip: </td>
 	<td><input type = "text" name = "zip" /></td>
 </tr>
 <tr>
    <td colspan = "2" align = "center">
        <input type = "submit" value = "Create Profile" /> 
        </td>
 </tr>
</table>
</form>
@endif
@endsection
