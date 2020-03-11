@extends('layout.achieveMaster')
@section('title', 'Edit Job Posting Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>
@if(Session::has('users'))
<form action = "processEditRecruitment" method="post">
<input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
<h2>Edit Job</h2>
@if($errors->count() != 0)
<h1>List of Errors</h1>
@foreach($errors->all() as $message)
	{{ $message }} <br/>
@endforeach
@endif
<table>
<tr>
  <td>Job Title: </td>
  <td><input type = "text" name = "jobtitle" value="{{$job->getJobTitle()}}" maxlength=20/></td>
  </tr>
 <tr>
 	<td>Company: </td>
 	<td><input type = "text" name = "company" value="{{$job->getCompany()}}" maxlength=20/></td>
 </tr>
 <tr>
  <td>Descripton: </td>
  <td><input type = "text" name = "descripton"  value="{{$job->getDescription()}}" maxlength=20/></td>
  </tr>
 <tr>
 	<td>Salary: </td>
 	<td><input type = "text" name = "salary" value="{{$job->getSalary()}}" maxlength=20/></td>
 </tr>
  <tr>
  <td>Requirements: </td>
  <td><input type = "text" name = "requirements"  value="{{$job->getRequirements()}}" maxlength=20/></td>
  <td><input type="hidden" name="id" value="{{$id}}"></td>
  </tr>
 <tr>
 
    <td colspan = "2" align = "center">
        <input type = "submit" value = "Edit Job Post" /> 
        </td>
 </tr>
</table>
</form>
@endif
@endsection
