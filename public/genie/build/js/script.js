// ************
// X-CSRF-TOKEN
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
// X-CSRF-TOKEN
// ************ 
$('.loading').hide();
 
var dataTableStudents = $('#datatable-students').on('draw.dt',function(e,settings){
	$('#datatable-students').find('[data-toggle="popover"]').popover({html:true,container:'body'});
	var $this = this;
			 	 
	$('#datatable-students').find('#check-columns').on('change',function(){
		if(this.checked){
			$('.check-box').prop('checked',true);
			 
		}else{
			$('.check-box').prop('checked',false);
		}
	});

 
 
})
.dataTable({
 
	"fixedHeader": true,
	"processing":true,
	"serverSide":true,
	"paging":true,
	"ordering":false,
	"lengthMenu": [
            [10,25,50,100,250,500],
            ['10','25','50','100','250','500']
        ],
		  
			
	"ajax":{
		url:"/students/getstudents",
		data:function(d){
			d.page = (d.start/d.length)+1;
			d.search['expdf']=$('*[name="search[expdf]"]').val();
			d.search['expdt']=$('*[name="search[expdt]"]').val();
			d.search['course']=$('*[name="search[course][]"]').val();
			
			
			var status = $('*[name="search[status][]"]').val();
			if(status!=null && status.length=='1' && status[0]==''){
				d.search['status']="";
			}else{
				d.search['status']=$('*[name="search[status][]"]').val();
			}
			//d.search['status']=$('*[name="search[status][]"]').val();
			d.search['counsellor']=$('.counsellor-control').val();
			var $this = this;
			$this.checked_Ids = [];
			$('#check-columns:checked').each(function(){
		 
			if(!(new String("on").valueOf() == $(this).val())){
			 
			$this.checked_Ids.push($(this).val());
			}
			});
			d.search['check-columns']=$this.checked_Ids;
			d.columns = null;
			d.order = null;
		},
		dataSrc:function(json){
			recordCollection = json.recordCollection;
			return json.data;
		}
	}
}).api();
		var $this = this;
		$this.checked_Ids = [];		
		$('#check-columns:checked').on('change',function(){
	   if($(this).prop("checked") == true){		   
		if(!(new String("on").valueOf() == $(this).val())){	 
		$this.checked_Ids.push($(this).val());
			 dataTableStudents.column($(this).val()).visible(true);
		} 
		
	   } else if($(this).prop("checked") == false){
		  
			$this.checked_Ids.push($(this).val());
			dataTableStudents.column($(this).val()).visible(false);
			
		}
		});
		 









 var dataTableviewbatchdetails = $('#datatable-viewbatchdetails')
.dataTable({
	  
/*  "columnDefs": [{
"targets": [ 5,6,7 ],
  
"visible": false,
"searchable": false
}],  */
	"fixedHeader": true,
	"processing":true,
	"serverSide":true,
	"paging":true,
	"ordering":false,
	"lengthMenu": [
            [200,25,50,100,250,500],
            ['200','25','50','100','250','500']
        ],
		 
	"ajax":{
		url:"/batch/get-view-batch-details",
		data:function(d){
			 
			
			d.page = (d.start/d.length)+1;
			d.search['batch_id']=$('#batch_id').val();
	 
 
			d.columns = null;
			d.order = null;
				 
		},
		dataSrc:function(json){
			recordCollection = json.recordCollection;
			return json.data;
		}
	}
}).api();
 

var dataTablerunningBatches = $('#datatable-runningBatches')
.dataTable({
	"fixedHeader": true,
	"processing":true,
	"serverSide":true,
	"paging":true,
	"ordering":false,
	"lengthMenu": [
            [10,25,50,100,250,500],
            ['10','25','50','100','250','500']
        ],
		 dom: "Blfrtip",
                buttons: [
                    {
                        extend: "excel",
                        className: "btn-sm"
                    },
                     
                    {
                        extend: "print",
                        className: "btn-sm"
                    },
                ],
	"ajax":{
		url:"/batch/get-running-batches",
		data:function(d){		 
			
			d.page = (d.start/d.length)+1;	
			d.search['trainer']=$('*[name="search[trainer]"]').val();			
			d.search['course']=$('*[name="search[course]"]').val();			
			d.columns = null;
			d.order = null;
		},
		dataSrc:function(json){
			recordCollection = json.recordCollection;
			return json.data;
		}
	}
}).api();
 

		
		$('#check-columns:checked').on('change',function(){
		var $this = this;
		$this.checked_Ids = [];	
	 
		if($(this).prop("checked") == true){		   
		if(!(new String("on").valueOf() == $(this).val())){	 
		$this.checked_Ids.push($(this).val());
		dataTablerunningBatches.column($(this).val()).visible(true);
		} 

		} else if($(this).prop("checked") == false){

		$this.checked_Ids.push($(this).val());
		dataTablerunningBatches.column($(this).val()).visible(false);

		}
		});

var dataTablefinishedBatches = $('#datatable-finishedBatches')
.dataTable({
	"fixedHeader": true,
	"processing":true,
	"serverSide":true,
	"paging":true,
	"ordering":false,
	"lengthMenu": [
            [10,25,50,100,250,500],
            ['10','25','50','100','250','500']
        ],
		 dom: "Blfrtip",
                buttons: [
                     {
                        extend: "excel",
                        className: "btn-sm"
                    },
                     
                    {
                        extend: "print",
                        className: "btn-sm"
                    },
                ],
	"ajax":{
		url:"/batch/get-finished-batches",
		data:function(d){		 
			
			d.page = (d.start/d.length)+1;		
			d.search['trainer']=$('*[name="search[trainer]"]').val();			
			d.search['course']=$('*[name="search[course]"]').val();			
			d.columns = null;
			d.order = null;
		},
		dataSrc:function(json){
			recordCollection = json.recordCollection;
			return json.data;
		}
	}
}).api();
 
		     
	
 
var dataTablePayInvoice = $('#datatable-payinvoice')
.dataTable({
	"fixedHeader": true,
	"processing":true,
	"serverSide":true,
	"paging":true,
	"ordering":false,
	"lengthMenu": [
            [10,25,50,100,250,500],
            ['10','25','50','100','250','500']
        ],
		 dom: "Blfrtip",
                buttons: [
                    {
                        extend: "excel",
                        className: "btn-sm"
                    },
                     
                    {
                        extend: "print",
                        className: "btn-sm"
                    },
                ],
	"ajax":{
		url:"/invoice/get-pay-invoice",
		data:function(d){		 
			
			d.page = (d.start/d.length)+1;	
			d.search['trainer']=$('*[name="search[trainer]"]').val();			
			d.search['course']=$('*[name="search[course]"]').val();				
			d.columns = null;
			d.order = null;
		},
		dataSrc:function(json){
			recordCollection = json.recordCollection;
			return json.data;
		}
	}
}).api();
 
 

 
 
