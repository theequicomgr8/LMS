 @extends('genie.layouts.app')
 @section('title')
    Students
@endsection
@section('content')	
  <div class="right_col" role="main">
          <div class="">
		  <div class="row">
              
              
             <style>
			 .dataTables_length{
				 float: left;
			 }
			 div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    float: right;
}
             </style>
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
				 
						
                    <h2>Students<small>List</small></h2>
                     
					 
                    <div class="clearfix"></div>
                  </div>
				  
					
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                  
					
                    <table id="datatable-students" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<form method="GET" action="" novalidate autocomplete="off">
					<!--<div class="form-group">
					<div class="col-md-3">
					<label>Source</label>
					<select class="form-control" name="search[source]">
					<option value="">-- SELECT SOURCE --</option>

					<option value="23" selected>Website</option>


					</select>
					</div>
					</div>-->


					<div class="keep-open btn-group open" title="Columns" style="float:right"><button type="button" aria-label="columns" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="glyphicon glyphicon-th icon-th"></i> <span class="caret"></span></button><ul class="dropdown-menu" role="menu" style="top: 28px;">
					<!--<?php if(!empty($arraystudent)){  foreach($arraystudent as $key=>$val){ ?>
					<li role="menuitem"><label style="display: block;padding: 3px 20px; clear: both; font-weight: normal;line-height: 1.428571429;">
					
					<input type="checkbox" id="check-columns" name="search[<?php echo $val; ?>]" data-field="<?php echo $val; ?>" value="<?php echo $key; ?>" checked="checked"> <?php echo $val; ?></label></li>
					
					
					<?php } } ?>-->

					<li role="menuitem"><label style="display: block;padding: 3px 20px; clear: both; font-weight: normal;line-height: 1.428571429;">					
					<input type="checkbox" id="check-columns" name="search[Id]" data-field="Id" value="0" checked="checked"> Id</label></li>
					
					<li role="menuitem"><label style="display: block;padding: 3px 20px; clear: both; font-weight: normal;line-height: 1.428571429;">					
					<input type="checkbox" id="check-columns" name="search[Name]" data-field="Id" value="1" checked="checked"> Name</label></li>
					
					<li role="menuitem"><label style="display: block;padding: 3px 20px; clear: both; font-weight: normal;line-height: 1.428571429;">					
					<input type="checkbox" id="check-columns" name="search[Email]" data-field="Email" value="2" checked="checked"> Email</label></li>
					
					<li role="menuitem"><label style="display: block;padding: 3px 20px; clear: both; font-weight: normal;line-height: 1.428571429;">					
					<input type="checkbox" id="check-columns" name="search[Phone]" data-field="Phone" value="3" checked="checked"> Phone</label></li>
					
					</ul></div>

					<!--<div class="form-group">
					<div class="col-md-3">
					<label></label>


					<button type="submit" class="btn btn-block btn-info">Filter</button>
					</div>
					</div>-->
					</form>
                      <thead>
                        <tr>
						 <!--  <?php if($arraystudent){  foreach($arraystudent as $key=>$val){ ?>
                          <th><?php echo $val; ?></th>
						   <?php } }?>-->
                          <th>Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Tiger</td>
                          <td>Nixon</td>
                          <td>System Architect</td>
                          <td>Edinburgh</td>
                          
                        </tr>
                        <tr>
                          <td>Garrett</td>
                          <td>Winters</td>
                          <td>Accountant</td>
                          <td>Tokyo</td>
                           
                        </tr>
                        <tr>
                          <td>Ashton</td>
                          <td>Cox</td>
                          <td>Junior Technical Author</td>
                          <td>San Francisco</td>
                          
                        </tr>
                        <tr>
                          <td>Cedric</td>
                          <td>Kelly</td>
                          <td>Senior Javascript Developer</td>
                          <td>Edinburgh</td>
                         
                        </tr>
                        <tr>
                          <td>Airi</td>
                          <td>Satou</td>
                          <td>Accountant</td>
                          <td>Tokyo</td>
                          
                        </tr>
                        <tr>
                          <td>Brielle</td>
                          <td>Williamson</td>
                          <td>Integration Specialist</td>
                          <td>New York</td>
                          
                        </tr>
                          
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
            </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
    @endsection