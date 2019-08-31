       <?php //echo'<pre>';print_r($student_transport);exit; ?>

<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Student Transport Registration</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            
            <div class="tab-content">
            <div class="">
              <form id="defaultForm1" method="POST" class="" action="<?php echo base_url('Academic_Mangement/student_transport_edit_post');?>">
				<input  type="hidden" name="s_t_id" id="s_t_id" value="<?php echo isset($student['s_t_id'])?$student['s_t_id']:''; ?>">
						<div class="row">
						
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Class list</label>
								<div class="">
								<select id="class_id" name="class_id" onchange="get_student_list(this.value);" class="form-control"  >
								<option value="">Select</option>
								<?php foreach ($class_list as $list){ ?>
								<?php if($list['id']==$student['class_id']){ ?>
								<option selected value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
								<?php }else{ ?>
								<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
								 <?php } ?>
				                  <?php }?>
								</select>
								</div>
							</div>
                        </div>
						
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Student Name</label>
								<div class="">
									<select id="student_id" name="student_id"  class="form-control"  >
									<option value="">Select</option>
									<?php foreach ($student_name as $list){ ?>
								<?php if($list['u_id']==$student['student_id']){ ?>
									<option  selected value="<?php echo $list['u_id']; ?>"><?php echo $list['name']; ?></option>
								<?php }else{ ?>
									<option value="<?php echo $list['u_id']; ?>"><?php echo $list['name']; ?></option>
								<?php } ?>
							<?php }?>
									</select>
								</div>
							</div>
							
							
                        </div>	
						<div class="col-md-4">
								<div class="form-group">
								<label class=" control-label">Route Name</label>
								<div class="">
									<select class="form-control" name="route" onchange="get_stop_list(this.value)" style="border-radius:0px;">
										<option value=""> Select</option>
											<?php foreach ($routes_number as $list){ ?>
											<?php if($list['r_id']==$student['route']){ ?>
											<option selected value="<?php echo $list['r_id']; ?>"><?php echo $list['route_no']; ?></option>
											<?php }else{?>
											<option selected value="<?php echo $list['r_id']; ?>"><?php echo $list['route_no']; ?></option>
											<?php }?>
											<?php }?>
									</select>
								</div>
							</div>
                        </div>	
						<div class="col-md-4">
						 <div class="form-group">
						 <label class=" control-label">Stop Name</label>
						<div class="">
						<select id="stop" name="stop" class="form-control select">
						<option value="">Select</option>
							<?php foreach ($route_stops as $list){ ?>
								<?php if($list['stop_id']==$student['stop']){ ?>
									<option  selected value="<?php echo $list['stop_id']; ?>"><?php echo $list['stop_name']; ?></option>
								<?php }else{ ?>
									<option value="<?php echo $list['stop_id']; ?>"><?php echo $list['stop_name']; ?></option>
								<?php } ?>
							<?php }?>
						</select>
					  </div>
					  </div>
					  
					  </div>	
						<div class="col-md-4">
						<div class="form-group">
								<label class=" control-label">Vehicle Number</label>
								<div class="">
								<select id="vechical_number" name="vechical_number" onchange="get_vechical_stop_list(this.value)"  class="form-control" >
								<option value="">Select</option>
								<?php foreach ($vechical_detail as $list){ ?>
								<?php if($list['v_id']==$student['vechical_number']){ ?>
								<option selected value="<?php echo $list['v_id']; ?>"><?php echo $list['registration_no']; ?></option>
								<?php }else{ ?>
								<option value="<?php echo $list['v_id']; ?>"><?php echo $list['registration_no']; ?></option>
								 <?php } ?>
				                  <?php }?>
								</select>
								</div>
							</div>
                        </div>		
						<div class="col-md-4">
								<div class="form-group">
								<label class=" control-label">Pickup Point</label>
								<div class="">
									<select id="pickup_point" name="pickup_point" class="form-control" style="border-radius:0px;">
									<option value="">Select</option>
							<?php foreach ($stops_list as $list){ ?>
								<?php if($list['v_s_id']==$student['pickup_point']){ ?>
									<option  selected value="<?php echo $list['v_s_id']; ?>"><?php echo $list['stop_name']; ?></option>
								<?php }else{ ?>
									<option value="<?php echo $list['v_s_id']; ?>"><?php echo $list['stop_name']; ?></option>
								<?php } ?>
							<?php }?>
									</select>
								</div>
							</div>
                        </div>		
						<div class="col-md-4">
								<div class="form-group">
								<label class=" control-label">Distance</label>
								<div class="">
									<input class="form-control" placeholder="Enter Distance" name="distance" id="distance" value="<?php echo $student['distance']; ?>" >
								</div>
							</div>
                        </div>
						<div class="col-md-4">
								<div class="form-group">
								<label class=" control-label">Amount</label>
								<div class="">
									<input class="form-control" placeholder="Enter Amount" name="amount" id="amount" value="<?php echo $student['amount']; ?>">
								</div>
							</div>
                        </div>		
						
						
                        </div>
					
						
						
						
							
