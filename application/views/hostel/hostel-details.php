<?php //echo'<pre>';print_r($hostel_details);exit; ?>
<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Hostel Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
			 <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){ echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Hostel Details
</a></li>
              <li class="<?php if(isset($tab) && $tab==1){ echo "active";} ?>"><a href="#tab_2" data-toggle="tab">Hostel List</a></li>
             
            </ul>
			
            <div class="tab-content">
             <div class="tab-pane <?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">
              <form id="defaultForm" method="POST" class="" action="<?php echo base_url('Hostelmanagement/add_hosteldetails');?>">
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Hostel Name</label>
									<div class="">
										<input class="form-control" name="hostel_name" id="hostel_name"  placeholder="Enter Hostel Name">
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								<div class="form-group">
								<label class=" control-label">Hostel Type</label>
								<div class="">
								<select id="hostel_type" name="hostel_type"  class="form-control" >
								<option value="">Select</option>
								<?php foreach ($hostel_types as $list){ ?>
								<option value="<?php echo $list['h_t_id']; ?>"><?php echo $list['hostel_type']; ?></option>
								<?php }?>
								</select>
								</div>
							</div>
								
								
							</div>
						
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Warden Name</label>
									<div class="">
										<input class="form-control" name="warden_name" id="warden_name" placeholder="Enter Warden Name">
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Contact Number</label>
									<div class="">
										<input class="form-control" name="contact_number" id="contact_number" placeholder="Enter Contact Number">
									</div>
								</div>
							</div>	
						
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Address</label>
									<div class="">
										<input class="form-control" name="address"id="address" placeholder="Enter Address">
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Facilities Provided</label>
									<div class="">
										<input class="form-control" name="facilities" id="facilities" placeholder="Enter Facilities Provided">
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
              <div class="tab-pane <?php if(isset($tab) && $tab==1){ echo "active";} ?>" id="tab_2">
				 <div class="clearfix"></div>
        
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S. No</th>
                  <th>Hostel Name</th>
                  <th>Hostel Type</th>
                  <th>Warden Name</th>
                  <th>Contact Number</th>
                  <th>Address</th>
                  <th>Facilities Provided</th>
				  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
               <tbody>
				<?php $cnt=1;foreach($hostel_details as $list){ ?>
				<tr>
                  <td><?php echo $cnt; ?></td>
                  <td><?php echo $list['hostel_name']; ?></td>
                  <td><?php echo $list['username']; ?></td>
                  <td><?php echo $list['warden_name']; ?></td>
                  <td><?php echo $list['contact_number']; ?></td>
                  <td><?php echo $list['address']; ?></td>
                  <td><?php echo $list['facilities']; ?></td>
                  <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
				  <td>
					<a href="<?php echo base_url('hostelmanagement/hosteldetailsedit/'.base64_encode($list['id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
              <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" data-toggle="modal" data-target="#myModal" title="Edit"><i class="fa fa-info-circle btn btn-warning"></i></a>		
			<a href="javascript;void(0);" onclick="admindedelete('<?php echo base64_encode($list['id']) ?>');admindedeletemsg();" data-toggle="modal" data-target="#myModal" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
					</td>

                </tr>
				</tbody>
				<?php $cnt++;}?>
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



