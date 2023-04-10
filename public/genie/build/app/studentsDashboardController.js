	//var app = angular.module('myStudentApp', []);
	var app = angular.module('app', [], function($interpolateProvider){
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});
 

 app.controller('studentHeaderController',['$scope','$http',function($scope,$http){
/* 	$scope.dcs_DateRangePicker = false;
	$scope.showDCS_DateRangePicker = function(){
		$scope.dcs_DateRangePicker = !$scope.dcs_DateRangePicker;
	};
	$scope.fromDate = moment().format('DD/MMM');
	$scope.toDate = moment().format('DD/MMM'); */
	
	$http
	.get("/dashboard")
	.then(function(response){
		//alert(JSON.stringify(response));
		//$scope.total_leads = "dd";
		$scope.stud_id = response.data.response.stud_id;
	//	alert($scope.stud_id);
		$scope.stud_name = response.data.response.stud_name;
		$scope.stud_email = response.data.response.stud_email;
		$scope.stud_phone = response.data.response.stud_phone;
		$scope.stud_course = response.data.response.stud_course;
		$scope.stud_to_be_paid = response.data.response.stud_to_be_paid;
		$scope.stud_course_short = response.data.response.stud_course_short;
		$scope.stud_batch_short = response.data.response.stud_batch_short;
		$scope.stud_attendace = response.data.response.stud_attendace;
		$scope.stud_batch_attendance = response.data.response.stud_batch_attendance;
		$scope.stud_count_attendance = response.data.response.stud_count_attendance;
		$scope.stud_c_per = response.data.response.stud_c_per;
		$scope.std_feedback = response.data.response.std_feedback;
		$scope.stud_take_attendance = response.data.response.stud_take_attendance;
		$scope.stud_batch_name = response.data.response.stud_batch_name;
			$scope.stud_trainer_name = response.data.response.stud_trainer_name;
		$scope.stud_batch_start = response.data.response.stud_batch_start;
		$scope.stud_attendancebatch = response.data.response.stud_attendancebatch;
		$scope.stud_occurrence = response.data.response.stud_occurrence;
			$scope.stud_course_compete = response.data.response.stud_course_compete;
		$scope.stud_course_compete = response.data.response.stud_course_compete;
		$scope.std_feespending = response.data.response.std_feespending;
		$scope.std_due_date = response.data.response.std_due_date;
    	$scope.std_total_c_video = response.data.response.std_total_c_video;
		$scope.std_total_c_notes = response.data.response.std_total_c_notes;
		$scope.std_total_c_assign = response.data.response.std_total_c_assign;
		$scope.std_total_feedback = response.data.response.std_total_feedback;
	//	 $scope.stud_image_list = response.data.response.stud_image_list;
		$('.show-student').html(response.data.response.stud_image_list);
		
		 
		
	});
	
	$('.students-course' ).on('change',function(){		
		var user_id = $(this).val(); 	 
 
		$http
		.get("/dashboard/"+user_id)
		.then(function(response){ 
			//alert(JSON.stringify(response));
			$scope.stud_id = response.data.response.stud_id;
			$scope.stud_name = response.data.response.stud_name;
			$scope.stud_email = response.data.response.stud_email;
			$scope.stud_phone = response.data.response.stud_phone;
			$scope.stud_course = response.data.response.stud_course;
			$scope.stud_to_be_paid = response.data.response.stud_to_be_paid;
			$scope.stud_course_short = response.data.response.stud_course_short;
			$scope.stud_batch_short = response.data.response.stud_batch_short;
			$scope.stud_attendace = response.data.response.stud_attendace;
			$scope.stud_batch_attendance = response.data.response.stud_batch_attendance;
			$scope.stud_count_attendance = response.data.response.stud_count_attendance;
			$scope.stud_c_per = response.data.response.stud_c_per;
			$scope.std_feedback = response.data.response.std_feedback;
			$scope.stud_take_attendance = response.data.response.stud_take_attendance;
			$scope.stud_batch_name = response.data.response.stud_batch_name;
			$scope.stud_trainer_name = response.data.response.stud_trainer_name;
	    	$scope.stud_batch_start = response.data.response.stud_batch_start;
	    	$scope.stud_attendancebatch = response.data.response.stud_attendancebatch;
	    	$scope.stud_occurrence = response.data.response.stud_occurrence;
			$scope.stud_course_compete = response.data.response.stud_course_compete;
			$scope.stud_course_compete = response.data.response.stud_course_compete;
			$scope.std_feespending = response.data.response.std_feespending;
			$scope.std_due_date = response.data.response.std_due_date;
		    $scope.std_total_c_video = response.data.response.std_total_c_video;
		    $scope.std_total_c_notes = response.data.response.std_total_c_notes;
		    $scope.std_total_c_assign = response.data.response.std_total_c_assign;
		    $scope.std_total_feedback = response.data.response.std_total_feedback;
	//	 $scope.stud_image_list = response.data.response.stud_image_list;
		$('.show-student').html(response.data.response.stud_image_list);
		},function(response){
			alert("AJAX Failed !!");
		});
	});
 
	/* $scope.getCoumsellerlist = function(msg){
	
		$scope.result = msg;
			 
		//var user_id =  $('#getCounsel').val();
 
		 //$scope.dcs_getCounsel = !$scope.dcs_getCounsel;
		
		$http
		.get("/dashboard/counsellor/"+user_id)
		.then(function(response){
			//alert(JSON.stringify(response));
			$scope.total_leads = response.data.response.total_leads;
			$scope.total_interested = response.data.response.total_interested;
			$scope.total_follow_up = response.data.response.total_follow_up;
			$scope.calling_visits = response.data.response.calling_visits;
			$scope.direct_visits = response.data.response.direct_visits;
			$scope.total_joined = response.data.response.total_joined;
			$scope.total_leads_tm = response.data.response.total_leads_tm;
			$scope.total_interested_tm = response.data.response.total_interested_tm;
			$scope.total_follow_up_tm = response.data.response.total_follow_up_tm;
			$scope.calling_visits_tm = response.data.response.calling_visits_tm;
			$scope.direct_visits_tm = response.data.response.direct_visits_tm;
			$scope.total_joined_tm = response.data.response.total_joined_tm;
			$scope.dcs_new_lead = response.data.response.daily_calling_status.new_lead;
			$scope.dcs_new_lead_percent = response.data.response.daily_calling_status.new_lead_percent;
			$scope.dcs_interested = response.data.response.daily_calling_status.interested;
			$scope.dcs_interested_percent = response.data.response.daily_calling_status.interested_percent;
			$scope.dcs_pending = response.data.response.daily_calling_status.pending;
			$scope.dcs_pending_percent = response.data.response.daily_calling_status.pending_percent;
			$scope.dcs_not_interested = response.data.response.daily_calling_status.not_interested;
			$scope.dcs_not_interested_percent = response.data.response.daily_calling_status.not_interested_percent;
			$scope.dcs_visits = response.data.response.daily_calling_status.visits;
			$scope.dcs_visits_percent = response.data.response.daily_calling_status.visits_percent;
			$scope.dcs_joined = response.data.response.daily_calling_status.joined;
			$scope.dcs_joined_percent = response.data.response.daily_calling_status.joined_percent;
			$scope.dcs_total_call_count_leads = response.data.response.daily_calling_status.total_call_count_leads;
			$scope.dcs_total_call_count_demos = response.data.response.daily_calling_status.total_call_count_demos;
			$scope.wcs_new_lead = response.data.response.weekly_calling_status.new_lead;
			$scope.wcs_new_lead_percent = response.data.response.weekly_calling_status.new_lead_percent;
			$scope.wcs_interested = response.data.response.weekly_calling_status.interested;
			$scope.wcs_interested_percent = response.data.response.weekly_calling_status.interested_percent;
			$scope.wcs_pending = response.data.response.weekly_calling_status.pending;
			$scope.wcs_pending_percent = response.data.response.weekly_calling_status.pending_percent;
			$scope.wcs_not_interested = response.data.response.weekly_calling_status.not_interested;
			$scope.wcs_not_interested_percent = response.data.response.weekly_calling_status.not_interested_percent;
			$scope.wcs_visits = response.data.response.weekly_calling_status.visits;
			$scope.wcs_visits_percent = response.data.response.weekly_calling_status.visits_percent;
			$scope.wcs_joined = response.data.response.weekly_calling_status.joined;
			$scope.wcs_joined_percent = response.data.response.weekly_calling_status.joined_percent;
			$scope.wcs_total_call_count_leads = response.data.response.weekly_calling_status.total_call_count_leads;
			$scope.wcs_total_call_count_demos = response.data.response.weekly_calling_status.total_call_count_demos;
		},function(response){
			alert("AJAX Failed !!");
		});
	};
	 */
	 /* 
	$scope.getCallingStatus = function(){
		
		var fromDate = $('.fromDate').val();
		var toDate = $('.toDate').val();
		var user_id = $('.counsellor-control').val();
		if(typeof user_id === "undefined")
			user_id = '';
		else
			user_id = "/"+user_id;
		if(fromDate==''||toDate=='')
			return;
		$scope.fromDate = moment(fromDate).format('DD/MMM');
		$scope.toDate = moment(toDate).format('DD/MMM');
		$scope.dcs_DateRangePicker = !$scope.dcs_DateRangePicker;
		$http
		.post("/dashboard/counsellor/daily-calling-status"+user_id,
			{
				"fromDate":fromDate,
				"toDate":toDate
			}
		)
		.then(function(response){
			//alert(JSON.stringify(response));
			$scope.dcs_new_lead = response.data.response.daily_calling_status.new_lead;
			$scope.dcs_new_lead_percent = response.data.response.daily_calling_status.new_lead_percent;
			$scope.dcs_interested = response.data.response.daily_calling_status.interested;
			$scope.dcs_interested_percent = response.data.response.daily_calling_status.interested_percent;
			$scope.dcs_pending = response.data.response.daily_calling_status.pending;
			$scope.dcs_pending_percent = response.data.response.daily_calling_status.pending_percent;
			$scope.dcs_not_interested = response.data.response.daily_calling_status.not_interested;
			$scope.dcs_not_interested_percent = response.data.response.daily_calling_status.not_interested_percent;
			$scope.dcs_visits = response.data.response.daily_calling_status.visits;
			$scope.dcs_visits_percent = response.data.response.daily_calling_status.visits_percent;
			$scope.dcs_joined = response.data.response.daily_calling_status.joined;
			$scope.dcs_joined_percent = response.data.response.daily_calling_status.joined_percent;
			$scope.dcs_total_call_count_leads = response.data.response.daily_calling_status.total_call_count_leads;
			$scope.dcs_total_call_count_demos = response.data.response.daily_calling_status.total_call_count_demos;
		},function(response){
			alert("AJAX Failed !!");
		});
	};
	 */
		
	/* $scope.getSubmitChating = function(){
		
		var chating_id = $('#chating_id').val();
		var chating = $('#chating').val();
		  
		$scope.chating_id =chating_id;
		$scope.chating = chating;
		 
		$http
		.post("/dashboard/chating",
			{
				"chating_id":chating_id,
				"chating":chating
			}
		)
		.then(function(response){
			//alert(JSON.stringify(response));
			$scope.chatingshow = response.data.response.chatingshow;
			 
		},function(response){
			//alert("AJAX Failed !!");
		});
	}; */
	 
	 
	
	
	
	
	
}]);