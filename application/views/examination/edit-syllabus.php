<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Syllabus</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
            <form  id="defaultForm" method="post" action="<?php echo base_url('examination/editsyllabuspost'); ?>" enctype="multipart/form-data">
		<input type="hidden" id="e_s_id" name="e_s_id" value="<?php echo isset($edit_exam_syllabus['e_s_id'])?$edit_exam_syllabus['e_s_id']:'' ?>">

			<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Class list</label>
								<div class="">
								<select id="class_id" name="class_id"  class="form-control" >
								<option value="">Select</option>
								<?php if(isset($class_list) && count($class_list)>0){ ?>
									<?php foreach($class_list as $list){ ?>
										<?php if($edit_exam_syllabus['class_id']==$list['id']){ ?>
											<option selected value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
										<?php }else{ ?>
											<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
										<?php } ?>
									<?php } ?>
								<?php } ?>
								</select>
								</div>
							</div>
							
							
							
                        </div>
						
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Upload File</label>
								<div class="">
									<input type="file" name="document" id="document" class="form-control" value="<?php echo isset($edit_exam_syllabus['document'])?$edit_exam_syllabus['document']:'' ?>" />
								</div>
							</div>
                        </div>	
						
							
						<div class="col-md-2">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
							  <button type="submit" class="btn btn-primary pull-right " name="signup" value="submit">Add</button>
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
						  <th>Roll No</th>
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
  <script type="text/javascript">
$(document).ready(function() {
   $('#defaultForm').bootstrapValidator({
//     
        fields: {
			
            
			class_id: {
                validators: {
                    notEmpty: {
                        message: 'Select Class'
                    }
                }
            },
			document: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
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
   			url: "<?php echo base_url('Examination/class_student_list');?>",
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

function get_student_allsubjects_list(student_id){
	if(student_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('Examination/get_student_allsubjects_list');?>",
   			data: {
				student_id: student_id,
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
							$('#subject').append("<option value="+parsedData.list[i].name+">"+parsedData.list[i].subject+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}









</script>