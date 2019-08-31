
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Student </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Edit Student </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
		<div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            
            <div class="tab-content">
              <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <form id="defaultForm" method="post" class="" action="<?php echo base_url('student/editdetailspost'); ?>" enctype="multipart/form-data">
			
			<input type="hidden" name="u_id" id="u_id" value="<?php echo isset($student_list['u_id'])?$student_list['u_id']:''; ?>">
						<div class="col-md-6">
						<h3 class="box-title"> <i class="fa fa-info" aria-hidden="true"></i>&nbsp;Personal Details</h3>
					
						<div class="form-group">
                            <label class=" control-label">Name of the Student</label>
                            <div class="">
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($student_list['name'])?$student_list['name']:''; ?>" placeholder="Name of the Student" />
                            </div>
                        </div>
						<div class="form-group">
						<label>Date of Birth</label>

						<div class="input-group date">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						  <input type="text" class="form-control pull-right datechanges" id="datepicker" autocomplete="off" name="dob" value="<?php echo isset($student_list['dob'])?$student_list['dob']:''; ?>" placeholder="MM/DD/YYYY" />
						</div>
						
					  </div>
						
						<div class="form-group ">
							<label class=" control-label">Gender</label>
							<div class="row">
								<div class="radio col-md-2">
									<label>
										<input type="radio"  name="gender" value="Male" <?php if($student_list['gender']=='Male'){ echo "checked"; } ?> data-bv-field="gender"> Male
									</label>
								</div>
								<div class="radio col-md-2" style="margin-top:10px">
									<label>
										<input type="radio" name="gender" value="Female" <?php if($student_list['gender']=='Female'){ echo "checked"; } ?> data-bv-field="gender"> Female
									</label>
								</div>
								<i class="form-control-feedback" data-bv-icon-for="gender" style="display: none;"></i>
							</div>
							
						</div>
						<div class="form-group">
                            <label class=" control-label">Current Address</label>
                            <div class="">
                                <input type="text" class="form-control" name="current_address" id="current_address" value="<?php echo isset($student_list['address'])?$student_list['address']:''; ?>" placeholder="Enter Current Address" />
                            </div>
                        </div>
						
							<div class="row">
								<div class=" col-md-6">
									<div class="form-group">
										<div class="">
											<input type="text" class="form-control" name="current_city" id="current_city" value="<?php echo isset($student_list['current_city'])?$student_list['current_city']:''; ?>" placeholder="Enter City Name" />
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
															if(isset($student_list['current_state']) && $student_list['current_state'] == $state):
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
												<option value="India" <?php if($student_list['per_country']=='India'){ echo "selected"; } ?>> India</option>
											</select>
										</div>
									</div>
								</div>
								<div class=" col-md-6">
									<div class="form-group">
										<div class="">
											<input type="text" class="form-control" name="current_pincode" id="current_pincode" value="<?php echo isset($student_list['current_pincode'])?$student_list['current_pincode']:''; ?>" placeholder="Enter Pincode" />
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
                                <input type="text" class="form-control" name="per_address" id="per_address" value="<?php echo isset($student_list['per_address'])?$student_list['per_address']:''; ?>" placeholder="Enter Current Address" />
                            </div>
                        </div>
						
							<div class="row">
								<div class=" col-md-6">
									<div class="form-group">
										<div class="">
											<input type="text" class="form-control" name="per_city" id="per_city" value="<?php echo isset($student_list['per_city'])?$student_list['per_city']:''; ?>" placeholder="Enter City Name" />
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
															if($student_list['per_state'] == $state):
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
												<option value="India" <?php if($student_list['per_country']=='India'){ echo "selected"; } ?>> India</option>
											</select>
										</div>
									</div>
								</div>
								<div class=" col-md-6">
									<div class="form-group">
										<div class="">
											<input type="text" class="form-control" name="per_pincode" id="per_pincode" value="<?php echo isset($student_list['per_pincode'])?$student_list['per_pincode']:''; ?>" placeholder="Enter Pincode" />
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
									<option value="O+" <?php if($student_list['blodd_group']=='O+'){ echo "selected"; } ?>>O +</option>
									<option value="O-" <?php if($student_list['blodd_group']=='O-'){ echo "selected"; } ?>>O -</option>
									<option value="A+" <?php if($student_list['blodd_group']=='A+'){ echo "selected"; } ?>>A +</option>
									<option value="A-" <?php if($student_list['blodd_group']=='A-'){ echo "selected"; } ?>>A -</option>
									<option value="B+" <?php if($student_list['blodd_group']=='B+'){ echo "selected"; } ?>>B +</option>
									<option value="B-" <?php if($student_list['blodd_group']=='B-'){ echo "selected"; } ?>>B -</option>
									<option value="AB+" <?php if($student_list['blodd_group']=='AB+'){ echo "selected"; } ?>>AB +</option>
									<option value="AB-" <?php if($student_list['blodd_group']=='AB-'){ echo "selected"; } ?>>AB -</option>
								</select>
                            </div>
                        </div>
						
							
						
						
						<div class="form-group">
                            <label class=" control-label">Profile</label>
							<input type="file" id="profile_pic" name="profile_pic" class="form-control">
                        </div> 
						
                        </div>
					<!--school details-->
						<div class="col-md-6">
						<h3 class="box-title"><i class="fa fa-building" aria-hidden="true"></i>&nbsp;School Details</h3>
						<div class="form-group">
                            <label class=" control-label">Date of Join</label>
                            <div class="input-group date">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
								<input type="text" class="form-control pull-right" value="<?php echo isset($student_list['doj'])?$student_list['doj']:''; ?>" id="datepicker1" autocomplete="off" name="doj" placeholder="MM/DD/YYYY" />
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
												<?php if($student_list['class_name']== $list['id']){ ?>
													<option value="<?php echo $list['id'];?>" selected><?php echo $list['name'].' '.$list['section'];?></option>
												<?php }else{ ?>
														<option value="<?php echo $list['id'];?>"><?php echo $list['name'].' '.$list['section'];?></option>
												<?php } ?>
											<?php } ?>
										</select>
										</div>
									</div>
								</div>
								<!--<div class=" col-md-6">
									<div class="form-group">
									<label class=" control-label">Admission Number</label>
										<div class="">
											<input type="text" class="form-control" name="roll_number" id="roll_number" value="<?php echo isset($student_list['roll_number'])?$student_list['roll_number']:''; ?>" placeholder=" Enter roll Number" />
										</div>
									</div>
								</div>-->
							</div>
							<!--<div class="row">
								<div class=" col-md-4">
									<div class="form-group">
									<label class=" control-label">Total Fee Amount</label>
										<div class="">
											<input type="text" class="form-control" readonly="true" name="fee_amount" id="fee_amount" value="<?php echo isset($student_list['fee_amount'])?$student_list['fee_amount']:''; ?>" placeholder="Enter Fee Amount" />
										</div>
									</div>
								</div>
								<div class=" col-md-4">
									<div class="form-group">
									<label class=" control-label">Fee Terms</label>
										<div class="">
										<select name="fee_terms" id="fee_terms" class="form-control">
										<option value="">Select</option>
											<option value="1" <?php if($student_list['fee_terms']==1){  echo "selected"; }?>>1</option>
											<option value="2" <?php if($student_list['fee_terms']==2){  echo "selected"; }?>>2</option>
											<option value="3" <?php if($student_list['fee_terms']==3){  echo "selected"; }?>>3</option>
										</select>
										</div>
									</div>
								</div>
								<div class=" col-md-4">
									<div class="form-group">
									<label class=" control-label">Pay Amount</label>
										<div class="">
											<input type="text" class="form-control" readonly="true" name="pay_amount" id="pay_amount" value="<?php echo isset($student_list['pay_amount'])?$student_list['pay_amount']:''; ?>" placeholder="Enter Pay Amount" />
										</div>
									</div>
								</div>
							</div>-->
							<div class="clearfix">&nbsp;</div>
							<h3 class="box-title"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Parent Detail</h3>
						<div class="form-group">
                            <label class=" control-label"> Name of the Parent</label>
                            <div class="">
                                <input type="text" class="form-control" name="parent_name" value="<?php echo isset($student_list['parent_name'])?$student_list['parent_name']:''; ?>" placeholder="Enter Name of the Parent" />
                            </div>
                        </div>
						<div class="form-group ">
							<label class=" control-label">Gender</label>
							<div class="row">
								<div class="radio col-md-2">
									<label>
										<input type="radio" name="parent_gender" value="Male" <?php if($student_list['parent_gender']=='Male'){ echo "checked"; } ?> data-bv-field="gender"> Male
									</label>
								</div>
								<div class="radio col-md-2" style="margin-top:10px">
									<label>
										<input type="radio" name="parent_gender" value="Female" <?php if($student_list['parent_gender']=='Female'){ echo "checked"; } ?> data-bv-field="gender"> Female
									</label>
								</div>
							</div>
							
						</div>
						<div class="form-group">
                            <label class=" control-label">Email address</label>
                            <div class="">
                                <input type="text" class="form-control" name="parent_email" value="<?php echo isset($student_list['parent_email'])?$student_list['parent_email']:''; ?>" placeholder="Enter Email address" />
                            </div>
                        </div>
							<div class="row">
								<div class=" col-md-6">
									<div class="form-group">
									<label class=" control-label">Education</label>
										<div class="">
											<input type="text" class="form-control" name="education" id="education" value="<?php echo isset($student_list['education'])?$student_list['education']:''; ?>" placeholder="Enter Education" />
										</div>
									</div>
								</div>
								<div class=" col-md-6">
									<div class="form-group">
									<label class=" control-label">Profession</label>
										<div class="">
											<input type="text" class="form-control" name="profession" id="profession" value="<?php echo isset($student_list['profession'])?$student_list['profession']:''; ?>" placeholder=" Enter Profession" />
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class=" col-md-12">
									<div class="form-group">
									<label class=" control-label">Mobile</label>
										<div class="">
											<input type="text" class="form-control" id="parent_mobile" name="parent_mobile" value="<?php echo isset($student_list['mobile'])?$student_list['mobile']:''; ?>" placeholder="Enter Mobile" />
										</div>
									</div>
								</div>
								
							</div>
                        </div> 
						
						  <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-10">
                                <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Update Student</button>
								<a href="<?php echo base_url('dashboard'); ?>" type="submit" class="btn btn-warning" >Cancel</a>
                                
                            </div>
                        </div>
						
                    </form>
					<div class="clearfix">&nbsp;</div>
           </div>
          </div>
      
        </div>
					<div class="clearfix">&nbsp;</div>

						
                    </form>
                
              
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
	</section>
 </div>
 </div>

 
 <script>

$(function(){
    $('#address_same').click(function() {
        if($(this).is(':checked'))
			$('#same_as_above').hide();
        else
          $('#same_as_above').show();
    });
});
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
            email: {
                validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
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
						message: 'password and confirm Password do not match'
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
			class_name: {
                 validators: {
					notEmpty: {
						message: 'Class is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Class can only consist of Alphanumeric, space and dot'
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
			roll_number: {
                 validators: {
					notEmpty: {
						message: 'Roll NUmber is required'
					},
					regexp: {
					regexp:/^[0-9]*$/,
					message:' Roll Number must be 10 digits'
					}
				
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
			parent_email: {
                 validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
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
            },parent_mobile: {
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