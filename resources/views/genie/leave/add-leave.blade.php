 @extends('genie.layouts.app')
 @section('title')
     Apply for Leave
@endsection
@section('content')	
 
   <div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-windows"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Apply for Leave</h2>
										<p>Welcome to <span class="bread-ntd">Apply for Leave</span></p>
											<div class="successmessage"></div>
											<div class="errormessage"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
 
	<!-- Breadcomb area End-->
    <!-- Form Element area Start-->
    <div class="form-element-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list">
                        						
						 
						<form onsubmit="return leaveController.applyleave(this)" autocomplete="off">
						{{csrf_field()}}   
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>Leaves you Have</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-form"></i>
                                    </div>
                                    <div class="nk-int-st">
											<?php  
											$total_leaves= $users->carry_forward_leaves+$users->current_leaves;

											//$balanceleaves= $total_leaves-$users->leaves_taken;
											if(!empty($total_leaves) && $total_leaves>0 ){
											$balance_leaves=$total_leaves;
											}else{
											$balance_leaves=0;
											}	
											?>
                                        <input type="text" class="form-control" name="leavesyouhave" value="<?php 	echo $balance_leaves; ?>" >
										 
                                    </div>
                                </div>
                            </div> 
								 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>Leave Day</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
                                    <div class="nk-int-st">
                                      	<select class="selectpicker bootstrap-select fm-cmp-mg" name="leave_day" id="leave_day" >
											<option value="">Select Leave Day</option>
											<option value="Half-Day Leave" @if ("Half-Day Leave"== old('leave_day'))
									selected="selected"	
									@endif >Half-Day Leave</option>
											<option value="Full-Day Leave" @if ("Full-Day Leave"== old('leave_day'))
									selected="selected"	
									 @endif >Full-Day Leave</option>
											</select>
										@if ($errors->has('leave_day'))
											<small class="error">{{ $errors->first('leave_day') }}</small>
											@endif
                                    </div>
                                </div>
                            </div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>Date Range select</h2>
                                </div>
                              
                                    <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                   <div class="form-ic-cmp">
                                        <i class="fa fa-calculator"></i>
                                    </div>
                                    <div class="input-daterange input-group" id="datepicker" style="margin-left: 36px;margin-top: -26px;">
                                        <input type="text" class="form-control" name="start_date" id="start_date" value="{{ old('start_date')}}" placeholder="Select Date" />
										@if ($errors->has('start_date'))
											<small class="error">{{ $errors->first('start_date') }}</small>
											@endif
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="form-control" name="end_date" value="{{ old('end_date')}}" id="end_date" placeholder="Select Date To" >
										@if ($errors->has('end_date'))
											<small class="error">{{ $errors->first('end_date') }}</small>
											@endif
                                    </div>
                                </div>
                                
                            </div> 
							
							<!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>Date From</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calculator"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control leavedatefrom" name="start_date" value="{{ old('start_date')}}" placeholder="Select Date">
										@if ($errors->has('start_date'))
											<small class="error">{{ $errors->first('start_date') }}</small>
											@endif
                                    </div>
                                </div>
                            </div>  
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>Date To</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calculator"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control leavedateto" name="end_date" value="{{ old('end_date')}}" placeholder="Select Date To">
										@if ($errors->has('end_date'))
											<small class="error">{{ $errors->first('end_date') }}</small>
											@endif
                                    </div>
                                </div>
                            </div>	-->						
						
                            </div>
							 <div class="row">
							 
							<!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>No. of Days</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calculator"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="noofdays" value="{{ old('noofdays')}}" placeholder="Enter No of Days">
										 
                                    </div>
                                </div>
                            </div>
                           
							
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>Paid Leaves</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="paidleaves" value="{{ old('paidleaves')}}"  placeholder="Paidleaves">
										@if ($errors->has('paidleaves'))
											<small class="error">{{ $errors->first('paidleaves') }}</small>
											@endif
                                    </div>
                                </div>
                            </div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>Leave without Pay</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="leavewithoutpay" value="{{ old('leavewithoutpay')}}"  placeholder="Leave without Pay">
										@if ($errors->has('LeavewithoutPay'))
											<small class="error">{{ $errors->first('LeavewithoutPay') }}</small>
											@endif
                                    </div>
                                </div>
                            </div>-->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>Reason</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="reason" value="{{ old('reason')}}"  placeholder="Enter reason">
										@if ($errors->has('reason'))
											<small class="error">{{ $errors->first('reason') }}</small>
											@endif
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="row">
						<button class="btn btn-success notika-btn-success waves-effect" name="submit" style="margin-left: 48%;">Submit</button>
						</div>
						
						</form>
                         </div>
                </div>
            </div>
            
			  </div>
    </div>
    <!-- Form Element area End-->
    
     @endsection