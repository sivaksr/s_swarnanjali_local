<?php //echo'<pre>';print_r($hostel_details);exit; ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Send SMS For Students</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div style="padding:20px;">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
							
                                

                                <div class="tab-content">
                                    
                                       <form id="defaultForm" method="post" class="" action="<?php echo base_url('announcement/smspost');?>">
                                            <div class="row">
                                                <div class="col-md-4">
                                <div class="form-group">
                                    <label class=" control-label">SMS</label>
                                    <div class="">
                                        <select id="p_type" name="sms" class="form-control">
                                            <option value="">Select</option>
                                            <option value="sms">SMS</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                         
                           <div class="col-md-4"  >
                                <div class="form-group">
                                    <label class=" control-label">Class</label>
                                    <div class="">
                                        <select id="class_id" name="class_id" onchange="get_student_list(this.value);" class="form-control"  >
											<option value="">Select</option>
												<?php if(isset($class_list) && count($class_list)>0){ ?>
													<?php foreach($class_list as $list){ ?>
													<option   value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
													<?php }?>
												<?php }?>
											</select>
                                    </div>
                                </div>
                            </div>
							
							
							
							
							
							
							<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Student Name</label>
								<div class="" id="student_name">
									 
								</div>
							</div>
                        </div>	
										 
                                  <div class="col-md-12" >
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class=" control-label"> Message</label>
                                            <div class="">
                                                <textarea class="form-control" id="text_msg" name="msg" rows="7" placeholder="Enter Message Here"></textarea>
                                                <br>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>              
                                               
                                                
                                            </div>
                           <div class="col-md-12 text-center">
					  <button type="submit" class="btn btn-primary col-md-offset-4" name="signup" value="submit">Submit</button>
                                 &nbsp;&nbsp;
                            </div>
                            <div class="clearfix">&nbsp;</div>
                            
                        </form>
                        
                                    
             
									
									
                               
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
$(".select2").select2();
</script>
<script>
$(document).ready(function() {
   $('#defaultForm').bootstrapValidator({
//     
        fields: {
			sms:{
			 validators: {
                    notEmpty: {
                        message: 'SMS is required'
                    }
                }
            },
			
            'stu_ids[]': {
                validators: {
                    notEmpty: {
                        message: 'Student Name is required'
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
			
			msg: {
                validators: {
                    notEmpty: {
                        message: 'Message is required'
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

function get_student_list(class_id){
	//alert('sss');
	if(class_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('Announcement/class_student_list');?>",
   			data: {
				class_id: class_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#student_name').empty();
							$('#student_name').append("<input type='checkbox' id='checkall' onClick='selectAll(this)'  />Select All<br>");
							for(i=0; i < parsedData.list.length; i++) {
							//$('#student_name').append("<option value="+parsedData.list[i].u_id+">"+parsedData.list[i].name+"</option>");                      
							$('#student_name').append("<input type='checkbox' name='student_name[]' id='stu_ids' class='checkbox1'  value="+parsedData.list[i].u_id+">&nbsp;&nbsp;&nbsp;"+parsedData.list[i].name+"&nbsp;<br>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}


  $(function () {
    $("#example1").DataTable();
  });
</script>

<script>

function get_s_type(val){
	if(val=='student'){
		$('#student_ids').show();
		$('#class_id').val('');
	}else{
		$('#student_ids').hide();
		$('#class_id').val('');
	}
	
}
$(document).ready(function(){
	$("#message").css("display", "none");
    $("#showTextarea").click(function(){
        $("#message").css("display", "block");
    });
});
  $(function () {
    $("#example").DataTable();
  });
  function selectAll(source) {
		checkboxes = document.getElementsByName('student_name[]');
		for(var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}
</script>