var dataTableUserList = $('#datatable-userlist')
.dataTable({
	"fixedHeader": true,
	"processing":true,
	"serverSide":true,
	"paging":true,
	"ordering":false,
	"lengthMenu": [
            [10,25,50,100,250,500],
            ['10','25','50','100','250','500']
        ],
		 dom: "Blfrtip",
                buttons: [
                     {
                        extend: "excel",
                        className: "btn-sm"
                    },
                     
                    {
                        extend: "print",
                        className: "btn-sm"
                    },
                ],
	"ajax":{
		url:"/users/get-user",
		data:function(d){		 
			
			d.page = (d.start/d.length)+1;		 
			d.columns = null;
			d.order = null;
		},
		dataSrc:function(json){
			recordCollection = json.recordCollection;
			return json.data;
		}
	}
}).api();
 
var dataTableAllcourse = $('#datatable-allcourse')
.dataTable({
	"fixedHeader": true,
	"processing":true,
	"serverSide":true,
	"paging":true,
	"ordering":false,
	"lengthMenu": [
            [20,25,50,100,250,500],
            ['20','25','50','100','250','500']
        ],
		 dom: "Blfrtip",
                buttons: [
                     {
                        extend: "excel",
                        className: "btn-sm"
                    },
                     
                    {
                        extend: "print",
                        className: "btn-sm"
                    },
                ],
	"ajax":{
		url:"/course/get-course",
		data:function(d){		 
			
			d.page = (d.start/d.length)+1;		 
			d.columns = null;
			d.order = null;
		},
		dataSrc:function(json){
			recordCollection = json.recordCollection;
			return json.data;
		}
	}
}).api();
 
 
 
var dataTablePaidInvoice = $('#datatable-paidinvoice')
.dataTable({
	"fixedHeader": true,
	"processing":true,
	"serverSide":true,
	"paging":true,
	"ordering":false,
	"lengthMenu": [
            [10,25,50,100,250,500],
            ['10','25','50','100','250','500']
        ],
		 dom: "Blfrtip",
                buttons: [
                    {
                        extend: "excel",
                        className: "btn-sm"
                    },
                     
                    {
                        extend: "print",
                        className: "btn-sm"
                    },
                ],
	"ajax":{
		url:"/invoice/get-paid-invoice",
		data:function(d){		 
			
			d.page = (d.start/d.length)+1;		 
			d.columns = null;
			d.order = null;
		},
		dataSrc:function(json){
			recordCollection = json.recordCollection;
			return json.data;
		}
	}
}).api();
 

  
var dataTablePaidInvoice = $('#datatable-pay-trainer-history')
.dataTable({
	"fixedHeader": true,
	"processing":true,
	"serverSide":true,
	"paging":true,
	"ordering":false,
	"lengthMenu": [
            [10,25,50,100,250,500],
            ['10','25','50','100','250','500']
        ],
		 dom: "Blfrtip",
                buttons: [
                    
                    {
                        extend: "excel",
                        className: "btn-sm"
                    },
                     
                    {
                        extend: "print",
                        className: "btn-sm"
                    },
                ],
	"ajax":{
		url:"/invoice/get-pay-trainer-history",
		data:function(d){		 
			
			d.page = (d.start/d.length)+1;		 
			d.columns = null;
			d.order = null;
		},
		dataSrc:function(json){
			recordCollection = json.recordCollection;
			return json.data;
		}
	}
}).api();
 


//************Day Log***********

var dataTabledayLog = $('#datatable-dayLog')
.dataTable({
	"fixedHeader": true,
	"processing":true,
	"serverSide":true,
	"paging":true,
	"ordering":false,
	"lengthMenu": [
            [10,25,50,100,250,500],
            ['10','25','50','100','250','500']
        ],
		 dom: "Blfrtip",
                buttons: [
                    {
                        extend: "excel",
                        className: "btn-sm"
                    },
                    {
                        extend: "print",
                        className: "btn-sm"
                    },
                ],
	"ajax":{
		url:"/log/get-day-log",
		data:function(d){		 	
			d.page = (d.start/d.length)+1;	
			d.search['date_from']=$('*[name="search[date_from]"]').val();
			d.search['date_to']=$('*[name="search[date_to]"]').val();
			d.search['role']=$('*[name="search[role]"]').val();			
			d.search['live']=$('*[name="search[live]"]').val();				
			d.search['course_mark']=$('*[name="search[course_mark]"]').val();				
			d.columns = null;
			d.order = null;
			 
		},
		dataSrc:function(json){
			recordCollection = json.recordCollection;
			return json.data;
		}
	}
}).api();
 
 
 $(document).on('change','#completecourse',function(e){
			e.preventDefault();
			$this = $(this);
			if($this.val()=='') return;	 
		 var bid= $('#batch_id').val();
		 
				$.ajax({
					"url":"/batch/course-status/"+$this.val()+"/"+bid,
					"type":"get",
					"success":function(data,textStatus,jqXHR){
					 
						if(data.statusCode){
							 alert(data.data.message);
						}else{
							alert(data.data.message);
						}
						 
					}
				});
		 
			mainSpinner.stop();
		});
		
		
 
$(document).ready(function () {
	setTimeout(function(){ init_calendar(); }, 7000);
	  //init_calendar(); 
});
 
