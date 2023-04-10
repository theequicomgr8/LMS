 @extends('genie.layouts.app')
 @section('title')
    Courses Edit
 @endsection
@section('content')	
    <div class="right_col" role="main">
          <div class="">
		    <div class="page-title">
              <div class="title_left">
                <h4>Course Edit</h4>
              </div>              
            </div>
			 <div class="clearfix"></div>
		  <div class="row">
              <style>
			 .dataTables_length{
				 float: left;
			 }
			 div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    float: right;
}
             </style>
              
             
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Course Edit</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                   
					
                    <table id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Course</th>                           
                          <th>Content</th>
                          <th>Action</th>
                           
                        </tr>
                      </thead>
					    <tbody>
						<?php
						$heading = DB::table('courses_heading as heading');				 
						$heading= $heading->where('course_id',$edit_data->id);
						$heading= $heading->get();

						if($heading){
							
							foreach($heading as $course){
							
							?>
						<tr><td><?php 
						
						$coursename = App\FeesCourse::where('id',$course->course_id)->first();
					if($coursename){
						echo $coursename->course;
					}
						
						?></td>
						<td>
						<table>
						<tr><td><?php echo str_replace('?','',$course->heading); ?></td>
					 
						<td>
						<table>
						<?php 
						$contents = App\CoursesContent::where('heading_id',$course->id)->get();
						 if($contents){						 
							 
							 foreach($contents as $content){ ?>
								<tr><td><?php echo str_replace('?','',$content->coursescontent).'<br>'; ?></td>
								<td><table><?php 
									$subcontents = App\CoursesSubCountent::where('content_id',$content->id)->get();
									if($subcontents){
										
										foreach($subcontents as $sub){ ?>
										<tr><td> <?php echo str_replace('?','',$sub->subcontent); ?></td>
										
									<td><table><?php 
									$lastcontents = App\CoursesLastContent::where('subcontent_id',$sub->id)->get();
									if($lastcontents){
										
										foreach($lastcontents as $last){
										?><tr><td><?php echo str_replace('?','',$last->lastcontent); ?></td></tr><?php } } ?></table></td></tr>	
								<?php 			
										}
									}
								?></table></td>
								
								</tr> 
								
						 <?php }
						 }
 
						 ?>
						
							 
						</table></td></tr></table></td>
						
						</tr>
						<?php } } ?>
					    </tbody>
					</table>
					
					
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