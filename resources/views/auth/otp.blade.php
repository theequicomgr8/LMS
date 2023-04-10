<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mobile OTP</title>

    <!-- Bootstrap -->
    <link href="{{asset('genie/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('genie/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('genie/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('genie/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('genie/build/css/custom.min.css')}}" rel="stylesheet">
		<style>
	.error{
		color:red;
	}
	</style>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          <form action="{{ url('login/otp') }}" method="POST">
              <h1>Mobile OTP</h1>
				<div class="row">
				<div class="col-md-12 col-md-offset-1">
				<div class="input-group col-md-10">
				{{csrf_field()}}   
				<input type="text" class="form-control" name="otp" placeholder="Enter OTP">
				@if ($errors->has('otp'))
				<span class="help-block">
				<strong class="error">{{ $errors->first('otp') }}</strong>
				</span>
				@endif
				</div>
				</div>
				</div>              
              <div>                 
				<button class="btn btn-success notika-btn-success waves-effect" name="submit" >Submit</button>                 
              </div>   
             
            </form>
          </section>
        </div>        
      </div>
    </div>
  </body>
</html>
