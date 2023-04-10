@extends('genie.layouts.app')
@section('title')
     Course Offer
@endsection
@section('content')	
        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-9">
                <div class="batches">
                  <div class="batches-heading">
                    <h4>COURSES OFFER</h4>
                    
                  </div>
                  <div class="batches-sections">
                    <div class="batches-status">
                      <div class="batches-status-heading">
                        <p class="strong-heading">Course Name</p>
                        <span>:</span>
                        <p>Python Learning Training</p>
                      </div>   
                      <div class="batches-status-heading">
                        <p class="strong-heading">Start/End Date</p>
                        <span>:</span>
                        <p>1st-Feb-2020,5th-Feb-2020</p>
                      </div> 
                      <div class="batches-status-heading">
                        <p class="strong-heading">Duration</p>
                        <span>:</span>
                        <p>1 Month (30 Days) (48Hrs.)</p>
                      </div>   
                      <div class="batches-status-heading">
                        <p class="strong-heading">Amount</p>
                        <span>:</span>
                        <p><strong><i class="fa fa-rupee"></i>18,600</strong> <del><i class="fa fa-rupee"></i>30,500</del></p>
                      </div> 
                      <div class="batches-status-heading">
                        <p class="strong-heading">Fee Status</p>
                        <span>:</span>
                        <p> <span class="bg-yellow" style="padding: 9px;color: #000;font-weight: 600;">NO DUES</span></p>
                      </div>   
                      <div class="batches-status-heading">
                        <p class="strong-heading">Payment</p>
                        <span>:</span>
                        <p><span class="bg-green" style="padding: 9px;color: #000;font-weight: 600; color: #fff;">PAYED</span></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="batches">
                  <div class="batches-sections">
                    <div class="batches-status">
                      <div class="batches-status-heading">
                        <p class="strong-heading">Course Name</p>
                        <span>:</span>
                        <p>Python Learning Training</p>
                      </div>   
                      <div class="batches-status-heading">
                        <p class="strong-heading">Start/End Date</p>
                        <span>:</span>
                        <p>1st-Feb-2020,5th-Feb-2020</p>
                      </div> 
                      <div class="batches-status-heading">
                        <p class="strong-heading">Duration</p>
                        <span>:</span>
                        <p>1 Month (30 Days) (48Hrs.)</p>
                      </div>   
                      <div class="batches-status-heading">
                        <p class="strong-heading">Amount</p>
                        <span>:</span>
                        <p><strong><i class="fa fa-rupee"></i>18,600</strong> <del><i class="fa fa-rupee"></i>30,500</del></p>
                      </div> 
                      <div class="batches-status-heading">
                        <p class="strong-heading">Fee Status</p>
                        <span>:</span>
                        <p> <span class="bg-cyan" style="padding: 9px;color: #000;font-weight: 600;color: #fff;">Discount on Call</span></p>
                      </div>   
                      <div class="batches-status-heading">
                        <p class="strong-heading">Payment</p>
                        <span>:</span>
                        <p class="discount-present">
                          <span class="yellow" style="font-weight: 800;margin-right: 15px;">15% OFF</span>
                          <span class="bg-blue" style="padding: 9px;color: #000;font-weight: 600; color: #fff;">USE CODE 15C</span>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="asking-button">
                  <button class="bg-green">ENROLL NOW</button>
                  <button class="bg-blue">REQUEST CALL</button>
                  <button class="bg-yellow" style="border:none;color: #fff;">DEMO CLASS</button>
                </div>
              </div>
				  <div class="col-md-3">
                    <div class="query">
                      <div class="query-heading">
                        <i class="fa fa-phone-square"></i>
                        <h4>Adviser is just a call away</h4>
                        
                      </div>
                      
                      <div class="form-selection">
                          <p><i class="fa fa-phone" aria-hidden="true"></i> +91 99999 99999, <span class="ml-1"> 0120-4455-455</span></p>
                        <h5>Drop us a Query</h5>                     
                        <div class="radio radio-selection">
                          <label>
                            <input type="radio" class="flat" checked name="Trainer"  onchange="hideB(this)"> To Your Trainer
                          </label>
                          <label>
                            <input type="radio" class="flat" name="Trainer" onchange="hideA(this)"> To Management
                          </label>
                        </div>
                        <div class="form-trainer-management" id="A">
                          <form class="form-horizontal">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Mobile No*" required>
                            </div>
                            <div class="form-group">
                              <input type="email" class="form-control" placeholder="E-mail Address*" required>
                            </div>
                            <div class="form-group">
                              <textarea class="form-control" placeholder="Type your query here" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                              <button class="btn btn-primary form-submit">SUBMIT YOUR QUERY</button>
                            </div>
                          </form>
                        </div>
                        <div class="form-trainer-management" id="B" style="display: none;">
                          <form class="form-horizontal">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Phone No.*" required>
                            </div>
                            <div class="form-group">
                              <input type="email" class="form-control" placeholder="E-mail Address*" required>
                            </div>
                            <div class="form-group">
                              <textarea class="form-control" placeholder="Type your query here" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                              <button class="btn btn-primary form-submit">SUBMIT YOUR QUERY</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="refer-earn">
                      <div class="refer-earn-heading">
		                            <img src="{{asset('genie/build/images/referandearn.png')}}">
                        <h5>Refer and Earn</h5>
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
                      <button class="btn btn-primary form-submit">GET REFER NOW</button>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
          
         
      
	@endsection