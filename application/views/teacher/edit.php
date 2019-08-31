<?php //echo'<pre>';print_r($hostel_details);exit; ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Teacher Modules</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div style="padding:20px;">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){ echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Edit Teacher Modules
</a></li>
             
            </ul>
							
                                

                                <div class="tab-content">
                                    
             <div class="tab-pane active<?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">
                                       <form id="defaultForm" method="POST" class="" action="<?php echo base_url('teacher/editpost');?>">
                                            <input type="hidden" name="t_m_id" id="t_m_id" value="<?php echo isset($edit_modules['t_m_id'])?$edit_modules['t_m_id']:''?>">
											<div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Modules</label>
                                                        <div class="">
														<input class="form-control" id="modules" name="modules" placeholder="Enter Modules" value="<?php echo isset($edit_modules['modules'])?$edit_modules['modules']:''?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                               
                                                
                                            </div>
                                            <div class="clearfix"> </div>
											<br><br>
                                            <div class="col-md-12">
                                                <div class="">
                                                    <button type="submit" class="btn btn-primary " id="" name="" value="">Submit</button>
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
	function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('student/homeworkstatus/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('student/homeworkdelete/'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
   $('#defaultForm').bootstrapValidator({
//       
        fields: {
            modules: {
                 validators: {
					notEmpty: {
						message: 'Modules is required'
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