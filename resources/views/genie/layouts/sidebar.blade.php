<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
             
                <ul class="nav side-menu">
				<?php $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role == 'students') )
		{		    ?>
              
			<li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{url('/student/student-batch')}}"><i class="fa fa-tasks" aria-hidden="true"></i>Batch </a></li>
			<li><a href="{{url('/student/course-contents')}}"><i class="fa fa-file-text"></i> Course Content</a></li>
			<li><a><i class="fa fa-rss"></i>Feedback <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			<li><a href="{{url('/student/first-feedback')}}">Initial Feedback</a></li>
			<li><a href="{{url('/student/second-feedback')}}">Mid-Course Feedback</a></li>
			<li><a href="{{url('/student/third-feedback')}}">Final Feedback</a></li>
			</ul>
			</li>
			<li><a href="{{url('/student/fees-details')}}"><i class="fa fa-money"></i> Fees Details</a></li>
			<li><a href="{{url('/student/student-attendance')}}"><i class="fa fa-clock-o fa-fw"></i> Attendance </a></li>
			<!--<li><a href="{{url('/student/course-offer')}}"><i class="fa fa-contao fa-fw"></i> Course Offer </a></li>-->		
			<li><a href="{{url('/student/job')}}"><i class="fa fa-graduation-cap"></i> Job </a></li>
			<li><a href="{{url('/grev-list')}}"><i class="fa fa-feed"></i>Grevience List</a></li>
		<?php }else if($mobile !="" && ($role == 'trainer') ){  ?>  
				   
				 
				    <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>	
				  <li><a><i class="fa fa-clock-o"></i> Batch <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/batch/running-batches')}}">Running Batches</a></li>
                      <li><a href="{{url('/batch/finished-batches')}}">Finished Batches</a></li>                       
                    </ul>
                  </li>  
				  
				  <li><a><i class="fa fa-file-pdf-o"></i> Invoice <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/invoice/pay-invoice')}}">Pay Invoice</a></li>
                      <li><a href="{{url('/invoice/paid-invoice')}}">Paid Invoice</a></li>
                       
                    </ul>
                  </li>
			  <!--<li><a href="{{url('/roomallotment')}}"><i class="fa fa-home"></i> Room Allotment</a></li>-->
			    
				  
				  
				  
				  
				  
			<?php }else if($mobile !="" && ($role == 'Admin') ){  ?>  
		
		
                    <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    
                    </ul>
                    </li>
				     
					
                  <li><a><i class="fa fa-user"></i> User <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/users/add')}}">Add User</a></li>
                      <li><a href="{{url('/users')}}">All User</a></li>
                       
                    </ul>
                  </li> 

				  <li><a><i class="fa fa-certificate"></i> Course <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/course/add')}}">Add Course</a></li>
                      <li><a href="{{url('/course')}}">All Course</a></li>
                       
                     
                    </ul>
                  </li> 
				  
				  <li><a><i class="fa fa-tachometer fa-fw"></i> Batch <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/batch/running-batches')}}">Running Batches</a></li>                       
                      <li><a href="{{url('/batch/finished-batches')}}">Finished Batches</a></li>
                       
                    </ul>
                  </li>  
				  
				  <li><a><i class="fa fa-file-pdf-o"></i> Invoice <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/invoice/pay-invoice')}}">Pay Invoice</a></li>
                      <li><a href="{{url('/invoice/paid-invoice')}}">Paid Invoice</a></li>
                       
                    </ul>
                  </li>
                <li><a href="{{url('/log/day-log')}}"><i class="fa fa-history"></i>Log </a></li>	  

			  <!--<li><a href="{{url('/roomallotment')}}"><i class="fa fa-home"></i> Room Allotment</a></li>-->
			  <!--<li><a href="{{url('genie/attendance')}}"><i class="fa fa-check-circle-o"></i> Attendance</a></li>-->
			<!--  <li><a href="{{url('/student/profile')}}"><i class="fa fa-users"></i> Students Profile</a></li>-->
			
			 <!-- <li><a href="{{url('/student/feed-back')}}"><i class="fa fa-feed"></i> Feed Back</a></li>-->
			  
			  <li><a href="{{url('/student/feed-back-question')}}"><i class="fa fa-feed"></i> Feed Back Question</a></li>
			  <li><a href="{{url('/grev-list')}}"><i class="fa fa-feed"></i>Grevience List</a></li>
			  
				   
		<?php }else if($mobile !="" && ($role == 'Manager') ){  ?>  
		
		
		 <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>
                      <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li>
                    </ul>
                  </li>
				  <!--  <li><a href="{{url('/students')}}"><i class="fa fa-home"></i>Students</a></li>-->
                  <li><a><i class="fa fa-edit"></i> User <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/users/add')}}">Add User</a></li>
                      <li><a href="{{url('/users')}}">All User</a></li>
                      <li><a href="form_validation.html">Form Validation</a></li>
                      <li><a href="form_wizards.html">Form Wizard</a></li>
                      <li><a href="form_upload.html">Form Upload</a></li>
                      <li><a href="form_buttons.html">Form Buttons</a></li>
                    </ul>
                  </li> 
				  
				  <li><a><i class="fa fa-tasks" aria-hidden="true"></i> Batch <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/batch/running-batches')}}">Running Batches</a></li>
                      <li><a href="{{url('/batch/finished-batches')}}">Finished Batches</a></li>
                       
                    </ul>
                  </li>  
				  
				  <li><a><i class="fa fa-file-pdf-o"></i> Invoice <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/invoice/pay-invoice')}}">Pay Invoice</a></li>
                      <li><a href="{{url('/invoice/paid-invoice')}}">Paid Invoice</a></li>
                       
                    </ul>
                  </li>
			  <li><a href="{{url('/roomallotment')}}"><i class="fa fa-home"></i> Room Allotment</a></li>
			  <!--<li><a href="{{url('genie/attendance')}}"><i class="fa fa-check-circle-o"></i> Attendance</a></li>-->
			  <!--<li><a href="{{url('/student/profile')}}"><i class="fa fa-users"></i> Students Profile</a></li>-->
			  <li><a href="{{url('/student/feed-back')}}"><i class="fa fa-feed"></i> Feed Back</a></li>
			  <!--<li><a href="{{url('genie/student')}}"><i class="fa fa-users"></i> Students</a></li>-->
			   	  
				  
		
		
		<?php } ?>
		
		
                </ul>
              </div>
              

            </div>