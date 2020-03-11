@extends('layout.achieveMaster')
@section('title', 'Education Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>
<form action = "processEducation" method="post">
<input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
<h2>Edit Profile</h2>
<table>
<tr>
  <td>Degree Name: </td>
  <td><input type = "text" name = "degreename" value="{{$educate->getDegreeName()}}" maxlength=20/></td>
  </tr>
 <tr>
 	<td>University: </td>
 	<td><input type = "text" name = "university" value="{{$educate->getUniversity()}}" maxlength=20/></td>
 </tr>
 <tr>
  <td>Start Date: </td>
  <td><input type = "text" name = "startdate"  value="{{$educate->getStartdate()}}" maxlength=20/></td>
  </tr>
 <tr>
 	<td>End Date: </td>
 	<td><input type = "text" name = "enddate" value="{{$educate->getEnddate()}}" maxlength=20/></td>
 </tr>
 <tr>
    <td colspan = "2" align = "center">
        <input type = "submit" value = "Edit Education" /> 
        </td>
 </tr>
</table>
</form>
@endsection
