 @extends('genie.layouts.app')
 @section('title')
     Feed Back
@endsection
@section('content')	
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Feed Back</h3>
              </div>

               
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Feed Back  <small>Form</small> (<?php echo (isset($students->batchname)?$students->batchname:"<span style='color:red'>No Found Batch!</span>"); ?>)<div class="succesmessage"></div><div class="errormessage"></div> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <!-- Smart Wizard -->
                    <p>This is a feed back form the selected and submit of rating.</p>
					 <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">First Feed Back</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Second Feed Back</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Third Feed Back</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane   active show" id="tab_content1" aria-labelledby="home-tab">

                             <h2 class="StepTitle">First Feed Back</h2>
					    <div class="row">
                          
                          <div class="col-sm-12">
                            <div class="card-box">
						<table border="1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="40%">
						<tr><td>Name</td><td><?php echo(isset($students->name)?$students->name:""); ?></td><td>Mobile</td><td><?php echo(isset($students->phone)?$students->phone:""); ?></td></tr>
						<tr><td>Email</td><td><?php echo(isset($students->course)?$students->course:""); ?></td><td>Technology</td><td><?php echo(isset($students->course)?$students->course:""); ?></td></tr>
						<tr><td>Trainer Name</td><td><?php echo(isset($students->trainer_name)?$students->trainer_name:""); ?></td>
						<td>Reg Date</td><td><?php echo(isset($students->student_registered)?date('d-M-Y',strtotime($students->student_registered)):""); ?></td></tr>
						</table>
						</div>
						</div>
						</div>
						<div class="row">
                           <div class="col-sm-1">
						   </div>
                          <div class="col-sm-10">
                            <div class="card-box">
						<table border="1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="40%">
						<tr><td>5-Excellent</td><td>4–Very Good</td><td>3–Good</td><td>2–Poor</td><td>1–Very Poor</td></tr>
						 
						</table>
						</div>
						</div>
						</div>
						<form action="" class="form-horizontal form-label-left" onsubmit="return studentsController.firstFeedBacksubmit(this)">
						<div class="row">
                          <div class="col-sm-1">
						  </div>
                          <div class="col-sm-10">
                            <div class="card-box">
						<table border="1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<th colspan="7" >Trainer / Facilitator</th>
						<tr><th>Sr.No</th><th>Topics</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th></tr>
						<tr><td>1</td><td>Trainer encouraged active participation</td><td><div class="form-group"><input type="hidden" name="std_id" value="<?php echo(isset($students->std_id)?$students->std_id:""); ?>"><input type="radio" name="rating1" value="5"></td><td><input type="radio" name="rating1" value="4"></div></td><td><input type="radio" name="rating1" value="3"></td><td><input type="radio" name="rating1" value="2"></td><td><input type="radio" name="rating1" value="1"></td></tr>
						<tr><td>2</td><td>Trainer’s ability to resolve queries</td><td><input type="radio" name="rating2" value="5"></td><td><input type="radio" name="rating2" value="4"></td><td><input type="radio" name="rating2" value="3"> </td><td><input type="radio" name="rating2" value="2"></td><td><input type="radio" name="rating2" value="1"></td></tr>
						<tr><td>3</td><td>Trainer’s Preparation/presentation of training</td><td><input type="radio" name="rating3" value="5"></td><td><input type="radio" name="rating3" value="4"></td><td><input type="radio" name="rating3" value="3"></td><td><input type="radio" name="rating3" value="2"></td><td><input type="radio" name="rating3" value="1"></td></tr>
						<tr><td>4</td><td>Trainer’s Knowledge on the technology</td><td><input type="radio" name="rating4" value="5"></td><td><input type="radio" name="rating4" value="4"></td><td><input type="radio" name="rating4" value="3"></td><td><input type="radio" name="rating4" value="2"></td><td><input type="radio" name="rating4" value="1"></td></tr>
						<tr><td>5</td><td>Overall rating for the trainer</td><td><input type="radio" name="rating5" value="5"> </td><td><input type="radio" name="rating5" value="4"></td><td><input type="radio" name="rating5" value="3"></td><td><input type="radio" name="rating5" value="2"></td><td><input type="radio" name="rating5" value="1"></td></tr>
						 
						</table>
						</div>
						</div>
						</div>
						<div class="row">
                          <div class="col-sm-1">
						  </div>
                          <div class="col-sm-10">
                            <div class="card-box">
						<table border="1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="40%">
						<th colspan="7" >Content / Course Outline</th>
						<tr><th>Sr.No</th><th>Topics</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th></tr>
						<tr><td>1</td><td>The training met your expectations</td><td><input type="radio" name="courserating1" value="5"></td><td><input type="radio" name="courserating1" value="4"></td><td><input type="radio" name="courserating1" value="3"></td><td><input type="radio" name="courserating1" value="2"></td><td><input type="radio" name="courserating1" value="1"></td></tr>
						<tr><td>2</td><td>The content was organized and easy to follow</td><td><input type="radio" name="courserating2" value="5"></td><td><input type="radio" name="courserating2" value="4"></td><td><input type="radio" name="courserating2" value="3"></td><td><input type="radio" name="courserating2" value="2"></td><td><input type="radio" name="courserating2" value="1"></td></tr>
						<tr><td>3</td><td>Duration of the training was sufficient</td><td><input type="radio" name="courserating3" value="5"></td><td><input type="radio" name="courserating3" value="4"></td><td><input type="radio" name="courserating3" value="3"></td><td><input type="radio" name="courserating3" value="2"></td><td><input type="radio" name="courserating3" value="1"></td></tr>
						 
						 
						</table>
						</div>
						</div>
						</div>
						
						
						<div class="row">
                          <div class="col-sm-1">
						  </div>
                          <div class="col-sm-10">
                            <div class="card-box">
						<table border="1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="40%">
						<th colspan="7" >Hands – On / Activities</th>
						<tr><th>Sr.No</th><th>Topics</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th></tr>
						<tr><td>1</td><td>Practical / activities performed were relevant / sufficient as per Course Content</td><td><input type="radio" name="activities1" value="5"></td><td><input type="radio" name="activities1" value="4"></td><td><input type="radio" name="activities1" value="3"></td><td><input type="radio" name="activities1" value="2"></td><td><input type="radio" name="activities1" value="1"></td></tr>
						<tr><td>2</td><td>Required software/materials were available for the practical before training commencement</td><td><input type="radio" name="activities2" value="5"></td><td><input type="radio" name="activities2" value="4"></td><td><input type="radio" name="activities2" value="3"></td><td><input type="radio" name="activities2" value="2"></td><td><input type="radio" name="activities2" value="1"></td></tr>
						 
						 
						</table>
						</div>
						</div>
						</div>
						
						<?php 
						 
						//if($students->attendancebatch>=3){ ?>
						<div class="row">
						<div class="item form-group">
						<div class="col-md-12 col-sm-12 offset-md-10">
						<button type="submit" class="btn btn-success">Submit</button>
						<button class="btn btn-primary" type="button">Cancel</button>



						</div>
						</div>
						</div>
						 
						
						   </form>


                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
						<h2 class="StepTitle">Second Feed Back</h2>
						
					     
						<div class="row">
                           <div class="col-sm-1">
						   </div>
                          <div class="col-sm-10">
                            <div class="card-box">
						<table border="1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="40%">
						<tr><td>5-Excellent</td><td>4–Very Good</td><td>3–Good</td><td>2–Poor</td><td>1–Very Poor</td></tr>
						 
						</table>
						</div>
						</div>
						</div>
						<form action="" class="form-horizontal form-label-left" onsubmit="return studentsController.secondFeedBacksubmit(this)">
						<div class="row">
                          <div class="col-sm-1">
						  </div>
                          <div class="col-sm-10">
                            <div class="card-box">
						<table border="1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="40%">
						<th colspan="7" >Trainer / Facilitator</th>
						<tr><th>Sr.No</th><th>Topics</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th></tr>
						<tr><td>1</td><td>Trainer encouraged active participation</td><td><input type="hidden" name="std_id" value="<?php echo(isset($students->std_id)?$students->std_id:""); ?>"><input type="radio" name="rating1" value="5"></td><td><input type="radio" name="rating1" value="4"></td><td><input type="radio" name="rating1" value="3"></td><td><input type="radio" name="rating1" value="2"></td><td><input type="radio" name="rating1" value="1"></td></tr>
						<tr><td>2</td><td>Trainer’s ability to resolve queries</td><td><input type="radio" name="rating2" value="5"></td><td><input type="radio" name="rating2" value="4"></td><td><input type="radio" name="rating2" value="3"></td><td><input type="radio" name="rating2"value="2"></td><td><input type="radio" name="rating2" value="1"></td></tr>
						<tr><td>3</td><td>Trainer’s Preparation/presentation of training</td><td><input type="radio" name="rating3" value="5"></td><td><input type="radio" name="rating3" value="4"></td><td><input type="radio" name="rating3" value="3"></td><td><input type="radio" name="rating3" value="2"></td><td><input type="radio" name="rating3" value="1"></td></tr>
						<tr><td>4</td><td>Trainer’s Knowledge on the technology</td><td><input type="radio" name="rating4" value="5"></td><td><input type="radio" name="rating4" value="4"></td><td><input type="radio" name="rating4" value="3"></td><td><input type="radio" name="rating4"value="2"></td><td><input type="radio" name="rating4" value="1"></td></tr>
						<tr><td>5</td><td>Overall rating for the trainer</td><td><input type="radio" name="rating5" value="5"></td><td><input type="radio" name="rating5" value="4"></td><td><input type="radio" name="rating5" value="3"></td><td><input type="radio" name="rating5" value="4"></td><td><input type="radio" name="rating5" value="1"></td></tr>
						 
						</table>
						</div>
						</div>
						</div>
						<div class="row">
                          <div class="col-sm-1">
						  </div>
                          <div class="col-sm-10">
                            <div class="card-box">
						<table border="1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="40%">
						<th colspan="7" >Content / Course Outline</th>
						<tr><th>Sr.No</th><th>Topics</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th></tr>
						<tr><td>1</td><td>The training met your expectations</td><td><input type="radio" name="courserating1" value="5"></td><td><input type="radio" name="courserating1" value="4"></td><td><input type="radio" name="courserating1" value="3"></td><td><input type="radio" name="courserating1" value="2"></td><td><input type="radio" name="courserating1" value="1"></td></tr>
						<tr><td>2</td><td>The content was organized and easy to follow</td><td><input type="radio" name="courserating2" value="5"></td><td><input type="radio" name="courserating2" value="4"></td><td><input type="radio" name="courserating2" value="3"></td><td><input type="radio" name="courserating2" value="2"></td><td><input type="radio" name="courserating2" value="1"></td></tr>
						<tr><td>3</td><td>Duration of the training was sufficient</td><td><input type="radio" name="courserating3" value="5"></td><td><input type="radio" name="courserating3" value="4"></td><td><input type="radio" name="courserating3" value="3"></td><td><input type="radio" name="courserating3" value="2"></td><td><input type="radio" name="courserating3" value="1"></td></tr>
						 
						 
						</table>
						</div>
						</div>
						</div>
						
						
						<div class="row">
                          <div class="col-sm-1">
						  </div>
                          <div class="col-sm-10">
                            <div class="card-box">
						<table border="1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="40%">
						<th colspan="7" >Hands – On / Activities</th>
						<tr><th>Sr.No</th><th>Topics</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th></tr>
						<tr><td>1</td><td>Practical / activities performed were relevant / sufficient as per Course Content</td><td><input type="radio" name="activities1" value="5"></td><td><input type="radio" name="activities1" value="4"></td><td><input type="radio" name="activities1" value="3"></td><td><input type="radio" name="activities1" value="2"></td><td><input type="radio" name="activities1" value="1"></td></tr>
						<tr><td>2</td><td>Required software/materials were available for the practical before training commencement</td><td><input type="radio" name="activities2" value="5"></td><td><input type="radio" name="activities2" value="4"></td><td><input type="radio" name="activities2" value="3"></td><td><input type="radio" name="activities2" value="2"></td><td><input type="radio" name="activities2" value="1"></td></tr>
						 
						 
						</table>
						</div>
						</div>
						</div>
						
						<?php 
						  
						if($students->batch_course_status>=50){ ?>
						<div class="row">
						<div class="item form-group">
						<div class="col-md-12 col-sm-12 offset-md-10">
						<button type="submit" class="btn btn-success">Submit</button>
						<button class="btn btn-primary" type="button">Cancel</button>



						</div>
						</div>
						</div>
                            <?php } ?>
						</form>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                             <h2 class="StepTitle">Third Feed Back</h2>
					    
						<div class="row">
                           <div class="col-sm-1">
						   </div>
                          <div class="col-sm-10">
                            <div class="card-box">
						<table border="1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="40%">
						<tr><td>5-Excellent</td><td>4–Very Good</td><td>3–Good</td><td>2–Poor</td><td>1–Very Poor</td></tr>
						 
						</table>
						</div>
						</div>
						</div>
						<form action="" class="form-horizontal form-label-left" onsubmit="return studentsController.thirdFeedBacksubmit(this)">
						<div class="row">
                          <div class="col-sm-1">
						  </div>
                          <div class="col-sm-10">
                            <div class="card-box">
						<table border="1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="40%">
						<th colspan="7" >Trainer / Facilitator</th>
						<tr><th>Sr.No</th><th>Topics</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th></tr>
						<tr><td>1</td><td>Trainer encouraged active participation</td><td><input type="hidden" name="std_id" value="<?php echo(isset($students->std_id)?$students->std_id:""); ?>"><input type="radio" name="rating1" value="5"></td><td><input type="radio" name="rating1" value="4"></td><td><input type="radio" name="rating1" value="3"></td><td><input type="radio" name="rating1" value="2"></td><td><input type="radio" name="rating1" value="1"></td></tr>
						<tr><td>2</td><td>Trainer’s ability to resolve queries</td><td><input type="radio" name="rating2" value="5"></td><td><input type="radio" name="rating2" value="4"></td><td><input type="radio" name="rating2" value="3"></td><td><input type="radio" name="rating2" value="2"></td><td><input type="radio" name="rating2" value="1"></td></tr>
						<tr><td>3</td><td>Trainer’s Preparation/presentation of training</td><td><input type="radio" name="rating3" value="5"></td><td><input type="radio" name="rating3" value="4"></td><td><input type="radio" name="rating3" value="3"></td><td><input type="radio" name="rating3" value="2"></td><td><input type="radio" name="rating3" value="1"></td></tr>
						<tr><td>4</td><td>Trainer’s Knowledge on the technology</td><td><input type="radio" name="rating4" value="5"></td><td><input type="radio" name="rating4" value="4"></td><td><input type="radio" name="rating4" value="3"></td><td><input type="radio" name="rating4"value="2"></td><td><input type="radio" name="rating4" value="1"></td></tr>
						<tr><td>5</td><td>Overall rating for the trainer</td><td><input type="radio" name="rating5" value="5"></td><td><input type="radio" name="rating5" value="4"></td><td><input type="radio" name="rating5" value="3"></td><td><input type="radio" name="rating5" value="2"></td><td><input type="radio" name="rating5" value="1"></td></tr>
						 
						</table>
						</div>
						</div>
						</div>
						<div class="row">
                          <div class="col-sm-1">
						  </div>
                          <div class="col-sm-10">
                            <div class="card-box">
						<table border="1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="40%">
						<th colspan="7" >Content / Course Outline</th>
						<tr><th>Sr.No</th><th>Topics</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th></tr>
						<tr><td>1</td><td>The training met your expectations</td><td><input type="radio" name="courserating1" value="5"></td><td><input type="radio" name="courserating1" value="4"></td><td><input type="radio" name="courserating1" value="3"></td><td><input type="radio" name="courserating1" value="2"></td><td><input type="radio" name="courserating1" value="1"></td></tr>
						<tr><td>2</td><td>The content was organized and easy to follow</td><td><input type="radio" name="courserating2" value="5"></td><td><input type="radio" name="courserating2" value="4"></td><td><input type="radio" name="courserating2" value="3"></td><td><input type="radio" name="courserating2" value="2"></td><td><input type="radio" name="courserating2" value="1"></td></tr>
						<tr><td>3</td><td>Duration of the training was sufficient</td><td><input type="radio" name="courserating3" value="5"></td><td><input type="radio" name="courserating3" value="4"></td><td><input type="radio" name="courserating3" value="3"></td><td><input type="radio" name="courserating3" value="2"></td><td><input type="radio" name="courserating3" value="1"></td></tr>
						 
						 
						</table>
						</div>
						</div>
						</div>
						
						
						<div class="row">
                          <div class="col-sm-1">
						  </div>
                          <div class="col-sm-10">
                            <div class="card-box">
						<table border="1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="40%">
						<th colspan="7" >Hands – On / Activities</th>
						<tr><th>Sr.No</th><th>Topics</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th></tr>
						<tr><td>1</td><td>Practical / activities performed were relevant / sufficient as per Course Content</td><td><input type="radio" name="activities1" value="5"></td><td><input type="radio" name="activities1" value="4"></td><td><input type="radio" name="activities1" value="3"></td><td><input type="radio" name="activities1" value="2"></td><td><input type="radio" name="activities1" value="1"></td></tr>
						<tr><td>2</td><td>Required software/materials were available for the practical before training commencement</td><td><input type="radio" name="activities2" value="5"></td><td><input type="radio" name="activities2" value="4"></td><td><input type="radio" name="activities2" value="3"></td><td><input type="radio" name="activities2" value="2"></td><td><input type="radio" name="activities2" value="1"></td></tr>
						 
						 
						</table>
						</div>
						</div>
						</div>
						<?php 
						 
						if($students->batch_course_status=='100'){ ?>
						<div class="row">
						<div class="item form-group">
						<div class="col-md-12 col-sm-12 offset-md-10">
						<button type="submit" class="btn btn-success">Submit</button>
						<button class="btn btn-primary" type="button">Cancel</button>



						</div>
						</div>
						</div>
						<?php } ?>
						</form>
							
                          </div>
                        </div>
                      </div>
					  
					
					
					
                      
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
@endsection
		
        