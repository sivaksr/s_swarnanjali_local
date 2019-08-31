<?php //echo'<pre>';print_r($hostel_details);exit; ?>
<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Hostel Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
			 <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){ echo "active";} ?>"><a href="#tab_1" data-toggle="tab"> Edit Hostel Details
</a></li>
             
            </ul>
			
            <div class="tab-content">
             <div class="tab-pane active<?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">
            <form id="defaultForm" method="POST" class="" action="<?php echo base_url('Hostelmanagement/edit_hostel');?>">
			<input type="hidden" id="id" name="id" value="<?php echo $hostel_details['id'] ?>">
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Hostel Name</label>
									<div class="">
										<input class="form-control" name="hostel_name" id="hostel_name" value="<?php echo isset($hostel_details['hostel_name'])?$hostel_details['hostel_name']:''; ?>" placeholder="Enter Hostel Name">
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								<div class="form-group">
								<label class=" control-label">Hostel Type</label>
								<div class="">
								<select id="hostel_type" name="hostel_type"  class="form-control" >
										<option value="">Select</option>
										<?php if(isset($hostel_types) && count($hostel_types)>0){ ?>
											<?php foreach($hostel_types as $list){ ?>
											
													<?php if($hostel_details['hostel_type']==$list['h_t_id']){ ?>
															<option selected value="<?php echo $list['h_t_id']; ?>"><?php echo $list['hostel_type']; ?></option>
													<?php }else{ ?>
															<option value="<?php echo $list['h_t_id']; ?>"><?php echo $list['hostel_type']; ?></option>
													<?php } ?>
											<?php } ?>
										<?php } ?>
										</select>
								</div>
							</div>
								
								
							</div>
						
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Warden Name</label>
									<div class="">
										<input class="form-control" name="warden_name" id="warden_name" value="<?php echo isset($hostel_details['warden_name'])?$hostel_details['warden_name']:''; ?>" placeholder="Enter Warden Name">
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Contact Number</label>
									<div class="">
										<input class="form-control" name="contact_number" id="contact_number" value="<?php echo isset($hostel_details['contact_number'])?$hostel_details['contact_number']:''; ?>" placeholder="Enter Contact Number">
									</div>
								</div>
							</div>	
						
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Address</label>
									<div class="">
										<input class="form-control" name="address"id="address" value="<?php echo isset($hostel_details['address'])?$hostel_details['address']:''; ?>" placeholder="Enter Address">
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Facilities Provided</label>
									<div class="">
										<input class="form-control" name="facilities" id="facilities" value="<?php echo isset($hostel_details['facilities'])?$hostel_details['facilities']:''; ?>" placeholder="Enter Facilities Provided">
									</div>
								</div>
							</div>	
						</div>
						<div class="clearfix"> </div>						
						<div class="col-md-12">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group pull-right">
							  <button type="submit"  class="btn btn-primary " id="validateBtn" name="validateBtn" value="check">Save</button> &nbsp;
							  <a href="<?php echo base_url('dashboard'); ?>"  class="btn btn-warning " name="submit" value="check">Cancel</a>
							</div>
							<!-- /.input group -->
						  </div>
                        </div>
					
						<div class="clearfix">&nbsp;</div>
						
						
						
						
					
						<div class="clearfix">&nbsp;</div>
						 
						
                    </form>
              </div>
              <!-- /.tab-pane -->
              
              </div>
              <!-- /.tab-pane -->
           
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
   function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('hostelmanagement/hostalstatus/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('hostelmanagement/hostaldelete/'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
   
  
 $(document).ready(function() {
   
    $('#defaultForm').bootstrapValidator({
//      
        fields: {
			 hostel_name:{
			   validators: {
					notEmpty: {
						message: 'Hostel Name is required'
					},regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Name can only consist of alphanumeric, space and dot'
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
			warden_name:{
			   validators: {
					notEmpty: {
						message: 'Warden Name is required'
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
			address:{
			   validators: {
					notEmpty: {
						message: 'Address is required'
					},regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address wont allow <> [] = % '
					}
				}
            },
			facilities: {
                validators: {
					notEmpty: {
						message: 'Facilities Provided is required'
					}
				}
            }
			
			
        }
    });

});
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



