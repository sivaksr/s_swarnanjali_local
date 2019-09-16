
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Add Students  
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Students</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
		<div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){ echo "active"; }?>"><a href="#tab_1" data-toggle="tab">Add Student</a></li>
              <li class="<?php if(isset($tab) && $tab==1){ echo "active"; }?>"><a href="#tab_2" data-toggle="tab"> Student List</a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane <?php if(isset($tab) && $tab==''){ echo "active"; }?>" id="tab_1">
              <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <form  onsubmit="return get_total_amt();" id="defaultForm" method="post" class="" action="<?php echo base_url('student/addpost'); ?>" enctype="multipart/form-data">
			
			<input type="hidden" name="role_id" id="role_id" value="7">
						<div class="col-md-6">
						<h3 class="box-title"> <i class="fa fa-info" aria-hidden="true"></i>&nbsp;Personal Details</h3>
					
						<div class="form-group">
                            <label class=" control-label">Name of the Student</label>
                            <div class="">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name of the Student" />
                            </div>
                        </div>
						
						
						
					<div class="form-group">
						<label>Date of Birth</label>

						<div class="input-group date">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						  <input type="text" class="form-control pull-right datechanges" id="datepicker" autocomplete="off" name="dob" placeholder="MM/DD/YYYY" />
						</div>
						
					  </div>
						
						<div class="form-group ">
							<label class=" control-label">Gender</label>
							<div class="row">
								<div class="radio col-md-2">
									<label>
										<input type="radio"  name="gender" value="Male" data-bv-field="gender"> Male
									</label>
								</div>
								<div class="radio col-md-2" style="margin-top:10px">
									<label>
										<input type="radio" name="gender" value="Female" data-bv-field="gender"> Female
									</label>
								</div>
								<i class="form-control-feedback" data-bv-icon-for="gender" style="display: none;"></i>
							</div>
							
						</div>
						<div class="form-group">
                            <label class=" control-label">Current Address</label>
                            <div class="">
                                <input type="text" class="form-control" name="current_address" id="current_address" placeholder="Enter Current Address" />
                            </div>
                        </div>
						
							<div class="row">
								<div class=" col-md-6">
									<div class="form-group">
										<div class="">
											<input type="text" class="form-control" name="current_city" id="current_city" placeholder="Enter City Name" />
										</div>
									</div>
								</div>
								<div class=" col-md-6">
									<div class="form-group">
										<div class="">
											<?php $states = array ('Andhra Pradesh' => 'Andhra Pradesh', 'Arunachal Pradesh' => 'Arunachal Pradesh', 'Assam' => 'Assam', 'Bihar' => 'Bihar', 'Chhattisgarh' => 'Chhattisgarh', 'Goa' => 'Goa', 'Gujarat' => 'Gujarat', 'Haryana' => 'Haryana', 'Himachal Pradesh' => 'Himachal Pradesh', 'Jammu & Kashmir' => 'Jammu & Kashmir', 'Jharkhand' => 'Jharkhand', 'Karnataka' => 'Karnataka', 'Kerala' => 'Kerala', 'Madhya Pradesh' => 'Madhya Pradesh', 'Maharashtra' => 'Maharashtra', 'Manipur' => 'Manipur', 'Meghalaya' => 'Meghalaya', 'Mizoram' => 'Mizoram', 'Nagaland' => 'Nagaland', 'Odisha' => 'Odisha', 'Punjab' => 'Punjab', 'Rajasthan' => 'Rajasthan', 'Sikkim' => 'Sikkim', 'Tamil Nadu' => 'Tamil Nadu', 'Telangana' => 'Telangana', 'Tripura' => 'Tripura', 'Uttarakhand' => 'Uttarakhand','Uttar Pradesh' => 'Uttar Pradesh', 'West Bengal' => 'West Bengal', 'Andaman & Nicobar' => 'Andaman & Nicobar', 'Chandigarh' => 'Chandigarh', 'Dadra and Nagar Haveli' => 'Dadra and Nagar Haveli', 'Daman & Diu' => 'Daman & Diu', 'Delhi' => 'Delhi', 'Lakshadweep' => 'Lakshadweep', 'Puducherry' => 'Puducherry'); ?>
												  <select class="form-control" name="current_state" id="current_state">
												  <option value = "">Select State</option>
													<?php foreach($states as $key=>$state):
															if(isset($hospital_details['current_state']) && $hospital_details['current_state'] == $state):
															$selected ='selected=selected';
															else : 
															$selected = '';
															endif;
														 ?>
														<option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
													<?php endforeach; ?>
												  </select>
										</div>
									</div>
								</div>
								<div class=" col-md-6">
									<div class="form-group">
										<div class="">
											<select class="form-control" name="current_country" id="current_country">
												<option value="">Select Country</option>
												<option value="India"> India</option>
											</select>
										</div>
									</div>
								</div>
								<div class=" col-md-6">
									<div class="form-group">
										<div class="">
											<input type="text" class="form-control" name="current_pincode" id="current_pincode" placeholder="Enter Pincode" />
										</div>
									</div>
								</div>
								
								
							</div>

								<div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="address_same" name="address_same"> Same the above
                                    </label>
                                </div>
								<span id="same_as_above">
						<div class="form-group">
                            <label class=" control-label">Permanent Address</label>
                            <div class="">
                                <input type="text" class="form-control" name="per_address" id="per_address" placeholder="Enter Current Address" />
                            </div>
                        </div>
						
							<div class="row">
								<div class=" col-md-6">
									<div class="form-group">
										<div class="">
											<input type="text" class="form-control" name="per_city" id="per_city" placeholder="Enter City Name" />
										</div>
									</div>
								</div>
								<div class=" col-md-6">
									<div class="form-group">
										<div class="">
											<?php $states = array ('Andhra Pradesh' => 'Andhra Pradesh', 'Arunachal Pradesh' => 'Arunachal Pradesh', 'Assam' => 'Assam', 'Bihar' => 'Bihar', 'Chhattisgarh' => 'Chhattisgarh', 'Goa' => 'Goa', 'Gujarat' => 'Gujarat', 'Haryana' => 'Haryana', 'Himachal Pradesh' => 'Himachal Pradesh', 'Jammu & Kashmir' => 'Jammu & Kashmir', 'Jharkhand' => 'Jharkhand', 'Karnataka' => 'Karnataka', 'Kerala' => 'Kerala', 'Madhya Pradesh' => 'Madhya Pradesh', 'Maharashtra' => 'Maharashtra', 'Manipur' => 'Manipur', 'Meghalaya' => 'Meghalaya', 'Mizoram' => 'Mizoram', 'Nagaland' => 'Nagaland', 'Odisha' => 'Odisha', 'Punjab' => 'Punjab', 'Rajasthan' => 'Rajasthan', 'Sikkim' => 'Sikkim', 'Tamil Nadu' => 'Tamil Nadu', 'Telangana' => 'Telangana', 'Tripura' => 'Tripura', 'Uttarakhand' => 'Uttarakhand','Uttar Pradesh' => 'Uttar Pradesh', 'West Bengal' => 'West Bengal', 'Andaman & Nicobar' => 'Andaman & Nicobar', 'Chandigarh' => 'Chandigarh', 'Dadra and Nagar Haveli' => 'Dadra and Nagar Haveli', 'Daman & Diu' => 'Daman & Diu', 'Delhi' => 'Delhi', 'Lakshadweep' => 'Lakshadweep', 'Puducherry' => 'Puducherry'); ?>
												  <select class="form-control" name="per_state" id="per_state">
												  <option value = "">Select State</option>
													<?php foreach($states as $key=>$state):
															if($hospital_details['hos_rep_state'] == $state):
															$selected ='selected=selected';
															else : 
															$selected = '';
															endif;
														 ?>
														<option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
													<?php endforeach; ?>
												  </select>
										</div>
									</div>
								</div>
								<div class=" col-md-6">
									<div class="form-group">
										<div class="">
											<select class="form-control" name="per_country" id="per_country">
												<option value="">Select Country</option>
												<option value="India"> India</option>
											</select>
										</div>
									</div>
								</div>
								<div class=" col-md-6">
									<div class="form-group">
										<div class="">
											<input type="text" class="form-control" name="per_pincode" id="per_pincode" placeholder="Enter Pincode" />
										</div>
									</div>
								</div>
								
								
							</div>
							
							</span>
						<div class="form-group">
                            <label class=" control-label">Blood Group (Optional)</label>
                            <div class="">
								<select class="form-control" id="blodd_group" name="blodd_group">
									<option value="">Select Blood Group</option>
									<option value="O+">O +</option>
									<option value="O-">O -</option>
									<option value="A+">A +</option>
									<option value="A-">A -</option>
									<option value="B+">B +</option>
									<option value="B-">B -</option>
									<option value="AB+">AB +</option>
									<option value="AB-">AB -</option>
								</select>
                            </div>
                        </div>
                      
						
						<div class="form-group">
                            <label class=" control-label">Profile Image</label>
							<input type="file" id="profile_pic" name="profile_pic" class="form-control">
                        </div> 
						
                        </div>
					<!--school details-->
						<div class="col-md-6">
						<h3 class="box-title"><i class="fa fa-building" aria-hidden="true"></i>&nbsp;School Details</h3>
						<div class="form-group">
						<label>Date of Join</label>

						<div class="input-group date">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						  <input type="text" class="form-control pull-right datechanges" id="datepicker1" autocomplete="off" name="doj" placeholder="MM/DD/YYYY" />
						</div>
						
					  </div>
						<div class="row">
								<div class=" col-md-6">
									<div class="form-group">
									<label class=" control-label">Class</label>
										<div class="">
										<select class="form-control" name="class_name" id="class_name">
											<option value="">Select Class</option>
											<?php foreach($class_list as $list){ ?>
											<option value="<?php echo $list['id'];?>"><?php echo $list['name'].' '.$list['section'];?></option>
											<?php } ?>
										</select>
										</div>
									</div>
								</div>
								<div class=" col-md-6">
								<div class="form-group">
                            <label class=" control-label">Admission Number</label>
                            <div class="">
                                <input type="text" class="form-control" name="roll_number" placeholder="Enter Admission Number" />
                            </div>
                        </div>
						</div>
								
							</div>
							<div class="row">
								<div class=" col-md-4">
									<div class="form-group">
									<label class=" control-label">Total Fee Amount</label>
										<div class="">
											<input type="text" class="form-control" name="fee_amount" id="fee_amount" placeholder="Enter Fee Amount" />
										</div>
									</div>
								</div>
								<div class=" col-md-4">
									<div class="form-group">
									<label class=" control-label">Fee Terms</label>
										<div class="">
										<select name="fee_terms" id="fee_terms" class="form-control">
										<option value="">Select</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
										</select>
										</div>
									</div>
								</div>
								<div class=" col-md-4">
									<div class="form-group">
									<label class=" control-label">Pay Amount</label>
										<div class="">
											<input type="text" class="form-control" name="pay_amount" id="pay_amount" value="<?php echo isset($student_list['pay_amount'])?$student_list['pay_amount']:''; ?>" placeholder="Enter Pay Amount" />
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix">&nbsp;</div>
							<h3 class="box-title"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Parent Details</h3>
						<div class="form-group">
                            <label class=" control-label"> Name of the Parent</label>
                            <div class="">
                                <input type="text" class="form-control" name="parent_name" placeholder="Enter Name of the Parent" />
                            </div>
                        </div>
						<div class="form-group ">
							<label class=" control-label">Gender</label>
							<div class="row">
								<div class="radio col-md-2">
									<label>
										<input type="radio" name="parent_gender" value="Male" data-bv-field="gender"> Male
									</label>
								</div>
								<div class="radio col-md-2" style="margin-top:10px">
									<label>
										<input type="radio" name="parent_gender" value="Female" data-bv-field="gender"> Female
									</label>
								</div>
							</div>
							
						</div>
						<div class="form-group">
                            <label class=" control-label">Email address</label>
                            <div class="">
                                <input type="text" class="form-control" name="parent_email" placeholder="Enter Email address" />
                            </div>
                        </div>
						<!--<div class="row">   
								<div class=" col-md-6">
									<div class="form-group">
									<label class=" control-label">Password</label>
										<div class="">
											<input type="password" class="form-control" name="parent_password" id="parent_password" placeholder="Enter Password" />
										</div>
									</div>
								</div>
								<div class=" col-md-6">
									<div class="form-group">
									<label class=" control-label">Confirm Password</label>
										<div class="">
											<input type="password" class="form-control" name="parent_org_password" id="parent_org_password" placeholder=" Enter Confirm Password" />
										</div>
									</div>
								</div>
						        </div>-->
							<!--<div class="row">
								<div class=" col-md-6">
									<div class="form-group">
									<label class=" control-label">Education</label>
										<div class="">
											<input type="text" class="form-control" name="education" id="education" placeholder="Enter Education" />
										</div>
									</div>
								</div>
								<div class=" col-md-6">
									<div class="form-group">
									<label class=" control-label">Profession</label>
										<div class="">
											<input type="text" class="form-control" name="profession" id="profession" placeholder=" Enter Profession" />
										</div>
									</div>
								</div>
							</div>-->
							
							<div class="row">
								<div class=" col-md-12">
									<div class="form-group">
									<label class=" control-label">Mobile</label>
										<div class="">
											<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" />
										</div>
									</div>
								</div>
							</div>
							
							<div class=" col-md-6">
									<div class="form-group">
									 <label class=" control-label">Bus Transport</label>
										<div class="">
											<select class="form-control" name="bus_transport" id="bus_transport">
												<option value="">Select</option>
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											</select>
										</div>
									</div>
								</div>
							
                        </div> 
						
						  <div class="form-group">
                            <div class="pull-right">
						
                                <button  type="submit" class="btn btn-primary " name="signup" value="Sign up">Add Student</button>
									<a style="margin-right:10px;" href="<?php echo base_url('dashboard'); ?>" type="submit" class="btn btn-warning " >Cancel</a> 
								
                                
                            </div>
							<div class="clearfix">&nbsp;</div>
                        </div>
						
                    </form>
					<div class="clearfix">&nbsp;</div>
           </div>
          </div>
      
        </div>
					<div class="clearfix">&nbsp;</div>

						
                    </form>
                
              </div>
              <!-- /.tab-pane -->
              <div class=" table-responsive tab-pane <?php if(isset($tab) && $tab==1){ echo "active"; }?>" id="tab_2">
			
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Mobile Number</th>
                  <th>Address</th>
                  <th>Class & Section</th>
                  <th>Admission Number</th>
                  <th>Parent Email</th>
                  <th>Parent Name</th>
                  <th>Bus Transport</th>
                  <th>Created Date </th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php if(isset($student_list) && count($student_list)>0){ ?>
						<?php $cnt=1;foreach($student_list as $list){ ?>
							<tr>
								  <td><?php echo $cnt; ?></td>
								  <td><?php echo $list['name']; ?></td>
								  <td><?php echo $list['gender']; ?></td>
								  <td><?php echo $list['mobile']; ?></td>
								  <td>
								   <?php echo isset($list['address'])?$list['address'].', ':''; ?>
								   <?php echo isset($list['current_city'])?$list['current_city'].', ':''; ?>
								   <?php echo isset($list['current_state'])?$list['current_state'].', ':''; ?>
								   <?php echo isset($list['current_country'])?$list['current_country'].', ':''; ?>
							       <?php echo isset($list['current_pincode'])?$list['current_pincode'].'.':''; ?>
								  </td>
								  <td><?php echo $list['class_name']; ?></td>
								  <td><?php echo $list['roll_number']; ?></td>
								  <td><?php echo $list['parent_email']; ?></td>
								  <td><?php echo $list['parent_name']; ?></td>
								  <td><?php echo $list['bus_transport']; ?></td>
								  <td><?php echo date('d-m-Y',strtotime(htmlentities($list['create_at'])));?></td>
								  <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
								  <td>
								  	<a  target="_blank" href="<?php echo base_url('student/prints/'.base64_encode($list['u_id'])); ?>" class="btn-sm btn-primary hidden-print" ><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>

									  <a href="javascript;void(0);"  data-toggle="modal" data-target="#squarespaceModal<?php echo $list['u_id']; ?>"  title="View"><i class="fa fa-eye btn btn-success"></i></a>

									  <a href="<?php echo base_url('student/edit/'.base64_encode($list['u_id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
 
									  <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['u_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" data-toggle="modal" data-target="#myModal" title="Edit"><i class="fa fa-info-circle btn btn-warning"></i></a>
									  <a href="javascript;void(0);" onclick="admindedelete('<?php echo base64_encode($list['u_id']) ?>');admindedeletemsg();" data-toggle="modal" data-target="#myModal" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
									</td>
							</tr>
							 <div class="modal fade" id="squarespaceModal<?php echo $list['u_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
								<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-primary">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
										<h3 class="modal-title" id="lineModalLabel"><?php echo $list['name']; ?>&nbsp;&nbsp;Profile View</h3>
									</div>
									<div class="modal-body">
										
									   <div class="row">
											<div class="col-md-3 col-lg-3 " align="center">
											<?php if($userdetails['profile_pic']!=''){?>
											<img src="<?php echo base_url('assets/adminpic/'.$userdetails['profile_pic']);?>" class="img-circle img-responsive" alt="<?php echo htmlentities($userdetails['profile_pic']); ?>" />
											<?php }else{ ?>
											<img src="<?php echo base_url();?>assets/vendor/201811.svg" class="img-circle img-responsive" alt="User Image" />
											<?php } ?>
											</div>
										   
											<div class=" col-md-9 col-lg-9 "> 
											  
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Name of the Student</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['name'])?$list['name']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Class</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['class_name'])?$list['class_name']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Admission Number</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['roll_number'])?$list['roll_number']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Total Fee Amount</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['fee_amount'])?$list['fee_amount']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Fee Terms</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['fee_terms'])?$list['fee_terms']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Paid Amount</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['pay_amt'])?$list['pay_amt']:''; ?> ( <b><strong>Due  Amount </strong></b>: <?php echo $list['fee_amount']- $list['pay_amt'] ; ?>)
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Date of Join</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo date('d-m-Y',strtotime(htmlentities($list['doj'])));?>
												  </div>
											  </div> 
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Gender</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['gender'])?$list['gender']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Address</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['address'])?$list['address'].', ':''; ?>
												  <?php echo isset($list['current_city'])?$list['current_city'].', ':''; ?>
												  <?php echo isset($list['current_state'])?$list['current_state'].', ':''; ?>
												  <?php echo isset($list['current_country'])?$list['current_country'].', ':''; ?>
												  <?php echo isset($list['current_pincode'])?$list['current_pincode'].'.':''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Parent Email</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['parent_email'])?$list['parent_email']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Name of the Parent</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['parent_name'])?$list['parent_name']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Mobile Number</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['mobile'])?$list['mobile']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Status</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?>
												  </div>
											  </div>
										  </div>

									</div>
									<div class="modal-footer">
										<div class="btn-group btn-group-justified" role="group" aria-label="group button">
											<div class="">
												<button type="button" class="btn btn-danger btn-sm " data-dismiss="modal"  role="button">Close</button>
												<a href="<?php echo base_url('student/edit/'.base64_encode($list['u_id'])); ?>" class="btn btn-warning btn-sm"  role="button">Edit</a>
												
												<?php if($list['pay_amt'] < $list['fee_amount']){ ?>
												<a href="<?php echo base_url('student/payment/'.base64_encode($list['u_id'])); ?>" class="btn btn-primary btn-sm"  role="button">Payment</a>
												<?php } ?>
											</div>
											
										</div>
									</div>
								</div>
							  </div>
							</div>
							  
						<?php $cnt++;} ?>
				
				<?Php } ?>
                
                
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Mobile Number</th>
                  <th>Address</th>
                  <th>Class & Section</th>
                  <th>Admission Number</th>
                  <th>Parent Email</th>
                  <th>Parent Name</th>
                  <th>Bus Transport</th>
                  <th>Created Date </th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            
    
              </div>
              
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
	</section>
 </div>
 </div>

 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
			
			<div style="padding:10px">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 style="pull-left" class="modal-title">Confirmation</h4>
			</div>
			<div class="modal-body">
			<div class="alert alert-danger alert-dismissible" id="errormsg" style="display:none;"></div>
			  <div class="row">
				<div id="content1" class="col-xs-12 col-xl-12 form-group">
				Are you sure ? 
				</div>
				<div class="col-xs-6 col-md-6">
				  <button type="button" aria-label="Close" data-dismiss="modal" class="btn  blueBtn">Cancel</button>
				</div>
				<div class="col-xs-6 col-md-6">
                <a href="?id=value" class="btn  blueBtn popid" style="text-decoration:none;float:right;"> <span aria-hidden="true">Ok</span></a>
				</div>
			 </div>
		  </div>
      </div>
      
    </div>
  </div>
 <!-- load jQuery UI CSS theme -->
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css" type="text/css" media="all">
 <script>
 function get_total_amt(sval){
		var paid_amount=$('#pay_amount').val();
		var t_amount=$('#fee_amount').val();
		if(t_amount<paid_amount){
		alert('pay amount not accept greater than total amount');return false;	
		}
 
 }
 </script>
 <script>
 $(function() {
  var $dp1 = $("#datepicker1");
  $dp1.datepicker({
    changeYear: true,
    changeMonth: true,
      minDate:0,
    dateFormat: "mm/dd/yy",
    yearRange: "-100:+80",
  });

  var $dp2 = $("#datepicker");
  $dp2.datepicker({
    changeYear: true,
    changeMonth: true,
	maxDate:-1,
    yearRange: "-80:+80",
    dateFormat: "mm/dd/yy",
  });
});
</script>
<script>
$(function(){
    $('#address_same').click(function() {
        if($(this).is(':checked'))
			$('#same_as_above').hide();
        else
          $('#same_as_above').show();
    });
});
 function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('student/status'); ?>"+"/"+id);
} 
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to Activate?');
	}
}
function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('student/delete'); ?>"+"/"+id);
}
function admindedeletemsg(id){
	$('#content1').html('Are you sure you want to delete?');
	
}

  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
 <script>
