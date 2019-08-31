<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Vehicle Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
			 <li class="<?php if(isset($tab) && $tab==''){ echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Edit Vehicle Details
			</a></li>
             
             
            </ul>
			<?php //echo'<pre>' ;print_r($vechical_details);exit;?>
            <div class="tab-content">
              <div class="tab-pane active<?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">
              <form id="defaultForm1" method="POST" class="" action="<?php echo base_url('transportation/edit_post');?>">
					<input type="hidden" id="v_id" name="v_id" value="<?php echo isset($vechical_details['v_id'])?$vechical_details['v_id']:''; ?>">	
						<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Select Route Number</label>
								<div class="">
								<select id="route_number" name="route_number" onchange="get_stop_list(this.value);"   class="form-control" >
								<option value="">Select</option>
								<?php foreach ($route as $list){ ?>
								<?php if($vechical_details['route_number']==$list['r_id']){ ?>
								<option selected value="<?php echo $list['r_id']; ?>"><?php echo $list['route_no']; ?></option>
								<?php }else{?>
									<option value="<?php echo $list['r_id']; ?>"><?php echo $list['route_no']; ?></option>

								<?php }?>
								<?php }?>
								</select>
								</div>
							</div>
							 	
                        </div>
						
						<?php //echo'<pre>';print_r($vechical_details['stop_list']);
						foreach($vechical_details['stop_list'] as $list){

							$rr[]=$list['multiple_stops'];						
						
						}
						//echo'<pre>';print_r($rr);
						//$tt=explode();
						//exit; ?>
						<div class="col-md-6">
						<div class="form-group">
								<label class=" control-label">Multiple</label>
								<div class="">
									<select id="multiple_stops" name="multiple_stops[]" class="form-control select2" multiple="multiple"  >
										<option value="">select</option>
										<?php foreach($all_stop_list as $lis){ ?>
													<?php if (in_array($lis['stop_id'], $rr)){ ?>
															<option selected value="<?php echo $lis['stop_id']; ?>"><?php echo $lis['stop_name']; ?></option>

													<?php }else{ ?>
														<option  value="<?php echo $lis['stop_id']; ?>"><?php echo $lis['stop_name']; ?></option>
													<?php } ?>
										<?php } ?>
									</select>
								</div>
					
							</div>
						  
                        </div>
						</div>
						<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Registration No</label>
								<div class="">
									<input class="form-control" name="registration_no" id="registration_no" value="<?php echo $vechical_details['registration_no']; ?>">
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Driver Name </label>
								<div class="">
									<input class="form-control" name="driver_name" id="driver_name" value="<?php echo $vechical_details['driver_name']; ?>">
								</div>
							</div>
                        </div>
                        </div>
						<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Driver Mobile Number </label>
								<div class="">
									<input class="form-control" name="driver_no" id="driver_no" value="<?php echo $vechical_details['driver_no'];?>">
								</div>
							</div>
                        </div>
                        </div>
						
							
<div class="clearfix"> </div>						
						<div class="col-md-3">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
							  <button type="submit"  class="btn btn-primary " name="submit" value="check">Edit Vehicle </button>
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
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
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
			 route_number:{
			   validators: {
					notEmpty: {
						message: 'Route Number is required'
					}
				}
            },
			multiple_stops:{
			   validators: {
					notEmpty: {
						message: 'Multiple stops is required'
					}
				}
            },
			registration_no:{
			   validators: {
					notEmpty: {
						message: 'Registration No is required'
					}
				}
            },
			driver_name:{
			   validators: {
					notEmpty: {
						message: 'Driver Name is required'
					}
				}
            },
			
			driver_no:{
			   validators: {
					notEmpty: {
						message: 'Driver Mobile Number is required'
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
function get_stop_list(route_number){
	if(route_number !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('transportation/routes_sides');?>",
   			data: {
				route_number: route_number,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#multiple_stops').empty();
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#multiple_stops').append("<option value="+parsedData.list[i].stop_id+">"+parsedData.list[i].stop_name+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}
</script>

