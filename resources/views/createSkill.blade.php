@extends('layout.achieveMaster')
@section('title', 'Edit Skill Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>
@if(Session::has('users'))
<form action = "processCreateSkill" method="post">
<input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
<h2>Create Skill</h2>
@if($errors->count() != 0)
<h1>List of Errors</h1>
@foreach($errors->all() as $message)
	{{ $message }} <br/>
@endforeach
@endif
<table>
<tr>
  <td>Skill name: </td>
  <td><input type = "text" name = "skill" value="" maxlength=20/></td>
  </tr>
 <tr>
    <td colspan = "2" align = "center">
        <input type = "submit" value = "Create Skill" /> 
        </td>
 </tr>
</table>
</form>
@endif
@endsection
