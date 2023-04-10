@extends('genie.layouts.app')
@section('title')
     <?php if(!empty($jobsdetails->title)){ echo ucfirst($jobsdetails->title); } ?>
@endsection
@section('content')	
 <div class="right_col" role="main">
        <div class="">
            <style>
            .button1 {
    margin: auto;
    display: block;
    padding: 10px 24px;
    border: none;
    background: linear-gradient(45deg, #007dac, #172e45);
    color: #fff;
    border-radius: 4px;
}
    .button1 a {
    color: #fff !important;
    }
    .singlepage-job-list {
    padding: 8px 0;
}
.singlepage-job-listing-heading {
    border-left: 2px solid #083553;
    padding: 20px 0px 15px 15px;
    margin-bottom: 15px;
}
.singlepage-contact-details ul{
        margin-left: -23px;
}
.singlepage-job-listing-heading ul{
        margin-left: -23px;
}
.singlepage-job-desc-left {
    padding: 0 50px 0 25px;
    text-align: justify;
    border-right: 2px solid #083553;
}
.singlepage-job-desc-left-sections {
    margin-bottom: 40px;
    color: #737373;
}
.singlepage-job-desc-left-sections p {
    margin-top: 20px;
}
.singlepage-job-desc-right-sections {
    margin-bottom: 15px;
    border-bottom: 1px solid #000;
    padding-bottom: 5px;
    color: #737373;
}
.singlepage-key-skill {
    margin-left: 15px;
    padding: 40px 0;
}
.singlepage-keyskill-heading-line.contact {
    color: #083553;
    margin-left: 19px;
}
.singlepage-keyskill-heading-line h5 i {
    margin-right: 10px;
}
.horizontal-line {
    width: 50%;
    height: 2px;
    background: #083553;
    position: absolute;
    top: 50%;
    margin-left: 10px;
}

.singlepage-key-skill-listing {
    display: flex;
    flex-wrap: wrap;
    margin-left: 23px;
}
.singlepage-contact {
    padding: 40px 0;
}
.singlepage-keyskill-heading-line {
    color: #083553;
}
.singlepage-keyskill-heading-line h5, .singlepage-job-listing-heading-line h5 {
    position: relative;
}
.singlepage-contact-details {
    margin-left: 30px;
    color: #737373;
}
ul {
    list-style: none;
}
.singlepage-contact-details ul li {
    display: flex;
}
.singlepage-contact-details ul li strong {
    width: 220px;
}
            </style>
			<div class="clearfix"></div>
			<?php //echo "<pre>";print_r($jobsdetails); ?>
			<div class="row">
				<div class="col-md-8">
					<div class="main">	
						<section class="singlepage-job-list">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<div class="singlepage-job-listing-heading">
											<div class="singlepage-job-listing-heading-line">
												<h5> {{$jobsdetails->title}}<span class="horizontal-line"></span></h5>
											</div>
											<ul>
												<li><i class="fa fa-briefcase"></i>&nbsp; <?php echo $jobsdetails->from_year;?>&nbsp; - <?php echo $jobsdetails->maxexperience;?> Year</li>
												<li><i class="fa fa-rupee"></i>&nbsp; Not Disclosed</li>
												<li><i class="fa fa-map-marker"></i>&nbsp; <?php echo $jobsdetails->location;?></li>
                                                <li><i class="fa fa-calendar"></i><span>&nbsp; <?php if($jobsdetails->modificationdate){ echo date('j<\s\u\p>S</\s\u\p> M Y',strtotime($jobsdetails->modificationdate)); } ?></span>
                                                </li>
											</ul>
										</div>
										<!--<a class="button1" href="" target="_blank">APPLY NOW</a>-->
										<div class="apply-job-detail">
											<!--<button>APPLY NOW</button>-->
											<button class="button1"><a  href="{{url('https://cromacampus.com/jobportal/home/jobdetails/'.base64_encode($jobsdetails->jobid))}}" target="_blank">APPLY NOW</a></button>
										</div>
									</div>
								</div>
							</div>
						</section>
						<section class="singlepage-job-desc">
							<div class="container">
								<div class="row">
									<div class="col-md-9">
										<div class="singlepage-job-desc-left">
											<div class="singlepage-job-desc-left-sections">
												<strong>Job Description : </strong>
												<p><?php echo $jobsdetails->description;?></p>
											</div>
											<div class="singlepage-job-desc-left-sections">
												<strong>Key &amp; Responsibilities : </strong>
												<p><?php if(!empty($jobsdetails->courses_name)){  echo $jobsdetails->courses_name;	}  	?>,{{$jobsdetails->technology}}.</p>
											</div>
										 
										</div>
									</div>
									<div class="col-md-3">
										<div class="singlepage-job-desc-right">
											<div class="singlepage-job-desc-right-sections">
												<strong>Salary</strong>
												<p>Not Disclosed</p>
											</div>
											<div class="singlepage-job-desc-right-sections">
												<strong>Industry</strong>
												<p><?php echo $jobsdetails->companyname;?></p>
											</div>
											<div class="singlepage-job-desc-right-sections">
												<strong>Functional Areas</strong>
												<p><?php echo $jobsdetails->location;?></p>
											</div>
											<div class="singlepage-job-desc-right-sections">
												<strong>Experience</strong>
												<p><?php echo $jobsdetails->from_year;?>-<?php echo $jobsdetails->maxexperience;?> Year</p>
											</div>
											<div class="singlepage-job-desc-right-sections">
												<strong>Empolyment Type</strong>
												<p>Full Time, Permanent</p>
											</div>
											<div class="singlepage-job-desc-right-sections">
												<strong>Education</strong>
												<p>B.Tech</p>
												<p>MBA</p>
												<p>BCA</p>
												<p>MCA</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
						<section class="singlepage-key-skill">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<div class="singlepage-keyskill-heading-line">
											<h5><i class="fa fa-lightbulb-o"></i>Key Skills <span class="horizontal-line"></span></h5>
										</div>
										<div class="singlepage-key-skill-listing">
                                        @if(!empty($jobsdetails->courses_name))
                                        <?php $listjob = explode(',',$jobsdetails->courses_name);
                                        
                                        if(!empty($listjob)){
                                        foreach($listjob as $key=>$val){
                                        ?>
                                        <a href="#0"><?php echo  $val.',&nbsp;'; ?></a>
                                        <?php  } } ?>
                                        
                                        @endif
											  {{$jobsdetails->technology}}
										</div>
									</div>
								</div>
							</div>
						</section>
						<section class="singlepage-contact">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<div class="singlepage-keyskill-heading-line contact">
											<h5><i class="fa fa-user"></i>Contact Details <span class="horizontal-line"></span></h5>
										</div>
										<div class="singlepage-contact-details">
											<ul>
												<li>
													<strong>Contact Person : </strong>
													<span><?php echo $jobsdetails->c_name;?></span>
												</li>
												<li>
													<strong>Contact Number : </strong>
													<span><?php echo $jobsdetails->c_mobile;?></span>
												</li>
												<li>
													<strong>E-mail : </strong>
													<span><?php echo $jobsdetails->c_email;?></span>
												</li>
											</ul>
										</div>
											<!--<a class="button1" href="" target="_blank" style="width: 140px;">APPLY NOW</a>-->
											<div class="apply-job-detail">
											<!--<button>APPLY NOW</button>-->
												<button class="button1"><a  href="{{url('https://cromacampus.com/jobportal/home/jobdetails/'.base64_encode($jobsdetails->jobid))}}" target="_blank">APPLY NOW</a></button>
											</div>
									</div>
								</div>
							</div>
						</section>
		   
					</div>
					
				</div>
			
				  @include('genie.layouts.sidebar_form')
				
				
			</div>	
            
		</div>
	</div>
	


@endsection