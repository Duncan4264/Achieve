@extends('layout.achieveMaster')
@section('title', ' Search Results Page')

@section('content')

<table>
<tr>
<td>
@if($jobs == null)
<h1>Search Results Not Found</h1>
@endif
@if($jobs !=null)
@foreach($jobs as $job)
<form action='adminAction' method="post">
<input type="hidden" name = "_token" value = "{{csrf_token()}}" />
    <h1>{{$job->getJobTitle()}}</h1><h1>-----------------</h1><h2>{{$job->getCompany()}}</h2>
    <input type="hidden" name="id" value="{{$job->getId()}}">
    <input type="hidden" name="search" value="{{$search}}">
    
    <button type="submit" name="show" formaction="displayjob">Show Job</button>

    </form>
@endforeach
@endif
</td>
</tr>
</table>


@endsection
