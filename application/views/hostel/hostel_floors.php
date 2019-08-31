<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Hostel Floors</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
			 <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){ echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Hostel Floors
</a></li>
              <li class="<?php if(isset($tab) && $tab==1){ echo "active";} ?>"><a href="#tab_2" data-toggle="tab">Hostel Floors List</a></li>
             
            </ul>
			
            <div class="tab-content">
             <div class="tab-pane <?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">
              <form id="defaultForm" method="POST" class="" action="<?php echo base_url('hostelmanagement/addhostelfloors');?>">
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Hostel Floors</label>
									<div class="">
										<input class="form-control" name="floor_name" id="floor_name"  placeholder="Enter Hostel Floors">
									</div>
								</div>
							</div>	
							
						</div>
						<div class="clearfix"> </div>						
						<div class="col-md-12">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group pull-right">
							  <button type="submit"  class="btn btn-primary " name="validateBtn" id="validateBtn" value="check">Save</button> &nbsp;
							 <a  href="<?php echo base_url('dashboard'); ?>" type="button"  class="btn btn-warning " name="submit" value="">Cancel</a>
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
                  <th>Hostel Floors</th>
				  <th>Created_at</th>
				  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
               <tbody>
				<?php  foreach($hostel_floors as $list){?>
				<tr>
                 
                  <td><?php echo $list['floor_name']; ?></td>
				  <td><?php echo $list['created_at']; ?></td>
                   <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
                  
				  <td>
					<a href="<?php echo base_url('hostelmanagement/hostelfloorsedit/'.base64_encode($list['f_id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
					<a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['f_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" data-toggle="modal" data-target="#myModal" title="Edit"><i class="fa fa-info-circle btn btn-warning"></i></a>
					<a href="javascript;void(0);" onclick="admindedelete('<?php echo base64_encode($list['f_id']) ?>');admindedeletemsg();" data-toggle="modal" data-target="#myModal" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
					</td>
                </tr>
				</tbody>
			<?php }?>
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
  
  
  
  </script>
  <script type="text/javascript">
  function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('hostelmanagement/hostelfloorsstatus/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('hostelmanagement/hostelfloorsdelete/'); ?>"+"/"+id);
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
			 floor_name:{
			   validators: {
					notEmpty: {
						message: 'Hostel Floors is required'
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
