<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Vehicle Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
			
			 <li class="<?php if(isset($tab) && $tab==0){  echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Add Vehicle Details</a></li>
               <li class="<?php if(isset($tab) && $tab==1){  echo "active";} ?>"><a href="#tab_2" data-toggle="tab">Vehicle Details List</a></li>
			 
            </ul>
            <div class="tab-content">
             <div class="tab-pane <?php if(isset($tab) && $tab==''){  echo "active";} ?>" id="tab_1">
              <form id="defaultForm" method="POST" class="" action="<?php echo base_url('transportation/vehicle_details_post');?>">
						
						<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Select Route Number</label>
								<div class="">
								<select id="route_number" name="route_number" onchange="get_stop_list(this.value);"   class="form-control" >
								<option value="">Select</option>
								<?php foreach ($route as $list){ ?>
								<option value="<?php echo $list['r_id']; ?>"><?php echo $list['route_no']; ?></option>
								<?php }?>
								</select>
								</div>
							</div>
							    
								
								
                        </div>
						<div class="col-md-6">
						<div class="form-group">
								<label class=" control-label">Multiple</label>
								<div class="">
									<select id="multiple_stops" name="multiple_stops[]" class="form-control select2" multiple="multiple"  >
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
									<input class="form-control" name="registration_no" id="registration_no">
								</div>
							</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Driver Name </label>
								<div class="">
									<input class="form-control" name="driver_name" id="driver_name">
								</div>
							</div>
                        </div>
                        </div>
						<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Driver Mobile Number </label>
								<div class="">
									<input class="form-control" name="driver_no" id="driver_no">
								</div>
							</div>
                        </div>
                        </div>
						
							
<div class="clearfix"> </div>						
						<div class="col-md-3">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
							  <button type="submit"  class="btn btn-primary" name="validateBtn" id="validateBtn" value="check">Add Vehicle </button>
							</div>
							<!-- /.input group -->
						  </div>
                        </div>
					
						<div class="clearfix">&nbsp;</div>
						
						
						
						
					
						<div class="clearfix">&nbsp;</div>
						 
						
                    </form>
              </div>
              <!-- /.tab-pane -->
             <div class="tab-pane  <?php if(isset($tab) && $tab==1){  echo "active";} ?>" id="tab_2">
				 <div class="clearfix"></div>
        
            <!-- /.box-header -->
			<?php if(isset($vehicle_list) && count($vehicle_list)>0){ ?>
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
                  <th>Route Number</th>
                  <th>Route Stops</th>
                  <th>Registration No</th>
                  <th>Driver Name</th>
                  <th>Driver Mobile Number</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach($vehicle_list as $list){?>
                <tr>
                  <td><?php echo $list['route_no'];?></td>
                  <td>
				  <?php foreach($list['stop_list'] as $lop){ ?>
					<h5><?php echo $lop['stop_name'];?></h5>
				  <?php }?>
				  </td>
                  <td><?php echo $list['registration_no'];?></td>
                  <td><?php echo $list['driver_name'];?></td>
                 
                  <td><?php echo $list['driver_no'];?></td>
                <td><?php if($list['status']==1){ echo "active";}else{  echo "Deactive"; } ?></td>
				<td>
				<a href="<?php echo base_url('transportation/edit/'.base64_encode($list['v_id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
				<a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['v_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" data-toggle="modal" data-target="#myModal" title="Edit"><i class="fa fa-info-circle btn btn-warning"></i></a>
				<a href="javascript;void(0);" onclick="admindedelete('<?php echo base64_encode($list['v_id']) ?>');admindedeletemsg();" data-toggle="modal" data-target="#myModal" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
				</td>  
                </tr>
				<?php }?>
				</tbody>
                 <tfoot>
				
                <tr>
                  <th>Route Number</th>
                  <th>Route Stops</th>
                  <th>Registration No</th>
                  <th>Driver Name</th>
                  <th>Driver Mobile Number</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
			<?php }else{ ?>
            <div> No data available</div>
          <?php }?>
            <!-- /.box-body -->
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
      
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
	  
    </section> 
   
</div>
  <script>
  $(document).ready(function() {
   
    $('#defaultForm').bootstrapValidator({
//      
        fields: {
			 route_number:{
			   validators: {
					notEmpty: {
						message: 'Route Number is required'
					}
				}
            },
			'multiple_stops[]':{
			   validators: {
					notEmpty: {
						message: 'multiple is required'
					}
				}
            },registration_no:{
			   validators: {
					notEmpty: {
						message: 'Registration No is required'
					}
				}
            }, 
			   driver_name: {
                validators: {
					notEmpty: {
						message: 'Driver Name is required'
					},regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Driver Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			  driver_no: {
                validators: {
					notEmpty: {
						message: 'Driver Mobile Number is required'
					},regexp: {
					regexp:  /^[0-9]{10}$/,
					message:'Driver Mobile Number must be 10 digits'
					}
				}
            }
			
			
        }
    });

});
</script>

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
  <script type="text/javascript">
  
    function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('transportation/vechicalstatus/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('transportation/vechicaldelete/'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to Activate?');
	}
}
  




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
							$('#multiple_stops').append("<option>select</option>");
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

