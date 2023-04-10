<!DOCTYPE html>
<html lang="en" ng-app="app">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="<?php echo csrf_token(); ?>">
	<link rel="canonical" href="{{ URL::current() }}"/>
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/logo/lms.jpeg')}}">
    <!-- Bootstrap -->
  
    <link href="{{asset('genie/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('genie/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    
    <link href="{{asset('genie/vendors/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('genie/vendors/fullcalendar/dist/fullcalendar.print.css')}}" rel="stylesheet" media="print">
    <!-- iCheck -->
    <link href="{{asset('genie/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- Datatables -->
        
		 <!-- bootstrap-progressbar -->
    <link href="{{asset('genie/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('genie/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('genie/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <link href="{{asset('genie/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('genie/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('genie/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('genie/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('genie/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('genie/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{asset('genie/build/Classes/paginator.class.php')}}" rel="stylesheet">
    <link href="{{asset('genie/build/css/custom.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md" ng-controller="studentHeaderController">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{url('/dashboard')}}" class="site_title"><i class="fa fa-paw"></i> <span>LMS</span></a>
            </div>
            <div class="clearfix"></div>
            <br />
            <!-- sidebar menu -->
            @include('genie.layouts.sidebar')
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav"><div class="nav_menu"><div class="nav toggle"><a id="menu_toggle"><i class="fa fa-bars"></i></a></div>
        <?php  
        $role = Session::get('role');	
        if($role=="students"){		
        ?>
        <?php 
        $getStudentsCourse =getStudentsCourse();	 
        $feesStudentselect =	App\FeesStudents::where('phone',Session::get('mobile'))->orderby('id','asc')->first(); 			 
        if(!empty($getStudentsCourse) && count($getStudentsCourse)>1){
        ?>
        <div class="select-course"><select class="students-course"><option value="">Select Your Technology</option>   
        @if(!empty($getStudentsCourse))
        @foreach($getStudentsCourse as $studcourse)
        <option value="{{$studcourse->std_id}},{{$studcourse->courseid}}" <?php if($feesStudentselect->id.','.$feesStudentselect->courses ==$studcourse->std_id.','.$studcourse->courseid){ echo 'selected'; }{ echo ""; } ?>>{{$studcourse->course}}</option>
        @endforeach
        @endif
        </select>
        </div>
        <?php } } ?>
        <nav class="nav navbar-nav"><ul class=" navbar-right"><li class="nav-item dropdown open" style="padding-left: 15px;"><a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
        <?php 
        $names= explode(' ',ucwords(session::get('name')));
        if(!empty($names)){
        $result="";
        $result = substr(ucwords($names['0']),0,1);
        if(!empty($names['1'])){
        $result .= substr(ucwords($names['1']),0,1);
        }else{
        $result .='&nbsp;';
        }
        }else{
        $result .="&nbsp;";
        }
        echo $result;	
        ?> 
        </a>
        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown"><div class="st-data-details"><div class="profile-userpic">
        <?php  $feesStudentselect =	App\FeesStudents::where('phone',Session::get('mobile'))->orderby('id','asc')->first(); 	
        if(!empty($feesStudentselect->pic_image)){
        ?>
        <img src="{{asset('/uploads/image/'.$feesStudentselect->pic_image)}}" style="max-width: 72px;height: 72px;width: 72px;" class="img-responsive" alt="profile">
        <?php  }else{ ?>
        <img src="{{asset('logo/user.png')}}" style="max-width: 72px;height: 72px;width: 72px;" class="img-responsive" alt="profile">
        <?php } ?>       
        </div>
        <div class="user-data">
        <h4><?php  $names= ucwords(session::get('name'));
        echo (strlen($names) > 12 ? substr($names,0,12).'..' : $names);
        ?></h4>
        <?php $role = Session::get('role');	
        $mobile = Session::get('mobile');	
        if($mobile !="" && ($role == 'students') )
        {		    ?>
        <a class="dropdown-item"  href="{{url('student/profile')}}"> My Profile</a>
        <?php  }else{ ?>
        
        <a class="dropdown-item"  href="{{url('trainer/profile')}}"> My Profile</a>
        <?php } ?>
        <a class="dropdown-item"  href="{{url('/logout')}}">Log Out</a>
        </div></div></div></li></ul>
        </nav>
            </div>
            <?php $role = Session::get('role');	
				$mobile = Session::get('mobile');	
				if($mobile !="" && ($role == 'students') )
				{		    ?>
				@include('genie.layouts.student_header')
				<?php } ?>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        @yield('content')
        <!-- /page content -->
		<div id="messagemodel" class="modal fade" role="dialog" style="z-index:9999"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Payment List</h5>
		<button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body" style="padding-top:5px"><div class="imgclass"></div>
		</div><div class="modal-footer"><button type="submit" class="btn btn-success"  data-dismiss="modal" style="text-align: center;display: block;margin: auto;">Ok</button>
		</div></div></div></div>
		<div id="coursemodel" class="modal fade" role="dialog">
		<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Course Content</h5><div class="succesmessage"></div><div class="errormessage"></div>
		<button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body" style="padding-top:5px"></div></div></div></div><div id="contentmodel" class="modal fade" role="dialog">
		<div class="modal-dialog  modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Course Content</h5><div class="succesmessage"></div><div class="errormessage"></div>
		<button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body" style="padding-top:5px"></div></div></div></div>
        <footer> <div class="pull-right"> Developed By Cromacampus</div><div class="clearfix"></div></footer>
        </div></div><a class="whatsappme whatsappme--left whatsappme--show whatsappme--dialog" href="https://api.whatsapp.com/send?phone=917303191680" target="_blank"><div class="whatsappme__button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" fill="currentColor"></path></svg>
        <div class="whatsappme__badge whatsappme__badge--in">1</div></div></a>
<section class="bottom-fixed" id="bottom-fixed">
<div class="container"><div class="row"><div class="col-md-12 text-center"><div class="bottom-fixed-links">
<div class="fixed"><a href="tel:+917303191680" target="_blank"><img src="{{asset('img/call-back.png')}}" alt="phone" ><span>Get a Call Back</span></a>
						</a></div><div class="fixed ml-0"><a href="https://api.whatsapp.com/send?phone=917303191680" target="_blank"><img src="{{asset('img/whatsapp-color.png')}}" alt="whatsapp">
<span>7303191680</span></a></a></div></div></div></div></div></section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-sm" role="document"><div class="modal-content">
<div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Provide Your Detail</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
<div class="modal-body"><form action="#" method="POST" id="" autocomplete="off"><div class="form-group"><div class="inner-addon left-addon">
<i class="fa fa-user fa-lg"></i><input type="text" class="form-control" name="iq_name" id="iq_name" placeholder="Enter Name"></div></div><div class="form-group">
<div class="inner-addon left-addon"><i class="fa fa-envelope fa-lg"></i><input type="email" class="form-control" name="iq_email" id="iq_email" placeholder="Enter Email"></div>
</div><div class="form-group"> <div class="inner-addon left-addon"><i class="fa fa-phone fa-lg"></i><input type="email" class="form-control" name="iq_phone" id="iq_phone" placeholder="Enter Phone No.">
</div></div><div class="form-group"><div class="inner-addon left-addon"><i class="fa fa-book fa-lg"></i><input type="text" class="form-control" name="iq_course" id="iq_course" placeholder="Enter Course">
</div></div><div class="form-group"><div class="inner-addon left-addon"><i class="fa fa-paper-plane-o fa-lg"></i><select class="form-control" name="iq_participant" tabindex="2">
<option value="">Select</option><option value="student">Student</option><option value="trainer">Trainer</option></select> </div></div>
<div class="form-group"><textarea class="form-control" name="iq_message" rows="3" placeholder="Enter your message"></textarea></div><input type="submit" class="btn btn-default btn-stick-submit btn-black" value="Send Enquiry">
</form></div></div></div></div>
<div class="chat-box"></div>


    <!-- jQuery -->
    <script src="{{asset('genie/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
   <script src="{{asset('genie/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('genie/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('genie/vendors/nprogress/nprogress.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('genie/vendors/iCheck/icheck.min.js')}}"></script>
	
	<!-- Chart.js -->
    <script src="{{asset('genie/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{asset('genie/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('genie/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
	
	
	  <!-- Skycons -->
    <script src="{{asset('genie/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
   <script src="{{asset('genie/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('genie/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('genie/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('genie/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('genie/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
   <script src="{{asset('genie/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('genie/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('genie/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('genie/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
  <script src="{{asset('genie/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('genie/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('genie/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('genie/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('genie/vendors/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <script src="{{asset('genie/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	
	
    <!-- Datatables -->
    <script src="{{asset('genie/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('genie/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('genie/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('genie/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('genie/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('genie/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('genie/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('genie/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('genie/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('genie/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('genie/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('genie/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('genie/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('genie/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('genie/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
     <script src="{{asset('genie/vendors/select2/dist/js/select2.full.min.js')}}"></script>
  <script src="{{asset('genie/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js')}}"></script>
   <script src="{{asset('genie/vendors/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script>
   
    <!-- Custom Theme Scripts -->
    
    		<?php $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role == 'students') )
		{		    ?>
		<script src="{{asset('genie/build/js/angular.min.js')}}"></script>
		<script src="{{asset('genie/build/app/app.js')}}"></script>
		<script src="{{asset('genie/build/app/studentsDashboardController.js')}}"></script> 
		<?php } ?>
    <script src="{{asset('genie/build/js/custom.js')}}"></script>
    <script src="{{asset('genie/build/js/script.js')}}"></script>

 <script>
 	jQuery(document).ready(function(){
setTimeout(function() {
    $('.notesmessage').fadeOut(4000);
}, 5000);
});
</script>
 <!--<script src="//code.jivosite.com/widget/qMVrmYre5T" async></script>-->
  </body>
</html>