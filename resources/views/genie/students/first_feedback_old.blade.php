 @extends('genie.layouts.app')
 @section('title')
     Feed Back
@endsection
@section('content')	
           
         
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>
			
		 
			
            <div class="row">
                  <div class="col-md-9">
				  <form action="" class="form-horizontal form-label-left" onsubmit="return studentsController.firstFeedBacksubmit(this)">
                    <div class="feedback">
                      <div class="first-feedback-heading">
                        <h4>First Feedback</h4>
                      </div>
                      <div class="feedback-sections">
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Trainer / Facilitator</h4>
                            <h4 class="hidden-mobile">Ratings</h4>
                          </div>
					
                          <div class="feedback-sections-question">
                            <ul>
                              <li>
                                <span>1. Trainer encouraged active participation</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin"><input type="hidden" name="std_id" value="<?php echo(isset($students->std_id)?$students->std_id:""); ?>"><input type="radio" name="rating1" value="5"></button>
                                    <button type="button" class="button-admin"><input type="radio" name="rating1" value="4"></button>
                                    <button type="button" class="button-admin"><input type="radio" name="rating1" value="3"></button>
                                    <button type="button" class="button-admin"><input type="radio" name="rating1" value="2"></button>
                                    <button type="button" class="button-admin"><input type="radio" name="rating1" value="1"></button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Trainer’s Preparation/presentation of training</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin"><input type="radio" name="rating2" value="5"></button>
                                    <button type="button" class="button-admin"><input type="radio" name="rating2" value="4"></button>
                                    <button type="button" class="button-admin"><input type="radio" name="rating2" value="3"></button>
                                    <button type="button" class="button-admin"><input type="radio" name="rating2" value="2"></button>
                                    <button type="button" class="button-admin"><input type="radio" name="rating2" value="1"></button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Trainer’s Knowledge on the technology</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin"><input type="radio" name="rating3" value="5"></button>
                                    <button type="button" class="button-admin"><input type="radio" name="rating3" value="4"></button>
                                    <button type="button" class="button-admin"><input type="radio" name="rating3" value="3"></button>
                                    <button type="button" class="button-admin"><input type="radio" name="rating3" value="2"></button>
                                    <button type="button" class="button-admin"><input type="radio" name="rating3" value="1"></button>
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
						  
						  
                        </div>
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Hands-On / Activities</h4>
                            <h4 class="hidden-mobile">Yes/No</h4>
                          </div>
                          <div class="feedback-sections-question">
                            <ul>
                              <li>
                                <span>1. Is Trainer taking 2 hours session</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES<input type="radio" name="rating4" value="1"></button>
                                    <button type="button" class="button-admin">NO<input type="radio" name="rating4" value="0"></button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Required software were available for the practical before training starts.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES <input type="radio" name="rating5" value="1"></button>
                                    <button type="button" class="button-admin">NO <input type="radio" name="rating5" value="1"></button>
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Education Counsellor</h4>
                            <h4 class="hidden-mobile">Yes/No</h4>
                          </div>
                          <div class="feedback-sections-question">
                            <ul>
                              <li>
                                <span>1. Has counsellor explained you about fee structure.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES<input type="radio" name="rating6" value="1"></button>
                                    <button type="button" class="button-admin">NO<input type="radio" name="rating6" value="0"></button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Is your counsellor providing you batch timing.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES<input type="radio" name="rating7" value="1"></button>
                                    <button type="button" class="button-admin">NO<input type="radio" name="rating7" value="0"></button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Is your counsellor solving your queries.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES<input type="radio" name="rating8" value="1"></button>
                                    <button type="button" class="button-admin">NO<input type="radio" name="rating8" value="0"></button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Does your counsellor provided you all information you wanted.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES<input type="radio" name="rating9" value="1"></button>
                                    <button type="button" class="button-admin">NO<input type="radio" name="rating9" value="0"></button>
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="feedback-submit">
                     <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="submit" class="btn btn-success" name="submit">SUBMIT</button>
                    </div>
					</form>
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
			
			<div class="row">
                  <div class="col-md-9">
				  <form action="" class="form-horizontal form-label-left" onsubmit="return studentsController.secondFeedBacksubmit(this)">
                    <div class="feedback">
                      <div class="first-feedback-heading">
                        <h4>Second Feedback</h4>
                      </div>
                      <div class="feedback-sections">
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Trainer / Facilitator</h4>
                            <h4 class="hidden-mobile">Ratings</h4>
                          </div>
                          <div class="feedback-sections-question">
                            <ul>
                              <li>
                                <span>1. Trainer encouraged active participation</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group"> 
                                   <button type="button" class="button-admin">5<input type="radio" name="rating1" value="5" class="button-admin"></button>
                                    <button type="button" class="button-admin">4<input type="radio" name="rating1" value="4" class="button-admin"></button>
                                    <button type="button" class="button-admin">3<input type="radio" name="rating1" value="3" class="button-admin"></button>
                                    <button type="button" class="button-admin">2<input type="radio" name="rating1" value="2" class="button-admin"></button>
                                    <button type="button" class="button-admin">1<input type="radio" name="rating1" value="1" class="button-admin"></button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Trainer’s Preparation/presentation of training</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">5<input type="radio" name="rating2" value="5" class="button-admin"></button>
                                    <button type="button" class="button-admin">4<input type="radio" name="rating2" value="4" class="button-admin"></button>
                                    <button type="button" class="button-admin">3<input type="radio" name="rating2" value="3" class="button-admin"></button>
                                    <button type="button" class="button-admin">2<input type="radio" name="rating2" value="2" class="button-admin"></button>
                                    <button type="button" class="button-admin">1<input type="radio" name="rating2" value="1" class="button-admin"></button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Trainer’s Knowledge on the technology</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">5</button>
                                    <button type="button" class="button-admin">4</button>
                                    <button type="button" class="button-admin">3</button>
                                    <button type="button" class="button-admin">2</button>
                                    <button type="button" class="button-admin">1</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Trainer’s ability to resolve queries</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">5</button>
                                    <button type="button" class="button-admin">4</button>
                                    <button type="button" class="button-admin">3</button>
                                    <button type="button" class="button-admin">2</button>
                                    <button type="button" class="button-admin">1</button>
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Content / Course Outline</h4>
                            <h4 class="hidden-mobile">Yes/No</h4>
                          </div>
                          <div class="feedback-sections-question">
                            <ul>
                              <li>
                                <span>1. Is Trainer sharing the notes/study material</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. The training materials distributed is helpful</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. The content is organized and easy to follow</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Counselling, Placement & Activities</h4>
                            <h4 class="hidden-mobile">Yes/No</h4>
                          </div>
                          <div class="feedback-sections-question">
                            <ul>
                              <li>
                                <span>1. Are you performing Practical/activities during training</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Course Status Has Trainer covered 50% of the curriculum</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Is your counsellor solving your queries</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Does your counsellor provided you all information you wanted.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>5. Is Placement Cell interacting with you</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="feedback-submit">
                      <button type="submit" class="btn btn-success" name="submit">SUBMIT</button>
                    </div>
					</form>
                  </div>
                  
            </div>
			<div class="row">
                  <div class="col-md-9">
				   <form action="" class="form-horizontal form-label-left" onsubmit="return studentsController.thirdFeedBacksubmit(this)">
                    <div class="feedback">
                      <div class="first-feedback-heading">
                        <h4>Third Feedback</h4>
                      </div>
                      <div class="feedback-sections">
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Trainer / Facilitator</h4>
                            <h4 class="hidden-mobile">Ratings</h4>
                          </div>
                          <div class="feedback-sections-question">
                            <ul>
                              <li>
                                <span>1. The training met your expectations</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">5</button>
                                    <button type="button" class="button-admin">4</button>
                                    <button type="button" class="button-admin">3</button>
                                    <button type="button" class="button-admin">2</button>
                                    <button type="button" class="button-admin">1</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. The training materials distributed were helpful</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">5</button>
                                    <button type="button" class="button-admin">4</button>
                                    <button type="button" class="button-admin">3</button>
                                    <button type="button" class="button-admin">2</button>
                                    <button type="button" class="button-admin">1</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Trainer encouraged active participation</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">5</button>
                                    <button type="button" class="button-admin">4</button>
                                    <button type="button" class="button-admin">3</button>
                                    <button type="button" class="button-admin">2</button>
                                    <button type="button" class="button-admin">1</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Trainer’s ability to resolve queries</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">5</button>
                                    <button type="button" class="button-admin">4</button>
                                    <button type="button" class="button-admin">3</button>
                                    <button type="button" class="button-admin">2</button>
                                    <button type="button" class="button-admin">1</button>
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Content / Course Outline</h4>
                            <h4 class="hidden-mobile">Yes/No</h4>
                          </div>
                          <div class="feedback-sections-question">
                            <ul>
                              <li>
                                <span>1. Does your Trainer helped you in resume designing</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Does Trainer provided you Interview questions & tips</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. The time allotted for the training was sufficient.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Counselling, Placement & Activities</h4>
                            <h4 class="hidden-mobile">Yes/No</h4>
                          </div>
                          <div class="feedback-sections-question">
                            <ul>
                              <li>
                                <span>1. Practical/activities performed were sufficient as per Course Content</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Has Trainer covered 100% of the curriculum</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Has Placement cell gathered your educational/technical data</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Has you mockup interviews been conducted</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>5. Is Placement Cell interacting with you</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="button-admin">YES</button>
                                    <button type="button" class="button-admin">NO</button>
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="feedback-submit">
                      <button type="button" class="btn btn-success">SUBMIT</button>
                    </div>
					</form>
                  </div>
                  
            </div>
          </div>
        </div>
		
		<script>
       function hideA(x) {
         if (x.checked) {
           document.getElementById("A").style.display = "none";
           document.getElementById("B").style.display = "block";
         }
       }

       function hideB(x) {
         if (x.checked) {
           document.getElementById("B").style.display = "none";
           document.getElementById("A").style.display = "block";
         }
       }
    </script>
	
	@endsection