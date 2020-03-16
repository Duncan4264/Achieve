@extends('layout.achieveMaster')
@section('title', 'Education Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>
@if(Session::has('users'))
<form action = "processEducation" method="post">
<input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
<input type="hidden" name="id" value="{{$educate->getId()}}">
<h2>Edit Education</h2>
@if($errors->count() != 0)
<h1>List of Errors</h1>
@foreach($errors->all() as $message)
	{{ $message }} <br/>
@endforeach
@endif
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
@endif
@endsection
