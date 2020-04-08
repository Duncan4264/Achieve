@extends('layout.achieveMaster')
@section('title', 'Create Job Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>
@if(Session::has('users'))
<form action = "createJob" method="post">
<input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
<h2>Create Job History</h2>
@if($errors->count() != 0)
<h1>List of Errors</h1>
@foreach($errors->all() as $message)
	{{ $message }} <br/>
@endforeach
@endif
<table>
<tr>
  <td>Job Title: </td>
  <td><input type = "text" name = "jobtitle" value="" maxlength=20/></td>
  </tr>
 <tr>
 	<td>Company: </td>
 	<td><input type = "text" name = "company" value="" maxlength=20/></td>
 </tr>
 <tr>
  <td>Start Date: </td>
  <td><input type = "text" name = "startdate"  value="" maxlength=20/></td>
  </tr>
 <tr>
 	<td>End Date: </td>
 	<td><input type = "text" name = "enddate" value=""  maxlength=20/></td>
 </tr>
 <tr>
    <td colspan = "2" align = "center">
        <input type = "submit" value = "Edit Job" /> 
        </td>
 </tr>
</table>
</form>
@endif
@endsection
