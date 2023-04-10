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
					<style>
				.button-rating{
				    margin: 2px 18px;
    border: 1px solid #c5c5c5;
    background: #fff;
    margin-right: 5px;
				}
					</style><?php $FB_1 = explode(',',$students->FB_1); 
					//echo "<pre>";print_r($FB_1);
					?>
                          <div class="feedback-sections-question">
                            <ul>
                              <li>
                                <span>1. Trainer encouraged active participation</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="hidden" name="std_id" value="<?php echo(isset($students->std_id)?$students->std_id:""); ?>"><input type="radio" name="participation" class="button-rating" value="5" <?php echo ((isset($FB_1[0]) && $FB_1[0]==5)? "checked":"") ?>>5
                                    <input type="radio" name="participation" class="button-rating" value="4" <?php echo ((isset($FB_1[0]) && $FB_1[0]==4)? "checked":"") ?>>4
                                    <input type="radio" name="participation" class="button-rating" value="3" <?php echo ((isset($FB_1[0]) && $FB_1[0]==3)? "checked":"") ?>>3
                                    <input type="radio" name="participation" class="button-rating" value="2" <?php echo ((isset($FB_1[0]) && $FB_1[0]==2)? "checked":"") ?>>2
                                    <input type="radio" name="participation" class="button-rating" value="1" <?php echo ((isset($FB_1[0]) && $FB_1[0]==1)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Trainer’s Preparation/presentation of training</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="preparation" class="button-rating" value="5" <?php echo ((isset($FB_1[1]) && $FB_1[1]==5)? "checked":"") ?>>5
                                    <input type="radio" name="preparation" class="button-rating" value="4" <?php echo ((isset($FB_1[1]) && $FB_1[1]==4)? "checked":"") ?>>4
                                    <input type="radio" name="preparation" class="button-rating" value="3" <?php echo ((isset($FB_1[1]) && $FB_1[1]==3)? "checked":"") ?>>3
                                    <input type="radio" name="preparation" class="button-rating" value="2" <?php echo ((isset($FB_1[1]) && $FB_1[1]==2)? "checked":"") ?>>2
                                    <input type="radio" name="preparation" class="button-rating" value="1" <?php echo ((isset($FB_1[1]) && $FB_1[1]==1)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Trainer’s Knowledge on the technology</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="technology" class="button-rating" value="5" <?php echo ((isset($FB_1[2]) && $FB_1[2]==5)? "checked":"") ?>>5
                                    <input type="radio" name="technology" class="button-rating" value="4" <?php echo ((isset($FB_1[2]) && $FB_1[2]==4)? "checked":"") ?>>4
                                    <input type="radio" name="technology" class="button-rating" value="3" <?php echo ((isset($FB_1[2]) && $FB_1[2]==3)? "checked":"") ?>>3
                                    <input type="radio" name="technology" class="button-rating" value="2" <?php echo ((isset($FB_1[2]) && $FB_1[2]==2)? "checked":"") ?>>2
                                    <input type="radio" name="technology" class="button-rating" value="1" <?php echo ((isset($FB_1[2]) && $FB_1[2]==1)? "checked":"") ?>>1
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
                                    <input type="radio" name="session" class="button-rating" value="1" <?php echo ((isset($FB_1[3]) && $FB_1[3]==1)? "checked":"") ?>>YES
                                   <input type="radio" name="session" class="button-rating" value="0" <?php echo ((isset($FB_1[3]) && $FB_1[3]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Required software were available for the practical before training starts.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                   <input type="radio" name="software" class="button-rating" value="1" <?php echo ((isset($FB_1[4]) && $FB_1[4]==1)? "checked":"") ?>>YES
                                     <input type="radio" name="software" class="button-rating" value="0" <?php echo ((isset($FB_1[4]) && $FB_1[4]==0)? "checked":"") ?>>NO
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
                                    <input type="radio" name="feestructure" class="button-rating" value="1" <?php echo ((isset($FB_1[5]) && $FB_1[5]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="feestructure" class="button-rating" value="0" <?php echo ((isset($FB_1[5]) && $FB_1[5]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Is your counsellor providing you batch timing.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                   <input type="radio" name="batchtiming" class="button-rating" value="1" <?php echo ((isset($FB_1[6]) && $FB_1[6]==1)? "checked":"") ?>>YES 
                                    <input type="radio" name="batchtiming" class="button-rating" value="0" <?php echo ((isset($FB_1[6]) && $FB_1[6]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Is your counsellor solving your queries.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="queries" class="button-rating" value="1" <?php echo ((isset($FB_1[7]) && $FB_1[7]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="queries" class="button-rating" value="0" <?php echo ((isset($FB_1[7]) && $FB_1[7]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Does your counsellor provided you all information you wanted.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="information" class="button-rating" value="1"  <?php echo ((isset($FB_1[8]) && $FB_1[8]==1)? "checked":"") ?>>YES
                                   <input type="radio" name="information" class="button-rating" value="0" <?php echo ((isset($FB_1[8]) && $FB_1[8]==0)? "checked":"") ?>>NO
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
			<?php $FB_2 = explode(',',$students->FB_2); 
					//echo "<pre>";print_r($FB_1);
					?>
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
								  <input type="hidden" name="std_id" value="<?php echo(isset($students->std_id)?$students->std_id:""); ?>">
                                   <input type="radio" name="participation" value="5" class="button-rating" <?php echo ((isset($FB_2[0]) && $FB_2[0]==5)? "checked":"") ?>>5
                                   <input type="radio" name="participation" value="4" class="button-rating" <?php echo ((isset($FB_2[0]) && $FB_2[0]==4)? "checked":"") ?>>4
                                    <input type="radio" name="participation" value="3" class="button-rating" <?php echo ((isset($FB_2[0]) && $FB_2[0]==3)? "checked":"") ?>>3
                                    <input type="radio" name="participation" value="2" class="button-rating" <?php echo ((isset($FB_2[0]) && $FB_2[0]==2)? "checked":"") ?>>2
									<input type="radio" name="participation" value="1" class="button-rating" <?php echo ((isset($FB_2[0]) && $FB_2[0]==1)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Trainer’s Preparation/presentation of training</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="preparation" value="5" class="button-rating" <?php echo ((isset($FB_2[1]) && $FB_2[1]==5)? "checked":"") ?>>5
                                    <input type="radio" name="preparation" value="4" class="button-rating" <?php echo ((isset($FB_2[1]) && $FB_2[1]==5)? "checked":"") ?>>4
									<input type="radio" name="preparation" value="3" class="button-rating" <?php echo ((isset($FB_2[1]) && $FB_2[1]==5)? "checked":"") ?>>3
                                    <input type="radio" name="preparation" value="2" class="button-rating" <?php echo ((isset($FB_2[1]) && $FB_2[1]==5)? "checked":"") ?>>2
                                    <input type="radio" name="preparation" value="1" class="button-rating" <?php echo ((isset($FB_2[1]) && $FB_2[1]==5)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Trainer’s Knowledge on the technology</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="technology" value="5" class="button-rating" <?php echo ((isset($FB_2[2]) && $FB_2[2]==5)? "checked":"") ?>>5
									<input type="radio" name="technology" value="5" class="button-rating" <?php echo ((isset($FB_2[2]) && $FB_2[2]==4)? "checked":"") ?>>4
                                   <input type="radio" name="technology" value="5" class="button-rating" <?php echo ((isset($FB_2[2]) && $FB_2[2]==3)? "checked":"") ?>>3
                                    <input type="radio" name="technology" value="5" class="button-rating" <?php echo ((isset($FB_2[2]) && $FB_2[2]==2)? "checked":"") ?>>2
                                    <input type="radio" name="technology" value="5" class="button-rating" <?php echo ((isset($FB_2[2]) && $FB_2[2]==1)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Trainer’s ability to resolve queries</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="queries" value="5" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==5)? "checked":"") ?>>5
                                    <input type="radio" name="queries" value="4" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==4)? "checked":"") ?>>4
                                    <input type="radio" name="queries" value="3" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==3)? "checked":"") ?>>3
                                    <input type="radio" name="queries" value="2" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==2)? "checked":"") ?>>2
                                    <input type="radio" name="queries" value="1" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==1)? "checked":"") ?>>1
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
                                    <input type="radio" name="material" value="1" class="button-rating" <?php echo ((isset($FB_2[4]) && $FB_2[4]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="material" value="0" class="button-rating" <?php echo ((isset($FB_2[4]) && $FB_2[4]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. The training materials distributed is helpful</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                   <input type="radio" name="helpful" value="1" class="button-rating" <?php echo ((isset($FB_2[5]) && $FB_2[5]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="helpful" value="0" class="button-rating" <?php echo ((isset($FB_2[5]) && $FB_2[5]==1)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. The content is organized and easy to follow</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="organized" value="1" class="button-rating" <?php echo ((isset($FB_2[6]) && $FB_2[6]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="organized" value="0" class="button-rating" <?php echo ((isset($FB_2[6]) && $FB_2[6]==1)? "checked":"") ?>>NO
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
                                    <input type="radio" name="practical" value="1" class="button-rating" <?php echo ((isset($FB_2[6]) && $FB_2[6]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="practical" value="0" class="button-rating" <?php echo ((isset($FB_2[6]) && $FB_2[6]==1)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Course Status Has Trainer covered 50% of the curriculum</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="curriculum" value="1" class="button-rating" <?php echo ((isset($FB_2[7]) && $FB_2[7]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="curriculum" value="0" class="button-rating" <?php echo ((isset($FB_2[7]) && $FB_2[7]==1)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Is your counsellor solving your queries</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="solving" value="1" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="solving" value="0" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==1)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Does your counsellor provided you all information you wanted.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="information" value="1" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="information" value="0" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==1)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>5. Is Placement Cell interacting with you</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="interacting" value="1" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="interacting" value="0" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==1)? "checked":"") ?>>NO
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
                                    <input type="radio" name="rating2" value="5" class="button-rating">5
                                    <input type="radio" name="rating2" value="4" class="button-rating">4
									<input type="radio" name="rating2" value="3" class="button-rating">3
                                    <input type="radio" name="rating2" value="2" class="button-rating">2
                                    <input type="radio" name="rating2" value="1" class="button-rating">1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. The training materials distributed were helpful</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="rating2" value="5" class="button-rating">5
                                   <input type="radio" name="rating2" value="4" class="button-rating">4
                                   <input type="radio" name="rating2" value="3" class="button-rating">3
                                    <input type="radio" name="rating2" value="2" class="button-rating">2
                                    <input type="radio" name="rating2" value="1" class="button-rating">1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Trainer encouraged active participation</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="rating2" value="5" class="button-rating">5
                                    <input type="radio" name="rating2" value="4" class="button-rating">4
									<input type="radio" name="rating2" value="3" class="button-rating">3
                                    <input type="radio" name="rating2" value="2" class="button-rating">2
                                    <input type="radio" name="rating2" value="1" class="button-rating">1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Trainer’s ability to resolve queries</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                   <input type="radio" name="rating2" value="5" class="button-rating">5
                                    <input type="radio" name="rating2" value="4" class="button-rating">4
                                    <input type="radio" name="rating2" value="3" class="button-rating">3
                                    <input type="radio" name="rating2" value="2" class="button-rating">2
                                    <input type="radio" name="rating2" value="1" class="button-rating">1
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
                                    <input type="radio" name="rating2" value="1" class="button-rating">YES
                                    <input type="radio" name="rating2" value="0" class="button-rating">NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Does Trainer provided you Interview questions & tips</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="rating2" value="1" class="button-rating">YES
                                    <input type="radio" name="rating2" value="0" class="button-rating">NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. The time allotted for the training was sufficient.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="rating2" value="1" class="button-rating">YES
                                    <input type="radio" name="rating2" value="0" class="button-rating">NO
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
                                    <input type="radio" name="rating2" value="1" class="button-rating">YES
                                   <input type="radio" name="rating2" value="0" class="button-rating">NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Has Trainer covered 100% of the curriculum</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="rating2" value="1" class="button-rating">YES
                                    <input type="radio" name="rating2" value="0" class="button-rating">NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Has Placement cell gathered your educational/technical data</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="rating2" value="1" class="button-rating">YES
                                    <input type="radio" name="rating2" value="0" class="button-rating">NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Has you mockup interviews been conducted</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="rating2" value="1" class="button-rating">YES</button>
                                   <input type="radio" name="rating2" value="0" class="button-rating">NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>5. Is Placement Cell interacting with you</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="rating2" value="1" class="button-rating">YES
                                    <input type="radio" name="rating2" value="0" class="button-rating">NO 
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