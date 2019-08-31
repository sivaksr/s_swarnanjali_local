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
              <li class="<?php if(isset($tab) && $tab==''){ echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Edit Hostel Details
</a></li>
           
			</ul>
            <div class="tab-content">
             <div class="tab-pane active id="tab_1">
              <form id="defaultForm1" method="POST" class="" action="<?php echo base_url('hostelmanagement/edithosteltype');?>">
			  <input type="hidden" id="h_t_id" name="h_t_id" value="<?php echo $hostel_type_list['h_t_id'] ?>">
						<div class="row">
							
							<div class="col-md-6">
								<div class="col-md-6">
								<div class="form-group">
									<label class=" control-label">Hostel Type</label>
									<div class="">
										<input class="form-control" name="hostel_type" id="hostel_type" value="<?php echo isset($hostel_type_list['hostel_type'])?$hostel_type_list['hostel_type']:''; ?>"  placeholder="Enter Hostel Type">
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
							  <button type="submit"  class="btn btn-primary " name="submit" value="check">Save</button> &nbsp;
							  <a href="<?php echo base_url('dashboard'); ?>" type="submit"  class="btn btn-warning " name="submit" value="">Cancel</a>
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
  
$(document).ready(function() {
   
    $('#defaultForm').bootstrapValidator({
//      
        fields: {
			 hostel_type:{
			   validators: {
					notEmpty: {
						message: 'Hostel Type is required'
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