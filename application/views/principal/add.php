<?php //echo'<pre>';print_r($hostel_details);exit; ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Principal assign instructions for teachers</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div style="padding:20px;">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){ echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Add Instructions
</a></li>
             
            </ul>
							
                                

                                <div class="tab-content">
                                    
             <div class="tab-pane active<?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">
                                       <form id="defaultForm" method="POST" class="" action="<?php echo base_url('principal/addpost');?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Teacher Modules</label>
                                                        <div class="">
														<select class="form-control" id="teacher_modules" name="teacher_modules" onchange="get_teachers_list(this.value);">
												<option value="">Select</option>
												<?php foreach($teacher_modules as $list){ ?>
											<option value="<?php echo $list['teacher_module'];?>"><?php echo $list['modules'];?></option>
											<?php } ?>
											</select>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                             <div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Teachers</label>
								<div class="" id="teachers">
									 
								</div>
							</div>
                        </div>	
						</div>
                                               <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class=" control-label">Instructions</label>
                                                        <div class="">
                                                            <textarea class="form-control" name="instractions" id="instractions" placeholder="Enter Instructions" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"> </div>
                                            <div class="col-md-12">
                                                <div class="input-group pull-right">
                                                    <button type="submit" class="btn btn-primary " id="" name="" value="">Add</button>
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
            teacher_modules: {
                 validators: {
					notEmpty: {
						message: 'Teacher Modules is required'
					}
				}
            },
			instractions: {
                 validators: {
					notEmpty: {
						message: 'Instructions is required'
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
function selectAll(source) {
		checkboxes = document.getElementsByName('teacher_ids[]');
		for(var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}
</script>
<script>

function get_teachers_list(teacher_modules){
	//alert('sss');
	if(teacher_modules !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('principal/get_teachers_list');?>",
   			data: {
				teacher_modules: teacher_modules,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#teachers').empty();
							$('#teachers').append("<input type='checkbox' id='checkall' onClick='selectAll(this)'  />Select All<br>");
							for(i=0; i < parsedData.list.length; i++) {
							//$('#student_name').append("<option value="+parsedData.list[i].u_id+">"+parsedData.list[i].name+"</option>");                      
							$('#teachers').append("<input type='checkbox' id='teacher_ids' class='checkbox1' name='teacher_ids[]' value="+parsedData.list[i].teacher+">&nbsp;&nbsp;&nbsp;"+parsedData.list[i].name+"&nbsp;<br>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}

  </script>