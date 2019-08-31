<style>
.entry:not(:first-of-type)
{
    margin-top: 10px;
}

.glyphicon
{
    font-size: 12px;
}
.input-group[class*=col-] {
    float: none;
    padding-right: 14px;
    padding-left: 14px;
}
</style>
<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Transport Fee Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){ echo "active"; } ?>"><a href="#tab_1" data-toggle="tab">Add Transport Fee</a></li>
              <li class="<?php if(isset($tab) && $tab==1){ echo "active"; } ?>"><a href="#tab_2" data-toggle="tab">Transport Fee List</a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane <?php if(isset($tab) && $tab==''){ echo "active"; } ?>" id="tab_1">
              	<div class="">
        <div class="control-group" id="fields">
           
            <div class="controls"> 
                <form role="form" id="defaultForm" autocomplete="off" method="post" action="<?php echo base_url('transportation/transport_fee_details_post'); ?>">
		
  <div id="education_fields">
          
        </div>
       <div class="col-sm-3 nopadding">
			<div class="form-group">
			<label class=" control-label">Route Number</label>
			<select id="route_id" name="route_id[]" onchange="get_stops_route_list0(this.value);" class="form-control" >
			<option value="">Select</option>
			<?php foreach ($route as $list){ ?>
			<option value="<?php echo $list['r_id']; ?>"><?php echo $list['route_no']; ?></option>
			<?php }?>
			</select>
			</div>
		</div>
		<div class="col-sm-3 nopadding">
		  <div class="form-group">
		  <label class=" control-label">From Stop</label>
			<select id="stops" name="stops[]"  class="form-control select">
			<option value="">Select</option>
			<?php foreach ($stops as $list){ ?>
			<option value="<?php echo $list['v_s_id']; ?>"><?php echo $list['stop_name']; ?></option>
			<?php }?>
			</select>
		  </div>
		</div>
		<div class="col-sm-3 nopadding">
		  <div class="form-group">
		  <label class=" control-label">To Stop</label>
			<select id="to_stops" name="to_stops[]"     class="form-control select">
			<option value="">Select</option>
			</select>
		  </div>
		</div>
		<!--<div class="col-sm-3 nopadding">
		  <div class="form-group">
		   <label class=" control-label">Frequency</label>
				<input class="form-control" name="frequency[]"  class="form-control select" type="text" placeholder="Enter Frequency " />
		  </div>
		</div>-->

		<div class="col-sm-3 nopadding">
		  <div class="form-group">
		   <label class=" control-label">Amount</label>
			<div class="input-group">
				<input class="form-control" name="amount[]" class="form-control select"  type="text" placeholder="Amount / Annual" />

			  <div class="input-group-btn">
				<button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
			  </div>
			</div>
		  </div>
		</div>
		<div class="clear"></div>
  	<div class="col-md-3">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
							  <button type="submit"  class="btn btn-primary " name="validateBtn" id="validateBtn" value="check">Add Fee</button>
							  
							</div>
							<!-- /.input group -->
						  </div>
                        </div>
 </form>
		<div class="clearfix"> </div>
	</div>
              </div>
              </div>
			  
			  
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane <?php if(isset($tab) && $tab==1){ echo "active"; } ?>" id="tab_2">
				 <div class="clearfix"></div>
        
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Route Number</th>
                  <th>From Stop</th>
                  <th>To Stop</th>
                  <th>Amount </th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php if(isset($transport_free) && count($transport_free)>0){ ?>
				<?php foreach($transport_free as $lis){ ?>
				<tr>
                  <td><?php echo $lis['route_no']; ?></td>
                  <td><?php echo $lis['stop_name']; ?></td>
                  <td><?php echo $lis['stops']; ?></td>
                  <td><?php echo $lis['amount']; ?></td>
                  <td><?php if($lis['status']==1){ echo "active";}else{ echo "Deactive"; } ?></td>
					
				<td>
				<a href="<?php echo base_url('transportation/transportedit/'.base64_encode($lis['f_id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
				<a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($lis['f_id'])).'/'.base64_encode(htmlentities($lis['status']));?>');adminstatus('<?php echo $lis['status'];?>')" data-toggle="modal" data-target="#myModal" title="Edit"><i class="fa fa-info-circle btn btn-warning"></i></a>
				<a href="javascript;void(0);" onclick="admindedelete('<?php echo base64_encode($lis['f_id']) ?>');admindedeletemsg();" data-toggle="modal" data-target="#myModal" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
				</td>  
					
                </tr>
				<?php } ?>
				<?php }?>
                
				</tbody>
                
              </table>
            </div>
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
  
 <script type="text/javascript">