function init_calendar() {

    if (typeof ($.fn.fullCalendar) === 'undefined') { return; }
    console.log('init_calendar');

    var date = new Date(),
        d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear(),
        //started,
       // categoryClass; 
		 sci   = $('#calendar').data('stud_cal_id');

		var calendar = $('#calendar').fullCalendar({
        header: {
           //left: 'prev,next today',
          // left: 'prev,next',
           // center: 'title',
            //right: 'month,agendaWeek,agendaDay,listMonth'
        },
        selectable: true,
        selectHelper: true,          
        editable: true,	 

		events: function( start, end, timezone, callback ) { 
		var events = [];
		jQuery.ajax({
		url: '/student/getAttention/'+sci,
		type: 'GET',    
		success: function (data) {
		if (data != null) {
		for(var i in data){
		events.push({
		title: "",
		start: data[i].attendate,
		});
		}
		} 
		callback(events);  
		}
		});
		}, 

    });

}
 
 
 
 
 
 
 
 var batchController = (function(){
		return {
			checked_Ids:[],
			submit:function(THIS){
				mainSpinner.start();
				var $this = $(THIS),
					data  = $this.serialize();
					//alert(data);
				$.ajax({
					url:"/demo/add-lead-students",
					type:"POST",
					data:data,
					success:function(response){
						if(response.status){
							mainSpinner.stop();
							$('body').scrollTop('0px');
							$('.alert').addClass('hide');
							$('.alert-success').removeClass('hide').html('Lead added successfully');
							$this.find('button[type="reset"]').click();
							$this.find('[name="course"]').html('').val('').trigger('change');
							window.location=document.location.href;     
							 
							
						}else{
							mainSpinner.stop();
							$('body').scrollTop('0px');
							$('.alert').addClass('hide');
							$('.alert-danger').removeClass('hide').html(response.errors);							
						}
					},
					error:function(){
						mainSpinner.stop();
						$('.alert').addClass('hide');
						$('.alert-danger').removeClass('hide').html('Lead not added');
					}
				});
				return false;
			},
			studentsAttendance:function(){
				
				var $this = this;
				$this.checked_Ids = [];
				$this.unchecked_Ids = [];
				
				$('.check-box:checked').each(function(){
					if(!(new String("on").valueOf() == $(this).val())){
						$this.checked_Ids.push($(this).val());
					}
				});
				
				//get unchecked value
				$("input:checkbox:not(:checked)").each(function(){
					if(!(new String("on").valueOf() == $(this).val())){
						$this.unchecked_Ids.push($(this).val());
					}
				});
				
				
				if($this.checked_Ids.length == 0){
				    alert('Please select data to then get attendance!');
					return false;
				}
				 
				//mainSpinner.start();
				$.ajax({
					url:"/batch/attendance",
					type:"POST",
					dataType:"json",
					data:{
						ids:$this.checked_Ids,
						unids:$this.unchecked_Ids
					},
					success:function(data,textStatus,jqXHR){
					 
						if(data.statusCode){
							
							$('#messagemodel .modal-title').text('Attendance');	
							$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+data.data.message+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							dataTableviewbatchdetails.ajax.reload( null, false );   
							 
							 
						}else{
							$('#messagemodel .modal-title').text('Attendance');	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+data.data.message+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							
						}
					},
					error:function(jqXHR,textStatus,errorThrown){
						
					}
				});
				return false;				
			},
			
			studentsAttendanceGoogleMeeting:function(s_id){
				
				var $this = this;
				 
			 
				// window.location.href = "https://www.cromacampus.com/";  
		
				//mainSpinner.start();
				$.ajax({
					url:"/batch/studentsAttendanceGoogleMeeting/"+s_id,
					type:"POST",
					dataType:"json",
					 
					success:function(data,textStatus,jqXHR){
					 
						if(data.statusCode){
							$('#attendancemodal_'+s_id).modal('hide');
							$('#messagemodel .modal-title').text('Attendance');	
							$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+data.data.message+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							dataTableviewbatchdetails.ajax.reload( null, false );   
							 
							 
						}else{
							$('#messagemodel .modal-title').text('Attendance');	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+data.data.message+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							
						}
					},
					error:function(jqXHR,textStatus,errorThrown){
						
					}
				});
				
						 
				return false;				
			},
			trainerAttendanceGoogleMeeting:function(b_id,t_id){
				
				var $this = this;
				 
			 
				 
				//mainSpinner.start();
				$.ajax({
					url:"/batch/trainerAttendanceGoogleMeeting/"+b_id+"/"+t_id,
					type:"POST",
					dataType:"json",
					 
					success:function(data,textStatus,jqXHR){
					 
						if(data.statusCode){
							$('#contentmodel').modal('hide');
							$('#messagemodel .modal-title').text('Attendance');	
							$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+data.data.message+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							dataTableviewbatchdetails.ajax.reload( null, false );   
							 
							 
						}else{
							$('#messagemodel .modal-title').text('Attendance');	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+data.data.message+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							
						}
					},
					error:function(jqXHR,textStatus,errorThrown){
						
					}
				});
				return false;				
			},
			
			invoiceGenerated:function(id){
			 	if( confirm("Are You Sure Generete Invoice!") ) {	
			 
				$.ajax({
					url:"/invoice/invoiceGenerated",
					type:"POST",
					dataType:"json",
					data:{
						ids:id
					},
					success:function(data,textStatus,jqXHR){
					 
						if(data.statusCode){
							
							 
							$('#messagemodel .modal-title').text('Invoice Generete');	
							$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+data.data.message+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							dataTableviewbatchdetails.ajax.reload( null, false );   
							 
						}else{
							$('#messagemodel .modal-title').text('Invoice Generete');	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+data.data.message+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							
						}
					},
					error:function(jqXHR,textStatus,errorThrown){
						
					}
				}); 
				}	
			},
			getCourseContentDetails:function(b_id,c_id,t_id){
		 
				$.ajax({
					url:"/batch/get-batch-content-form/"+b_id+"/"+c_id+"/"+t_id,
					type:"GET",
					success:function(response){		
					 
					$('#contentmodel .modal-body').html(response.html);  
					//$('#contentmodel .modal-title').text('Course Content');		
					$('#contentmodel').modal({keyboard:false,backdrop:'static'});
					$('#contentmodel').css({'width':'100%'});
					
				var acc = document.getElementsByClassName("paccordion");
				var i;

				for (i = 0; i < acc.length; i++) {
				acc[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight) {
				panel.style.maxHeight = null;
				} else {
				panel.style.maxHeight = panel.scrollHeight + "px";
				} 
				});
				}
						 
					},
					error:function(response){
						 
					}
				});
				 
			},
			getGoogleMeetingURL:function(b_id,c_id,t_id){
		 
				$.ajax({
					url:"/batch/get-google-meeting-form/"+b_id+"/"+c_id+"/"+t_id,
					type:"GET",
					success:function(response){		
					 
					$('#contentmodel .modal-body').html(response.html);  
					$('#contentmodel .modal-title').text('Online Batch Confirmation');		
					$('#contentmodel').modal({keyboard:false,backdrop:'static'});
					$('#contentmodel').css({'width':'100%'});
					
				var acc = document.getElementsByClassName("paccordion");
				var i;

				for (i = 0; i < acc.length; i++) {
				acc[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight) {
				panel.style.maxHeight = null;
				} else {
				panel.style.maxHeight = panel.scrollHeight + "px";
				} 
				});
				}
						 
					},
					error:function(response){
						 
					}
				});
				 
			},
			curriculumContentSubmit:function(){
 
				var $this = this;
				 
				var b_id   = $('#b_id').val();
				var t_id   = $('#t_id').val();
				var c_id   = $('#c_id').val();				 			
				$this.checked_Ids = [];
				$this.checked_headings_id = [];
				$this.checked_sub_content_id = [];
				$this.checked_status = [];
				$('.content:checked').each(function(){
				if(!(new String("on").valueOf() == $(this).val())){
				$this.checked_Ids.push($(this).val());				 				
				}	 
				
				});
				
				$('.subcontents:checked').each(function(){
				if(!(new String("on").valueOf() == $(this).val())){
				$this.checked_sub_content_id.push($(this).val());				 				
				}	 
				});
				
				$('.headings:checked').each(function(){
				if(!(new String("on").valueOf() == $(this).val())){
				$this.checked_headings_id.push($(this).val());				 				
				}	 
				
				});
				
				if($this.checked_Ids.length == 0 && $this.checked_sub_content_id.length == 0 && $this.checked_headings_id.length == 0 ){
				alert('Please check course Content topics !');
				 
				return false;
				}
				
				$('button[type="submit"]').prop('disabled','disabled');	
				$('input[type="text"],input[type="checkbox"]').keyup(function() {
				if($(this).val() != '') {
				$(':input[type="submit"]').prop('disabled', false);
				} });
				 
				$.ajax({
				url:"/course/course-content-status",
				type: 'POST',
				data: {
				'action': 'updateContentstatus',				 
				'cid': $this.checked_Ids,
				'subcid': $this.checked_sub_content_id,
				'hcid': $this.checked_headings_id,
				'b_id': b_id,
				'c_id': c_id,
				't_id': t_id,
				 
				},
			//	dataType: 'JSON',
				success: function(response){	
				 				
				if(response.status){
					 alert(response.msg);
				//	$('#successmessage').modal('show');
				//	$('.join-classes h5').html(response.msg);
					 location.reload();
				 	
				}
				else{
					 $('#successmessage').modal('show');
					$('.join-classes h5').html(response.msg);
				}		
				 
				}
				});
				 
				return false;
			},
		 
			
			
	};
	})();
 
 
 var invoiceController = (function(){
		return {
			checked_Ids:[],
			 
			getInvoicePay:function(id){
			 
				$.ajax({
					url:"/invoice/get-invoice-pay/"+id,
					type:"GET",
					success:function(response){						 
						$('#invoice-paylist .modal-body').html(response.html);		 
						 
						dataTableinvoicehistory = $('#datatable-invoice-paylist').dataTable({						
			
							 "fixedHeader": true,
							"processing":true,
							"serverSide":true,
							"paging":true,
							"ordering":false,
							"searching":false,
							"lengthChange":false,
							"info":false,
							"autoWidth":false,
							"lengthMenu": [
							[10,25],
							['10','25']
							],
							"ajax":{
								url:"/invoice/get-invoice-payment-list/"+id,
								data:function(d){
									d.page = (d.start/d.length)+1;		 
									d.columns = null;
									d.order = null;
									 
								} 
							}
						}).api();
						 
						 $('.dataTables_filter').hide();
						$('#invoice-paylist').modal({keyboard:false,backdrop:'static'});
						$('#invoice-paylist .select2-container').css({'width':'100%'});
						 
					},
					error:function(response){
						 
					}
				});
				 
			}
			
			 
			
		 
			
			
	};
	})();
  
 var courseController = (function(){
		return {
			checked_Ids:[],
			 
			getCourseContentForm:function(id){
			 
				$.ajax({
					url:"/course/get-course-content-form/"+id,
					type:"GET",
					success:function(response){		
					
					$('#coursemodel .modal-body').html(response.html);  
					$('#coursemodel .modal-title').text('Course Content');		
					$('#coursemodel').modal({keyboard:false,backdrop:'static'});
					$('#coursemodel').css({'width':'100%'});
				 //	window.location=document.location.href;     	 
					},
					error:function(response){
						 
					}
				});
				 
			},
			saveCourseContent:function(id,THIS){	
			 
				var $this = $(THIS);
					data  = $this.serialize();
			var form = new FormData();			 
				form.append('image', $('input[type=file]')[0].files[0]);			 
					 
				$.ajax({
					url:"/course/saveCourseContent/"+id,
					type:"POST",
					dataType:"json",					 
					//data:$this.serialize(),
					data:form,
					 contentType: false, 
                   processData: false, 
					success:function(data,textStatus,jqXHR){
					 
					
						if(data.status){					
							 $('#coursemodel').modal('hide');
							$('#messagemodel .modal-title').text('Course Content Upload!');	
							$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+data.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							$('#messagemodel').css({'width':'100%'});	 
							dataTableAllcourse.ajax.reload( null, false );   
							 	window.location=document.location.href; 
						}else{
							$('#messagemodel .modal-title').text('Course Content Upload!');	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+data.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							
						}
					},
					error:function(jqXHR,textStatus,errorThrown){
						
					}
				}); 
				 return false;	
			},
			getCourseContentBatchForm:function(bid,cid){
			 
				$.ajax({
					url:"/course/get-course-content-batch-form/"+bid+"/"+cid,
					type:"GET",
					success:function(response){		
					
					$('#coursemodel .modal-body').html(response.html);  
					$('#coursemodel .modal-title').text('Course Content');		
					$('#coursemodel').modal({keyboard:false,backdrop:'static'});
					$('#coursemodel').css({'width':'100%'});
				 //	window.location=document.location.href;     	 
					},
					error:function(response){
						 
					}
				});
				 
			},
			saveCourseBatchContent:function(id,bid,THIS){	
			 
				var $this = $(THIS);
					data  = $this.serialize();
			var form = new FormData();			 
				form.append('image', $('input[type=file]')[0].files[0]);			 
					 
				$.ajax({
					url:"/course/saveCourseBatchContent/"+id+"/"+bid,
					type:"POST",
					dataType:"json",					 
					//data:$this.serialize(),
					data:form,
					 contentType: false, 
                   processData: false, 
					success:function(data,textStatus,jqXHR){
					 
					
						if(data.status){					
							 $('#coursemodel').modal('hide');
							$('#messagemodel .modal-title').text('Course Content Upload!');	
							$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+data.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							$('#messagemodel').css({'width':'100%'});	 
							dataTablerunningBatches.ajax.reload( null, false );   
							//dataTableAllcourse.ajax.reload( null, false );   
							 //	window.location=document.location.href; 
						}else{
							$('#messagemodel .modal-title').text('Course Content Upload!');	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+data.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							
						}
					},
					error:function(jqXHR,textStatus,errorThrown){
						
					}
				}); 
				 return false;	
			},
			
			getCourseVideoForm:function(id){
			 
				$.ajax({
					url:"/course/get-course-video-form/"+id,
					type:"GET",
					success:function(response){		
						 
						$('#coursemodel .modal-body').html(response.html);	
						 $('#coursemodel .modal-title').text('Course Video');		
						$('#coursemodel').modal({keyboard:false,backdrop:'static'});
						$('#coursemodel').css({'width':'100%'});
						 
					},
					error:function(response){
						 
					}
				});
				 
			},
			saveCourseVideo:function(h_id,b_id,c_id,t_id,THIS){	
 
				var $this = $(THIS);
					$('.loading').show();
					//mainSpinner.start();
			var form = new FormData(THIS);	
			 
				$.ajax({
					url:"/course/saveCourseVideo/"+h_id+"/"+b_id+"/"+c_id+"/"+t_id,
					type:"POST",					   
					dataType:"json",					 
					//data:$this.serialize(),
					data:form,
					 cache: false,
					 contentType: false, 
                     processData: false, 
					success:function(data,textStatus,jqXHR){
					// mainSpinner.stop();	
						 			
						if(data.status){	
						    	$('.loading').hide();
						    	$('.succesmessage').show();
								$('.succesmessage').html("<div class='alert alert-success'>"+data.msg+"</div>");			 					 
						 
							 window.location=document.location.href; 
						}else{
							$('#coursemodel .errormessage').html("<div class='alert alert-danger'>"+data.msg+"</div>");
						 
							
						}
					},
					error:function(jqXHR,textStatus,errorThrown){
						
					}
				}); 
				 return false;	
			},
			adminSaveCourseVideo:function(h_id,c_id,THIS){	
 
				var $this = $(THIS);
					$('.loading').show();
					//mainSpinner.start();
			var form = new FormData(THIS);	
			 $('.loading').show();
				$.ajax({
					url:"/course/adminSaveCourseVideo/"+h_id+"/"+c_id,
					type:"POST",					   
					dataType:"json",					 
					//data:$this.serialize(),
					data:form,
					 cache: false,
					 contentType: false, 
                     processData: false, 
					success:function(data,textStatus,jqXHR){
					// mainSpinner.stop();	
						 			$('.loading').hide();
						if(data.status){	
						    	$('.loading').hide();
						    	$('.succesmessage').show();
								$('.succesmessage').html("<div class='alert alert-success'>"+data.msg+"</div>");			 					 
						 
							 window.location=document.location.href; 
						}else{
							$('#coursemodel .errormessage').html("<div class='alert alert-danger'>"+data.msg+"</div>");
						 
							
						}
					},
					error:function(jqXHR,textStatus,errorThrown){
						
					}
				}); 
				 return false;	
			},
			
			getCourseNotesForm:function(id){
			 
				$.ajax({
					url:"/course/get-course-notes-form/"+id,
					type:"GET",
					success:function(response){		
					$('#coursemodel').modal();
						$('#coursemodel .modal-body').html(response.html);					 
						 
						 $('#coursemodel .modal-title').text('Course Notes');		
						$('#coursemodel').modal({keyboard:false,backdrop:'static'});
						$('#coursemodel').css({'width':'100%'});
						 
					},
					error:function(response){
						 
					}
				});
				 
			},
			saveCourseNotes:function(h_id,b_id,c_id,t_id,THIS){	
				var $this = $(THIS);
				
			var form = new FormData(THIS);			 
			 
				$.ajax({
					url:"/course/saveCourseNotes/"+h_id+"/"+b_id+"/"+c_id+"/"+t_id,
					type:"POST",
					dataType:"json",					 
					//data:$this.serialize(),
					data:form,
					 cache: false,
					 contentType: false, 
                   processData: false, 
					success:function(data,textStatus,jqXHR){
					    
					 	if(data.status){	
					 	     $('.notesmessage').show();
								$('.notesmessage').html("<div class='alert alert-success'>"+data.msg+"</div>");								 
							 	window.location=document.location.href; 
						}else{
							$('.errormessage').html("<div class='alert alert-danger'>"+data.msg+"</div>");
							
						}
					},
					error:function(jqXHR,textStatus,errorThrown){
						
					}
				}); 
				 return false;	
			},
			adminSaveCourseNotes:function(h_id,c_id,THIS){	
			   
				var $this = $(THIS);
			var form = new FormData(THIS);			 
				 
				$.ajax({
					url:"/course/adminSaveCourseNotes/"+h_id+"/"+c_id,
					type:"POST",
					dataType:"json",					 
					//data:$this.serialize(),
					data:form,
					 cache: false,
					 contentType: false, 
                   processData: false, 
					success:function(data,textStatus,jqXHR){
					 
					 	if(data.status){
					 	    $('.notesmessage').show();
					 	      
								$('.notesmessage').html("<div class='alert alert-success'>"+data.msg+"</div>");	
							 	window.location=document.location.href; 
						}else{
							$('.noteerrormessage').html("<div class='alert alert-danger'>"+data.msg+"</div>");
							
						}
					},
					error:function(jqXHR,textStatus,errorThrown){
						
					}
				}); 
				 return false;	
			},
			saveCourseAssignment:function(h_id,b_id,c_id,t_id,THIS){	
				var $this = $(THIS);
			var formData  = new FormData(THIS);	
 
			
				$.ajax({
					url:"/course/saveCourseAssignment/"+h_id+"/"+b_id+"/"+c_id+"/"+t_id,
					type:"POST",
					dataType:"json",					 
					//data:$this.serialize(),
					data:formData ,
					 cache: false,
					 contentType: false, 
                   processData: false, 
					success:function(data,textStatus,jqXHR){
					 
					
						if(data.status){		
						    
							$('.succesmessage').html("<div class='alert alert-success'>"+data.msg+"</div>");		
							window.location=document.location.href; 
							 
						}else{
							 
							$('.errormessage').html("<div class='alert alert-danger'>"+data.msg+"</div>");
							 
							
						}
					},
					error:function(jqXHR,textStatus,errorThrown){
						
					}
				}); 
				 return false;	
			},
			adminSaveCourseAssignment:function(h_id,c_id,THIS){	
				var $this = $(THIS);
					data  = $this.serialize();
					
			var formData  = new FormData(THIS);	
	
			
				$.ajax({
					url:"/course/adminSaveCourseAssignment/"+h_id+"/"+c_id,
					type:"POST",
					dataType:"json",					 
					//data:$this.serialize(),
					data:formData ,
					 cache: false,
					 contentType: false, 
                   processData: false, 
					success:function(data,textStatus,jqXHR){
					 
					
						if(data.status){					
							$('.succesmessage').html("<div class='alert alert-success'>"+data.msg+"</div>");		
							window.location=document.location.href; 
							 
						}else{
							 
							$('.errormessage').html("<div class='alert alert-danger'>"+data.msg+"</div>");
							 
							
						}
					},
					error:function(jqXHR,textStatus,errorThrown){
						
					}
				}); 
				 return false;	
			},
			delete:function(id){
		 
			 	if( confirm("Are You Sure Want to Delete!") ) {	
				 
				$.ajax({
					url:"/course/delete/"+id,
					type:"GET",
					//dataType:"json",	
					success:function(response){	
					 
					if(response.status){
					    $('#messagemodel').modal();
						$('#messagemodel .modal-title').text("Course Content Delete");	
						$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");			
						$('#messagemodel').modal({keyboard:false,backdrop:'static'});
						$('#messagemodel').css({'width':'100%'});
						dataTableAllcourse.ajax.reload( null, false );   
					}else{
					    $('#messagemodel').modal();
							$('#messagemodel .modal-title').text("Course Content Delete");	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");		
							$('#messagemodel').modal({keyboard:false,backdrop:'static'});
							$('#messagemodel').css({'width':'100%'});
					}						
					},
					error:function(response){
						 alert('some error');
					}
				});
				}
			},
			deleteCourseContentBatch:function(bid,cid){
		 
			 	if( confirm("Are You Sure Want to Delete Course Content! ") ) {	
				 
				$.ajax({
					url:"/course/deleteCourseContentBatch/"+bid+"/"+cid,
					type:"GET",
					//dataType:"json",	
					success:function(response){	
					 
					if(response.status){
					    $('#messagemodel').modal();
						$('#messagemodel .modal-title').text("Course Content Delete");	
						$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");			
						$('#messagemodel').modal({keyboard:false,backdrop:'static'});
						$('#messagemodel').css({'width':'100%'});
						dataTablerunningBatches.ajax.reload( null, false );   
					}else{
					    $('#messagemodel').modal();
							$('#messagemodel .modal-title').text("Course Content Delete");	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");		
							$('#messagemodel').modal({keyboard:false,backdrop:'static'});
							$('#messagemodel').css({'width':'100%'});
					}						
					},
					error:function(response){
						 alert('some error');
					}
				});
				}
			},
			tempCourseContentdelete:function(bid,cid){
			 	if( confirm("Are You Sure Want to Delete!") ) {	
				 
				$.ajax({
					url:"/course/tempCourseContentdelete/"+bid+'/'+cid,
					type:"GET",
					//dataType:"json",	
					success:function(response){	
					 
					if(response.status){
					    $('#messagemodel').modal();
						$('#messagemodel .modal-title').text("Course Content Delete");	
						$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");			
						$('#messagemodel').modal({keyboard:false,backdrop:'static'});
						$('#messagemodel').css({'width':'100%'});
						window.location=document.location.href; 
						
						
					}else{
					    $('#messagemodel').modal();
							$('#messagemodel .modal-title').text("Course Content Delete");	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");		
							$('#messagemodel').modal({keyboard:false,backdrop:'static'});
							$('#messagemodel').css({'width':'100%'});
					}						
					},
					error:function(response){
						 alert('some error');
					}
				});
				}
			},
			courseVideodelete:function(id){
			 	if( confirm("Are You Sure Want to Delete!") ) {	
				$.ajax({
					url:"/course/courseVideodelete/"+id,
					type:"GET",
					//dataType:"json",	
					success:function(response){	
					if(response.status){
					    $('#messagemodel').modal();
						$('#messagemodel .modal-title').text("Course Video Delete");	
						$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");			
						$('#messagemodel').modal({keyboard:false,backdrop:'static'});
						$('#messagemodel').css({'width':'100%'});
						//dataTablerunningBatches.ajax.reload( null, false );   
						window.location=document.location.href;
					}else{
					    $('#messagemodel').modal();
							$('#messagemodel .modal-title').text("Course Video Delete");	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");		
							$('#messagemodel').modal({keyboard:false,backdrop:'static'});
							$('#messagemodel').css({'width':'100%'});
					}						
					},
					error:function(response){
						 alert('some error');
					}
				});
				}
			},
			
			courseNotesdelete:function(id){		
			     
			 	if( confirm("Are You Sure Want to Delete!") ) {					 
				jQuery.ajax({
					url:"/course/courseNotesdelete/"+id,
					type:"GET",
					//dataType:"json",	
					success:function(response){	
					 
					if(response.status){
						$('#messagemodel').modal();
						$('#messagemodel .modal-title').text("Course Notes Delete");	
						$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");			
						$('#messagemodel').modal({keyboard:false,backdrop:'static'});
						$('#messagemodel').css({'width':'100%'});
						//dataTablerunningBatches.ajax.reload( null, false );   
						window.location=document.location.href;
					}else{
							$('#messagemodel').modal();
							$('#messagemodel .modal-title').text("Course Notes Delete");	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");		
							$('#messagemodel').modal({keyboard:false,backdrop:'static'});
							$('#messagemodel').css({'width':'100%'});
					}						
					},
					error:function(response){
						 alert('some error');
					}
				});
				}
			},
			 courseAssignmentdelete:function(id){		 
			 	if( confirm("Are You Sure Want to Delete!") ) {					 
				jQuery.ajax({
					url:"/course/courseAssignmentdelete/"+id,
					type:"GET",
					//dataType:"json",	
					success:function(response){	
					 
					if(response.status){
						$('#messagemodel').modal();
						$('#messagemodel .modal-title').text("Course Notes Delete");	
						$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");			
						$('#messagemodel').modal({keyboard:false,backdrop:'static'});
						$('#messagemodel').css({'width':'100%'});
						//dataTablerunningBatches.ajax.reload( null, false );   
						window.location=document.location.href;
					}else{
							$('#messagemodel').modal();
							$('#messagemodel .modal-title').text("Course Notes Delete");	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");		
							$('#messagemodel').modal({keyboard:false,backdrop:'static'});
							$('#messagemodel').css({'width':'100%'});
					}						
					},
					error:function(response){
						 alert('some error');
					}
				});
				}
			}
			 
			 
			
		 
			
			
	};
	})();
 
 
 var studentsController = (function(){
		return {
			checked_Ids:[],
			submit:function(THIS){
			 
				var $this = $(THIS),
					data  = $this.serialize();
					 
				$.ajax({
					url:"/student/profile-update",
					type:"POST",
					data:data,
					success:function(response){
						 
						if(response.status){						 
							 $('#messagemodel').modal();
							 $('#messagemodel .modal-title').text('Profile Upate');	
							$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							window.location=document.location.href;     
							    
							
						}else{	
						    $('#messagemodel').modal();
							$('#messagemodel .modal-title').text('Profile Upate');	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});					 
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
						var response = JSON.parse(jqXHR.responseText);
						if(response.status){
							showValidationErrors($this,response.errors);
						 
						}else{
							alert('Something went wrong');
						}
						 
					}
				});
				return false;
			},
			
			
			firstFeedBacksubmit:function(THIS){
			 
				var $this = $(THIS),
					data  = $this.serialize();
					  
				$.ajax({
					url:"/student/first-feedback-save",
					type:"POST",
					data:data,
					success:function(response){
						 
						if(response.status){	
							 $('#messagemodel').modal();
							$('#messagemodel .modal-title').text('Feedback');	
							$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
						//	window.location=document.location.href;     
							     removeValidationErrors($this);
							
						}else{	
						    $('#messagemodel').modal();
							$('#messagemodel .modal-title').text('Feedback');	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});			 
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
						var response = JSON.parse(jqXHR.responseText);
						if(response.status){
							showValidationErrors($this,response.errors);
							var errors= response.errors;
						 
						}else{
							alert('Something went wrong');
						}
						 
					}
				});
				return false;
			},
			secondFeedBacksubmit:function(THIS){
			 
				var $this = $(THIS),
					data  = $this.serialize();
					  
				$.ajax({
					url:"/student/second-feedback-save",
					type:"POST",
					data:data,
					success:function(response){
						 
						if(response.status){	
							 $('#messagemodel').modal();
							$('#messagemodel .modal-title').text('Feedback');	
							$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
				       removeValidationErrors($this);
							    
							
						}else{	
						    $('#messagemodel').modal();
							$('#messagemodel .modal-title').text('Feedback');	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});						 
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
						var response = JSON.parse(jqXHR.responseText);
						if(response.status){
							showValidationErrors($this,response.errors);
							var errors= response.errors;
						 
						}else{
							alert('Something went wrong');
						}
						 
					}
				});
				return false;
			},
			thirdFeedBacksubmit:function(THIS){
			 
				var $this = $(THIS),
					data  = $this.serialize();
					  
				$.ajax({
					url:"/student/third-feedback-save",
					type:"POST",
					data:data,
					success:function(response){
						 
						if(response.status){
						    $('#messagemodel').modal();
							$('#messagemodel .modal-title').text('Feedback');	
							$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
					   
							    removeValidationErrors($this); 
							
						}else{			
						    $('#messagemodel').modal();
							 $('#messagemodel .modal-title').text('Feedback');	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});					 
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
						var response = JSON.parse(jqXHR.responseText);
						if(response.status){
							showValidationErrors($this,response.errors);
							var errors= response.errors;
						 
						}else{
							alert('Something went wrong');
						}
						 
					}
				});
				return false;
			},				
			feedbackQuestion:function(THIS){
			 
				var $this = $(THIS),
					data  = $this.serialize();
					  
				$.ajax({
					url:"/student/feedbackQuestion-save",
					type:"POST",
					data:data,
					success:function(response){
						 
						if(response.status){	
					    	$this.find('button[type="reset"]').click();
					    	$('#messagemodel').modal();
							$('#messagemodel .modal-title').text('Feed back Question Added');	
							$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
					    removeValidationErrors($this);
							    
							
						}else{		
						    $('#messagemodel').modal();
							 $('#messagemodel .modal-title').text('Not Feed back Question Added');	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});					 
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
						var response = JSON.parse(jqXHR.responseText);
						if(response.status){
							showValidationErrors($this,response.errors);
							var errors= response.errors;
						 
						}else{
							alert('Something went wrong');
						}
						 
					}
				});
				return false;
			},
			querySave:function(THIS){			 
				var $this = $(THIS),
					data  = $this.serialize();
					  //alert(data);
				$.ajax({
					url:"/student/querySave",
					type:"POST",
					data:data,
					success:function(response){
						 
						if(response.status){	
					    	$this.find('input[type="reset"]').click();
					    	$('#messagemodel').modal();
							$('#messagemodel .modal-title').text('Message');	
							  $('.imgclass').html('<img src="../logo/Thanks_Reaching_Us.jpg" style="width: 100%;text-align: center;margin: auto;display: block;">');
						//	$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
					   
							     removeValidationErrors($this);
							
						}else{		
						    $('#messagemodel').modal();
							 $('#messagemodel .modal-title').text('Not Feed back Question Added');	
							  $('.imgclass').html('<img src="../logo/message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');	
							//$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});					 
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
						var response = JSON.parse(jqXHR.responseText);
						if(response.status){
							showValidationErrors($this,response.errors);
							var errors= response.errors;
						 
						}else{
							alert('Something went wrong');
						}
						 
					}
				});
				return false;
			}, 
			
			referEarnSave:function(THIS){			 
				var $this = $(THIS),
					data  = $this.serialize();
					  //alert(data);
				$.ajax({
					url:"/student/referEarnSave",
					type:"POST",
					data:data,
					success:function(response){
						 
						if(response.status){	
					    	$this.find('input[type="reset"]').click();
					    	$('#referand_earn').modal('hide');
					    	$('#messagemodel').modal();
							$('#messagemodel .modal-title').text('Message');	
							$('.imgclass').html('<img src="../logo/Thanks_Reaching_Us.jpg" style="width: 100%;text-align: center;margin: auto;display: block;">');
							//$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
					    removeValidationErrors($this);
							    
							
						}else{		
						    $('#messagemodel').modal();
							 $('#messagemodel .modal-title').text('Not Message');
							  $('.imgclass').html('<img src="../logo/message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');	
						//	$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});					 
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
						var response = JSON.parse(jqXHR.responseText);
						if(response.status){
							showValidationErrors($this,response.errors);
							var errors= response.errors;
						 
						}else{
							alert('Something went wrong');
						}
						 
					}
				});
				return false;
			},
			 
			 
			
			
	};
	})();
  
  
 var userController = (function(){
		return {
			checked_Ids:[],
			registerSubmit:function(THIS){
			 
				var $this = $(THIS),
					data  = $this.serialize();
					 
				$.ajax({
					url:"/users/add",
					type:"POST",
					data:data,
					success:function(response){
						 
						if(response.status){						 
							 $('#messagemodel').modal();
							 $('#messagemodel .modal-title').text('Upate');	
							$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							//window.location=document.location.href;     
							    
							
						}else{	
						    $('#messagemodel').modal();
							$('#messagemodel .modal-title').text('Upate');	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});					 
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
						var response = JSON.parse(jqXHR.responseText);
						if(response.status){
							showValidationErrors($this,response.errors);
						 
						}else{
							alert('Something went wrong');
						}
						 
					}
				});
				return false;
			},
			 editRegisterSubmit:function(THIS){
			 
				var $this = $(THIS),
					data  = $this.serialize();
					 var id= $('#user_id').val();
				$.ajax({
					url:"/users/edit/"+id,
					type:"POST",
					data:data,
					success:function(response){
						 
						if(response.status){						 
							 
							 $('#messagemodel .modal-title').text('Profile Upate');	
							$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});
							//window.location=document.location.href;     
							    
							
						}else{							 
							$('#messagemodel .modal-title').text('Profile Upate');	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");
							$('#messagemodel').modal({backdrop:"static",keyboard:false});					 
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
						var response = JSON.parse(jqXHR.responseText);
						if(response.status){
							showValidationErrors($this,response.errors);
						 
						}else{
							alert('Something went wrong');
						}
						 
					}
				});
				return false;
			},
			 
			 
			 
			 delete:function(id){
		 
			 	if( confirm("Are You Sure Want to Delete!") ) {			 
				$.ajax({
					url:"/users/delete/"+id,
					type:"GET",
					//dataType:"json",	
					success:function(response){						 
					if(response.status){
					    $('#messagemodel').modal();
						$('#messagemodel .modal-title').text("User Delete");	
						$('#messagemodel .modal-body').html("<div class='alert alert-success'>"+response.msg+"</div>");			
						$('#messagemodel').modal({keyboard:false,backdrop:'static'});
						$('#messagemodel').css({'width':'100%'});
						dataTableUserList.ajax.reload( null, false );   
					}else{
					    $('#messagemodel').modal();
							$('#messagemodel .modal-title').text("User Delete");	
							$('#messagemodel .modal-body').html("<div class='alert alert-danger'>"+response.msg+"</div>");		
							$('#messagemodel').modal({keyboard:false,backdrop:'static'});
							$('#messagemodel').css({'width':'100%'});
					}						
					},
					error:function(response){
						 alert('some error');
					}
				});
				}
			}
			
			
	};
	})();
  
  
		function removeValidationErrors($this){
		$this.find('.form-group').removeClass('has-error');
		$this.find('.help-block').remove();
		}
		
		function showValidationErrors($this,errors){
		$this.find('.form-group').removeClass('has-error');
		$this.find('.help-block').remove();
		for (var key in errors) {
		if(errors.hasOwnProperty(key)){
		var el = $this.find('*[name="'+key+'"]');
		$('<span class="help-block"><strong>'+errors[key][0]+'</strong></span>').insertAfter(el);
		el.closest('.form-group').addClass('has-error');
		}
		}
		}
	 
 	$(document).on('click','#batchInvoice',function(e){
	  
		var THIS = $(this);
		var id   = THIS.data('sid'); 		
	 
			$.ajax({
			url:"/invoice/batch-generate-invoice",
			type:"POST",			
			data:{action:'getBatchinvoicePrintPdf',bid:id},
			 
			success: function(response) {        		
				var printWindow = window.open('', '', 'width=700,height=500');
				printWindow.document.write(response);
				return false;

			}

			});	 

	});

	$(document).on('click','#invoicePrintPdfSlip',function(e){
	  
		var THIS = $(this);
		var gid   = THIS.data('gid'); 		
		var bid   = THIS.data('bid'); 		
			$.ajax({
			url:"/invoice/get-generate-invoice",
			type:"POST",			
			data:{action:'getInvoicePrintPdf',bid:bid,gid:gid},
			 
			success: function(response) {        		
				var printWindow = window.open('', '', 'width=950,height=500');
				printWindow.document.write(response);
				return false;

			}

			});	 

	});



