@extends('layout.achieveMaster')
@section('title', 'Profile Page')

@section('content')
<?php 
// Cyrus Duncan
// CST - 256
// This is my own work
?>

<h2>Profile</h2>
<form action="getProfile" method="get">
<table>
<tr>
  <td>First Name: </td>
  <td>{{ $profile->getFirstname() }}</td>
  </tr>
 <tr>
 	<td>Last Name: </td>
 	<td>{{ $profile->getLastname() }}</td>
 </tr>
 <tr>
  <td>Country: </td>
  <td>{{$profile->getCountry()}}</td>
  </tr>
 <tr>
 	<td>State: </td>
 	<td>{{$profile->getState()}}</td>
 </tr>
  <tr>
  <td>City: </td>
  <td>{{$profile->getCity()}}</td>
  </tr>
 <tr>
 	<td>Street: </td>
 	<td>{{$profile->getStreet()}}</td>
 </tr>
  <tr>
 	<td>Zip: </td>
 	<td>{{$profile->getZip()}}</td>
 </tr>
</table>
@if(!!Session::has('users'))
  <button type="submit" formaction="createprofile">Create Profile</button>

@endif
  <button type ="submit" formaction="editprofile">Edit Profile</button>
  </form>
@endsection
