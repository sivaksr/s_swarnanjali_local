<div class="content-wrapper">
 <section class="content-header">
      <h1><?php echo isset($details['id'])?'Edit Slots':'Add Slots'; ?>  
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> <?php echo isset($details['id'])?'Edit Slots':'Add Slots'; ?> </li>
      </ol>
    </section>
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Assign time slot to Teacher</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
            <form id="defaultForm" method="post" class="" action="<?php echo base_url('classwise/addtimeslot'); ?>">
				<input type="hidden" name="timeslot_id" value="<?php echo isset($details['id'])?$details['id']:''; ?>">
			
						<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label">Day</label>
										<div class="">
											<select id="day" name="day" class="form-control">
												<option value="">Select Day</option>
												<option value="Monday" <?php if(isset($details['day']) && $details['day']=='Monday'){ echo "selected"; } ?>>Monday</option>
												<option value="Tuesday"<?php if(isset($details['day']) && $details['day']=='Tuesday'){ echo "selected"; } ?>>Tuesday</option>
												<option value="Wednesday"<?php if(isset($details['day']) && $details['day']=='Wednesday'){ echo "selected"; } ?>>Wednesday</option>
												<option  value="Thursday"<?php if(isset($details['day']) && $details['day']=='Thursday'){ echo "selected"; } ?>>Thursday</option>
												<option value="Friday"<?php if(isset($details['day']) && $details['day']=='Friday'){ echo "selected"; } ?>>Friday</option>
												<option value="Saturday"<?php if(isset($details['day']) && $details['day']=='Saturday'){ echo "selected"; } ?>>Saturday</option>
												<option value="Sunday"<?php if(isset($details['day']) && $details['day']=='Sunday'){ echo "selected"; } ?>>Sunday</option>
												
											</select>
										</div>
									</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label"> Slot Time</label>
										<div class="">
								<select id="time" name="time"    class="form-control">
								<option value="">Select Slot Time</option>
										<?php foreach($timings_list as $list){ ?>
													<?php if($details['time']==$list['id']){ ?>
														<option selected value="<?php echo $list['id']; ?>"><?php echo $list['form_time'].' '.$list['to_time']; ?></option>
													<?php }else{ ?>
															<option value="<?php echo $list['id']; ?>"><?php echo $list['form_time'].' '.$list['to_time']; ?></option>
													<?php } ?>
												<?php } ?>
												</select>										
										</div>
									</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label"> Class</label>
										<div class="">
											<select id="class_id" name="class_id" onchange="get_student_subject_list(this.value); get_teacher_modules_type(this.value); get_class_wise_teachers(this.value);"   class="form-control">
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
                        </div>
						
						<div class="col-md-4">
									<div class="form-group">
									<label class=" control-label">Teacher Module</label>
										<div class="">
											<select class="form-control" name="teacher_module" id="teacher_module" onchange="class_names_lists(this.value);">
												<option value="">Select</option>
												<?php foreach($teacher_modules as $list){ ?>
												<?php if($details['teacher_module']==$list['teacher_module']){ ?>
														<option selected value="<?php echo $list['teacher_module']; ?>"><?php echo $list['modules']; ?></option>
													<?php }else{ ?>
															<option value="<?php echo $list['teacher_module']; ?>"><?php echo $list['modules']; ?></option>
													<?php } ?>
												<?php } ?>
											
											</select>
										</div>
									</div>
								</div>  
						
						<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label">Subject</label>
										<div class="">
											<select id="subject" name="subject"   class="form-control">
												<option value="">Select Subject</option>
												<?php foreach($subjects_list as $list){ ?>
													<?php if($details['subject']==$list['id']){ ?>
														<option selected value="<?php echo $list['id']; ?>"><?php echo $list['subject']; ?></option>
													<?php }else{ ?>
															<option value="<?php echo $list['id']; ?>"><?php echo $list['subject']; ?></option>
													<?php } ?>
												<?php } ?>
											</select>
										</div>
									</div>
                        </div>	
						<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label">Teacher</label>
										<div class="">
											<select id="teacher" name="teacher" class="form-control">
												<option value="">Select Teacher</option>
												<?php foreach($teachers_list as $list){ ?>
													<?php if($details['teacher']==$list['u_id']){ ?>
														<option selected value="<?php echo $list['u_id']; ?>"><?php echo $list['name']; ?></option>
													<?php }else{ ?>
														<option value="<?php echo $list['u_id']; ?>"><?php echo $list['name']; ?></option>

													<?php } ?>
												<?php } ?>
											</select>
										</div>
									</div>
                        </div>
						
						
						
					
						<div class="clearfix">&nbsp;</div>
						  <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-10">
                                <button type="submit" class="btn btn-primary" name="signup" value="Sign up"><?php echo isset($details['id'])?'Update':'Add'; ?></button>
								<!--<a href="<?php echo base_url('dashboard'); ?>" type="submit" class="btn btn-warning" >Cancel</a>-->

								
                                
                            </div>
                        </div>
						
                    </form>
					<div class="clearfix">&nbsp;</div>
					
					<div class="box">
            <div class="box-header">
              <h3 class="">List of Slots for All Teachers</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
			<form id="default" method="post" class="" action="<?php echo base_url('classwise/prints');?>">
			<div class="row" style="position:absolute;left:40%;z-index:1024">
			<div class="col-md-10" >
			<div class="form-group">
			<select class="form-control"  name="class_id"  id="class_id"   >
				<option value="">Select Class</option>
				<?php foreach($class_list as $list){ ?>
				<option value="<?php echo $list['id'];?>"><?php echo $list['name'].' '.$list['section'];?></option>
				<?php } ?>
			</select>
			</div>
			</div>
			<div class="col-md-2">
			 <button  target="_blank" type="submit" class="btn btn-primary btn-sm" name="signup" value="Sign up">Print</button>
			</div>
			</div>
			</form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="display:none">id</th>
                  <th>Day</th>
                  <th>Slot Time</th>
                  <th>Class</th>
                  <th>Teacher Module</th>
                  <th>Subject</th>
                  <th>Teacher</th>
				  <th>Created Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				
				<?php foreach($time_slot_list as $list){ ?>
                <tr>
                  <td style="display:none"><?php echo $list['id']; ?></td>
                  <td><?php echo $list['day']; ?></td>
                  <td><?php echo $list['times']; ?></td>
                  <td><?php echo $list['classname']; ?></td>
                  <td><?php echo $list['modules']; ?></td>
                  <td><?php echo $list['subject']; ?></td>
                  <td><?php echo $list['name']; ?></td>
                  <td><?php echo date('d-m-Y',strtotime(htmlentities($list['create_at'])));?></td>
				  <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
				  <td>
					  <a href="<?php echo base_url('classwise/timetable/'.base64_encode(0).'/'.base64_encode($list['id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
					  <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" data-toggle="modal" data-target="#myModal" title="Edit"><i class="fa fa-info-circle btn btn-warning"></i></a>
					  <a href="javascript;void(0);" onclick="admindedelete('<?php echo base64_encode($list['id']) ?>');admindedeletemsg();" data-toggle="modal" data-target="#myModal" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
				</td>
                </tr>
				<?php } ?>
				
					
                
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
function get_student_subject_list(class_id){
	//alert('haii');
	if(class_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('classwise/get_student_subject_list');?>",
   			data: {
				class_id: class_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#subject').empty();
							$('#subject').append("<option value=''>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#subject').append("<option value="+parsedData.list[i].id+">"+parsedData.list[i].subject+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}


function get_teacher_modules_type(class_id){
	//alert('haii');
	if(class_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('classwise/get_teacher_modules_type');?>",
   			data: {
				class_id: class_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#teacher_module').empty();
							$('#teacher_module').append("<option value=''>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#teacher_module').append("<option value="+parsedData.list[i].teacher_module+">"+parsedData.list[i].modules+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}

function get_class_wise_teachers(class_id){
	//alert('haii');
	if(class_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('classwise/get_class_wise_teachers');?>",
   			data: {
				class_id: class_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#teacher').empty();
							$('#teacher').append("<option value=''>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#teacher').append("<option value="+parsedData.list[i].u_id+">"+parsedData.list[i].name+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}

</script>


  <script type="text/javascript">
  function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('classwise/timeslottatus'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('classwise/timeslotdelete'); ?>"+"/"+id);
}
$(document).ready(function() {
 
   $('#defaultForm').bootstrapValidator({
      fields: {
            day: {
                validators: {
					notEmpty: {
						message: 'Day is required'
					}
				}
            },
			time: {
                validators: {
					notEmpty: {
						message: 'Time is required'
					}
				}
            },class_id: {
                validators: {
					notEmpty: {
						message: 'Class is required'
					}
				}
            },
			teacher_module: {
                validators: {
					notEmpty: {
						message: 'Teacher Module is required'
					}
				}
            },
			subject: {
                validators: {
					notEmpty: {
						message: 'Subject is required'
					}
				}
            },
			teacher: {
                validators: {
					notEmpty: {
						message: 'Teacher is required'
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

