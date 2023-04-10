  @extends('genie.layouts.app')
 @section('title')
    Student Dashborad
@endsection
@section('content')	
<style>
/*.fc-day-number*/
/*{*/
/*    color:#fff ;*/
/*}*/

.tile_count
{
    margin-bottom:10px;
}
.mycircle-table tbody
{
    height:38px;
}
.student-batch-name-home a:hover
{
    color:#5A738E;
}
.block .block_content .excerpt a i 
{
      top: 13px;
    
}
.download-icon-pdf
{
    white-space: nowrap;
    width: 392px;
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
}
.table td, .table th {
    padding: 9px 13px !important;
}
.download-icon-pdf i {
    background: #c00303;
    color: #fff;
    padding: 9px;
    border-radius: 50%;
    margin-right: 0px;
    position: absolute;
    top: 4px;
    right: 20px;
}
.download-icon-edit i,.download-icon-play i
{
      position: absolute;
    top: 4px;
    right: 20px;
}
/*ul.quick-list li {*/
/*     padding-top: 9px;*/
   
/*}*/
.student-batch-name-home a span,.x_content h4
{
        font-size: 17px;

}

.timeline.widget
{
    margin-bottom:0px;
}
.fc-unthemed td.fc-today {
    background: #fcf8e300;
}
.x_title {
    border-bottom: 1px solid #dddddd;
    padding: 1px 5px 6px;
    margin-bottom: 10px;
}
ul.quick-list {
    /* width: 45%; */
    padding-left: 0;
    margin-bottom: 30px;
    display: inline-block;
}
/*.x_content h4 {*/
/*    font-size: 18px;*/
/*    font-weight: 500;*/
/*    margin-bottom: 25px;*/
/*    color: #73879C;*/
/*}*/
   .x_panel {
    border: none !important;
    min-height: 360px;
    position: relative;
    box-shadow: rgb(0 0 0 / 25%) 0px 1px 4px;
    border-radius: 2px;
    padding: 8px 15px 16px;
    display: block;
    margin-bottom: 20px;
}
@media (min-width: 360px) and (max-width: 812px)
{
    .x_panel {
   
    min-height: 0px;
    
}
.download-icon-pdf
{
    white-space: nowrap;
    width: 180px;
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
}
.student_batch-heading h4
{
    width: 198px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.x_title h2 {
    font-size: 20px;
}
.tile,.graph {
    zoom: 100%;
    height: inherit;
}
}
</style>
 <div class="right_col" role="main">
          <!-- top tiles -->
          	 
	 
          <div class="tile_count">
		
            <div class="tile_stats_count bor-top">
              <span class="count_top"><i class="fa fa-book"></i> Course </span>
              <div class="count" ng-bind="stud_course_short" title="<%stud_course%>"> </div>
              <!--<span class="count_bottom"><i class="green">4% </i> From last Month</span>-->
            </div>
            <div class="tile_stats_count bor-top">
              <span class="count_top"><i class="fa fa-clock-o"></i> Class Taken </span>
              <div class="count"  ng-bind="stud_take_attendance"></div>
             <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Month</span>-->
            </div>
            <div class="tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Topic Covered </span>
              <div class="count green" ng-bind="stud_course_compete"></div>
              <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>2% </i> From last Month</span>-->
            </div>
            <div class="tile_stats_count">
              <span class="count_top red"><i class="fa fa-money"></i> Fees Pending</span>
              <div class="count red" ng-bind="std_feespending"></div>
             <!-- <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>2% </i> From last Week</span>-->
            </div>
            <div class="tile_stats_count">
              <span class="count_top"><i class="fa fa-calendar"></i> Due Date </span>
              <div class="count" ng-bind="std_due_date"></div>
              <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>14% </i> From last Week</span>-->
            </div>
            <div class="tile_stats_count">
              <span class="count_top"><i class="fa fa-graduation-cap"></i> Course Opted </span>
              <div class="count"><?php if(!empty($studentdash)){ echo count($studentdash); } ?></div>
              <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>95% </i> From last Month</span>-->
            </div>
          </div>
          <!-- /top tiles -->

        
          <br />
<style>
.fc-title{
	color: #fff;
    text-align: center;
    margin-left: 8px;
}

tr:first-child>td>.fc-day-grid-event {
    margin-top: -28px;
    z-index: -9;
}
.fc-day-number > .fc-event-container{
	
	color:#fff !important;
}
.fc-ltr .fc-basic-view .fc-day-top .fc-day-number{
	float:none;
	
}
.fc-row .fc-content-skeleton td, .fc-row .fc-helper-skeleton td {
    text-align: center;
}
</style>
          <div class="row">
            <div class="col-md-4 col-sm-4 ">
              <div class="x_panel tile">
                <div class="x_title mb-3">
                  <h2>Attendance </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
				<style>
	.excerpt
	{
	    margin-bottom:0px;
	}
	.fc-widget-header .fc-sun{
		color:red;
	}
	.fc-row.fc-week.fc-widget-content .fc-bg .fc-sun{
		background:#ddd;
		color:#2A3F54;
	}	
	
	.fc-widget-header .fc-sat{
		color:red;
	}
	.fc-row.fc-week.fc-widget-content .fc-bg .fc-sat{
		background:#ddd;
		 
	}		 
	 .fc-basic-view .fc-body .fc-row {		 
    min-height: 1em !important;
	}
	.fc-widget-content .fc-scroller.fc-day-grid-container{
		   overflow: hidden !important;
	}
	.fc-time{
		display:none;
		
	}
	.fc-other-month .fc-day-number {
     display:none;
}
				</style>
			 
                <div class="x_content">            
 
 
				 <div id='calendar' data-stud_cal_id="<%stud_id%>"></div>
                </div>
				 
              </div>
            </div>

            <div class="col-md-4 col-sm-4 ">
              <div class="x_panel tile">
                <div class="x_title mb-3">
                  <h2>Performance </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <h4>Usage of Student</h4>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Video</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span ng-bind="std_total_c_video"></span>
                    </div>
                  </div>

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Notes</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span ng-bind="std_total_c_notes"></span>
                    </div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Assignments </span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span ng-bind="std_total_c_assign"></span>
                    </div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Feed Back</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                          <span class="sr-only"></span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span ng-bind="std_total_feedback"></span>
                    </div>
                  </div>
                  <!--<div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.6</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>1k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>-->

                </div>
              </div>
            </div>
            
            <div class="col-md-4 col-sm-4" onclick="window.open('<?php echo url('student/student-batch'); ?>')" >
            <div class="x_panel tile batch-home">
            <div class="x_title mb-3">
            <h2>Batch Details</h2>
            <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
            </ul>
            <div class="clearfix"></div>
            </div>
            <h2 class="student-batch-name-home"><a href="{{url('student/student-batch')}}" target="_blank" title="<%stud_batch_name%>"><span ng-bind="stud_batch_short"></span></a></h2>
            <div class="x_content">
            <ul class="quick-list">
            <li><i class="fa fa-calendar"></i><a href="#0" target="_blank" title="Batch Start Date">Start Date: <span ng-bind="stud_batch_start"></span></a></li>
            <li><i class="fa fa-book"></i><a href="" target="_blank" title="Course Name"><span ng-bind="stud_course"></span> </a></li>
            <li><i class="fa fa-user"></i><a href="" target="_blank" title="Trainer Name"><span ng-bind="stud_trainer_name"></span> </a></li>
            <li><i class="fa fa-calendar-check-o"></i><a href="#" title="Attendance">Attendance <span ng-bind="stud_attendancebatch"></span></a> </li>
            </ul>
            <div class="show-student" >  </div>
            </div>
            </div>
            </div>

        
          </div>
			<div class="row">
              <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Circular</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
					@if(!empty($coursesVideo))
						@foreach($coursesVideo as $video)
					<?php $cours= App\FeesCourse::where('id',$video->course_id)->first();
					if(!empty($cours)){
						$coursename=$cours->course;
					
					}
					
					?>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>{{$coursename}}</a>
                                          </h2>
                            <div class="byline">
                             <!-- <span>13 hours ago</span> by <a>Jane Smith</a>-->
                            </div>
                            <p class="excerpt">
							 <a href="#0" class="download-icon-play" data-toggle="modal" data-target="#getCourseVideoForm_<?php echo (isset($video->id)?$video->id:""); ?>"><i class="fa fa-play"></i></a>					
						  						
					 
							<div id="getCourseVideoForm_<?php echo (isset($video->id)?$video->id:""); ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title">Video </h5> <button type="button" class="close assignclose"  data-dismiss="modal"> &times;</button>
							</div>
							<div class="modal-body">
							<div class="panel-body">


							<div class="x_content">
							<div class="row">
							<div class="col-sm-12">
							<table  border="1" class="table table-striped table-bordered mycircle-table" cellspacing="0" width="100%">
						<?php  
						 
						$vname= unserialize($video->video);  ?>
						<tr><td>					
						 <a href="#0" class="download-icon-play" data-toggle="modal" data-target="#VideoPlay_<?php echo (isset($video->id)?$video->id:""); ?>"><i class="fa fa-play"></i></a>		
						<div id="VideoPlay_<?php echo (isset($video->id)?$video->id:""); ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg">
							<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title">Video </h5> <button type="button" class="close assignclose"  data-dismiss="modal"> &times;</button>
							</div>
							<div class="modal-body">
							<div class="">				 
							 
							 <video  width="750" controls><source src="<?php echo asset($vname['video']['src']) ?>" type=""> <i class="fa fa-film" aria-hidden="true"></i></video>
						 
					 
						 
							</div>
							</div>

							</div>

							</div>
							</div> 
							
							
						
						</td></tr>						
						 
					 </table>
						</div>
						</div>
						 </div>
							</div>
							</div>

							</div>

							</div>
							</div> 
							
                            </p>
                          </div>
                        </div>
                      </li>
					  @endforeach
					  @endif
					  @if($coursesNotes)
						  @foreach($coursesNotes as $notes)
					  <?php $cours= App\FeesCourse::where('id',$notes->course_id)->first();
					if(!empty($cours)){
						$coursename=$cours->course;
					
					}
					
					?>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>{{$coursename}}</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">
							
							
							
                            <a href="#0" class="download-icon-pdf"  data-toggle="modal" data-target="#getCourseNotesForm_<?php echo (isset($notes->id)?$notes->id:""); ?>"><i class="fa fa-file-pdf-o"></i></a>
							
							<div id="getCourseNotesForm_<?php echo (isset($notes->id)?$notes->id:""); ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title">Notes </h5>  
<button type="button" class="close assignclose"  data-dismiss="modal"> &times;</button>							</div>
							<div class="modal-body">
							<div class="panel-body">							 
						<div class="x_content">
						<div class="row">
						<div class="col-sm-12">
						<table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<?php   
							$nname= unserialize($notes->notes);  ?>
					<tr><td><a href="https://docs.google.com/viewer?url=<?php echo asset($nname['notes']['src']) ?>" class="download-icon-pdf" target="_blank">  
						 <?php echo $nname['notes']['name']; ?>
						 <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
						 
						 
						 
						 
						 </td></tr>
						 
						</table>
						</div>
						</div>
						 </div>
							</div>
							</div>

							</div>

							</div>
							</div> 
							
                            </p>
                          </div>
                        </div>
                      </li>
					  
					  @endforeach
					  @endif
					  @if(!empty($coursesAssignment))
						  @foreach($coursesAssignment as $assignment)
					   <?php $cours= App\FeesCourse::where('id',$assignment->course_id)->first();
					if(!empty($cours)){
						$coursename=$cours->course;
					
					}
					
					?>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>{{$coursename}}</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">
                            <a href="#0" class="download-icon-edit" data-toggle="modal" data-target="#getCourseAssignForm_<?php echo (isset($assignment->id)?$assignment->id:""); ?>"><i class="fa fa-edit"></i></a>
							<div id="getCourseAssignForm_<?php echo (isset($assignment->id)?$assignment->id:""); ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">


							<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title">Assignment </h5>
<button type="button" class="close assignclose"  data-dismiss="modal"> &times;</button>							


							</div>
							<div class="modal-body">
							<div class="panel-body">

							 
						<div class="x_content">
						<div class="row">
						<div class="col-sm-12">
						<table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<?php  
							$aname= unserialize($assignment->assignment); 	 ?>
					<tr><td><a href="https://docs.google.com/viewer?url=<?php echo asset($aname['assignment']['src']) ?>" class="download-icon-edit" target="_blank">  <?php echo $aname['assignment']['name']; ?>
						 <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td></tr>
						 
						</table>
						</div>
						</div>
						 </div>
							</div>
							</div>

							</div>

							</div>
							</div> 
                            </p>
                          </div>
                        </div>
                      </li>
					  @endforeach
					  @endif
                     <!-- <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>-->
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 ">
              <div class="x_panel tile overflow_hidden">
                <div class="x_title">
                  <h2>News/Events</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   <div class="dashboard-widget-content">
				<div class="twitpost">		
				<a class="twitter-timeline" data-height="600" data-theme="light" data-link-color="#3b94d9" data-border-color="#f5f5f5" href="https://twitter.com/cromacampus">Tweets by @Croma Campus</a>
				</div> 
                     
				 
				  
                </div>
              </div>
            </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Activities  Blog</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
 	 
                    <ul class="list-unstyled timeline widget">
                      @if(!empty($blogs))
						  @foreach($blogs as $blog)
					  <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a href="https://www.cromacampus.com/blogs/<?php echo $blog->post_name; ?>" target="_blank">{{$blog->post_title}}</a>
                                          </h2>
                            <div class="byline">
                              <span><?php echo date('',strtotime($blog->post_modified)); ?></span> by <a>Croma Campus</a>
                            </div>
                            <p class="excerpt"><?php echo substr($blog->post_content, 0,200)." ..."; ?> <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
					  @endforeach
					  @endif
					  <!--
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>-->
                    </ul>
                  </div>
                </div>
              </div>
            </div>

          </div>


          <div class="row">
             


            
          </div>
        </div>
		
		 <script src="{{asset('genie/build/twitter/widgets.js')}}"></script>
       @endsection