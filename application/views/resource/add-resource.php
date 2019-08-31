
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Add Resources  
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Add Resources </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
		<div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){ echo "active"; }?>"><a href="#tab_1" data-toggle="tab">Add Resources</a></li>
              <li class="<?php if(isset($tab) && $tab==1){ echo "active"; }?>"><a href="#tab_2" data-toggle="tab"> Resources List</a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane <?php if(isset($tab) && $tab==''){ echo "active"; }?>" id="tab_1">
              <form id="defaultForm" method="post" class="" action="<?php echo base_url('resource/addpost'); ?>" enctype="multipart/form-data">
					<?php $csrf = array(
								'name' => $this->security->get_csrf_token_name(),
								'hash' => $this->security->get_csrf_hash()
						); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							      <input type="hidden" id="school_id" name="school_id" value="<?php echo isset($school_details['s_id'])?$school_details['s_id']:''; ?>">

						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Role</label>
								<div class="">
								<select id="role_id" name="role_id" class="form-control">
								<option value=""> Select</option>
									<?php foreach($role_list as $list){ ?>
									<option value="<?php echo $list['id']; ?>"> <?php echo $list['name']; ?></option>
									<?php } ?>
									
								</select>
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Name</label>
								<div class="">
									<input type="text" class="form-control" name="name" id="name" value="" placeholder="Enter Name" />
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Email</label>
								<div class="">
									<input type="text" class="form-control" name="email" value="" id="email" placeholder="Enter Email" />
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Gender</label>
								<div class="">
									<?php $genders_list = array("Male","Female","Others"); ?>

									<select class="form-control" name="gender" id="gender">
									<option value = "">Select</option>
									<?php foreach($genders_list as $status):
									if(isset($resources_details['gender']) && $resources_details['gender'] == $status):
											$selected ='selected=selected';
											else : 
											$selected = '';
											endif;
											 ?>
									<option value = "<?php echo $status;?>" <?php echo $selected;?>><?php echo $status;?></option>
									<?php endforeach; ?>
									</select>
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Mobile Number</label>
								<div class="">
									<input type="text" class="form-control" name="phone" id="phone" value="" placeholder="Enter Mobile  number" />
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Password</label>
								<div class="">
									<input type="password" class="form-control" name="password" id="password" value="" placeholder="Enter Password" />
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Confirm Password</label>
								<div class="">
									<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" value="" placeholder="Enter Confirm Password" />
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Qualification</label>
								<div class="">
									<input type="text" class="form-control" name="qalification" id="qalification" value="" placeholder="Enter Qualification" />
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Address</label>
								<div class="">
									<input type="text" class="form-control" name="address" id="address" value="" placeholder="Enter Address" />
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Notes</label>
								<div class="">
									<input type="text" class="form-control" id="notes" name="notes" value="" placeholder="Enter Notes" />
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Profile Pic</label>
								<div class="">
									<input type="file" class="form-control" name="image" id="image" />
								</div>
							</div>
                        </div>
						
						
					
						  <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-10">
                                <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Add</button>
								<a href="<?php echo base_url('dashboard'); ?>" type="submit" class="btn btn-warning" >Back</a>
                                
                            </div>
                        </div>
					<div class="clearfix">&nbsp;</div>

						
                    </form>
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane <?php if(isset($tab) && $tab==1){ echo "active"; }?>" id="tab_2">
			
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Mobile Number</th>
                  <th>Qualification</th>
                  <th>Address</th>
                  <th>Created Date </th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php if(isset($resource_list) && count($resource_list)>0){ ?>
						<?php $cnt=1;foreach($resource_list as $list){ ?>
							<tr>
								  <td><?php echo $cnt; ?></td>
								  <td><?php echo $list['name']; ?></td>
								  <td><?php echo $list['email']; ?></td>
								  <td><?php echo $list['role_name']; ?></td>
								  <td><?php echo $list['mobile']; ?></td>
								  <td><?php echo $list['qalification']; ?></td>
								  <td><?php echo $list['address']; ?></td>
								  <td><?php echo date('d-m-Y',strtotime(htmlentities($list['create_at'])));?></td>
								  <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
								  <td>
									  <a href="javascript;void(0);"  data-toggle="modal" data-target="#squarespaceModal<?php echo $list['u_id']; ?>"  title="View"><i class="fa fa-eye btn btn-success"></i></a>
									  <a href="<?php echo base_url('resource/edit/'.base64_encode($list['u_id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
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
													<strong>Name</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['name'])?$list['name']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Department</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['role_name'])?$list['role_name']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Hire date</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo date('d-m-Y',strtotime(htmlentities($list['create_at'])));?>
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
													<strong>Qualification</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['qalification'])?$list['qalification']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Email</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['email'])?$list['email']:''; ?>
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
												<a href="<?php echo base_url('resource/edit/'.base64_encode($list['u_id'])); ?>" class="btn btn-warning btn-sm"  role="button">Edit</a>
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
				   <th>Email</th>
				   <th>Role</th>
                  <th>Mobile Number</th>
                  <th>Qualification</th>
                  <th>Address</th>
                  <th>Created Date</th>
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
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
								  <div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header bg-primary">
											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title" id="lineModalLabel">Profile View</h3>
										</div>
										<div class="modal-body">
											
										   <div class="row">
												<div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://image.flaticon.com/icons/svg/201/201811.svg" class="img-circle img-responsive"> </div>
											   
												<div class=" col-md-9 col-lg-9 "> 
												  <table class="table table-user-information">
													<tbody>
													  <tr>
														<td>Department:</td>
														<td>Programming</td>
													  </tr>
													  <tr>
														<td>Hire date:</td>
														<td>06/23/2013</td>
													  </tr>
														 <tr>
															 <tr>
														<td>Gender</td>
														<td>Female</td>
													  </tr>
														<tr>
														<td>Home Address</td>
														<td>Kathmandu,Nepal</td>
													  </tr>
													  <tr>
														<td>Email</td>
														<td><a href="mailto:info@support.com">info@support.com</a></td>
													  </tr>
														<td>Phone Number</td>
														<td>123-4567-890<br><br>
														</td>
														   
													  </tr>
													 
													</tbody>
												  </table>
												  
												
												</div>
											  </div>

										</div>
										<div class="modal-footer">
											<div class="btn-group btn-group-justified" role="group" aria-label="group button">
												<div class="btn-group" role="group">
													<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
												</div>
												
											</div>
										</div>
									</div>
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
 <script>
 function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('resource/status'); ?>"+"/"+id);
} 
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('resource/delete'); ?>"+"/"+id);
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
   $('#defaultForm').bootstrapValidator({
//       
        fields: {
            role_id: {
                validators: {
					notEmpty: {
						message: 'Role is required'
					}
				}
            },
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
            },phone: {
                 validators: {
					notEmpty: {
						message: 'Mobile Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Mobile Number must be 10 to 14 digits'
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
			qalification: {
                 validators: {
					notEmpty: {
						message: 'Qualification is required'
					},
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Qualification wont allow <> [] = % '
					}
				
				}
            },
			
			image: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(png|jpeg|jpg|gif)$",
					message: 'Uploaded file is not a valid. Only png,jpg,jpeg,gif files are allowed'
					}
				}
            }
        }
    });

    // Validate the form manually
    $('#validateBtn').click(function() {
        $('#defaultForm').bootstrapValidator('validate');
    });

    $('#resetBtn').click(function() {
        $('#defaultForm').data('bootstrapValidator').resetForm(true);
    });
});
$(document).ready(function() {
    $('#representative').bootstrapValidator({
        
        fields: {
            
            scl_representative: {
                 validators: {
					notEmpty: {
						message: 'Representative Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Representative Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			 scl_rep_contact: {
                validators: {
					notEmpty: {
						message: 'landline Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'landline Number must be 10 to 14 digits'
					}
				
				}
            },scl_rep_mobile: {
                 validators: {
					notEmpty: {
						message: 'Contact Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Contact Number must be 10 to 14 digits'
					}
				
				}
            },scl_rep_email: {
                validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },scl_rep_nationali_id: {
                validators: {
					notEmpty: {
						message: 'National ID is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'National ID must be 10 to 14 digits'
					}
				
				}
            },scl_rep_add1: {
                validators: {
					notEmpty: {
						message: 'Address1 is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address1 wont allow <> [] = % '
					}
                }
            },scl_rep_add2: {
                validators: {
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address2 wont allow <> [] = % '
					}
                }
            },scl_rep_zipcode: {
              validators: {
					notEmpty: {
						message: 'Pin code is required'
					},
					regexp: {
					regexp: /^[0-9]{5,7}$/,
					message: 'Pin code  must be  5 to 7 characters'
					}
				}
            },scl_rep_city: {
               validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'City can only consist of alphabets and Space'
					}
				
				}
            },scl_rep_state: {
                validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'State can only consist of alphabets and Space'
					}
				
				}
            },
			scl_rep_country: {
                validators: {
					notEmpty: {
						message: 'Country is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Country can only consist of alphabets and Space'
					}
				
				}
            }
            }
        })
     
});
$(document).ready(function() {
    $('#basicdetails').bootstrapValidator({
        
        fields: {
            
            scl_bas_name: {
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
			 scl_bas_contact: {
                validators: {
					notEmpty: {
						message: 'Contact Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message: 'Contact Number must be 10 to 14 digits'
					}
				
				}
            },scl_bas_email: {
                validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },scl_bas_nationali_id: {
                validators: {
					notEmpty: {
						message: 'National ID is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'National ID must be 10 to 14 digits'
					}
				
				}
            },scl_bas_add1: {
                validators: {
					notEmpty: {
						message: 'Address1 is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address1 wont allow <> [] = % '
					}
                }
            },scl_bas_add2: {
                validators: {
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address2 wont allow <> [] = % '
					}
                }
            },scl_bas_zipcode: {
              validators: {
					notEmpty: {
						message: 'Pin code is required'
					},
					regexp: {
					regexp: /^[0-9]{5,7}$/,
					message: 'Pin code  must be  5 to 7 characters'
					}
				}
            },scl_bas_city: {
               validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'City can only consist of alphabets and Space'
					}
				
				}
            },scl_bas_state: {
                validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'State can only consist of alphabets and Space'
					}
				
				}
            },
			scl_bas_country: {
                validators: {
					notEmpty: {
						message: 'Country is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'Country can only consist of alphabets and Space'
					}
				
				}
            },
			scl_bas_document: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            },
			scl_bas_logo: {
                validators: {
					
					regexp: {
					regexp: "(.*?)\.(png|jpeg|jpg|gif)$",
					message: 'Uploaded file is not a valid. Only png,jpeg,jpg,gif files are allowed'
					}
				}
            }
            }
        })
     
});
$(document).ready(function() {
    $('#financial').bootstrapValidator({
        
        fields: {
            
            bank_holder_name: {
                 validators: {
					notEmpty: {
						message: 'Bank Holder Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'Bank Holder Name can only consist of alphabets and space'
					}
				}
            },
			 bank_acc_no: {
                validators: 
					{
					    notEmpty: 
						{
						    message: 'Bank Account is required'
					    },
						regexp: 
						{
					     regexp:  /^[0-9]{9,16}$/,
					     message:'Bank Account  must be 9 to 16 digits'
					    }
				}
            },bank_name: {
                validators: {
					notEmpty: {
						message: 'BankName is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'BankName can only consist  of alphabets and Space'
					}
				}
            },bank_ifsc: {
                validators: {
					notEmpty: {
						message: 'IFSC Code is required'
					},
					regexp: {
					 regexp: /^[A-Za-z0-9]{4}\d{7}$/,
					message: 'IFSC Code must be alphanumeric'
					}
				}
            },
			bank_documents: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            }
            }
        })
     
});
$(document).ready(function() {
    $('#otherdetails').bootstrapValidator({
        
        fields: {
            
            kyc_doc1: {
                 validators: {
					notEmpty: {
						message: 'Document Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Document Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			 kyc_file1: {
                validators: {
					
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            },kyc_doc2: {
                 validators: {
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Document Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			 kyc_file2: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            }, kyc_doc3: {
                 validators: {
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Document Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			 kyc_file3: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            }
            }
        })
     
});
</script>