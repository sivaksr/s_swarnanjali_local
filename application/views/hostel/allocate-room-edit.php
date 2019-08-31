<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Allocate Room </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            
             <div class="tab-pane <?php if(isset($tab) && $tab==''){  echo "active";} ?>" id="tab_1">
              <form id="defaultForm" name="defaultForm" method="POST" class="" action="<?php echo base_url('hostelmanagement/editallottedpost');?>">
				<input type="hidden" id="a_r_id" name="a_r_id" value="<?php echo $allocaterrom_details['a_r_id']; ?>">		
						<div class="row">
							<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class=" control-label">Registration Type</label>
									<div class="">
									<select onchange="get_type(this.value);" id="registration_type" name="registration_type" value="<?php echo isset($allocaterrom_details['registration_type'])?$allocaterrom_details['registration_type']:''; ?>" class="form-control" >
									<option value="">Select</option>
									<option value="Staff" <?php if($allocaterrom_details['registration_type']=='Staff'){  echo "selected"; }?> >Staff</option>
									<option value="Student" <?php if($allocaterrom_details['registration_type']=='Student'){  echo "selected"; }?>>Student</option>
									
									</select>
									</div>
								</div>
							</div>	
							<div class="col-md-3">
								<div class="form-group">
								<label class=" control-label">Hostel Type</label>
								<div class="">
								<select id="hostel_type" name="hostel_type"  class="form-control"  >
								<option value="">Select</option>
								<?php foreach ($hostel_room_name as $list){ ?>
								<?php if($list['id']==$allocaterrom_details['hostel_type']){ ?>
								<option selected value="<?php echo $list['id']; ?>"><?php echo $list['hostel_name']; ?></option>
								<?php }else{ ?>
								<option value="<?php echo $list['id']; ?>"><?php echo $list['hostel_name']; ?></option>
								 <?php } ?>
				                  <?php }?>
								</select>
								</div>
							</div>
								
							</div>
							<div class="col-md-3">
								<div class="form-group">
								<label class=" control-label">Floor Number</label>
								<div class="">
								<select id="floor_name" name="floor_name"  class="form-control"  >
								<option value="">Select</option>
								<?php foreach ($floor_list as $list){ ?>
								<?php if($list['f_id']==$allocaterrom_details['floor_name']){ ?>
								<option selected value="<?php echo $list['f_id']; ?>"><?php echo $list['floor_name']; ?></option>
								<?php }else{ ?>
								<option value="<?php echo $list['f_id']; ?>"><?php echo $list['floor_name']; ?></option>
								 <?php } ?>
				                  <?php }?>
								</select>
								</div>
							</div>	
							</div>
							<div class="col-md-3">
								<div class="form-group">
								<label class=" control-label">Room Number</label>
								<div class="">
								<select id="room_numebr" name="room_numebr"  onchange="get_romm_wise_bed_list(this.value)" class="form-control"  >
								<option value="">Select</option>
								<?php foreach ($room_number_list as $list){ ?>
								<?php if($list['h_r_id']==$allocaterrom_details['room_numebr']){ ?>
								<option selected value="<?php echo $list['h_r_id']; ?>"><?php echo $list['room_name']; ?></option>
								<?php }else{ ?>
								<option value="<?php echo $list['h_r_id']; ?>"><?php echo $list['room_name']; ?></option>
								 <?php } ?>
				                  <?php }?>
								</select> 
								</div>
							</div>		
							</div>
							</div>
							<div class="row">
							
							<div class="col-md-4">
							
							<div class="form-group">
								<label class=" control-label">Allot Bed</label>
								<div class="">
								<select id="allot_bed" name="allot_bed"  class="form-control"  >
								<option value="">Select</option>
								<?php foreach ($bed_details as $list){ ?>
								<?php if($list['total_beds']==$allocaterrom_details['allot_bed']){ ?>
								<option selected value="<?php echo $list['total_beds']; ?>"><?php echo $list['total_beds']; ?></option>
								<?php }else{ ?>
								<option value="<?php echo $list['total_beds']; ?>"><?php echo $list['total_beds']; ?></option>
								 <?php } ?>
				                  <?php }?>
								</select> 
								</div>
							</div>	
							
							
							
								
							</div>
							
							
							
							
							<div id="retur_type_div">
							<div class="col-md-4">
							
							<div class="form-group">
								<label class=" control-label">Class list</label>
								<div class="">
								<select id="class_id" name="class_id" onchange="get_student_list(this.value);" class="form-control"  >
								<option value="">Select</option>
								<?php foreach ($class_list as $list){ ?>
								<?php if($list['id']==$allocaterrom_details['class_id']){ ?>
								<option selected value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
								<?php }else{ ?>
								<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
								 <?php } ?>
				                  <?php }?>
								</select>
								</div>
							</div>
                        </div>
						
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Student Name</label>
								<div class="">
									<select id="student_name" name="student_name"  class="form-control"  >
									<option value="">Select</option>
									<?php foreach ($student_name as $list){ ?>
								<?php if($list['u_id']==$allocaterrom_details['student_name']){ ?>
									<option  selected value="<?php echo $list['u_id']; ?>"><?php echo $list['name']; ?></option>
								<?php }else{ ?>
									<option value="<?php echo $list['u_id']; ?>"><?php echo $list['name']; ?></option>
								<?php } ?>
							<?php }?>
									</select>
								</div>
							</div>
							
							
                        </div>	
						</div>
						
						<div id="div_id">
							<div class="col-md-4">
								<div class="form-group">
									<label class=" control-label">Staff Name</label>
									<div class="">
										<input class="form-control" name="staff_name" id="staff_name" value="<?php echo isset($allocaterrom_details['staff_name'])?$allocaterrom_details['staff_name']:''?>" placeholder="Enter Staff Name">
									</div>
								</div>
							</div>
							</div>
						
						
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Gender</label>
									<div class="">
									<select id="gender" name="gender" value="<?php echo isset($allocaterrom_details['gender'])?$allocaterrom_details['gender']:''; ?>" class="form-control" >
									<option value="">Select</option>
									<option value="Male"<?php if($allocaterrom_details['gender']=='Male'){  echo "selected"; }?>>Male</option>
									<option value="Female" <?php if($allocaterrom_details['gender']=='Female'){  echo "selected"; }?>>Female</option>
									
									</select>
									</div>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Contact Number</label>
									<div class="">
										<input class="form-control" name="contact_number" id="contact_number" value="<?php echo isset($allocaterrom_details['contact_number'])?$allocaterrom_details['contact_number']:''; ?>" placeholder="Contact Number">
									</div>
								</div>
							</div>
							
							
							
							</div>
							<div class="row">
							
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Date of birth</label>
									<div class="">
										<input class="form-control" name="dob" id="datepicker" autocomplete="off"  value="<?php echo isset($allocaterrom_details['dob'])?$allocaterrom_details['dob']:''; ?>" placeholder="MM/DD/YYYY">
									</div>
								</div>
							</div>	
							</div>	
							<div class="row">
								<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Joining Date</label>
									<div class="">
										<input class="form-control" name="joining_date" id="datepicker1" autocomplete="off"  value="<?php echo isset($allocaterrom_details['joining_date'])?$allocaterrom_details['joining_date']:''; ?>" placeholder="MM/DD/YYYY">
									</div>
								</div>
							</div>
						
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Till Date</label>
									<div class="">
										<input class="form-control" name="till_date" id="datepicker2" autocomplete="off"  value="<?php echo isset($allocaterrom_details['till_date'])?$allocaterrom_details['till_date']:''; ?>" placeholder="MM/DD/YYYY">
									</div>
								</div>
							</div>
							</div>
							<div class="row">
								<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Charge per month</label>
									<div class="">
										<input class="form-control" name="charge_per_month" id="charge_per_month" value="<?php echo isset($allocaterrom_details['charge_per_month'])?$allocaterrom_details['charge_per_month']:''; ?>" placeholder="Enter Charge per month">
									</div>
								</div>
							</div>
						<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Number of Months</label>
									<div class="">
										<input class="form-control" name="no_of_months" id="no_of_months" placeholder="Enter Number of Months" value="<?php echo isset($allocaterrom_details['no_of_months'])?$allocaterrom_details['no_of_months']:''; ?>">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Paid Amount</label>
									<div class="">
										<input class="form-control" name="paid_amount" id="paid_amount" placeholder="Enter Paid Amount" value="<?php echo isset($allocaterrom_details['paid_amount'])?$allocaterrom_details['paid_amount']:''; ?>">
									</div>
								</div>
							</div>
							</div>
							
							<div class="col-md-12">
								<h3>Guardian Details</h3>
							</div>
							<div class="row">
								<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Guardian Name</label>
									<div class="">
										<input class="form-control" name="guardian_name" id="guardian_name" value="<?php echo isset($allocaterrom_details['guardian_name'])?$allocaterrom_details['guardian_name']:''; ?>" placeholder="Enter Guardian Name">
									</div>
								</div>
							</div>
						
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Guardian Contact Number</label>
									<div class="">
										<input class="form-control" name="g_contact_number" id="g_contact_number" value="<?php echo isset($allocaterrom_details['g_contact_number'])?$allocaterrom_details['g_contact_number']:''; ?>" placeholder="Enter Guardian Contact Number">
									</div>
								</div>
							</div>
							</div>
							<div class="row">
								<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Relation</label>
									<div class="">
										<input class="form-control" name="relation" id="relation" value="<?php echo isset($allocaterrom_details['relation'])?$allocaterrom_details['relation']:''; ?>" placeholder="Enter Relation">
									</div>
								</div>
							</div>
						
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Email </label>
									<div class="">
										<input type="email" class="form-control" name="email" id="email" value="<?php echo isset($allocaterrom_details['email'])?$allocaterrom_details['email']:''; ?>" placeholder="Email ">
									</div>
								</div>
							</div>
							</div>
							<div class="row">
								<div class="col-md-12">
								<div class="form-group">
									<label class=" control-label">Address</label>
									<div class="">
										<textarea class="form-control" name="address" id="address" placeholder="Enter Address"><?php echo isset($allocaterrom_details['address'])?$allocaterrom_details['address']:''; ?></textarea>
									</div>
								</div>
								</div>
							</div>
						</div>
					
						
					
						<div class="clearfix"> </div>						
						<div class="col-md-12">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group pull-right">
							  <button type="submit"  class="btn btn-primary " name="validateBtn" id="validateBtn" value="check">Add</button> &nbsp;
							  <a  href="<?php echo base_url('dashboard'); ?>" type="button"  class="btn btn-warning " name="submit" value="check">Cancel</a>
							</div>
							<!-- /.input group -->
						  </div>
                        </div>
					
						<div class="clearfix">&nbsp;</div>
						
						
						
						
					
						<div class="clearfix">&nbsp;</div>
						 
						
                    </form>
              </div>
              <!-- /.tab-pane -->
             <div class="tab-pane  <?php if(isset($tab) && $tab==1){  echo "active";} ?>" id="tab_2">
				 <div class="clearfix"></div>
        
           
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
       
          <!-- /.box -->
		   <div class="clearfix"></div>
          </div>
		 
          </div>
          <!-- /.box -->

         

        </div>
      
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
	  
    </section> 
   
