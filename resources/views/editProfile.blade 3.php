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
  <td><input type = "text" name = "firstname" value="{{$profile->getFirstname()}}" maxlength=20/></td>
  </tr>
 <tr>
 	<td>Last Name: </td>
 	<td><input type = "text" name = "lastname" value="{{$profile->getLastname()}}" maxlength=20/></td>
 </tr>
 <tr>
  <td>Country: </td>
  <td><input type = "text" name = "country"  value="{{$profile->getCountry()}}" maxlength=20/></td>
  </tr>
 <tr>
 	<td>State: </td>
 	<td><input type = "text" name = "state" value="{{$profile->getState()}}" maxlength=20/></td>
 </tr>
  <tr>
  <td>City: </td>
  <td><input type = "text" name = "city"  value="{{$profile->getCity()}}" maxlength=20/></td>
  </tr>
 <tr>
 	<td>Street: </td>
 	<td><input type = "text" name = "street" value="{{$profile->getStreet()}}" maxlength=20/></td>
 </tr>
  <tr>
 	<td>Zip: </td>
 	<td><input type = "text" name = "zip" value="{{$profile->getZip()}}" maxlength=20/></td>
 </tr>
 <tr>
    <td colspan = "2" align = "center">
        <input type = "submit" value = "Edit Profile" /> 
        </td>
 </tr>
</table>
</form>
@endsection