$(document).ready(function() {
 $('#datepicker1').datepicker({
      autoclose: true
    });
   $('#defaultForm').bootstrapValidator({
//       
        fields: {
            name: {
                validators: {
					notEmpty: {
						message: 'Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			dob: {
                validators: {
					notEmpty: {
								message: 'Date of Birth is required'
						},
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The value is not a valid date'
                    }
                }
            },
			phone: {
                 validators: {
					notEmpty: {
						message: 'Mobile Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10}$/,
					message:'Mobile Number must be 10 digits'
					}
				
				}
            },
			gender: {
                validators: {
					notEmpty: {
						message: 'Gender is required'
					}
				}
            },
			current_address: {
                 validators: {
					  notEmpty: {
						message: 'Address is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~'"\\|=^?$%*)(_+-]*$/,
					message: 'Address wont allow <>[]'
					}
                }
            },
			current_city: {
                 validators: {
					  notEmpty: {
						message: 'City is required'
					},
                    regexp: {
					regexp: /^[a-zA-Z]+$/,
					message:'City can only consist of alphabets',
					}
                }
            },
			current_state: {
                validators: {
					notEmpty: {
						message: 'State is required'
					}
				}
            },
			current_country: {
                validators: {
					notEmpty: {
						message: 'Country is required'
					}
				}
            },
			current_pincode: {
               validators: {
					notEmpty: {
						message: 'Pin code is required'
					},
					regexp: {
					regexp: /^[0-9]{5,7}$/,
					message: 'Pin code  must be  5 to 7 characters'
					}
				}
            },
			
			per_address: {
                 validators: {
					  notEmpty: {
						message: 'Address is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~'"\\|=^?$%*)(_+-]*$/,
					message: 'Address wont allow <>[]'
					}
                }
            },
			per_city: {
                 validators: {
					  notEmpty: {
						message: 'City is required'
					},
                    regexp: {
					regexp: /^[a-zA-Z]+$/,
					message:'City can only consist of alphabets',
					}
                }
            },per_state: {
                validators: {
					notEmpty: {
						message: 'State is required'
					}
				}
            },
			per_country: {
                validators: {
					notEmpty: {
						message: 'Country is required'
					}
				}
            },
			per_pincode: {
               validators: {
					notEmpty: {
						message: 'Pin code is required'
					},
					regexp: {
					regexp: /^[0-9]{5,7}$/,
					message: 'Pin code  must be  5 to 7 characters'
					}
				}
            },
			password: {
                validators: {
					notEmpty: {
						message: 'Password is required'
					},
					stringLength: {
                        min: 6,
                        message: 'Password  must be at least 6 characters'
                    },
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~'"\\|=^?$%*)(_+-]*$/,
					message: 'Password wont allow <>[]'
					}
				}
            },
           
           confirmpassword: {
					 validators: {
						 notEmpty: {
						message: 'Confirm Password is required'
					},
					identical: {
						field: 'password',
						message: 'password and Confirm Password do not match'
					}
					}
				},
			address: {
                 validators: {
					notEmpty: {
						message: 'Address is required'
					},
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address wont allow <> [] = % '
					}
				
				}
            },
			doj: {
                validators: {
                   notEmpty: {
								message: 'Date of Join is required'
						},
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The value is not a valid date'
                    }
                }
            },
			class_name: {
                 validators: {
					notEmpty: {
						message: 'Class is required'
					}
				
				}
            },
			roll_number: {
                 validators: {
					notEmpty: {
						message: 'Admission Number is required'
					},
				}
            },
			fee_amount: {
                 validators: {
					notEmpty: {
						message: 'Total Fee Amount is required'
					},
					regexp: {
					regexp:/^[0-9]*$/,
					message:' Total Fee Amount must be digits'
					}
				
				}
            },
			pay_amount: {
                 validators: {
					notEmpty: {
						message: 'Total Fee Amount is required'
					}
				
				}
            },fee_terms: {
                 validators: {
					notEmpty: {
						message: 'Fee Terms is required'
					}
				
				}
            },
			parent_name: {
                 validators: {
					notEmpty: {
						message: 'Name of the Parent is required'
					},
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:' Name of the Parent wont allow <> [] = % '
					}
				
				}
            },
			parent_gender: {
                 validators: {
					notEmpty: {
						message: 'Gender is required'
					}
				}
            },
			
			qalification: {
                 validators: {
					notEmpty: {
						message: 'Qalification is required'
					},
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Qalification wont allow <> [] = % '
					}
				
				}
            },
			parent_password: {
                validators: {
					notEmpty: {
						message: 'parent Password is required'
					},
					stringLength: {
                        min: 6,
                        message: 'Password  must be at least 6 characters'
                    },
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~'"\\|=^?$%*)(_+-]*$/,
					message: 'Password wont allow <>[]'
					}
				}
            },
		   parent_org_password:{
		            validators: {
						 notEmpty: {
						message: 'Confirm Password is required'
					},
					identical: {
						field: 'parent_password',
						message: 'password and Confirm Password do not match'
					}
					}
				},
				
			education: {
                 validators: {
					notEmpty: {
						message: 'Education is required'
					},
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Education wont allow <> [] = % '
					}
				
				}
            },profession: {
                 validators: {
					notEmpty: {
						message: 'Profession is required'
					},
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Profession wont allow <> [] = % '
					}
				
				}
            },mobile: {
                 validators: {
					notEmpty: {
						message: 'Mobile  Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10}$/,
					message:'Mobile Number must be 10 digits'
					}
				
				}
            },
			bus_transport:{
			validators: {
					notEmpty: {
						message: 'Bus Transport is required'
					}
				}
            },
			profile_pic: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(png|jpeg|jpg|gif)$",
					message: 'Uploaded file is not a valid. Only png,jpg,jpeg,gif files are allowed'
					}
				}
            }
        }
    });
	$('#datepicker').on('changeDate ', function(e) {
		$('#defaultForm').bootstrapValidator('revalidateField', 'dob');
		});
		$('#datepicker1').on('changeDate ', function(e) {
		$('#defaultForm').bootstrapValidator('revalidateField', 'doj');
		});
    // Validate the form manually
    $('#validateBtn').click(function() {
        $('#defaultForm').bootstrapValidator('validate');
    });

    $('#resetBtn').click(function() {
        $('#defaultForm').data('bootstrapValidator').resetForm(true);
    });
	
});


</script>
 