
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo isset($details['id'])?'Edit Class Times':'Add Class Times'; ?>  
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> <?php echo isset($details['id'])?'Edit Class Times':'Add Class Times'; ?> </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
		<div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab=='' || $tab==0){ echo "active"; }?>"><a href="#tab_1" data-toggle="tab">Add Class Times</a></li>
              <li class="<?php if(isset($tab) && $tab==1){ echo "active"; }?>"><a href="#tab_2" data-toggle="tab"> Class Times List</a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane <?php if(isset($tab) && $tab==''  || $tab==0){ echo "active"; }?>" id="tab_1">
              <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
             <form id="defaultForm" method="post" class="" action="<?php echo base_url('school/addclass_timepost'); ?>">
				<input type="hidden" name="time_id" value="<?php echo isset($details['id'])?$details['id']:''; ?>">
			 <!--<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label"> Class</label>
										<div class="">
											<select id="class_id" name="class_id" onchange="get_student_subject_list(this.value);"   class="form-control">
												<option value="">Select Class</option>
												<?php foreach($class_list as $list){ ?>
													<?php if($details['class_id']==$list['id']){ ?>
														<option selected value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
													<?php }else{ ?>
															<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
													<?php } ?>
												<?php } ?>
											</select>
										</div>
									</div>
                        </div>-->
						
			 <div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">From Time</label>
								<div class="">
									<input placeholder="Enter From Time"  name="form_time" class="form-control" value="<?php echo isset($details['form_time'])?$details['form_time']:''?>">
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">To Time</label>
								<input placeholder="Enter From To" name="to_time" class="form-control"  value="<?php echo isset($details['to_time'])?$details['to_time']:''?>">
							</div>
                        </div>
						
						
						
					
						<div class="clearfix">&nbsp;</div>
						  <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-10">
                                <button type="submit" class="btn btn-primary" name="signup" value="Sign up"><?php echo isset($details['id'])?'Update':'submit'; ?></button>
                                
                            </div>
                        </div>
						
                    </form>
					<div class="clearfix">&nbsp;</div>
				</div>
				</div>
                
              </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane <?php if(isset($tab) && $tab==1){ echo "active"; }?>" id="tab_2">
			
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="display:none">id </th>
				  <th>S.no</th>
                  <th>From Time </th>
                  <th>To Time</th>
                  <th>Created Date </th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php if(isset($time_list) && count($time_list)>0){ ?>
						<?php $cnt=1;foreach($time_list as $list){ ?>
							<tr>
								  <td style="display:none"><?php echo htmlentities($list['id']); ?></td>
								  <td><?php echo $cnt; ?></td>
								  <td><?php echo $list['form_time']; ?></td>
								  <td><?php echo $list['to_time']; ?></td>
								  <td><?php echo date('d-m-Y',strtotime(htmlentities($list['create_at'])));?></td>
								  <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
								  <td>
									  <a href="<?php echo base_url('school/class-times/'.base64_encode(0).'/'.base64_encode($list['id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
									  <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" data-toggle="modal" data-target="#myModal" title="Edit"><i class="fa fa-info-circle btn btn-warning"></i></a>
									  <a href="javascript;void(0);" onclick="admindedelete('<?php echo base64_encode($list['id']) ?>');admindedeletemsg();" data-toggle="modal" data-target="#myModal" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
								</td>
							</tr>
							 
							  
						<?php $cnt++;} ?>
				
				<?Php } ?>
                
                
                </tbody>
                <tfoot>
                  <tr>
				  <th style="display:none">id </th>
				  <th>#</th>
                  <th>From Time</th>
                  <th>To Time</th>
                  <th>Created Date </th>
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
	$(".popid").attr("href","<?php echo base_url('school/classs_timetatus'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('school/classtimedelete'); ?>"+"/"+id);
}




  $(function () {
    $("#example1").DataTable({
		 "order": [[0, "desc" ]]
	});

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
      fields: {
            class_id: {
                validators: {
					notEmpty: {
						message: 'class is required'
					}
				}
            },
			form_time: {
                validators: {
					notEmpty: {
						message: 'From Time is required'
					}
				}
            },
			to_time: {
                validators: {
					notEmpty: {
						message: 'To Time is required'
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



</script>