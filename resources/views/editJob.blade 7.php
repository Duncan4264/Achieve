@extends('layout.achieveMaster')
@section('title', 'Edit Skill Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>
<form action = "processJob" method="post">
<input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
<h2>Edit Profile</h2>
<table>
<tr>
  <td>Job Title: </td>
  <td><input type = "text" name = "jobtitle" value="{{$jobs->getJobTitle()}}" maxlength=20/></td>
  </tr>
 <tr>
 	<td>Company: </td>
 	<td><input type = "text" name = "company" value="{{$jobs->getCompany()}}" maxlength=20/></td>
 </tr>
 <tr>
  <td>Start Date: </td>
  <td><input type = "text" name = "startdate"  value="{{$jobs->getStartDate()}}" maxlength=20/></td>
  </tr>
 <tr>
 	<td>End Date: </td>
 	<td><input type = "text" name = "enddate" value="{{$jobs->getEndDate()}}"  maxlength=20/></td>
 </tr>
 <tr>
    <td colspan = "2" align = "center">
        <input type = "submit" value = "Edit Job" /> 
        </td>
 </tr>
</table>
</form>
@endsection
