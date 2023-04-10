 <style>
     #referand_earn .modal-header button span {position: absolute;right: 14px;background-color: #ddd;height: 28px;width: 28px;border-radius: 50%;line-height: 28px;font-size: 25px;color: #000;opacity: 9;font-weight: 700;text-align: center;text-shadow: 0 1px 0 #fff;}
.fa-phone{padding: 10px !important;}
 </style>
 <div class="col-md-4"><div class="query1 batches"><div class="query-heading1"><h4>Drop us a Query</h4></div><div class="form-selection1"></div>
 <div class="form-selection"><?php $getStudentsCourse =getStudentsCourse();	 ?>
 <div class="form-trainer-management mt-3" id="A"><form class="form-horizontal" autocomplete="off" onsubmit="return studentsController.querySave(this)" method="post">
<div class="form-group"><div class="inner-addon left-addon"><i class="fa fa-user fa-lg"></i>
<input type="hidden" class="form-control " name="name" value="<?php echo $students[0]->name; ?>" placeholder="Mobile No*" >                               
<input type="tel" name="mobile" class="form-control form-student" value="<?php echo Session::get('mobile'); ?>" maxlength="16" onkeypress="return isNumberKey(event);" placeholder="Enter Phone no ">
</div></div>
<div class="form-group">
                                <div class="inner-addon left-addon">
                                    <i class="fa fa-envelope fa-lg"></i>
                              <input type="email" class="form-control form-student" value="<?php echo Session::get('email'); ?>" name="email" placeholder="E-mail Address*" >
                            </div>
                            </div>
							<div class="form-group">
							     <div class="inner-addon left-addon">
					            <i class="fa fa-user fa-lg"></i>

							<select class="form-control form-student"  name="trainer">
							<option value="">Select Trainer</option>   
							@if(!empty($getStudentsCourse))
							@foreach($getStudentsCourse as $studcourse)
							<option value="{{$studcourse->trainer_name}}" >{{$studcourse->trainer_name}}</option>
							@endforeach
							@endif

							</select>
                            </div> 
                            </div>
							<div class="form-group"> 
				              <div class="inner-addon left-addon">
				              <i class="fa fa-book fa-lg"></i>

							<select class="form-control form-student"  name="course">
							<option value="">Select Technology</option>   
							@if(!empty($getStudentsCourse))
							@foreach($getStudentsCourse as $studcourse)
							<option value="{{$studcourse->course}}" >{{$studcourse->course}}</option>
							@endforeach
							@endif

							</select>
                                </div>
                            </div>
                            <div class="form-group">
                              <textarea class="form-control form-student" name="message" placeholder="Type your query here" rows="5"></textarea>
                            </div>
                            <div class="form-group">
							<input type="reset" class="resetform">
                              <button type="submit" class="btn btn-primary form-submit">SUBMIT YOUR QUERY</button>
                            </div>
                          </form>
                        </div>
                        <div class="form-trainer-management" id="B" style="display: none;">
                          <form class="form-horizontal">
                            <div class="form-group">
                              <input type="text" class="form-control form-student" placeholder="Phone No.*" required>
                            </div>
                            <div class="form-group">
                              <input type="email" class="form-control form-student" placeholder="E-mail Address*" required>
                            </div>
                            <div class="form-group">
                              <textarea class="form-control form-student" placeholder="Type your query here" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                              <button class="btn btn-primary form-submit">SUBMIT YOUR QUERY</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="refer-earn batches query1">
                      <div class="refer-earn-heading1 query-heading1">
                        <h4>Refer and Earn</h4>
                         </div>
                      <div class="refer-earn-data">
                        <div class="refer-earn-data-subheading">
                          <p class="blue">Refer A Friend, Get ₹ <span class="yellow">1000!</span></p>
                        </div>
                        <div class="refer-earn-img">
                          <img src="{{asset('genie/build/images/refer-earn.png')}}">
                        </div>
                      <div class="refer-earn-process">
                        <p>
                          <span>Invite Your <br><strong class="blue">Friend</strong></span>
                          <span class="blue">+</span>
                          <span>Your Friends <br><strong class="blue">Make A Admission</strong></span>
                          <span class="blue">=</span>
                          <span>You Earn <br><strong><span class="blue">₹</span><span class="yellow">1000</span></strong></span>
                        </p>
                      </div>
                      <button class="btn btn-primary form-submit" data-toggle="modal" data-target="#referand_earn">GET REFER NOW</button>
                      </div>
                    </div>
        
                  </div>
           <div id="referand_earn" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title ">Refer and Earn </h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
		</div>
		<div class="modal-body">
		<div class="">				 

		<form class="form-horizontal" autocomplete="off" onsubmit="return studentsController.referEarnSave(this)">

		<div class="form-group">
		<div class="inner-addon left-addon">
		    		<i class="fa fa-user fa-lg"></i>

		<input type="text" class="form-control" name="name" value="<?php echo $students[0]->name; ?>" placeholder="Enter Name*" readonly>
		</div>
		</div>
		<div class="form-group">
		    <div class="inner-addon left-addon">
<i class="fa fa-phone" aria-hidden="true"></i>
		 
		<input type="text" class="form-control" name="mobile" value="<?php echo $students[0]->phone; ?>" placeholder="Enter Mobile*" readonly>
		</div>
		</div>
		
		<div class="form-group">
		  <div class="inner-addon left-addon">
		<i class="fa fa-user fa-lg"></i>
		<input type="text" class="form-control" name="refer_name" placeholder="Enter Refer Name*" >
		</div>
		</div>
		<div class="form-group">
		    <div class="inner-addon left-addon">
<i class="fa fa-phone" aria-hidden="true"></i>
		<input type="tel" class="form-control" name="refer_mobile" maxlength="16" onkeypress="return isNumberKey(event);" placeholder="Enter Refer Mobile*" >
		</div>
		</div>
		<div class="form-group">
		<textarea class="form-control" name="message" placeholder="Type your query here" rows="3"></textarea>
		</div>
		<div class="inner-addon left-addon">
		<div class="form-group mb-0">
		<input type="reset" class="resetform">
		<button type="submit" class="btn btn-primary form-submit">GET REFER NOW</button>
		</div>
		</div>
		</form>
		</div></div></div></div></div> 