@extends('layout.achieveMaster')
@section('title', 'Profile Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>
<form action = "processAnnotation" method="post">
<input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
<h2>Edit Profile</h2>
<table>
<tr>
  <td>First Name: </td>
  <td><input type = "text" name = "firstname" value="{{$profile->getFirstname()}}"/></td>
  </tr>
 <tr>
 	<td>Last Name: </td>
 	<td><input type = "text" name = "lastname" value="{{$profile->getLastname()}}" /></td>
 </tr>
 <tr>
  <td>Country: </td>
  <td><input type = "text" name = "country"  value="{{$profile->getCountry()}}" /></td>
  </tr>
 <tr>
 	<td>State: </td>
 	<td><input type = "text" name = "state" value="{{$profile->getState()}}" /></td>
 </tr>
  <tr>
  <td>City: </td>
  <td><input type = "text" name = "city"  value="{{$profile->getCity()}}"/></td>
  </tr>
 <tr>
 	<td>Street: </td>
 	<td><input type = "text" name = "street" value="{{$profile->getStreet()}}" /></td>
 </tr>
  <tr>
 	<td>Zip: </td>
 	<td><input type = "text" name = "zip" value="{{$profile->getZip()}}"/></td>
 </tr>
 <tr>
    <td colspan = "2" align = "center">
        <input type = "submit" value = "Edit Profile" /> 
        </td>
 </tr>
</table>
</form>
@endsection
