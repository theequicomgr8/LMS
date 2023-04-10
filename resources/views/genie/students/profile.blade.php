 @extends('genie.layouts.app')
 @section('title')
     Profile
@endsection
@section('content')	
<style>

    .profile-status .profile-status-heading p {

    margin-bottom: 0px !important;
    color:#000;
}
.profile-status .profile-status-heading p {
    width: 29%;
    margin: 0;
    text-align: left;
    padding: 12px 87px !important;
}
.profile-status .profile-status-heading .strong-heading1 {
    width: 71%;
        color: rgb(0 0 0 / 68%);

}
input[type="file"] {
    height: 39px !important;
    padding: 6px 0px;
}
.profile-data
{
    margin-bottom:0px;
}
@media screen and (max-width: 992px) {
.profile-status .profile-status-heading p {
    padding: 12px 12px !important;
        width: 37%;

}
  input[type="file"] {
    height: 45px;
    padding: 10px 10px;
}  
}
</style>
<div class="right_col" role="main">
          <div class="">
            <!--<div class="page-title">-->
            <!--  <div class="title_left">-->
            <!--    <h3>Student Profile</h3>-->
            <!--  </div>-->

            <!--  <div class="title_right">-->
                 
            <!--  </div>-->
            <!--</div>-->
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 " style="margin-top: 20px;">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Student Profile</h2>
                    <ul class="nav navbar-right panel_toolbox ">
                    
                      <!--<li class="dropdown">-->
                      <!--  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>-->
                      <!--  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">-->
                      <!--      <a class="dropdown-item" href="#">Settings 1</a>-->
                      <!--      <a class="dropdown-item" href="#">Settings 2</a>-->
                      <!--    </div>-->
                      <!--</li>-->
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-12 col-sm-12 pr-0 pl-0">
                 <!--     <div class="profile_img">
                        <div id="crop-avatar">
                          <img class="img-responsive avatar-view" src="{{url('genie/build/images/picture.jpg')}}" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>-->
                     <!-- <h3><?php echo $students->name; ?></h3>-->

                    <!--  <ul class="list-unstyled user_data">
                        <li><i class="fa fa-envelope user-profile-icon"></i> <?php echo $students->email; ?>
                        </li> 
						
						<li><i class="fa fa-phone user-profile-icon"></i> <?php echo $students->phone; ?>
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $students->course; ?>
                        </li>

                         
                      </ul>-->

                    <!--  <a class="btn btn-success" data-toggle="modal" data-target="#paymodel"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>-->
                    <div class="profile-data mt-3">
                        <div class="profile-status">
                         <div class="profile-status-heading">
                        <p class="strong-heading">Full Name</p>
                        <span>:</span>
                        <p class="strong-heading1"><?php if(!empty($students->name)){ echo $students->name; } ?></p>
                      </div>  

					  <div class="profile-status-heading">
                        <p class="strong-heading">Email Id</p>
                        <span>:</span>
                        <p class="strong-heading1"><?php if(!empty($students->email)){ echo $students->email; } ?></p>
                      </div> 
                     
                         <div class="profile-status-heading">
                        <p class="strong-heading">Phone Number</p>
                        <span>:</span>
                        <p class="strong-heading1"><?php if(!empty($students->phone)){ echo $students->phone; } ?></p>
                      </div> 
                      
					  <div class="profile-status-heading">
                        <p class="strong-heading">Course Name</p>
                        <span>:</span>
                        <p class="strong-heading1"><?php if(!empty($students->course)){ echo $students->course; } ?></p>
                      </div> 
					
					
                        <div class="profile-status-heading">
                        <p class="photo-padding strong-heading ">Photo</p>
                        <span>:</span>
                        <form action="">
                        {{csrf_field()}}     
                        <div class="nk-int-st">
                        @if(!empty($students->pic_image))
                        <img src="{{asset('/uploads/image/'.$students->pic_image)}}" style="max-width:150px; height:100px; width:100px;">	
                        <a href="javascript:void(0);" id="picimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
                        
                        @else
                        <input type="file" class="form-control" name="photoimg" id="photoimg" accept="image/png, image/jpeg" style="border: 0;">
                        <a href="javascript:void(0);" id="getImage"></a>
                        @endif
                                              
                        
                        </div> 
                        </form>
                        </div> 
				
				
					   
                      
                    </div>
                        
                    </div>
                    
                      <br />
						<div id="paymodel" class="modal fade" role="dialog">
						<div class="modal-dialog">


						<div class="modal-content">
						<div class="modal-header">
						<h4 class="modal-title">Edit Profile:<div class="succesmessage"></div><div class="errormessage"></div> </h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						


						</div>
						<div class="modal-body">
						<div class="panel-body">
						<div class="row">
						<form action=""  autocomplete="off" onsubmit="return studentsController.submit(this)">

						<div class="col-lg-12">
						<div class="form-group">

						<label for="trainer-mobile">Name</label>
						<input type="hidden" name="std_id"   value="<?php echo (isset($students->std_id)?$students->std_id:"")?>">		
						<input type="text" class="form-control" name="name" value="<?php echo (isset($students->name)?$students->name:""); ?>" placeholder="Enter Name">
						 


						</div>
						</div>


						<div class="col-lg-12">
						<div class="form-group">
						<label for="trainer-mobile">Email</label>
						<input type="text" class="form-control" name="email" value="<?php echo (isset($students->email)?$students->email:""); ?>" placeholder="Enter Email" autofocus data-rule="students" data-msg="Enter Email">
						<div class="validation"></div>

						</div>
						</div>

  
						<div class="col-lg-12">
						<input type="submit" name="pay" class="btn btn-submit btn-info text-center" value="Submit" style="margin-left: 233px;">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

						</div>

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
              </div>
            </div>
          </div>
        </div>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script> 
$(document).ready(function() {
$("#getImage").click(function(){
$('#photoimg').trigger('click'); 
});
	$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
	});
$('#photoimg').on('change', function(){ 
 
$("#preview").html('<img src="site/images/loading-icon.gif" alt="Uploading...." style="width:120px;height:120px;"/>');

var file = this.files[0];

var form = new FormData();
form.append('image', file);
 
$.ajax({

url: '/student/picimage/<?php echo $students->std_id ?>',
type: 'post',
cache: false,
contentType: false,
processData: false,
data: form,
success: function(data) {
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
	location.reload();
}else{
	alert(obj.msg);
	
}
 
} 
});

});




//delete pic image
$('#picimage').on('click', function(){ 


 $.ajax({
url: '/student/del_picimage/<?php echo $students->std_id ?>',
type: 'get',
cache: false,
contentType: false,
processData: false, 
success: function(data) { 
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
	location.reload();
}else{
	alert(obj.msg);
	
}
 
 
}
 
});
});

});
</script>
@endsection
		
        