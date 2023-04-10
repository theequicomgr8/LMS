<!DOCTYPE html>
<?php 

//$con = mysqli_connect('103.53.40.64','cromag8l_fees','cromag8l_fees@23#','cromag8l_fees'); 
$con = mysqli_connect('localhost','learnvps_fees','learnvps_fees','learnvps_fees'); 
?>
<html lang="en">
<head>
    	
	<meta charset="utf-8" >
	<meta name="viewport" content="width=device-width, initial-scale= 1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Croma Campus</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('logo/lms.jpeg')}}">
	<!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<!--<link rel="stylesheet" type="text/css" href="{{asset('login/css/bootstrap.min.css')}}">-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/css/style.css')}}">
 	<link rel="stylesheet" type="text/css" href="{{asset('login/css/bootstrap.min.css')}}">

 
	<style>

	#exampleModalLabel
	{
	    color:#000;
	}
.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #042521;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgb(0 123 255 / 25%);
}
	.modal-header button span
	{
position: absolute;
    top: 5px;
    right: 14px;
    background-color: #ddd;
    height: 28px;
    width: 26px;
    border-radius: 50%;
    line-height: 21px;
    font-size: 25px;
    color: #000;
    opacity: 9;
    font-weight: 700;
    text-align: center;
	}
	.btn-stick-submit{
	    background-color: #042521;
    color: #fff;
    padding: 4px 15px 7px;
	}
		.btn-stick-submit:hover {
    color: #212529;
    color: #fff;
}
	.inner-addon {
    position: relative;
}
.form-group .inner-addon .form-control {
    padding: 6px 50px;
  
    font-size: 14px;
    color: #444;
}
button:focus, input:focus, input:focus, textarea, textarea:focus,select.form-control {
    outline: 0 !important;
    box-shadow: none !important;
}
.form-group .left-addon .fa {
    left: 0;
        border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}
.form-group .inner-addon .fa {
       padding: 12px;
    position: absolute;
    text-align: center;
    z-index: 10;
    font-size: 15px;
}
.inner-addon i {
    color: #fff;
    background: #042521;
    width: 40px;
}
.modal-header
{
    padding: 6px 31px 11px;
}
.whatsappme {
  position: fixed;
  z-index: 400;
  right: 20px;
  bottom: 20px;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  font-size: 16px;
  line-height: 26px;
  color: #262626;
  transform: scale3d(0, 0, 0);
  transition: transform .3s ease-in-out;
  user-select: none;
  -ms-user-select: none;
  -moz-user-select: none;
  -webkit-user-select: none;
}

.whatsappme--show {
  transform: scale3d(1, 1, 1);
  transition: transform .5s cubic-bezier(0.18, 0.89, 0.32, 1.28);
}

.whatsappme__button {
  position: absolute;
  z-index: 2;
  bottom:20px;
  right: 8px;
  height: 60px;
  min-width: 60px;
  max-width: 95vw;
  background-color: #25D366;
  color: #fff;
  border-radius: 30px;
  box-shadow: 1px 6px 24px 0 rgba(7, 94, 84, .24);
  cursor: pointer;
  transition: background-color 0.2s linear;
}

.whatsappme__button:hover {
  background-color: #128C7E;
  transition: background-color 1.5s linear;
}

.whatsappme--dialog .whatsappme__button {
  transition: background-color 0.2s linear;
}

.whatsappme__button:active {
  background-color: #075E54;
  transition: none;
}

.whatsappme__button svg {
  width: 36px;
  height: 60px;
  margin: 0 12px;
}

.whatsappme__badge {
  position: absolute;
  top: -4px;
  right: -4px;
  width: 20px;
  height: 20px;
  border: none;
  border-radius: 50%;
  background: #e82c0c;
  font-size: 12px;
  font-weight: 600;
  line-height: 20px;
  text-align: center;
  box-shadow: none;
  opacity: 0;
  pointer-events: none;
}

.whatsappme__badge.whatsappme__badge--in {
  animation: badge--in 500ms cubic-bezier(0.27, 0.9, 0.41, 1.28) 1 both;
}

.whatsappme__badge.whatsappme__badge--out {
  animation: badge--out 400ms cubic-bezier(0.215, 0.61, 0.355, 1) 1 both;
}

