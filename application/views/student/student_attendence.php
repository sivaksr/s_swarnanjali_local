				<?php //echo'<pre>';print_r($student_list);exit; ?>
<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Attendance</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
            <form onsubmit="return checkvalidation();" id="search_student" method="post" class="" action="<?php echo base_url('student/attendence');?>">
						<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label">Class</label>
										<div class="">
											<select class="form-control" id="class_id" name="class_id" onchange="get_class_sujects(this.value);">
												<option value="">Select Class</option>
												<?php foreach($class_list as $list){ ?>
														<option value="<?php echo $list['class_id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>

												<?php } ?>
											</select>
										</div>
									</div>
                        </div>
							
						<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label"> Subject</label>
										<div class="">
											<select class="form-control" id="subjects" name="subjects" >
											<option value="">Select Subject</option>
											</select>
										</div>
									</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label"> Time</label>
										<div class="">
											<select class="form-control" id="time" name="time">
											<option value="">Select</option>
											<?php foreach($class_time as $list){ ?>
										<option value="<?php echo $list['id']; ?>"><?php echo $list['form_time'].' '.$list['to_time']; ?></option>
											<?php } ?>
											</select>
										</div>
							</div>
                        </div>
						
							
						<div class="col-md-12">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
							  <button type="submit" id="attentdence" class="btn btn-primary pull-right " name="signup" value="Signup">Next</button>
							</div>
							<!-- /.input group -->
						  </div>
                        </div>
					
						<div class="clearfix">&nbsp;</div>
						
                    </form>
					<div class="clearfix">&nbsp;</div>
						<?php if(isset($student_list) && count($student_list)>0){ ?>
					<div class="box attentdence-table" style="">
            <div class="box-header">
              <h3 class="">Enter Attendance</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
			<!--<table id="example" class="display select table table-bordered table-striped" cellspacing="0" width="100%">
   <thead>
      <tr>
         <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
          <th>Roll No</th>
		  <th>Name</th>
		  <th>Subject</th>
		 
		  <th>Remarks</th>
      </tr>
   </thead>
      <tbody>
		<tr>
			<td><input type="checkbox"></td>
			<td>15</td>
			<td>Bayapureddy</td>
			<td>Mathamatics</td>
	
			<td><input class="form-control" type="text" placeholder="Remarks"/></td>
		</tr>
			<tr>
			<td><input type="checkbox"></td>
			<td>15</td>
			<td>Bayapureddy</td>
			<td>Mathamatics</td>
	
			<td><input class="form-control" type="text" placeholder="Remarks"/></td>
		</tr>
			<tr>
			<td><input type="checkbox"></td>
			<td>15</td>
			<td>Bayapureddy</td>
			<td>Mathamatics</td>
	
			<td><input class="form-control" type="text" placeholder="Remarks"/></td>
		</tr>
			<tr>
			<td><input type="checkbox"></td>
			<td>15</td>
			<td>Bayapureddy</td>
			<td>Mathamatics</td>
	
			<td><input class="form-control" type="text" placeholder="Remarks"/></td>
		</tr>
			<tr>
			<td><input type="checkbox"></td>
			<td>15</td>
			<td>Bayapureddy</td>
			<td>Mathamatics</td>
	
			<td><input class="form-control" type="text" placeholder="Remarks"/></td>
		</tr>
		
		

		
		
	  </tbody>
  
</table>-->
		
			<form action="<?php echo base_url('student/attendenceaddpost'); ?>" method="post">

			  
			  
			  
<table id="example" class="display select table table-bordered table-striped" cellspacing="0" width="100%">
   <thead>
      <tr>
         <th><input type="checkbox"  id="checkAll"></th>
          <th>Admission Number</th>
          <th>Class</th>
		  <th>Name</th>
		  <th>Subject</th>
		  <th>Time</th>
		  <th>Remarks</th>
      </tr>
   </thead>
      <tbody>
		
			
			<?php $cnt=0;foreach($student_list as $list){ ?>
			<tr>
                      <td>
					<input type="checkbox"  name="attendence[]" value="<?php echo isset($list['u_id'])?$list['u_id']:''; ?>">

					</td>	
					<input type="hidden" name="student_id[]" value="<?php echo isset($list['u_id'])?$list['u_id']:''; ?>">
					<input type="hidden" name="class_id" value="<?php echo isset($list['class_name'])?$list['class_name']:''; ?>">
					<input type="hidden" name="subject_id" value="<?php echo isset($subject_name['id'])?$subject_name['id']:''; ?>">
					<input type="hidden" name="time" value="<?php echo isset($class_times['id'])?$class_times['id']:''; ?>">
                    <td><?php echo isset($list['roll_number'])?$list['roll_number']:''; ?> </td>
				  <td><?php echo isset($list['classname'])?$list['classname']:''; ?><?php echo isset($list['section'])?$list['section']:''; ?> </td>
				  <td><?php echo isset($list['name'])?$list['name']:''; ?></td>
				  <td><?php echo isset($subject_name['subject']) ?$subject_name['subject']:''; ?></td>
				  <td><?php echo isset($class_times['time'])?$class_times['time']:''; ?></td>
	
			<td><input class="form-control" type="text" name="remarks[]" placeholder="Remarks"/></td>
		</tr>
		<?php $cnt++;} ?>	
		
		

		
		
	  </tbody>
  
</table>
			  <div class="clearfix">&nbsp;</div>
               <button type="submit" class="btn btn-primary col-md-offset-4">Add Attendance</button>
			 
			  </form>
            </div>
           
          </div>
		  <?php } ?>
	
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
function get_attandence(id){
	 alert('id');
	 var check_one=document.getElementById("attendence"+id).checked;
	if(check_one==true){
	document.getElementById("attendence"+id).value='present';
	}
	 var check=document.getElementById("attendence"+id).unchecked;
	if(check==true){
	document.getElementById("attendence"+id).value='absent';
	}
	 
 }
 </script>
  <script type="text/javascript">
  $("#checkAll").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
});
  
  
  function checkvalidation(){
	 var ids=$('#subjects').val(); 
	 if(ids==''){
		// alert('Please select subject');return false;
	 }
  }
  function get_class_sujects(class_id){
	  	if(class_id!=''){
			jQuery.ajax({

			url: "<?php echo base_url('student/get_teacher_class_subjects');?>",
			type: 'post',
			data: {
			class_id: class_id,
			},
			dataType: 'json',
				success: function (data) {
						$('#subjects').empty();
   						$('#subjects').append("<option value=''>select</option>");
   						for(i=0; i<data.list.length; i++) {
   							$('#subjects').append("<option value="+data.list[i].id+">"+data.list[i].subjects+"</option>");                      
                       }
				}
			
			});

	}
	  
  }
  
  
  function get_subject_wise_timings(subjects){
	  	if(subjects!=''){
			jQuery.ajax({

			url: "<?php echo base_url('student/get_subject_wise_timings');?>",
			type: 'post',
			data: {
			subjects: subjects,
			},
			dataType: 'json',
				success: function (data) {
						$('#time').empty();
   						$('#time').append("<option value=''>select</option>");
   						for(i=0; i<data.list.length; i++) {
   							$('#time').append("<option value="+data.list[i].timings+">"+data.list[i].timings+"</option>");                      
                       }
				}
			
			});

	}
	  
  }
  
  
  $(document).ready(function() {
 
   $('#search_student').bootstrapValidator({
//       
        fields: {
            class_id: {
                validators: {
					notEmpty: {
						message: 'Class is required'
					}
				}
            },
			time: {
                validators: {
					notEmpty: {
						message: 'Time is required'
					}
				}
            },
			subjects: {
                validators: {
					notEmpty: {
						message: 'Subject is required'
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
