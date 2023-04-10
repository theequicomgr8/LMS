<div class="profile-detail">
              <div class="col-md-5 col-12">
                <div class="Student-desc">
                  <div class="student-pic">
                    <img src="{{asset('genie/build/images/Dashboard_Profile_Pic.png')}}">
                  </div>
                  <div class="student-description">
				  <?php 
				  $students = DB::connection('mysql2')->table('wp_students_details as std');	 
		$students = $students->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$students = $students->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$students = $students->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
		
		$students=$students->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name');	 				
				$students=$students->where('phone','=',Session::get('mobile'));		
		$students=$students->first();
		
	 
				  ?>
                    <h4><?php if($students->name){ echo $students->name; } ?></h4>
                    <p style="font-weight: 600;">(Corporate Training -<?php if($students->course){ echo $students->course; } ?> )</p>
                    <p><span class="yellow">E : </span><?php if($students->email){ echo $students->email; } ?></p>
                    <p><span class="yellow">M : </span><?php if($students->phone){ echo $students->phone; } ?>|  <span class="green">Whatsapp : </span> +91 99999 99999</p>
                  </div>
                </div>                
              </div>
              <div class="col-md-7 col-12">
                <div class="student-range">
                  <div class="All-range">
                    <span class="chart" data-percent="86">
                      <span class="percent"></span>
                    </span>
                    <p>Attendance</p>
                  </div>
                  <div class="All-range">
                    <span class="chart" data-percent="70">
                      <span class="percent"></span>
                    </span>
                    <p>Course Completion</p>
                  </div>
                  <div class="All-range">
                    <span class="chart" data-percent="86">
                      <span class="percent"></span>
                    </span>
                    <p>Fees Pending</p>
                  </div>
                  <div class="All-range">
                    <span class="chart" data-percent="86">
                      <span class="percent"></span>
                    </span>
                    <p>Due Date</p>
                  </div>
                </div>                
              </div>
            </div>