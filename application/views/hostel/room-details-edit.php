<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Room Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            
             <div class="" id="tab_1">
              <form id="defaultForm" method="POST" class="" action="<?php echo base_url('hostelmanagement/editroomdetails'); ?>">
						<input type="hidden" name="h_r_id" id="h_r_id" value="<?php echo isset($room_details['h_r_id'])?$room_details['h_r_id']:''; ?>">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								<label class=" control-label">Hostel Name</label>
								<div class="">
								<select id="hotel_type" name="hotel_type"  class="form-control" >
								<option value="">Select</option>
								<?php if(isset($hostel_list) && count($hostel_list)>0){ ?>
									<?php foreach($hostel_list as $list){ ?>
										<?php if($room_details['hotel_type']==$list['id']){ ?>
											<option  selected value="<?php echo $list['id']; ?>"><?php echo $list['hostel_name']; ?></option>
										<?php }else{ ?>
											<option value="<?php echo $list['id']; ?>"><?php echo $list['hostel_name']; ?></option>
										<?php } ?>
									<?php } ?>
								<?php } ?>
								</select>
								</div>
							</div>
							
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Room Name</label>
									<div class="">
										<input class="form-control" name="room_name" id="room_name" value="<?php echo isset($room_details['room_name'])?$room_details['room_name']:''; ?>" placeholder="Enter Room Name">
									</div>
								</div>
							</div>	
					
						
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Floor Number</label>
									<div class="">
										<select id="floor_number" name="floor_number"  class="form-control" >
										<option value="">Select</option>
										<?php if(isset($hostel_floors_list) && count($hostel_floors_list)>0){ ?>
											<?php foreach($hostel_floors_list as $list){ ?>
											
													<?php if($room_details['floor_id']==$list['f_id']){ ?>
															<option selected value="<?php echo $list['f_id']; ?>"><?php echo $list['floor_name']; ?></option>
													<?php }else{ ?>
															<option value="<?php echo $list['f_id']; ?>"><?php echo $list['floor_name']; ?></option>
													<?php } ?>
											<?php } ?>
										<?php } ?>
										</select>
									</div>
								</div>
								
								
							</div>	
						
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Total Beds</label>
									<div class="">
										<input class="form-control" name="total_beds" id="total_beds" value="<?php echo isset($room_details['total_beds'])?$room_details['total_beds']:''; ?>" placeholder="Enter Total Beds">
									</div>
								</div>
							</div>	
							
							<!--<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Total Beds</label>
									<div class="">
										<input class="form-control" name="total_beds" id="total_beds" value="<?php echo isset($room_details['total_beds'])?$room_details['total_beds']:''; ?>" placeholder="Enter Total Beds">
									</div>
								</div>
							</div>-->
							
						</div>
						<div class="clearfix"> </div>						
						<div class="col-md-12">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group pull-right">
							  <button type="submit"  class="btn btn-primary " id="validateBtn" name="validateBtn" value="check">Update</button> &nbsp;
							  <a href="<?php echo base_url('hostelmanagement/roomdetails/'.base64_encode(1)); ?>" type="button"  class="btn btn-warning " name="submit" value="check">Cancel</a>
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
 
  <script>
  
 $(document).ready(function() {
   
    $('#defaultForm').bootstrapValidator({
//      
        fields: {
			 hotel_type:{
			   validators: {
					notEmpty: {
						message: 'Hostel Name is required'
					}
				}
            }, 
			room_name:{
			   validators: {
					notEmpty: {
						message: 'Room Name is required'
					},regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Room Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			floor_number:{
			   validators: {
					notEmpty: {
						message: 'Floor Number is required'
					}
				}
            },
			total_beds:{
			   validators: {
					notEmpty: {
						message: 'Total Beds is required'
					},regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Total Beds can only consist of alphanumeric, space and dot'
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



  