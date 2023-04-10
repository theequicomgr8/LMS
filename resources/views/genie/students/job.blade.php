@extends('genie.layouts.app')
@section('title')
     Jobs
@endsection
@section('content')	

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <style>
            .button1 {
    margin: auto;
    display: block;
    padding: 10px 24px;
    border: none;
    background: linear-gradient(
45deg, #007dac, #172e45);
    color: #fff;
    border-radius: 4px;
}
</style>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-8">
                <div class="jobs-available">
                    
                    <?php //echo "<pre>"; print_r($jobs); ?>
				@if(!empty($jobs))
					@foreach($jobs as $job)
                  <div class="jobs-section">
                    <div class="jobs-list">
                      <div class="job-heading">
                        <h5><?php if(!empty($job->title)){ echo ucfirst(substr($job->title,0,15)); } ?></h5>
                      </div>
                      <div class="job-data">
                        <div class="job-exp">
                          <i class="fa fa-suitcase"></i>
                          <span>{{$job->exp_req.'-'.$job->maxexperience.'Yr'}}</span>
                        </div>
                        <div class="salary-package">
                          <i class="fa fa-rupee"></i>
                          <span><?php if(!empty($job->fromlacs)){ $job->fromlacs.'-'.$job->tolacs.' Lacs'; }else{ echo "Not Disclosed"; } ?></span>
                        </div>
                       
						
						<div class="job-location">
                          <i class="fa fa-map-marker"></i>
                          <span>@if(!empty($job->location)){{$job->location}} @endif</span>
                        </div>
						 <div class="job-date">   
							<i class="fa fa-calendar"></i>						 
                          <span><?php if($job->modificationdate){ echo date('j<\s\u\p>S</\s\u\p> M Y',strtotime($job->modificationdate)); } ?></span>
                        </div>
                        <div class="job-desc">
                          <p><strong>Skills: </strong> @if(!empty($job->technology)){{ substr($job->technology,0,28)}} @endif </p>
                           <p> <a href="{{url('student/jobs/details/'.base64_encode($job->jobid))}}" target="_blank">More...</a></p>
						   
						   
						   
						   
                        </div>
                      </div>
                    </div>
                    <div class="apply-job">
                      <button class="button1"><a href="{{url('student/jobs/details/'.base64_encode($job->jobid))}}" target="_blank">APPLY NOW</a></button>
                    </div>
                  </div>
@endforeach
@endif
                    
                  
                  
                </div>
              </div>
				     @include('genie.layouts.sidebar_form')
            </div>
          </div>
        </div>
		    <script>
       function hideA(x) {
         if (x.checked) {
           document.getElementById("A").style.display = "none";
           document.getElementById("B").style.display = "block";
         }
       }

       function hideB(x) {
         if (x.checked) {
           document.getElementById("B").style.display = "none";
           document.getElementById("A").style.display = "block";
         }
       }
    </script>        
		@endsection