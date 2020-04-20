@extends('layout.achieveMaster')
@section('title', ' Job Admin Page')

@section('content')

 @if(Session::has('admin'))
 
 <form action='createJobPost' method="get">
<input type="hidden" name = "_token" value = "{{csrf_token()}}" />
<button type="submit" name="Create" formaction="createRecruitment">Create Job Post</button>
    </form>
@if($job != null)
<table>
<tr>
<td>

@foreach ($job as $jobs)
<form action='adminAction' method="post">
<input type="hidden" name = "_token" value = "{{csrf_token()}}" />
    <h1>{{$jobs->getJobTitle()}}</h1>
    <input type="hidden" name="id" value="{{$jobs->getId()}}">
    
    <button type="submit" name="Edit" formaction="displayEditRecuritment">Edit</button>

    <button type="submit" name="Delete" formaction="confirmDeleteRecuritment">Delete</button>
    </form>
@endforeach
</td>
</tr>
</table>
@endif
@endif



@endsection
