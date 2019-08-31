<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Exam Marks</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
            <form id="defaultForm" method="post" class="" action="<?php echo base_url('examination/updatemarks'); ?>">
						<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label">Class</label>
										<div class="">
											<select class="form-control" id="class_id" name="class_id" onchange="get_addexam_subjects_list(this.value);" >
												<option value="">Select Class</option>
												<?php foreach($class_list as $list){ ?>
												<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
												<?php } ?>
												
											</select>
										</div>
									</div>
                        </div>
							
						<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label"> Subject</label>
										<div class="">
											<select class="form-control" id="subject" name="subject">
												<option value="">Select subject</option>
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
					
			<?php if(isset($update_exam_marks) && count($update_exam_marks)>0){ ?>	
				<div class="box attentdence-table" style="">
					<div class="box-header">
					  <h3 class="">Enter marks Here </h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive">
					<form action="<?php echo base_url('examination/updatemarkspost'); ?>" method="post">
					
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
						<?php foreach($update_exam_marks as $list){ ?>
						<tr>
						<input type="hidden" name="student_id[]" value="<?php echo $list['student_id']; ?>">
						<input  type="hidden" name="exam_id" value="<?php echo $list['exam_id']; ?>">
					<input  type="hidden" name="subject_id" value="<?php echo $list['subject_id']; ?>">
					<input  type="hidden" name="class_id" value="<?php echo $list['class_id']; ?>">    

						  <th><?php echo $list['classname']; ?><?php echo $list['section']; ?></th>
						   <th><?php echo $list['roll_number']; ?></th>
						  <th><?php echo $list['name']; ?></th>
						  <th><?php echo $list['subject']; ?></th>
						  <th><?php echo $list['exam_type']; ?></th>
						
						  <td><input type="text" name="marks_obtained[]"  value="<?php echo isset($list['marks_obtained'])?$list['marks_obtained']:''?>" class="form-control"> </td>
						  <td><input type="text" name="max_marks[]" value="<?php echo isset($list['max_marks'])?$list['max_marks']:''?>" class="form-control"> </td>
						  <td><input type="text" name="remarks[]"  value="<?php echo isset($list['remarks'])?$list['remarks']:''?>" class="form-control"> </td>
						</tr>
						<?php } ?>
						
						
											
						
						</tbody>
						
					  </table>
					  <div class="clearfix">&nbsp;</div>
					   <button class="btn btn-primary col-md-offset-4">Update Marks</button>
					 
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
function get_addexam_subjects_list(class_id){
	//alert('haii');
	if(class_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('examination/get_addexam_subjects_list');?>",
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
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#subject').append("<option value="+parsedData.list[i].subjects+">"+parsedData.list[i].subject+"</option>");                      
                    
								
							 
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

