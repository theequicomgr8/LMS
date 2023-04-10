 @extends('genie.layouts.app')
 @section('title')
     Register  
@endsection
@section('content')	
 
 
	<!-- Breadcomb area Start-->
 
	<!-- Breadcomb area End-->
    <!-- Form Element area Start-->
    <div class="form-element-area">
        <div class="container">
             <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list">
                        <div class="cmp-tb-hd">
                            <h2>User Register</h2>
                            
                        </div>
						<form action="{{url('genie/users/add')}}" method="post" class="">
						{{csrf_field()}}   
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>Name</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="name" value="{{ old('name')}}" placeholder="Enter Name">
										@if ($errors->has('name'))
											<small class="error">{{ $errors->first('name') }}</small>
											@endif
                                    </div>
                                </div>
                            </div>  

							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>Email</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="email" value="{{ old('email')}}" placeholder="Enter Email">
										@if ($errors->has('email'))
											<small class="error">{{ $errors->first('email') }}</small>
											@endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>Password</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="password" value="{{ old('password')}}"  placeholder="Enter Password">
										@if ($errors->has('password'))
											<small class="error">{{ $errors->first('password') }}</small>
											@endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>Confirm Password</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="confirmpassword" value="{{ old('confirmpassword')}}"  placeholder="Emter Confirm Password">
										@if ($errors->has('confirmpassword'))
											<small class="error">{{ $errors->first('confirmpassword') }}</small>
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