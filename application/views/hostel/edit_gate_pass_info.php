<?php //echo'<pre>';print_r($hostel_details);exit; ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Edit Gate Pass & Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div style="padding:20px;">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
								
								<li class="<?php if(isset($tab) && $tab==''){ echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Gate Pass
                                </a></li>
			  
                                   
                                </ul>
								
								

                                <div class="tab-content">
                                    
                                    <div class="tab-pane active<?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">
                                        <form id="defaultForm" method="POST" class="" action="<?php echo base_url('hostelmanagement/gatepassinfoeditpost'); ?>">
								<input type="hidden" id="g_p_id" name="g_p_id" value="<?php echo isset($edit_gate_pass_info['g_p_id'])?$edit_gate_pass_info['g_p_id']:'' ?>">

                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Date</label>
                                                        <div class="">
                                                            <input type="date" class="form-control" name="date" id="date" placeholder="Enter Date" value="<?php echo isset($edit_gate_pass_info['date'])?$edit_gate_pass_info['date']:'' ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Gate Pass Number</label>
                                                        <div class="">
                                                            <input class="form-control" name="gate_pass_number" id="" placeholder="Enter Pass Number" value="<?php echo isset($edit_gate_pass_info['gate_pass_number'])?$edit_gate_pass_info['gate_pass_number']:'' ?>">
                                                        </div>
                                                    </div>
                                                </div>
												
												
												
														
								
								<div class="col-md-6">
								<div class="form-group">
								<label class=" control-label">Class list</label>
								<div class="">
								<select id="class_id" name="class_id" onchange="get_student_list(this.value);" class="form-control" >
								<option value="">Select</option>
								<?php foreach ($class_list as $list){ ?>
								<?php if($list['id']==$edit_gate_pass_info['class_id']){ ?>
								<option selected value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
								<?php }else{ ?>
								<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
								 <?php } ?>
				                  <?php }?>
								</select>
								</div>
							</div>
								
							</div>
								
								
								
								
							<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Student Name</label>
								<div class="">
									<select id="student_name" name="student_name"  class="form-control" >
									<option value="">Select</option>
									<?php foreach ($student_name as $list){ ?>
								<?php if($list['student_name']==$edit_gate_pass_info['student_name']){ ?>
									<option  selected value="<?php echo $list['student_name']; ?>"><?php echo $list['username']; ?></option>
								<?php }else{ ?>
									<option value="<?php echo $list['student_name']; ?>"><?php echo $list['username']; ?></option>
								<?php } ?>
							<?php }?>
									</select>
								</div>
							</div>
							
							
                        </div>	
							
							               
												
												
												
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Gate Pass in Hours</label>
                                                        <div class="">
                                                            <input class="form-control" name="gate_pass_hours" id="gate_pass_hours" placeholder="Enter No.of Hours" value="<?php echo isset($edit_gate_pass_info['gate_pass_hours'])?$edit_gate_pass_info['gate_pass_hours']:'' ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class=" control-label">Remarks</label>
                                                        <div class="">
                                                            <textarea class="form-control" name="remarks" id="remarks" placeholder=""><?php echo isset($edit_gate_pass_info['remarks'])?$edit_gate_pass_info['remarks']:'' ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                           


										   </div>
                                            <div class="clearfix"> </div>
                                            <div class="col-md-12">
                                                <div class="input-group pull-right">
												 <button type="submit"  class="btn btn-primary " id="validateBtn" name="validateBtn" value="check">Add</button> &nbsp;
                                                </div>
                                            </div>
                                            <div class="clearfix">&nbsp;</div>
                                            <div class="clearfix">&nbsp;</div>
                                        </form>
                                    </div>
                                    
                                    
									
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
function get_student_list(class_id){
	if(class_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('hostelmanagement/class_student_list');?>",
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
							$('#student_name').append("<option value=''>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#student_name').append("<option value="+parsedData.list[i].u_id+">"+parsedData.list[i].name+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}
</script>
<script>
$(document).ready(function() {
   
    $('#defaultForm').bootstrapValidator({
//      
        fields: {
			 
			
			date:{
			   validators: {
					notEmpty: {
						message: 'Date  is required'
					},
					date: {
                        format: 'DD-MM-YYYY',
                        message: 'The value is not a valid date'
                    }
				
				}
            },
			class_id:{
				validators: {
					notEmpty: {
						message: 'Class name is required'
					}
				}
            },
			student_name:{
				validators: {
					notEmpty: {
						message: 'Student name is required'
					}
				}
            },
			gate_pass_number: {
                validators: {
					notEmpty: {
						message: ' Gate Pass Number is required'
					}
				}
            },
			gate_pass_hours: {
                validators: {
					notEmpty: {
						message: ' Gate Pass in Hours is required'
					}
				}
            },
			
			remarks: {
                validators: {
					notEmpty: {
						message: ' Remarks is required'
					}
				}
            }
			
			
			
			
			
        }
    });

});
</script>