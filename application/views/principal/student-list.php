<?php //echo'<pre>';print_r($hostel_details);exit; ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Student List</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div style="padding:20px;">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
			
							
                                

                                <div class="tab-content">
                                    
                                       <form id="defaultForm" target='_blank' method="post" class="" action="<?php echo base_url('student/yearwiselist');?>">
                                            <div class="row">
											
											
											<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Class list</label>
								<div class="">
								<select id="class_id" name="class_id" onchange="get_student_list(this.value);" class="form-control" >
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
                                                        <label class=" control-label">Year</label>
                                                        <div class="">
														<input type="text" class="form-control" id="year" name="year" placeholder="Enter Year">
											
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
											<br><br>
                                            <div class="clearfix"> </div>
                                            <div class="col-md-12">
                                                <div class="">
                                                    <button type="submit" class="btn btn-primary " id="signup" name="signup" value="submit">Search</button>
                                                </div>
                                            </div>
                                            <div class="clearfix">&nbsp;</div>
                                            <div class="clearfix">&nbsp;</div>
                                        </form>                                 </div>
                                    
             
									
									
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
    </section>
</div>
<script>
$(document).ready(function() {
 $('#datepicker1').datepicker({
      autoclose: true
    });
	
   $('#defaultForm').bootstrapValidator({
//       
        fields: {
            year: {
                 validators: {
					notEmpty: {
						message: 'Year is required'
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
			
			
		
			
        }
    });
	$('#datepicker').on('changeDate ', function(e) {
		$('#defaultForm').bootstrapValidator('revalidateField', 'work_date');
		});
		$('#datepicker1').on('changeDate ', function(e) {
		$('#defaultForm').bootstrapValidator('revalidateField', 'work_sub_date');
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
   							$('#subjects').append("<option value="+data.list[i].subject+">"+data.list[i].subject+"</option>");                      
                       }
				}
			
			});

	}
	  
  }
  </script>