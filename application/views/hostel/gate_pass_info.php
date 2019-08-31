<?php //echo'<pre>';print_r($hostel_details);exit; ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Gate Pass & Info</h3>
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
              <li class="<?php if(isset($tab) && $tab==1){ echo "active";} ?>"><a href="#tab_2" data-toggle="tab">Gate Info</a></li>
			  
                                   
                                </ul>
								
								

                                <div class="tab-content">
                                    
                                    <div class="tab-pane <?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">
                                        <form id="defaultForm" method="POST" class="" action="<?php echo base_url('hostelmanagement/gatepassinfopost'); ?>">
                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Date</label>
                                                        <div class="">
                                                            <input type="date" class="form-control" name="date" id="date" placeholder="Enter Date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Gate Pass Number</label>
                                                        <div class="">
                                                            <input class="form-control" name="gate_pass_number" id="" placeholder="Enter Pass Number">
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
										<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
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
									</select>
								</div>
							</div>
                        </div>	
												
												
                                               
												
												
												
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Gate Pass in Hours</label>
                                                        <div class="">
                                                            <input class="form-control" name="gate_pass_hours" id="gate_pass_hours" placeholder="Enter No.of Hours">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class=" control-label">Remarks</label>
                                                        <div class="">
                                                            <textarea class="form-control" name="remarks" id="remarks" placeholder=""></textarea>
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
                                    
                                     <div class="tab-pane <?php if(isset($tab) && $tab==1){ echo "active";} ?>" id="tab_2">
                                        <div class="clearfix"></div>

                                        <!-- /.box-header -->
                                        <div class="box-body table-responsive">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>S. No</th>
                                                        <th>Date</th>
                                                        <th>Gate Pass Number</th>
														<th>Class</th>
                                                        <th>Student Name</th>           
                                                        <th>Gate Pass in Hours</th>
                                                        <th>Remarks</th>
                                                        <th>Status</th>
														<th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php $cnt=1; foreach($gate_pass_list as $list){ ?>
                                                    <tr>
                                                        <td><?php echo $cnt;?></td>
                                                        <td><?php echo isset($list['date'])?$list['date']:''?></td>
                                                        <td><?php echo isset($list['gate_pass_number'])?$list['gate_pass_number']:''?></td>
                                                        <td><?php echo isset($list['name'])?$list['name']:''?><?php echo isset($list['section'])?$list['section']:''?></td>
                                                        <td><?php echo isset($list['username'])?$list['username']:''?></td>
                                                        <td><?php echo isset($list['gate_pass_hours'])?$list['gate_pass_hours']:''?></td>
                                                        <td><?php echo isset($list['remarks'])?$list['remarks']:''?></td>
                                                         <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
                                                    <td>
													<a target="_blank" href="<?php echo base_url('hostelmanagement/gatepassprint/'.base64_encode($list['g_p_id'])); ?>"  data-toggle="tooltip" title="Print"  class="btn btn-info">Print</a>
														 <a href="<?php echo base_url('hostelmanagement/gatepassinfoedit/'.base64_encode($list['g_p_id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
                                                       <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['g_p_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" data-toggle="modal" data-target="#myModal" title="Edit"><i class="fa fa-info-circle btn btn-warning"></i></a>		
			                                        <a href="javascript;void(0);" onclick="admindedelete('<?php echo base64_encode($list['g_p_id']) ?>');admindedeletemsg();" data-toggle="modal" data-target="#myModal" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
					                                 </td>
													</tr>
                                                    
                                                    
                                                   
                                                </tbody>
												<?php $cnt++;}?>
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
							$('#student_name').append("<option>select</option>");
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
function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('hostelmanagement/gatepassinfostatus/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('hostelmanagement/gatepassinfodelete/'); ?>"+"/"+id);
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