.whatsappme--dialog .whatsappme__button {
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.3);
}

.whatsappme__box {
  position: absolute;
  bottom: 0;
  right: 0;
  z-index: 1;
  width: calc(100vw - 40px);
  max-width: 400px;
  min-height: 280px;
  padding-bottom: 60px;
  border-radius: 32px;
  background: #ede4dd url(../img/background-whatapp.png) center repeat-y;
  background-size: 100% auto;
  box-shadow: 0 2px 6px 0 rgba(0, 0, 0, .5);
  overflow: hidden;
  transform: scale3d(0, 0, 0);
  opacity: 0;
  transition: opacity 400ms ease-out, transform 0ms linear 300ms;
}

.whatsappme--dialog .whatsappme__box {
  opacity: 1;
  transform: scale3d(1, 1, 1);
  transition: opacity 200ms ease-out, transform 0ms linear;
}

.whatsappme__header {
  display: block;
  position: static;
  width: 100%;
  height: 70px;
  padding: 0 26px;
  margin: 0;
  background-color: #2e8c7d;
  color: rgba(255, 255, 255, .5);
}

.whatsappme__header svg {
  height: 100%;
}

.whatsappme__close {
  position: absolute;
  top: 18px;
  right: 24px;
  width: 34px;
  height: 34px;
  border-radius: 50%;
  background: #000;
  color: #fff;
  line-height: 34px;
  font-size: 25px;
  text-align: center;
  opacity: .4;
  cursor: pointer;
  transition: opacity 300ms ease-out;
}

.whatsappme__close:hover {
  opacity: .6;
}

.whatsappme__message {
  position: relative;
  min-height: 80px;
  padding: 20px 22px;
  margin: 34px 26px;
  border-radius: 32px;
  background-color: #fff;
  color: #4A4A4A;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.3);
}

.whatsappme__message:before {
  content: '';
  display: block;
  position: absolute;
  bottom: 30px;
  left: -18px;
  width: 18px;
  height: 18px;
  background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADcAAAA1CAYAAADlE3NNAAAEr0lEQVRo3t2aT0gjVxzHf++9mcn8zWhW6bpELWzcogFNaRar7a4tBNy2WATbHpacpdZ6redeZE+9CL02B1ktXsRD/xwsilhoSwsqag/xYK09hCQlmCiTf28vGRnGmZhE183MFx5vmGQy7zO/P/P7PYLAHUIAQCqDAwDPxMREG3IpHL+zs/MZcgkYAgAMAIwOl8lkYm6xGgYAFgAEAGgZHx9/vVwun7nJJTkAEAGgdW9v73NKKXWLSzIA4AEAGQDazs/P/3ALnNEl1a2trY9oRW6wmu6SEgC0ZrPZn9wCp2dIHgCU1dXVtymlZafDIatEksvlfqYGueG9xgOAcnBw8JSa5GR3vIi1aDTaUSwWj5wOZ3RHPUN6U6nUN9RCTnZHDwDI+/v745TSkpPhrOpHcWlpqbdcLieojZwGpseZMDo66svn87/RKnIaGAsAfCAQ8J6dnX1Pr5DjwABAzmazMVqDHAd2enr6La1RjgGLRCJqLpeL0TrUjFDGrMgCAD8/P38vn8//QutUs1pLT/fC5ubmQKFQOKANqNmspbuhBwDEZDL5BaX0lDaoZoK62NxZXFzs1DRthV5TrxrKGFue/v5+KZ1Of1kul5P0BtQUUAAgxOPx9wuFwl/0BvWq3O8C6vDw8F1N036gL0G3ZaVLUEdHRxFN036kL1E3DWMHxAEAPzc3dyedTk+XSqUdegu6CRijy5mBPLOzs2oikfhU07RFSmmG3qKuaxkdxuhy/MzMjDeRSHyiadrz2wYyClUBMh9bzRfAu7u7PX6//z1RFB9zHBcBALUZKoRqUMgEgyvHeHt7+353d/cjQRBGWJZ9jBDqaMYKHKpYBAEAXltbawsGg2FFUd7iOO4hIeQhQuiOEzpdOzCSTCaftLS0fEUIGXbiHiBjU5njVCr1sc/nW6wkDcduS1u1HKRUKv2KMR4ABwvbAWKMA+BwYbsasFgs/uMWuEtxd3x8/J3b4C4Ag8Hg83g8/iyfz//n5IRi1eZzla00HgA8oijyDMNwlFJCCGH0axiGQQAAXq+XyLLMeL1eRlEURpZlRpIkhud5oigK297eLvl8Prm1tVVSFEWSJEkWRVESBMGrqupriqLcFQThLsaYu612n6vUip4KMFv5HJssjhooEi5laoZh0NjYWNvw8PC9np6ejkAg8MDv9w+oqnrfxsNqhgNTh2wE1MGYChyyWGA9RYJVFWTM3MhwjMPhsDw9PT0QDocHOjs731RV9Y1rv+cMlb4Oiy3garWW1b2sPMfceZgHmZqa6pycnPywr6/vA47jfPXAWbU0xOCOqE44u2K8Wl9oBUfMa+rq6hIWFhbGBwcHn9pBohogcRWwRiCRTUiACQ6ZYpxY9JAkFAopy8vLM4FAYKyRrgA1GGf1JperLGgEM4cNG4vF3olGo18TQkT9JsRmAdQw66NsGlbn7Ibdd0um2XzOblz6/ZWVlX8JIb8PDQ090gFJDU+e2sBeZ1hBU9NcqvIQzDMFALq+vp7GGP85MjLyBCHE1tPO1LP4eq4FG/hqnlGyeSiwsbHxfygUOu7t7Y00059JUY3ZHFm8k1lT0cGfnJw8c0ojepWFzd6CMpnM3y8AJPEkZ9khO4IAAAAASUVORK5CYII=');
  background-size: 100%;
}

