<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">View Exam Marks</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
            <form id="defaultForm" method="post" class="" action="<?php echo base_url('examination/marksview'); ?>">
			<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Class list</label>
								<div class="">
								<select id="class_id" name="class_id" onchange="get_student_list(this.value); get_addexam_marks_subjects_list(this.value);" class="form-control" >
								<option value="">Select</option>
								<?php foreach ($class_list as $list){ ?>
								<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
								<?php }?>
								</select>
								</div>
							</div>
                        </div>
						
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Student Name</label>
								<div class="">
									<select id="student_id" name="student_id"  class="form-control" >
									<option value="">Select</option>
									</select>
								</div>
							</div>
                        </div>	
							
						<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label">All Subjects</label>
										<div class="">
											<select class="form-control" id="subject" name="subject">
												<option value="">Select</option>
												<?php foreach($subject_list as $list){ ?>
												<option value="<?php echo $list['id']; ?>"><?php echo $list['subject']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label"> Exam Type</label>
										<div class="">
											<select class="form-control" id="exam_type" name="exam_type">
												<option value="">Select exam Type</option>
												<?php foreach($exam_list as $list){ ?>
												<option value="<?php echo $list['id']; ?>"><?php echo $list['exam_type']; ?></option>
												<?php } ?>
												
											</select>
										</div>
									</div>
                        </div>
							
						<div class="col-md-12">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
				<button type="submit" class="btn btn-primary pull-right " name="signup" value="submit">Next</button>
							</div>
							<!-- /.input group -->
						  </div>
                        </div>
					
						<div class="clearfix">&nbsp;</div>
						
						
						
						
					
						<div class="clearfix">&nbsp;</div>
						 
						
                    </form>
					<div class="clearfix">&nbsp;</div>
					
			<?php if(isset($student_list) && count($student_list)>0){ ?>	
				<div class="box attentdence-table" style="">
					<div class="box-header">
					  <h3 class="">View Exam marks</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>Class</th>
						  <th>Admission Number</th>
						  <th>Name</th>
						  <th>Subject</th>
						  <th>Exam Type</th>
						  <th>Marks Obtained</th>
						  <th>Maximum Marks</th>
						  <th>Remarks</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($student_list as $list){ ?>
						<tr>
						   <th><?php echo $list['classname']; ?><?php echo $list['section']; ?></th>
						   <th><?php echo $list['roll_number']; ?></th>
						  <th><?php echo $list['name']; ?></th>
						  <th><?php echo $list['subject']; ?></th>
						  <th><?php echo $list['exam_type']; ?></th>
						  <th><?php echo $list['marks_obtained']; ?></th>
						  <th><?php echo $list['max_marks']; ?></th>
						  <th><?php echo $list['remarks']; ?></th>
						</tr>
						<?php } ?>
						
						
											
						
						</tbody>
						
					  </table>
					  <div class="clearfix">&nbsp;</div>
					 
					  </form>
					</div>
					<!-- /.box-body -->
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
  <script type="text/javascript">
  $(document).ready(function(){
    $("#attentdence").click(function(){
        $(".attentdence-table").toggle();
    });
});
  
  </script>
  <script>
  function get_addexam_marks_subjects_list(class_id){
	//alert('haii');
	if(class_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('examination/get_addexam_marks_subjects_list');?>",
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
							$('#subject').append("<option>select</option>");
							$('#subject').append("<option value='All'>All</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#subject').append("<option value="+parsedData.list[i].subject_id+">"+parsedData.list[i].subject+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}
  
</script>
  <script type="text/javascript">
$(document).ready(function() {
   $('#defaultForm').bootstrapValidator({
//     
        fields: {
			student_id:{
			 validators: {
                    notEmpty: {
                        message: 'Student Name is required'
                    }
                }
            },
			
            exam_type: {
                validators: {
                    notEmpty: {
                        message: 'Exam Type is required'
                    }
                }
            },
			class_id: {
                validators: {
                    notEmpty: {
                        message: 'Class is required'
                    }
                }
            },
			subject: {
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
<script>
function get_student_list(class_id){
	if(class_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('examination/class_student_list');?>",
   			data: {
				class_id: class_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#student_id').empty();
							$('#student_id').append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#student_id').append("<option value="+parsedData.list[i].u_id+">"+parsedData.list[i].name+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}










</script>