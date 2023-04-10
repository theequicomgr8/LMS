<div class="profile-detail"  >
              <div class="col-md-5 col-12">
                <div class="Student-desc">
                  <div class="student-pic text-center">
                      <?php  $feesStudentselect =	App\FeesStudents::where('phone',Session::get('mobile'))->orderby('id','asc')->first(); 	
				if(!empty($feesStudentselect->pic_image)){
			 ?>
                <img src="{{asset('/uploads/image/'.$feesStudentselect->pic_image)}}" style="border-radius: 50%;position: relative;width: 112px;height:112px;">
				<?php  }else{ ?>
				 <img src="{{asset('logo/user.png')}}" style="border-radius: 50%;position: relative;width: 112px;height:112px;">
				<?php } ?>     
                      <div class="half-circle"></div>
                  </div>
                  <div class="student-description">
                    <h4 ng-bind="stud_name"></h4>
                    <p style="font-weight: 600;" class="st-course-fon"><span ng-bind="stud_course"></span> </p>
                    <p><span class="yellow">E : </span><span ng-bind="stud_email"></span></p>
                    <p><span class="yellow">M : </span><span ng-bind="stud_phone"></span> |  <span class="green">Whatsapp : </span>  <span ng-bind="stud_phone"></span></p>
                  </div></div>                
              </div>
              <div class="col-md-7 col-12">
                <div class="student-range">
                    <div class="col-lg-3 col-6">
                              <div class="All-range">			 
                    <span class="chart" data-percent='<%stud_count_attendance%>'>                    
                      <span class="percent" ng-bind="stud_count_attendance"></span>
                    </span>
                    <p>Attendance</p>
                  </div>
                    </div>
                <div class="col-lg-3 col-6"><div class="All-range"><span class="chart" data-percent="<%stud_c_per%>"><span class="percent" ng-bind="stud_c_per"></span>
                </span><p>Course Completion</p></div></div>
             <div class="col-lg-3 col-6"><div class="All-range"><span class="chart" data-percent="<%std_feedback%>"><span class="percent" ng-bind="std_feedback"></span></span><p>Feedback</p>
                  </div></div>
                <div class="col-lg-3 col-6"><div class="All-range"><span class="chart" data-percent="100"><span class="percent">100</span>
                    </span>
                    <p>Query</p>
                  </div>
                  </div>
				    <div class="clearfix"></div>
                </div>                
              </div>
            </div>