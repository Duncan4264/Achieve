@extends('layout.achieveMaster')
@section('title', 'Edit Skill Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>
@if(Session::has('users'))
<form action = "processSkill" method="post">
<input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
<input type="hidden" name="id" value="{{$skill->getId()}}">
<h2>Edit Skill</h2>
@if($errors->count() != 0)
<h1>List of Errors</h1>
@foreach($errors->all() as $message)
	{{ $message }} <br/>
@endforeach
@endif
<table>
<tr>
  <td>Skill name: </td>
  <td><input type = "text" name = "skill" value="{{$skill->getSkill()}}" maxlength=20/></td>
  </tr>
 <tr>
    <td colspan = "2" align = "center">
        <input type = "submit" value = "Edit Profile" /> 
        </td>
 </tr>
</table>
</form>
@endif
@endsection
