
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo isset($class_details['id'])?'Edit Class':'Add Class'; ?>  
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> <?php echo isset($class_details['id'])?'Edit Class':'Add Class'; ?> </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
		<div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab=='' || $tab==0){ echo "active"; }?>"><a href="#tab_1" data-toggle="tab">Add Class</a></li>
              <li class="<?php if(isset($tab) && $tab==1){ echo "active"; }?>"><a href="#tab_2" data-toggle="tab"> Class List</a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane <?php if(isset($tab) && $tab==''  || $tab==0){ echo "active"; }?>" id="tab_1">
              <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
             <form id="defaultForm" method="post" class="" action="<?php echo base_url('school/addclasspost'); ?>">
						<input  type="hidden" name="c_id" value="<?php echo isset($class_details['id'])?$class_details['id']:''; ?>">
						
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Class Name</label>
								<div class="">
									<input type="text" class="form-control" name="name" id="name" placeholder="Enter Class Name" value="<?php echo isset($class_details['name'])?$class_details['name']:''; ?>" />
								</div>
							</div>
                        </div>
						
						
						         <div class="col-md-6">
									<div class="form-group">
									<label class=" control-label">Teacher Module</label>
										<div class="">
											<select name="teacher_module" id="teacher_module" onchange="get_class_name_list(this.value)" class="form-control">
												<option value="">Select</option>
										<?php if(isset($teacher_modules) && count($teacher_modules)>0){ ?>
											<?php foreach($teacher_modules as $list){ ?>
											
													<?php if($class_details['teacher_module']==$list['t_m_id']){ ?>
															<option selected value="<?php echo $list['t_m_id']; ?>"><?php echo $list['modules']; ?></option>
													<?php }else{ ?>
															<option value="<?php echo $list['t_m_id']; ?>"><?php echo $list['modules']; ?></option>
													<?php } ?>
											<?php } ?>
										<?php } ?>
										</select>
										</div>
									</div>
								</div>           
						
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Class Section</label>
								<div class="">
									<input type="text" class="form-control" name="section" id="section" placeholder="Enter Class Section" value="<?php echo isset($class_details['section'])?$class_details['section']:''; ?>" />
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Class Capacity</label>
								<div class="">
									<input type="text" class="form-control" name="capacity" id="capacity" placeholder="Enter Class Capacity" value="<?php echo isset($class_details['capacity'])?$class_details['capacity']:''; ?>" />
								</div>
							</div>
                        </div>
						
						
						
						
					
						<div class="clearfix">&nbsp;</div>
						  <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-10">
                                <button type="submit" class="btn btn-primary" name="signup" value="Sign up"><?php echo isset($class_details['id'])?'Update Class':'Add Class'; ?></button>
								<a href="<?php echo base_url('dashboard'); ?>" type="submit" class="btn btn-warning" >Back</a>
                                
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
				  <th>#</th>
                  <th>Type</th>
                  <th>Name</th>
                  <th>Section</th>
                  <th>capacity</th>
                  <th>Created Date </th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php if(isset($class_list) && count($class_list)>0){ ?>
						<?php $cnt=1;foreach($class_list as $list){ ?>
							<tr>
								  <td style="display:none"><?php echo htmlentities($list['id']); ?></td>
								  <td><?php echo $cnt; ?></td>
								  <td><?php echo $list['modules']; ?></td>
								  <td><?php echo $list['name']; ?></td>
								  <td><?php echo $list['section']; ?></td>
								  <td><?php echo $list['capacity']; ?></td>
								  <td><?php echo date('d-m-Y',strtotime(htmlentities($list['create_at'])));?></td>
								  <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
								  <td>
									  <a href="<?php echo base_url('school/class_lists/'.base64_encode(0).'/'.base64_encode($list['id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
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
				   <th>Type</th>
                  <th>Name</th>
                  <th>Section</th>
                  <th>capacity</th>
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
<script>
function get_class_name_list(teacher_module){
	if(teacher_module!=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('school/get_class_name_list');?>",
   			data: {
				teacher_module: teacher_module,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
							//alert(parsedData);
							$('#name').empty();
							$('#name').append("<option value=''>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								$('#name').append("<option value="+parsedData.list[i].class_name+">"+parsedData.list[i].class_name+"</option>");                      

							}
						}
						
   					}
           });
	   }
}

</script>
 
 <script>

 function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('school/classstatus'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('school/classdelete'); ?>"+"/"+id);
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
//       
        fields: {
			teacher_module: {
                validators: {
					notEmpty: {
						message: 'Teacher Module is required'
					},
					
				}
            },
			class_id: {
                validators: {
					notEmpty: {
						message: 'Class is required'
					},
					
				}
            },
            name: {
                validators: {
					notEmpty: {
						message: 'Class Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Class Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			section: {
                validators: {
					notEmpty: {
						message: 'Class Section is required'
					},
					regexp: {
                        regexp: /^[a-zA-Z0-9. ]+$/,
						message: 'Class Section can only consist of alphanumeric, space and dot'
                    }
				
				}
            },
            capacity: {
                validators: {
					notEmpty: {
						message: 'Capacity is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Capacity can only consist of alphanumeric, space and dot'
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