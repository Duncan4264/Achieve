@extends('layout.achieveMaster')
@section('title', 'Show Job Page')

@section('content')

@if(Session::has('users'))

<table>
<tr>
<td>
<br>
<h1>Position Title:</h1>
<h2>{{$job->getJobTitle()}}</h2>
<br>
<h1>Company:</h1>
<h3>{{$job->getCompany()}}</h3>
<br>
<h1>Job Description:</h1>
<h3>{{$job->getDescription()}}</h3>
<br>
<h1>Job Salary:</h1>
<h3>{{$job->getSalary()}}</h3>
<br>
<h1>Job Requirements:</h1>
<h3>{{$job->getRequirements()}}</h3>
<br>

<form name="jobAction" action="recruitmentAction" method="post">
<input type="hidden" name = "_token" value = "{{csrf_token()}}" />
<input type="hidden" name="id" value="{{$job->getID()}}">
<input type="hidden" name="name" value="{{$job->getJobTitle()}}">
<input type="hidden" name="search" value="{{$search}}">
<button name="apply" formaction="apply">Apply</button>
<button name="cancel" formaction="cancelJob">Cancel</button>
</form>
</td>


</tr>
</table>
@endif



@endsection
