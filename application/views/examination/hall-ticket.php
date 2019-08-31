
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Student Hall Ticket</h3>
                    </div>

                    <!-- /.box-header -->
                    <!-- form start -->
                    <div style="padding:20px;">
                        <form id="defaultForm" method="post" class="" action="">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class=" control-label">Class</label>
                                    <div class="">
                                        <select id="class_id" name="class_id" class="form-control" onchange="get_exam_types(this.value);">
                                           <option value="">Select Class</option>
										   <?php if(isset($class_list) && count($class_list)>0){ ?>
											<?php foreach($class_list as $list){ ?>
											
															<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
													<?php } ?>
											<?php } ?>
										
										
												
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-md-4">
                                <div class="form-group">
                                    <label class=" control-label">Student</label>
                                    <div class="">
                                        <select id="student_id" name="student_id"  class="form-control" >
									<option value="">Select</option>
									<?php if(isset($student_list) && count($student_list)>0){ ?>
											<?php foreach($student_list as $list){ ?>
											
													<?php if($exam_hallticket['student_id']==$list['u_id']){ ?>
															<option selected value="<?php echo $list['u_id']; ?>"><?php echo $list['name']; ?></option>
													<?php }else{ ?>
															<option value="<?php echo $list['u_id']; ?>"><?php echo $list['name']; ?></option>
													<?php } ?>
											<?php } ?>
										<?php } ?>
									</select>
                                    </div>
                                </div>
                            </div>-->
							 <div class="col-md-4">
                                <div class="form-group">
                                    <label class=" control-label">Exam Type</label>
                                    <div class="">
                                       <select class="form-control"  id="exam_type" name="exam_type">
												<option value="">Select exam Type</option>
												<?php if(isset($exam_list) && count($exam_list)>0){ ?>
											<?php foreach($exam_list as $list){ ?>
											<option><?php echo $list['exam_type']; ?></option>
											<?php }?>
											<?php }?>
											</select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <br>
                                <button type="submit" id="showHallticket" class="btn btn-primary" name="signup" value="submit">Generate Hall Ticket</button>
                            </div>
                            <div class="clearfix">&nbsp;</div>
                        </form>

                        <br><hr>
						
				<div class="box attentdence-table" style="">
					<div class="box-header">
					  <h3 class="">Hall Tickets</h3>
					</div>
					<!-- /.box-header -->
					<?php if(isset($student_list)&& count($student_list)>0){?>

					<div class="box-body table-responsive">
					
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>Class</th>
						  <th>Admission Number</th>
						  <th>Name</th>
						  <th>Exam Type</th>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody>

						<?php foreach($student_list as $list){ ?>
						<tr>
						 <th><?php echo $list['classname']; ?><?php echo $list['section']; ?></th>
						   <th><?php echo $list['roll_number']; ?></th>
						  <th><?php echo $list['name']; ?></th>
						  <th><?php echo $exam_type_list['exam_type']; ?></th>
						  <th>
						  <a target="_blank" href="<?php echo base_url('examination/prints/'.base64_encode($exam_type_list['exam_type']).'/'.base64_encode($list['class_name']).'/'.base64_encode($list['name'])); ?>"  style="float:right;" class="btn btn-primary col-md-offset-4">Print</a>
						  </th>
						
						  
						</tr>
						<?php } ?>
						
						
										
						
						</tbody>
						
					  </table>
					  <div class="clearfix">&nbsp;</div>
					 
					  
					</div>
					<?php }else{ ?>	
					<div>No data available</div>
					<?php } ?>
					<!-- /.box-body -->
				  </div>
		 
						
						<!--
						<?php if(isset($exam_hallticket)&& count($exam_hallticket)>0){?>
                        <div class="attentdence-table" id="">
						 
						<a target="_blank" href="<?php echo base_url('examination/prints/'.base64_encode($exam_hallticket['id'])); ?>"  style="float:right;" class="btn btn-primary col-md-offset-4">Print</a>
                            <h2 class="text-center">Student Hall Ticket</h2><br>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class=" control-label">Roll Number</label>
                                            <div class="">
                                                <input class="form-control" name="" id="" value="<?php echo isset($exam_hallticket['roll_number'])?$exam_hallticket['roll_number']:''?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class=" control-label">Class</label>
                                            <div class="">
                                                <input class="form-control" name="" id="showHallticket" value="<?php echo isset($exam_hallticket['name'])?$exam_hallticket['name']:''?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class=" control-label">Section</label>
                                            <div class="">
                                                <input class="form-control" name="" id="" value="<?php echo isset($exam_hallticket['section'])?$exam_hallticket['section']:''?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class=" control-label">Candidate's Name</label>
                                            <div class="">
                                                <input class="form-control" name="" id="" value="<?php echo isset($exam_hallticket['student_name'])?$exam_hallticket['student_name']:''?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class=" control-label">Gender</label>
                                            <div class="">
                                                <input class="form-control" name="" id="" value="<?php echo isset($exam_hallticket['gender'])?$exam_hallticket['gender']:''?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class=" control-label">Father's Name</label>
                                            <div class="">
                                                <input class="form-control" name="" id="" value="<?php echo isset($exam_hallticket['parent_name'])?$exam_hallticket['parent_name']:''?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-6">
                                        <div class="form-group">
                                            <label class=" control-label">Mother's Name</label>
                                            <div class="">
                                                <input class="form-control" name="" id="" value="Hey!" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix">&nbsp;</div>

                            <div class="" style="padding:20px;">
                                <div class="table-responsive">
                                    <table id="" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Subject</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Time</th>
                                                <th class="text-center">Invigilator Sign</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo isset($exam_hallticket['subject'])?$exam_hallticket['subject']:'' ?></td>
                                                <td><?php echo isset($exam_hallticket['exam_date'])?$exam_hallticket['exam_date']:'' ?></td>
                                                <td><?php echo isset($exam_hallticket['start_time'])?$exam_hallticket['start_time']:'' ?>&nbsp; to&nbsp;<?php echo isset($exam_hallticket['to_time'])?$exam_hallticket['to_time']:'' ?></td>
                                                <td></td>
                                            </tr>
                                           
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <p>NOTE :</p>
								<?php if(isset($exam_instructions)&& count($exam_instructions)>0){ ?>
								<?php  foreach($exam_instructions as $li){?>
                                
                                    <li><?php echo isset($li['instructions'])?$li['instructions']:''?></li>
                               
								<?php }?>
								<?php }?>
                            </div>
                            
                            <div class="col-md-4 pull-right">
                                <div class="form-group">
                                    <label class="text-center control-label">Principal Signature</label>
                                    <div class="">
                                        <input class="form-control" name="" id="" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">&nbsp;</div>
                        </div>
						<?php } ?>
						-->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!--/.col (right) -->
    </section>
</div>


<script>
$(document).ready(function(){
	$("#HTFormat").css("display", "none");
    $("#showHallticket").click(function(){
        $("#HTFormat").css("display", "block");
    });
});
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#attentdence").click(function(){
        $(".attentdence-table").toggle();
    });
});
  
  </script>
<script>
function get_exam_types(class_id){
	if(class_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('examination/get_exam_types_list');?>",
   			data: {
				class_id: class_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#exam_type').empty();
							$('#exam_type').append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#exam_type').append("<option value="+parsedData.list[i].id+">"+parsedData.list[i].exam_type+"</option>");                      
                    
								
							 
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
			student_id: {
                validators: {
                    notEmpty: {
                        message: 'Student is required'
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
