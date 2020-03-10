@extends('layout.achieveMaster')
@section('title', ' Search Results Page')

@section('content')

<table>
<tr>
<td>
@foreach($jobs as $job)
<form action='adminAction' method="post">
<input type="hidden" name = "_token" value = "{{csrf_token()}}" />
    <h1>{{$job->getJobTitle()}}</h1>
    <input type="hidden" name="id" value="{{$job->getId()}}">
    
    <button type="submit" name="show" formaction="displayJob">Show</button>

    </form>
@endforeach
</td>
</tr>
</table>


@endsection
