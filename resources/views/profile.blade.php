@extends('layout.achieveMaster')
@section('title', 'Profile Page')

@section('content')

@if(Session::has('users'))
<div class="container emp-profile">
            <form method="get">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    @if(Session::has('suspended'))
                    <h1>SUSPENDED</h1>
                    @endif
                        <div class="profile-head">
                                    <h5>
                                         {{ $profile->getFirstName() }} {{$profile->getLastName() }}
                                    </h5>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Education</a>
                                </li>
                                
                                    <li class="nav-item">
                                    <a class="nav-link" id="job-tab" data-toggle="tab" href="#job" role="tab" aria-controls="job" aria-selected="false">Job History</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="edit" formaction="editprofile" value="Edit Profile"/>

                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>SKILLS</p>
                            @if($skills != null)
                            @foreach ($skills as $skill)
                             <form action='skillAction' method="post">
                              <input type="hidden" name="id" value="{{$skill->getId()}}"/>
                              <input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
                            <a href="">{{$skill->getSkill()}}</a><br/>
                            <input type="submit" class="profile-edit-btn" name="editSkills" formaction="editskill" formmethod="post" value="Edit Skill"/>
                            </form>
                            </br>
                      @endforeach  
                      @endif  
                        </div>
                          <input type="submit" class="profile-edit-btn" name="createSkill" formaction="createskill" value="Create Skill"/>
                            
       
                    </div>
                 
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Country: </label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$profile->getCountry()}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>State: </label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$profile->getState()}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>City: </label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$profile->getCity()}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Street: </label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$profile->getStreet()}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Zip: </label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$profile->getZip()}}</p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                              @if($educations != null)
                              @foreach ($educations as $education)
                              <form action='educationAction' method="post">
                              <input type="hidden" name="id" value="{{$education->getId()}}"/>
                              <input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Degree Title: </label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$education->getDegreeName()}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>University: </label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$education->getUniversity()}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Start Date:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$education->getStartDate()}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>End Date:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$education->getEndDate()}}</p>
                                                 
                                            </div>
                                        </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" class="profile-edit-btn" name="editeducation" formaction="editeducation" formmethod="post" value="Edit Education"/>
                                    </div>
                                    
                                    </div>
                                   
                                   
                               
                                 </br>
                                 </form>
                                     @endforeach
                                     @endif
                                      <form action='educationAction' method="get">
                                 <div class="row">
                                    <div class="col-md-11">
                                    <input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
                                        <input type="submit" class="profile-edit-btn" name="createeducation" formaction="createeducation" value="Create Education"/>
                                    </div>   
                                    
                                </div>
                                </form>
                                
                            </div>

                            
                             <div class="tab-pane fade" id="job" role="tabpanel" aria-labelledby="profile-tab">
                             @if($jobs != null)
                             @foreach ($jobs as $job)
                             <form action='jobAction' method="post">
                              <input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
                              <input type="hidden" name="id" value="{{$job->getId()}}"/>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Job Title: </label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$job->getJobTitle()}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Compaty Name: </label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$job->getCompany()}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Start Date:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$job->getStartDate()}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>End Date:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$job->getEndDate()}}</p>
                                            </div>
                                        </div>
                           
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" class="profile-edit-btn" name="editjob" formaction="editjob" formmethod="post" value="Edit Job History"/>
                                    </div>
                                    
                                </div>
                                </br>
                                </form>
                                  @endforeach
                                  @endif
                                   <form action='jobAction' method="get">
                                     <input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
                                 <div class="row">
                                    <div class="col-md-11">
                                        <input type="submit" class="profile-edit-btn" name="createJob" formaction="createjob" value="Create Job"/>
                                    </div>   
                                    
                                </div>
                                </form>
                            
                            </div>
                            
                            
                           
                             
                        </div>
                    </div>
                </div>
            </form>           
        </div>
@endif
@endsection