</div>
 
  <script type="text/javascript">
  function get_type(val){
	  
	  if(val=='Student'){
		 $('#retur_type_div').show(); 
		 $('#div_id').hide();
		 $('#staff_name').val(''); 
	  }else if(val=='Staff'){
		  $('#div_id').show();
		  $('#retur_type_div').hide(); 
		  $('#class_id').val(''); 
		  $('#student_name').val(''); 
	  }
	  
  }
  
  
  $('#registration_type').keyup(function() {
  
  if ($(this).val().length == 5) {
    $('#retur_type_div').hide();
	$('#class_id').val('');
	$('#student_name').val('');
  } else {
    $('#retur_type_div').show();
  }
}).keyup(); 
  function get_romm_wise_bed_list(room_numebr){
	if(room_numebr !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('hostelmanagement/get_romm_wise_bed_list');?>",
   			data: {
				room_numebr: room_numebr,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						if(data.msg=1){
							var parsedData = JSON.parse(data);
							$('#allot_bed').empty();
							$('#allot_bed').append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								$('#allot_bed').append("<option value="+parsedData.list[i].total_beds+">"+	parsedData.list[i].total_beds+"</option>"); 
							}
						}
   					}
           });
	   }
}

  
  
  
    function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('hostelmanagement/allocateroomstatus'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('hostelmanagement/allocateroomdelete'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
  function get_room_number_list(floor_number){
	if(floor_number!=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('hostelmanagement/get_room_number_list');?>",
   			data: {
				floor_number: floor_number,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
							//alert(parsedData);
							$('#room_numebr').empty();
							$('#room_numebr').append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								$('#room_numebr').append("<option value="+parsedData.list[i].h_r_id+">"+parsedData.list[i].room_name+"</option>");                      

							}
						}
						
   					}
           });
	   }
}
 $(document).ready(function() {
   $('#datepicker1').datepicker({
      autoclose: true
    });
	$('#datepicker2').datepicker({
      autoclose: true
    });
    $('#defaultForm').bootstrapValidator({
//      
        fields: {
			 registration_type:{
			   validators: {
					notEmpty: {
						message: 'Registration Type is required'
					}
				}
            },
            staff_name:{
			validators: {
					notEmpty: {
						message: 'Staff Name is required'
					}
				}
            }, 				
			hostel_type:{
			   validators: {
					notEmpty: {
						message: 'Hostel Type is required'
					}
				}
            },
			floor_name:{
			   validators: {
					notEmpty: {
						message: 'Floor Number is required'
					}
				}
            },
			room_numebr:{
			   validators: {
					notEmpty: {
						message: 'Room Number is required'
					}
				}
            },
			class_id:{
			   validators: {
					notEmpty: {
						message: 'Class list is required'
					}
				}
            },
			student_name:{
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
			gender:{
			   validators: {
					notEmpty: {
						message:'Gender is required'
					}
				}
            },
			contact_number:{
			   validators: {
					notEmpty: {
						message:'Contact Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10}$/,
					message:'Contact Number must be 10 digits'
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
			joining_date: {
                validators: {
					notEmpty: {
								message: 'Joining Date is required'
						},
					date: {
                        format: 'MM/DD/YYYY',
                        message: 'The value is not a valid date'
                    }
				
				}
            },
			till_date: {
                validators: {
					notEmpty: {
								message: 'Till Date is required'
						},
					date: {
                        format: 'MM/DD/YYYY',
                        message: 'The value is not a valid date'
                    }
				
				}
            },
			allot_bed: {
                validators: {
					notEmpty: {
						message: 'Allot Bed is required'
					}
				}
            },
			charge_per_month: {
                validators: {
					notEmpty: {
						message: 'Charge per month is required'
					}
				}
            },
			no_of_months: {
                validators: {
					notEmpty: {
						message: 'Number of Months is required'
					},regexp: {
   					regexp:  /^[0-9]*$/,
   					message:'Number of Months must be digits'
   					}
				}
            },
			paid_amount:{
			validators: {
					notEmpty: {
						message: 'Paid Amount is required'
					},regexp: {
   					regexp:  /^[0-9]*$/,
   					message:'Paid Amount must be digits'
   					}
				}
            },	
			guardian_name: {
                validators: {
					notEmpty: {
						message: 'Guardian Name is required'
					},regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Guardian Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			g_contact_number: {
                validators: {
					notEmpty: {
						message: 'Guardian Contact Number is required'
					},regexp: {
					regexp:  /^[0-9]{10}$/,
					message:'Guardian Contact Number must be 10 digits'
					}
				}
            },
			relation: {
                validators: {
					notEmpty: {
						message: 'Relation is required'
					},regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Relation can only consist of alphanumeric, space and dot'
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
			address:{
			   validators: {
					notEmpty: {
						message: 'Address is required'
					},regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address wont allow <> [] = % '
					}
				}
            }
			
			
        }
    });
$('#datepicker').on('changeDate ', function(e) {
		$('#defaultForm').bootstrapValidator('revalidateField', 'dob');
		});
		$('#datepicker1').on('changeDate ', function(e) {
		$('#defaultForm').bootstrapValidator('revalidateField', 'joining_date');
		});
		$('#datepicker2').on('changeDate ', function(e) {
		$('#defaultForm').bootstrapValidator('revalidateField', 'till_date');
		});
});
</script>
<script>
function get_student_list(class_id){
	if(class_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('hostelmanagement/class_student_list');?>",
   			data: {
				class_id: class_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#student_name').empty();
							$('#student_name').append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#student_name').append("<option value="+parsedData.list[i].u_id+">"+parsedData.list[i].name+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}
</script>
<script>
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



