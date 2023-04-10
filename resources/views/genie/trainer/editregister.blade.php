 @extends('genie.layouts.app')
 @section('title')
    Edit Register  
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
                            <h6>User Register</h6>
                            
                        </div>
						<form action="{{url('genie/users/edit/'.$edit_data->id)}}" method="post" class="">
						{{csrf_field()}}   
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Name</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="name" value="{{ old('name',(isset($edit_data)) ? $edit_data->name:"")}}" placeholder="Enter Name">
										@if ($errors->has('name'))
											<small class="error">{{ $errors->first('name') }}</small>
											@endif
                                    </div>
                                </div>
                            </div>  

							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Email</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="email" value="{{ old('email',(isset($edit_data)) ? $edit_data->email:"")}}" placeholder="Enter Email">
										@if ($errors->has('email'))
											<small class="error">{{ $errors->first('email') }}</small>
											@endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Password</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="password" class="form-control" name="password" value="{{ old('password')}}"  placeholder="Enter Password">
										@if ($errors->has('password'))
											<small class="error">{{ $errors->first('password') }}</small>
											@endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Confirm Password</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="password" class="form-control" name="confirmed" value="{{ old('confirmed')}}"  placeholder="Emter Confirm Password">
										@if ($errors->has('confirmed'))
											<small class="error">{{ $errors->first('confirmed') }}</small>
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