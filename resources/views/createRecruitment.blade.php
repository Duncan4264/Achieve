@extends('layout.achieveMaster')
@section('title', 'Create Job Post Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>
<form action = "processRecuitment" method="post">
<input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
<h2>Create Job Posting</h2>
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
  <td>Description: </td>
  <td><input type = "text" name = "description"  value="" maxlength=20/></td>
  </tr>
 <tr>
 	<td>Salary: </td>
 	<td><input type = "text" name = "salary" value=""  maxlength=20/></td>
 </tr>
  <tr>
 	<td>Requirements: </td>
 	<td><input type = "text" name = "requirements" value=""  maxlength=20/></td>
 </tr>
 <tr>
    <td colspan = "2" align = "center">
        <input type = "submit" value = "Create Job Posting" /> 
        </td>
 </tr>
</table>
</form>
@endsection
