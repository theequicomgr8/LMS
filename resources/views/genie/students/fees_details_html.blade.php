@extends('genie.layouts.app')
 @section('title')
     Feed Back
@endsection
@section('content')	
           
         
      <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-9">
                <div class="fee">
                  <div class="fee-heading">
                    <h4>Fee Details</h4>
                    <a href="#0"><i class="fa fa-download"></i></a>
                  </div>
                  <div class="fee-sections">
                    <div class="fee-status">
                      <div class="fee-status-heading">
                        <p class="strong-heading">Course Name</p>
                        <span>:</span>
                        <p>Python Learning Training</p>
                      </div>   
                      <div class="fee-status-heading">
                        <p class="strong-heading">Last Fee Paid</p>
                        <span>:</span>
                        <p>01st-Feb-2020 <a href="#0" class="blue-color" style="font-size: 10px;">(View All Receipt)</a></p>
                      </div> 
                      <div class="fee-status-heading">
                        <p class="strong-heading">Total Fees</p>
                        <span>:</span>
                        <p>₹25,000</p>
                      </div>   
                      <div class="fee-status-heading">
                        <p class="strong-heading">Balance</p>
                        <span>:</span>
                        <p><span class="bg-yellow" style="padding: 9px;color: #000;font-weight: 600;">₹18,600</span></p>
                      </div> 
                      <div class="fee-status-heading">
                        <p class="strong-heading">Next Fee Date</p>
                        <span>:</span>
                        <p>21st-Feb-2020</p>
                      </div>   
                      <div class="fee-status-heading">
                        <p class="strong-heading">Payment</p>
                        <span>:</span>
                        <p><span class="bg-red" style="padding: 9px;color: #fff;font-weight: 600;">PENDING</span></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="fee">
                  <div class="fee-heading">
                    <h4>Fee Details</h4>
                    <a href="#0"><i class="fa fa-download"></i></a>
                  </div>
                  <div class="fee-sections">
                    <div class="fee-status">
                      <div class="fee-status-heading">
                        <p class="strong-heading">Course Name</p>
                        <span>:</span>
                        <p>Python Learning Training</p>
                      </div>   
                      <div class="fee-status-heading">
                        <p class="strong-heading">Last Fee Paid</p>
                        <span>:</span>
                        <p>01st-Feb-2020 <a href="#0" class="blue-color" style="font-size: 10px;">(View All Receipt)</a></p>
                      </div> 
                      <div class="fee-status-heading">
                        <p class="strong-heading">Total Fees</p>
                        <span>:</span>
                        <p>₹25,000</p>
                      </div>   
                      <div class="fee-status-heading">
                        <p class="strong-heading">Balance</p>
                        <span>:</span>
                        <p><span class="bg-yellow" style="padding: 9px;color: #000;font-weight: 600;">₹0</span></p>
                      </div> 
                      <div class="fee-status-heading">
                        <p class="strong-heading">Next Fee Date</p>
                        <span>:</span>
                        <p>21st-Feb-2020</p>
                      </div>   
                      <div class="fee-status-heading">
                        <p class="strong-heading">Payment</p>
                        <span>:</span>
                        <p><span class="bg-green" style="padding: 9px;color: #fff;font-weight: 600;">NO DUE</span></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                  <div class="col-md-3">
                    <div class="query">
                      <div class="query-heading">
                        <i class="fa fa-phone-square"></i>
                        <p>Our advise is just a call away <br> +91 99999 99999,0120-4455-455</p>
                      </div>
                      <div class="form-selection">
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