  @extends('genie.layouts.app')
 @section('title')
    Student Dashborad
@endsection
@section('content')	
 <div class="right_col" role="main">
          <!-- top tiles -->
          
          <div class="row" style="display: inline-block;" >
          <div class="tile_count">
		 
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-book"></i> Course </span>
              <div class="count" style="" title="<?php if(!empty($studentdash[0]->course)){ echo $studentdash[0]->course; } ?>"><?php echo (strlen($studentdash[0]->course) > 10 ? substr($studentdash[0]->course,0,10)."..." : $studentdash[0]->course); //if(!empty($studentdash[0]->course)){ echo substr($studentdash[0]->course,0,10); } ?></div>
              <span class="count_bottom"><i class="green">4% </i> From last Month</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top "><i class="fa fa-clock-o"></i> Class Taken </span>
              <div class="count"><?php if(!empty($studentdash[0]->attendancebatch)){ echo $studentdash[0]->attendancecount.'/'.$studentdash[0]->attendancebatch;}else{ echo "0/0";}  ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Month</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top green"><i class="fa fa-user"></i> Topic Covered </span>
              <div class="count green"><?php if(!empty($totalcousedh)){ echo $completetotaldh.'/'.$totalcousedh; }else{ echo "0/0"; } ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>2% </i> From last Month</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top red"><i class="fa fa-money"></i> Fees Pending</span>
              <div class="count red"><?php   				   
				    $feespending = DB::connection('mysql2')->table('wp_fees_details as fees')->where('s_id',$studentdash[0]->std_id)->sum('paid_amt');
				 
				    if($feespending){ echo $studentdash[0]->to_be_paid-$feespending; } ?></div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>2% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-calendar"></i> Due Date </span>
              <div class="count"><?php // $feesDue = DB::connection('mysql2')->table('wp_fees_details as fees')->where('s_id',$studentdash[0]->std_id)->orderby('id','desc')->limit(1)->first(); 
			 if(isset($studentdash[0]->next_due_date) && $studentdash[0]->next_due_date=='0000-00-00 00:00:00' ){  echo "N/A"; }else{ echo date('d-M-y',strtotime($studentdash[0]->next_due_date)); } ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>14% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-graduation-cap"></i> Course Opted </span>
              <div class="count"><?php if(!empty($studentdash)){ echo count($studentdash); } ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>95% </i> From last Month</span>
            </div>
          </div>
        </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="dashboard_graph">

                <div class="row x_title">
                  
                </div>
 
                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />
<style>
.fc-title{
	color: #fff;
    text-align: center;
    margin-left: 8px;
}
.fc-row .fc-content-skeleton td, .fc-row .fc-helper-skeleton td{
    text-align:center;
}
.fc-ltr .fc-basic-view .fc-day-top .fc-day-number{
    float:none;
}
.fc-time{
		display:none;
	}
</style>
          <div class="row">
            <div class="col-md-4 col-sm-4 ">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Attendance </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Settings 1</a>
                          <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
				<style>
	
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
				</style>
                <div class="x_content">                
 
				  <div id='calendar' data-stud_cal_id="<?php echo $studentdash[0]->std_id;?>"></div>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 ">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Performance : </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Settings 1</a>
                          <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
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
                      <span><?php echo "0/".count($coursesVideo); ?></span>
                    </div>
                    <div class="clearfix"></div>
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
                      <span><?php echo "0/".count($coursesNotes); ?></span>
                    </div>
                    <div class="clearfix"></div>
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
                      <span><?php echo "0/".count($coursesAssignment); ?></span>
                    </div>
                    <div class="clearfix"></div>
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
                      <span><?php if($studentdash[0]->first_feed=='1'){ echo "1"; }else if($studentdash[0]->first_feed=='2'){ echo "2";}else if($studentdash[0]->first_feed=="3"){  echo "3"; } ?></span>
                    </div>
                    <div class="clearfix"></div>
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


            <div class="col-md-4 col-sm-4 ">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Notification</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Settings 1</a>
                          <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="quick-list">
                      <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                      </li>
                      <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                      </li>
                    </ul>

                     
                  </div>
                </div>
              </div>
            </div>

          </div>
			<div class="row">
              <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Circular:<small>Sessions</small></h2>
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
							<h4 class="modal-title">Video </h4> <button type="button" class="close"  data-dismiss="modal"> &times;</button>
							</div>
							<div class="modal-body">
							<div class="panel-body">


							<div class="x_content">
							<div class="row">
							<div class="col-sm-12">
							<table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<?php  
						 
						$vname= unserialize($video->video);  ?>
						<tr><td>					
						 <a href="#0" class="download-icon-play" data-toggle="modal" data-target="#VideoPlay_<?php echo (isset($video->id)?$video->id:""); ?>"><i class="fa fa-play"></i></a>		
						<div id="VideoPlay_<?php echo (isset($video->id)?$video->id:""); ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg">
							<div class="modal-content">
							<div class="modal-header">
							<h4 class="modal-title">Video </h4> <button type="button" class="close"  data-dismiss="modal"> &times;</button>
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
							<h4 class="modal-title">Notes </h4>  
							<button type="button" class="close"  data-dismiss="modal">&times;</button>
							</div>
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
							<h4 class="modal-title">Assignment </h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							


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
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Settings 1</a>
                          <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
				<div class="twitpost">		
				<a class="twitter-timeline" data-height="600" data-theme="light" data-link-color="#3b94d9" data-border-color="#f5f5f5" href="https://twitter.com/cromacampus">Tweets by @Croma Campus</a>
				</div> 
                    </tr>
                    
                  </table>
				
				
				 
				  
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Activities  Blog<small>Sessions</small></h2>
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
                  <div class="dashboard-widget-content">
 
                    <ul class="list-unstyled timeline widget">
                      @if(!empty($blogs))
						  @foreach($blogs as $blog)
					  <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a href="http://localhost/cromacampus/blogs/<?php echo $blog->post_name; ?>">{{$blog->post_title}}</a>
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