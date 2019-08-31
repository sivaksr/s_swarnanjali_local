
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Resources  
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="<?php echo base_url('resource/index/'.base64_encode(1)); ?>"> Resources List</a></li>
        <li class="active"> Edit Resources </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
		<div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
           
            <div class="tab-content">
              <div class="" id="tab_1">
              <form id="defaultForm" method="post" class="" action="<?php echo base_url('resource/editpost'); ?>" enctype="multipart/form-data">
					<?php $csrf = array(
								'name' => $this->security->get_csrf_token_name(),
								'hash' => $this->security->get_csrf_hash()
						); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							      <input type="hidden" id="u_id" name="u_id" value="<?php echo isset($resources_details['u_id'])?$resources_details['u_id']:''; ?>">

						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Role</label>
								<div class="">
								<select id="role_id" name="role_id" class="form-control">
								<option value=""> Select</option>
									<?php foreach($role_list as $list){ ?>
									
										<?php if($resources_details['role_id']== $list['id']){ ?>
												<option selected value="<?php echo $list['id']; ?>"> <?php echo $list['name']; ?></option>
										<?php }else{ ?>
											<option value="<?php echo $list['id']; ?>"> <?php echo $list['name']; ?></option>
										<?php } ?>
									<?php } ?>
									
								</select>
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Name</label>
								<div class="">
									<input type="text" class="form-control" name="name" id="name" value="<?php echo isset($resources_details['name'])?$resources_details['name']:''; ?>" placeholder="Enter Name" />
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Email</label>
								<div class="">
									<input type="text" class="form-control" name="email" value="<?php echo isset($resources_details['email'])?$resources_details['email']:''; ?>" id="email" placeholder="Enter Email" />
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
									if($resources_details['gender'] == $status):
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
									<input type="text" class="form-control" name="phone" id="phone" value="<?php echo isset($resources_details['mobile'])?$resources_details['mobile']:''; ?>" placeholder="Enter Mobile  number" />
								</div>
							</div>
                        </div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Qualification</label>
								<div class="">
									<input type="text" class="form-control" name="qalification" id="qalification" value="<?php echo isset($resources_details['qalification'])?$resources_details['qalification']:''; ?>" placeholder="Enter Qualification" />
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Address</label>
								<div class="">
									<input type="text" class="form-control" name="address" id="address" value="<?php echo isset($resources_details['address'])?$resources_details['address']:''; ?>" placeholder="Enter Address" />
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Notes</label>
								<div class="">
									<input type="text" class="form-control" id="notes" name="notes" value="<?php echo isset($resources_details['notes'])?$resources_details['notes']:''; ?>" placeholder="Enter Notes" />
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
                                <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Update</button>
								<a href="<?php echo base_url('resource/index/'.base64_encode(1)); ?>" type="submit" class="btn btn-warning" >Back</a>
                                
                            </div>
                        </div>
					<div class="clearfix">&nbsp;</div>

						
                    </form>
                
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
            },
			gender: {
                validators: {
					notEmpty: {
						message: 'Gender is required'
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