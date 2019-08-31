<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Room Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
			
			 <li class="<?php if(isset($tab) && $tab==0){  echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Add New Room</a></li>
               <li class="<?php if(isset($tab) && $tab==1){  echo "active";} ?>"><a href="#tab_2" data-toggle="tab">Room Details List</a></li>
			 
            </ul>
            <div class="tab-content">
             <div class="tab-pane <?php if(isset($tab) && $tab==''){  echo "active";} ?>" id="tab_1">
              <form id="defaultForm" method="POST" class="" action="<?php echo base_url('hostelmanagement/addroomdetails'); ?>">
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								<label class=" control-label">Hostel Name</label>
								<div class="">
								<select id="hotel_type" name="hotel_type"  class="form-control" >
								<option value="">Select</option>
								<?php if(isset($hostel_list) && count($hostel_list)>0){ ?>
									<?php foreach($hostel_list as $list){ ?>
										<option value="<?php echo $list['id']; ?>"><?php echo $list['hostel_name']; ?></option>
										
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
										<input class="form-control" name="room_name" id="room_name" placeholder="Enter Room Name">
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
												<option value="<?php echo $list['f_id']; ?>"><?php echo $list['floor_name']; ?></option>
											
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
										<input class="form-control" name="total_beds" id="total_beds" placeholder="Enter Total Beds">
									</div>
								</div>
							</div>	
							<!--<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Fee for Each Bed</label>
									<div class="">
										<input class="form-control"  placeholder="Enter Bed Fee">
									</div>
								</div>
							</div>-->	
						</div>
						<div class="clearfix"> </div>						
						<div class="col-md-12">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group pull-right">
							  <button type="submit"  class="btn btn-primary " id="validateBtn" name="validateBtn" value="check">Add</button> &nbsp;
							  <a href="<?php echo base_url('dashboard'); ?>" type="button"  class="btn btn-warning " name="submit" value="check">Cancel</a>
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
        
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
                  <th>S. No</th>
                  <th>Hostel Name</th>
                  <th>Room Name</th>
                  <th>Floor Number</th>
                  <th>Total Beds</th>
                  <th>Action</th>
                </tr>
                </thead>
                  <tbody>
				<?php if(isset($room_list) && count($room_list)>0){ ?>
					<?php $count=1;foreach($room_list as $list){ ?>
						<tr>
						  <td><?php echo $count; ?></td>
						  <td><?php echo $list['hostel_name']; ?></td>
						  <td><?php echo $list['room_name']; ?></td>
						  <td><?php echo $list['floor_name']; ?></td>
						  <td><?php echo $list['total_beds']; ?></td>
						  <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
						
				         <td>
						 <a href="<?php echo base_url('hostelmanagement/roomdetails_edit/'.base64_encode($list['h_r_id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
						<a href="<?php echo base_url('hostelmanagement/roomstatus/'.$list['h_r_id'].'/'.$list['status']);?>"data-toggle="tooltip" title="Status"><i class="fa fa-info-circle btn btn-warning"></i></a>
						<a href="<?php echo base_url('hostelmanagement/roomdelete/'.$list['h_r_id']);?>"  data-toggle="tooltip" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
					     </td>
				  
				   
						</tr>
					
					<?php $count++;} ?>
				<?php } ?>
			
				</tbody>
             
              </table>
            </div>
            <!-- /.box-body -->
          </div>
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
	$(".popid").attr("href","<?php echo base_url('hostelmanagement/roomstatus/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('hostelmanagement/roomdelete/'); ?>"+"/"+id);
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



  