// change visibility request
	jQuery(document).on('click', '.heading', function(event){
		
		var THIS = jQuery(this);
		var complete_id   = THIS.data('complete_id');
		var heading_id   = THIS.data('heading_id');
		var b_id   = THIS.data('b_id');
		var c_id   = THIS.data('c_id');
		var t_id   = THIS.data('t_id');
		var heading   = THIS.data('heading');
		 
		 if( confirm("Are You Sure Want to Complete "+heading+"") ) {	 
		  
	
		 	if(THIS.is(':checked')){			 
			var visib = 1;	
		THIS.prop('disabled', true);			
		}else{			 
			var visib = 0;
			THIS.prop('disabled', false);
		}
		 
		jQuery.ajax({
			url:"/course/course-heading-status",
			type: 'POST',
			data: {
				'action': 'updateHeadingstatus',
				'complete_id': complete_id,
				'hid': heading_id,
				'b_id': b_id,
				'c_id': c_id,
				't_id': t_id,
				'status': visib,
			},
			dataType: 'JSON',
			success: function(response){
				
					if(response.status){
						if(visib==true){
							THIS.prop('checked', true);		
						}else{ 
						THIS.prop('checked', false);		
						}					 
						$('.succesmessage').html("<div class='alert alert-success'>"+response.msg+"</div>");			
					 
						 
					}
					else{
						THIS.prop('checked', false);		
					 
						$('.errormessage').html("<div class='alert alert-danger'>"+response.msg+"</div>");			
						 
					}
				
				 
				THIS.prop('disabled', false);
			}
		});
			}
			
			return false;
			 
		 
	});
	
	
	jQuery(document).on('click', '.contentsss', function(event){
		 
		
		var THIS = jQuery(this);
		var complete_id   = THIS.data('complete_id');
		var id   = THIS.data('content_id');
		var b_id   = THIS.data('b_id');
		var c_id   = THIS.data('c_id');
		var t_id   = THIS.data('t_id');
		var content   = THIS.data('content');
	//if( confirm("Are You Sure Want to Complete:- "+content+"") ) {
			 
		
		 	if(THIS.is(':checked')){			 
			var visib = 1;	
		THIS.prop('disabled', true);			
		}else{			 
			var visib = 0;
			THIS.prop('disabled', false);
		}
		
		jQuery.ajax({
			url:"/course/course-content-status",
			type: 'POST',
			data: {
				'action': 'updateContentstatus',
				'complete_id': complete_id,
				'cid': id,
				'b_id': b_id,
				'c_id': c_id,
				't_id': t_id,
				'status': visib,
			},
			dataType: 'JSON',
			success: function(response){				
					if(response.status){
					if(visib==true){
							THIS.prop('checked', true);		
						}else{ 
						THIS.prop('checked', false);		
						}					
						$('.succesmessage').html("<div class='alert alert-success'>"+response.msg+"</div>");	
					}
					else{
						THIS.prop('checked', false);						
						$('.errormessage').html("<div class='alert alert-danger'>"+response.msg+"</div>");	
					}			
				 
				THIS.prop('disabled', false);
			}
		});
		
		
			return false;
		 
	});
	
	jQuery(document).on('click', '.subcontent', function(event){ 
		
		var THIS = jQuery(this);
		var complete_id   = THIS.data('complete_id');
		var scid   = THIS.data('subcontent_id');
		var b_id   = THIS.data('b_id');
		var c_id   = THIS.data('c_id');
		var t_id   = THIS.data('t_id');
		var subcontent   = THIS.data('subcontent');
		 //if( confirm("Are You Sure Want to Complete "+subcontent+"") ) {
			 
	
		 	if(THIS.is(':checked')){			 
			var visib = 1;	
		THIS.prop('disabled', true);			
		}else{			 
			var visib = 0;
			THIS.prop('disabled', false);
		}
		
		jQuery.ajax({
			url:"/course/course-subcontent-status",
			type: 'POST',
			data: {
				'action': 'updateSubContentstatus',
				'complete_id': complete_id,
				'scid': scid,
				'b_id': b_id,
				'c_id': c_id,
				't_id': t_id,
				'status': visib,
			},
			dataType: 'JSON',
			success: function(response){				
					if(response.status){
						if(visib==true){
							THIS.prop('checked', true);		
						}else{ 
						THIS.prop('checked', false);		
						}					
						$('.succesmessage').html("<div class='alert alert-success'>"+response.msg+"</div>");	
					}
					else{
						THIS.prop('checked', false);
						
						$('.errormessage').html("<div class='alert alert-danger'>"+response.msg+"</div>");	
					}			
				 
				THIS.prop('disabled', false);
			}
		});
			
			return false;
		 
	});
	
	
	jQuery(document).on('click', '.lastcontent', function(event){		
		var THIS = jQuery(this);
		var complete_id   = THIS.data('complete_id');
		var lcid   = THIS.data('lastcontent_id');
		var b_id   = THIS.data('b_id');
		var c_id   = THIS.data('c_id');
		var t_id   = THIS.data('t_id');
		var lastcontent   = THIS.data('lastcontent');
		 //if( confirm("Are You Sure Want to Complete "+lastcontent+"") ) {
			 
		
		 	if(THIS.is(':checked')){			 
			var visib = 1;	
		THIS.prop('disabled', true);			
		}else{			 
			var visib = 0;
			THIS.prop('disabled', false);
		}
		
		jQuery.ajax({
			url:"/course/course-lastcontent-status",
			type: 'POST',
			data: {
				'action': 'updateLastContentstatus',
				'complete_id': complete_id,
				'lcid': lcid,
				'b_id': b_id,
				'c_id': c_id,
				't_id': t_id,
				'status': visib,
			},
			dataType: 'JSON',
			success: function(response){				
					if(response.status){
						if(visib==true){
							THIS.prop('checked', true);		
						}else{ 
						THIS.prop('checked', false);		
						}					
						$('.succesmessage').html("<div class='alert alert-success'>"+response.msg+"</div>");	
					}
					else{
						THIS.prop('checked', false);						
						$('.errormessage').html("<div class='alert alert-danger'>"+response.msg+"</div>");	
					}			
				 
				THIS.prop('disabled', false);
			}
		});
			
			return false;
		 
	});
	jQuery(document).on('click', '#studentSlipReceipt', function(){

		var THIS = jQuery(this);

		var id   = THIS.data('sid');
 
		$.ajax({
			url:"/student/studentSlipReceipt",
			type:"POST",			
			data:{action:'studentSlipReceipt',fid:id},
			 
			success: function(response) {        		
				var printWindow = window.open('', '', 'width=900,height=500');
				printWindow.document.write(response);
				return false;

			}

			});		

	});
	
        jQuery(document).on('click', '.vclose', function(){
        var THIS = jQuery(this);
        // var closeid  = $('.vclose').data('closeid');
        var closeid  = THIS.data('closeid');  
        $("#myModal_"+closeid+"").modal("hide");
        $(".theVideo_"+closeid+"").get(0).pause();	
        });  
 
	 $('.select_course').select2();
	 $('.select_trainer').select2();
	
	 
		function isNumberKey(e){
		var keyCode = e.keyCode || e.charCode;
		if(keyCode>=48&&keyCode<=57)
		return true;
		else
		return false;
		}
		
		
		
		
var dataTableGrevence = $('#Grevence-datatable')
.dataTable({
	"fixedHeader": true,
	"processing":true,
	"serverSide":true,
	"paging":true,
	"ordering":true,
	"lengthMenu": [
            [10,25,50,100,250,500],
            ['10','25','50','100','250','500']
        ],
		 dom: "Blfrtip",
                buttons: [
                     {
                        extend: "excel",
                        className: "btn-sm"
                    },
                     
                    {
                        extend: "print",
                        className: "btn-sm"
                    },
                ],
	"ajax":{
		url:"/grev-data",
		data:function(d){		 
			
			d.page = (d.start/d.length)+1;		
			d.search['trainer']=$('*[name="search[trainer]"]').val();			
			d.search['course']=$('*[name="search[course]"]').val();			
			//d.columns = null;
			//d.order = null;
		},
		dataSrc:function(json){
			recordCollection = json.recordCollection;
			return json.data;
		}
	}
}).api();	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	 