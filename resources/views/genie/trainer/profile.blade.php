 @extends('genie.layouts.app')
 @section('title')
     Profile
@endsection
@section('content')	
<style>
     .profile-status .profile-status-heading p {

    margin-bottom: 0px !important;    color:#000;

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
.profile-status-heading ul
{
    padding-top:12px;
    padding-bottom:12px;
        padding-left: 103px;
        margin-bottom:0px;     color: rgb(0 0 0 / 68%);


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
.profile-status-heading ul {
    padding-left: 23px;
    
}
}
</style>
<div class="right_col" role="main">
          <div class="">
            <!--<div class="page-title">-->
            <!--  <div class="title_left">-->
            <!--    <h4>Trainer Profile</h3>-->
            <!--  </div>-->

            <!--  <div class="title_right">-->
                 
            <!--  </div>-->
            <!--</div>-->
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 " style="margin-top: 32px;">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Trainer Profile </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <!--<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>-->
                      <!--</li>-->
                      <!--<li class="dropdown">-->
                      <!--  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>-->
                      <!--  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">-->
                      <!--      <a class="dropdown-item" href="#">Settings 1</a>-->
                      <!--      <a class="dropdown-item" href="#">Settings 2</a>-->
                      <!--    </div>-->
                      <!--</li>-->
                      <!--<li><a class="close-link"><i class="fa fa-close"></i></a>-->
                      <!--</li>-->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-12 col-sm-12  pr-0 pl-0">
                 

                    <!--  <a class="btn btn-success" data-toggle="modal" data-target="#paymodel"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>-->
                    <div class="profile-data mt-3">
                        <div class="profile-status">
                         <div class="profile-status-heading">
                        <p class="strong-heading strong-heading">Full Name</p>
                        <span>:</span>
                        <p class="strong-heading1"><?php if(!empty($trainers->name)){ echo $trainers->name; } ?></p>
                      </div>  

					  <div class="profile-status-heading">
                        <p class="strong-heading">Email Id</p>
                        <span>:</span>
                        <p class="strong-heading1"><?php if(!empty($trainers->trainer_email)){ echo $trainers->trainer_email; } ?></p>
                      </div> 
                     
                         <div class="profile-status-heading">
                        <p class="strong-heading">Phone Number</p>
                        <span>:</span>
                        <p class="strong-heading1"><?php if(!empty($trainers->trainer_phone)){ echo $trainers->trainer_phone; } ?></p>
                      </div> 
                      
                       <div class="profile-status-heading">
                        <p class="strong-heading">Photo</p>
                        <span>:</span>
                        <form action="">
                        {{csrf_field()}}     
                        <div class="nk-int-st">
                        @if(!empty($trainers->pic_image))
                        <img src="{{asset('/uploads/image/'.$trainers->pic_image)}}" style="max-width:150px; height:100px; width:100px;">	
                        <a href="javascript:void(0);" id="picimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
                        
                        @else
                        <input type="file" class="form-control" name="photoimg" id="photoimg" accept="image/png, image/jpeg" style="border: 0;">
                        <a href="javascript:void(0);" id="getImage"></a>
                        @endif
                                              
                        
                        </div> 
                        </form>
                        </div> 
                        
                        
                        <div class="profile-status-heading">
                        <p class="strong-heading">Course Name</p>
                        <span>:</span>
                        <?php  
                        $result_courses = unserialize($trainers->courses);
                        $courses = App\FeesCourse::orderBy('course','ASC')->get();
                        $usr = [];
                        foreach($courses as $course){
                        $coursename[$course->id] = $course->course;
                        }
                        if( count($result_courses) > 0 && !empty($result_courses) ) {
                        
                        
                        echo "<ul>";
                        foreach( $result_courses as $id ) {
                        
                        if( !empty($id) ) {
                        
                        echo "<li>".ucfirst(isset($coursename[$id])?$coursename[$id]:"" )."</li>";
                        }
                        }
                        echo "</ul>";
                        }
                        ?>
                        </div> 
					
					
				
				
				
					   
                      
                    </div>
                        
                    </div>
                    
                      <br />
						 
														
                       

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

url: '/trainer/picimage/<?php echo $trainers->id ?>',
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
url: '/trainer/del_picimage/<?php echo $trainers->id ?>',
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
		
        