@extends('layout.achieveMaster')
@section('title', 'Edit Skill Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>
<form action = "processSkill" method="post">
<input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
<h2>Edit Profile</h2>
<table>
<tr>
  <td>Skill 1: </td>
  <td><input type = "text" name = "skill1" value="{{$skill->getSkill1()}}" maxlength=20/></td>
  </tr>
 <tr>
 	<td>Skill 2: </td>
 	<td><input type = "text" name = "skill2" value="{{$skill->getSkill2()}}" maxlength=20/></td>
 </tr>
 <tr>
  <td>Skill 3: </td>
  <td><input type = "text" name = "skill3"  value="{{$skill->getSkill3()}}" maxlength=20/></td>
  </tr>
 <tr>
 	<td>Skill 4: </td>
 	<td><input type = "text" name = "skill4" value="{{$skill->getSkill4()}}" maxlength=20/></td>
 </tr>
  <tr>
  <td>Skill 5: </td>
  <td><input type = "text" name = "skill5"  value="{{$skill->getSkill5()}}" maxlength=20/></td>
  </tr>
 <tr>
    <td colspan = "2" align = "center">
        <input type = "submit" value = "Edit Profile" /> 
        </td>
 </tr>
</table>
</form>
@endsection