<div class="clearfix"> </div>						
						<div class="col-md-3">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
							  <button type="submit"  class="btn btn-primary " name="submit" value="check">Register </button>
							</div>
							<!-- /.input group -->
						  </div>
                        </div>
				
						<div class="clearfix">&nbsp;</div>
						
						
						
						
					
						<div class="clearfix">&nbsp;</div>
						 
						
                    </form>
              </div>
              <!-- /.tab-pane -->
             
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
      
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
	  
    </section> 
   
</div>
  
 <script>
function get_stop_list(route){
	if(route !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('Academic_Mangement/get_vehical_routes_lists');?>",
   			data: {
				route: route,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#stop').empty();
							$('#stop').append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#stop').append("<option value="+parsedData.list[i].stop_id+">"+parsedData.list[i].stop_name+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}


function get_vechical_stop_list(vechical_number){
	if(vechical_number !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('Academic_Mangement/get_vehical_stop_lists');?>",
   			data: {
				vechical_number: vechical_number,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#pickup_point').empty();
							$('#pickup_point').append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#pickup_point').append("<option value="+parsedData.list[i].v_s_id+">"+parsedData.list[i].stop_name+"</option>");                      
                    
								
							 
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
            firstName: {
                group: '.col-lg-4',
                validators: {
                    notEmpty: {
                        message: 'The first name is required and cannot be empty'
                    }
                }
            },
            
			 class_id: {
			   validators: {
					notEmpty: {
						message: 'Class list is required'
					}
				}
            },
			student_id:{
			 validators: {
					notEmpty: {
						message: 'Student Name is required'
					}
				}
            },	
			
			route:{
			validators: {
					notEmpty: {
						message: 'Route Name is required'
					}
				}
            },	
			stop:{
			validators: {
					notEmpty: {
						message: 'Stop Name is required'
					}
				}
            },	
			
			vechical_number:{
			validators: {
					notEmpty: {
						message: 'Vehicle Number is required'
					}
				}
            },	
			pickup_point:{
			validators: {
					notEmpty: {
						message: 'Pickup Point is required'
					}
				}
            },	
			
			distance:{
                    validators: {
                    notEmpty: {
                        message: 'Distance is required'
                    },
					regexp: {
   					regexp:  /^[0-9]*$/,
   					message:'Distance must be digits'
   					}
                }
            },
			
			amount:{
                validators: {
                    notEmpty: {
                        message: 'Amount is required'
                    },
					regexp: {
   					regexp:  /^[0-9]*$/,
   					message:'Amount must be digits'
   					}
                }
            },
			
            captcha: {
                validators: {
                    callback: {
                        message: 'Wrong answer',
                        callback: function(value, validator) {
                            var items = $('#captchaOperation').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
                            return value == sum;
                        }
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
   			url: "<?php echo base_url('Academic_Mangement/class_student_list');?>",
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