var room = 1;
function education_fields() {
 
    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
	divtest.setAttribute("class", "form-group removeclass"+room);
	var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"> <select id="route_id" name="route_id[]" onchange="get_stops_route_list1(this.value,'+room+');" class="form-control" ><option value="">Select</option><?php foreach ($route as $list){ ?><option value="<?php echo $list['r_id']; ?>"><?php echo $list['route_no']; ?></option><?php }?></select></div></div> <div class="col-sm-3 nopadding"><div class="form-group"> <select id="stops'+room+'" name="stops[]"    class="form-control select"><option value="">Select</option><?php foreach ($stops as $list){?><option value="<?php echo $list['v_s_id']?>"><?php echo $list['stop_name'];?></option><?php }?></select></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <select id="to_stops'+room+'" name="to_stops[]" class="form-control select"><option value="">Select</option></select></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"> <input class="form-control" name="amount[]" class="form-control select"  type="text" placeholder="Amount / Anual " /><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';
    
    objTo.appendChild(divtest)
	
		
}

   function remove_education_fields(rid) {
	   $('.removeclass'+rid).remove();
   }

  </script>
  <script>
  
    function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('transportation/transportstatus/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('transportation/transportdelete/'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to Activate?');
	}
}
  $(document).ready(function() {
   
    $('#defaultForm').bootstrapValidator({
//      
        fields: {
			 'route_id[]':{
			   validators: {
					notEmpty: {
						message: 'Route Number is required'
					}
				}
            },
			'stops[]':{
			   validators: {
					notEmpty: {
						message: 'From Stop is required'
					}
				}
            },
			
			'to_stops[]':{
			   validators: {
					notEmpty: {
						message: 'To Stop is required'
					}
				}
            }, 
			   'amount[]':{
                validators: {
                    notEmpty: {
                        message: 'Amount is required'
                    },
					regexp: {
   					regexp:  /^[0-9]*$/,
   					message:'Amount must be digits'
   					}
                }
            }
			  
			
			
        }
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
<!--<script>
function get_stops_order_list(stops){
	if(stops !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('transportation/get_stops_order_list');?>",
   			data: {
				stops: stops,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData);
							$('#to_stops').empty();
							$('#to_stops').append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
							//
							$('#to_stops').append("<option value="+parsedData.list[i].stop_name+">"+parsedData.list[i].stop_name+"</option>");  
                           
								
							 
							}
						}
						
   					}
           });
	   }
}
</script>-->

<script>
function get_stops_route_list0(route_id){
	if(route_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('transportation/routes_stops');?>",
   			data: {
				route_id: route_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#stops').empty();
							$('#to_stops').empty();
							$('#stops').append("<option>select</option>");
							$('#to_stops').append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#stops').append("<option value="+parsedData.list[i].multiple_stops+">"+parsedData.list[i].stop_name+"</option>");  
							$('#to_stops').append("<option value="+parsedData.list[i].multiple_stops+">"+parsedData.list[i].stop_name+"</option>");  
                           
								
							 
							}
						}
						
   					}
           });
	   }
}


function get_stops_order_list1(stops,divId){
	if(stops !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('transportation/get_stops_order_list');?>",
   			data: {
				stops: stops,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#to_stops'+divId).empty();
							$('#to_stops'+divId).append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#to_stops'+divId).append("<option value="+parsedData.list[i].stop_name+">"+parsedData.list[i].stop_name+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}







function get_stops_route_list1(route_id,divId){
	if(route_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('transportation/routes_stops');?>",
   			data: {
				route_id: route_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#stops'+divId).empty();
							$('#to_stops'+divId).empty();
							$('#stops'+divId).append("<option>select</option>");
							$('#to_stops'+divId).append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#stops'+divId).append("<option value="+parsedData.list[i].multiple_stops+">"+parsedData.list[i].stop_name+"</option>");                      
							$('#to_stops'+divId).append("<option value="+parsedData.list[i].multiple_stops+">"+parsedData.list[i].stop_name+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}
</script>