/* Align left */

.whatsappme--left {
  right: auto;
  left: 20px;
}

.whatsappme--left .whatsappme__button {
  right: auto;
  left: 8px;
}

.whatsappme--left .whatsappme__box {
  right: auto;
  left: 0;
}

@media (max-width: 480px) {
  .whatsappme {
    bottom: 6px;
    right: 6px;
  }

  .whatsappme--left {
    right: auto;
    left: 6px;
  }

  .whatsappme__box {
    width: calc(100vw - 12px);
    min-height: 0;
  }

  .whatsappme__header {
    height: 55px;
  }

  .whatsappme__close {
    top: 13px;
    width: 28px;
    height: 28px;
    line-height: 28px;
  }

  .whatsappme__message {
    padding: 14px 20px;
    margin: 15px 21px 20px;
    line-height: 24px;
  }
  .whatsappme__button {
  
  bottom:50px;
  
}
}

@keyframes badge--in {
  from {
    opacity: 0;
    transform: translateY(50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes badge--out {
  0% {
    opacity: 1;
    transform: translateY(0);
  }
  100% {
    opacity: 0;
    transform: translateY(-20px);
  }
}
		.select2-dropdown {
    font-size: 15px;
    width: 200px !important;
    z-index: 1051;
    color:#000 !important;
    font-weight:500 !important;
}
	.error {
        color: red;
        font-size: 14px;
        font-weight: 400;    line-height: 35px;
    }
    .newmob{
        position:relative;
    }
    .newmobsection p{
        position:absolute;
        top:30px;
    }
    .newmob label{
        margin:0;
        pointer-events: none;
        position:absolute;
        color: #50d6d3;
        font-size: 15px;
        top:-22px;
        font-weight: 400;
    }
    .class-label{
        animation-name: levelup;
        top:-25px;
        animation-duration: 800ms;
        font-size: 15px !important;
        font-weight: 300;
    }
    @keyframes  levelup{
        from{top:0px; font-size:16px;}
        to{top:-25px; font-size:14px;}
    }
    .newmob {
        width: 320px;
        margin: auto;
    }
    .newmobsection input{
        padding: 0px 0px 4px;
    }
    @media (max-width:440px){
        .newmobsection input{
            width:100%;
                border-radius: 0px!important;

        }
        .newmob{
            width:100%;
        }
	</style>
	<style>
	
.country_code{
display:flex;
flex-wrap: wrap;
}
#count_code
{
width:58%;
}
 
.select2-container .select2-selection--single {				 
height: 33px !important;

}
.select2-container--default .select2-selection--single .select2-selection__rendered {
line-height: 30px !important;
}
.select2-container--default .select2-selection--single{
	    border: 0px !important;
	background: transparent !important;
    border-bottom: 1px solid #50d6d3 !important;
	border-radius:0px !important;
	 	
	}
.select2-container--default .select2-selection--single .select2-selection__rendered{
	
	color:#fff !important;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 0px !important;
   
}
.bottom-fixed-links .fixed a {
    color: #fff;
    font-size: 16px;
    padding: 8px 11px 9px;
    text-decoration: none;
}

.bottom-fixed {
    padding: 6px;
    background: #3A3A3A;
    z-index: 1;
    width: 100%;
    position: fixed;
    bottom: 0;
}
.fixed a:hover
{
 color: #fff !important;

}
.bottom-fixed-links:hover
{
cursor:pointer;
}
/*.bottom-fixed-links .fixed a {*/
/*    background: #F8981D;*/
/*}*/
.fixed a span
{
    margin-left:0px;
}
.bottom-fixed-links {
    display: flex;
    justify-content: center;
}
@media only screen and (max-width: 600px) {

    .bottom-fixed-links .fixed {
    margin-left: 0px;
}
}
</style>
</head>
<body>
    
	<div class="login-wrapper">		
		<div class="login-form-page">
			<div class="login-logo">
				<img src="{{asset('public/login/img/CC_Logo.png')}}">
			</div>
			<div class="login-heading">
				<h4>Login</h4>
			</div>
			<div class="login-form">
			 <form action="login/check" method="POST" autocomplete="off">
 					 {{csrf_field()}}   
			        <div class="newmob">
			        	<label class="addclass">Enter Mobile Number</label>
			        	<div class="newmobsection">
			        	  <?php 
					$countryquery= "Select * from croma_country";
					$resultcountry = mysqli_query($con,$countryquery);
					$geodata = json_decode(file_get_contents("http://ipinfo.io/".$_SERVER['REMOTE_ADDR']));
				//	echo "<pre>";print_r($resultcountry);
					?>
					<select type="text" class="form-control" id="count_code" name="stud-code">
					<?php if(!empty($resultcountry)){ 
					while($country = mysqli_fetch_assoc($resultcountry)){				//	echo "<pre>";print_r($country);	
					?>
					<option value="<?php echo $country['phonecode']; ?>" <?php if($country['sortname']==$geodata->country){  echo "selected"; } ?>  ><?php echo '+'.$country['phonecode'].' '.$country['country_name'];  ?></option>
					<?php } } ?>
					</select>
							<input type="hidden" class="form-control" name="lgn" value="1">
				<input type="tel" class="newmobsection-input" name="mobile" maxlength="16">
				<p>@if ($errors->has('mobile'))
				<span class="help-block">
				<strong class="error">{{ $errors->first('mobile') }}</strong>
				</span>
				@endif
				</p>
			        	</div>
			        	
			        </div>
					<p style="margin: 13px 0;color: #FDCD00;"></p>
									 
<div class="login-button">
						<input type="submit"  name="submit" value="Login">
					</div>
				
					<span>Not A Member Yet ?</span>
					<p class="or">OR</p>
					<div class="form-social-img">
						<a href="#0"><img src="{{asset('public/login/img/Google-login-min.png')}}"></a>
						<a href="#0"><img src="{{asset('public/login/img/FB-min.png')}}"></a>
						<a href="#0"><img src="{{asset('public/login/img/Twitter-min.png')}}"></a>
					</div>
					<div class="terms-policy">
						<p>I accept Croma Campus <br> <a href="javascript:void(0);" >Terms of Use & Privacy Policy</a></p>
					</div>
				</form>
			</div>
		</div>
	</div>
<a class="whatsappme whatsappme--left whatsappme--show whatsappme--dialog" href="https://api.whatsapp.com/send?phone=917303191680" target="_blank">

            <div class="whatsappme__button">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" fill="currentColor"></path></svg>

            <div class="whatsappme__badge whatsappme__badge--in">1</div>        

            </div>                     

</a><section class="bottom-fixed" id="bottom-fixed">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="bottom-fixed-links">
					<div class="fixed">
							<a href="tel:+917303191680" target="_blank"><img src="https://cromacampus.com/public/img/call-back.png" alt="phone" >
<span>Get a Call Back</span></a>
						</a>
					</div>
					<div class="fixed ml-0">
<a href="https://api.whatsapp.com/send?phone=917303191680" target="_blank"><img src="https://cromacampus.com/public/img/whatsapp-color.png" alt="whatsapp">
<span>7303191680</span></a>						</a>
					</div>
			
				
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Provide Your Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

                        <form action="" method="POST" id="iq_form" autocomplete="off">
                                    <div class="form-group">
									<div class="inner-addon left-addon">
										<i class="fa fa-user fa-lg"></i>
										<input type="text" class="form-control" name="iq_name" id="iq_name" placeholder="Enter Name">
                                    </div>
                                    </div>
                                    <div class="form-group">
									<div class="inner-addon left-addon">
									<i class="fa fa-envelope fa-lg"></i>
                                        <input type="email" class="form-control" name="iq_email" id="iq_email" placeholder="Enter Email">
                                    </div>
                                    </div>
									
									<div class="form-group"> 
									<div class="inner-addon left-addon">
									<i class="fa fa-phone fa-lg"></i>
									 <input type="email" class="form-control" name="iq_phone" id="iq_phone" placeholder="Enter Phone No.">

									</div>
									</div> 
                                     
									<div class="form-group">
										<div class="inner-addon left-addon">
											<i class="fa fa-book fa-lg"></i>
                                        <input type="text" class="form-control" name="iq_course" id="iq_course" placeholder="Enter Course">
										</div>
                                    </div>
									<div class="form-group">
										<div class="inner-addon left-addon">
										<i class="fa fa-paper-plane-o fa-lg"></i>
                                        <select class="form-control" name="iq_participant" tabindex="2">
										<option value="">Select</option>
										<option value="student">Student</option>
										<option value="trainer">Trainer</option>
									</select> 
                                    </div>
                                    </div>
								 
									<div class="form-group">
                                        <textarea class="form-control" name="iq_message" rows="3" placeholder="Enter your message"></textarea>
                                    </div>
												<input type="submit" class="btn btn-default btn-stick-submit btn-black" value="Send Enquiry">

                                </form>

      </div>
   
    </div>
  </div>
</div>

<div class="chat-box">
<!-- Zopim Chat --><!--<script type="text/javascript">
	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
	$.src="//v2.zopim.com/?3grBT0UDXL4x5sH8tHitYRAniYyjVCem";z.t=+new Date;$.
	type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
	</script>-->
	
	<script src="//code.jivosite.com/widget/qMVrmYre5T" async></script>
	</div>
	<script>
 
	
		$(document).on('keydown','input[name="mobile"]',function(e){
		 
			if($(this).val().length!=0 && e.keyCode==13){
				verifyDemo();
			}
			if($(this).val().length==0 && e.keyCode==13){
				event.preventDefault();
			}
			if($(this).val().length==0 && (e.keyCode == 48 || e.keyCode == 96)){
				e.preventDefault();
			}
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				 // Allow: Ctrl+A,Ctrl+C,Ctrl+V, Command+A
				((e.keyCode === 65 || e.keyCode === 86 || e.keyCode === 67) && (e.ctrlKey === true || e.metaKey === true)) || 
				 // Allow: home, end, left, right, down, up
				(e.keyCode >= 35 && e.keyCode <= 40)) {
					 // let it happen, don't do anything
					 return;
			}
			// Ensure that it is a number and stop the keypress
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});
	</script>
	
	<!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>-->
	 
	  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="genie/src/js/custom.js"></script>
	<script> 
	  $('#count_code').select2();
	    /*$(document).on('click','.newmobsection-input',function(){
	       
	       // var THIS = $(this);
	        $('.addclass').addClass('class-label');
	    });*/
	    
	    $('.newmobsection-input').on('click',function(){ 
	    
	     //   $('.addclass').addClass('class-label');
	        
	        
	        
	    });
	</script>

	 
</body>
</html>