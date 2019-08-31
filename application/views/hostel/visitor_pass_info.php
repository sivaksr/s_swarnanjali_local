<?php //echo'<pre>';print_r($hostel_details);exit; ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Visitor Pass & Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div style="padding:20px;">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
								<li class="<?php if(isset($tab) && $tab==''){ echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Visitor Pass
</a></li>
              <li class="<?php if(isset($tab) && $tab==1){ echo "active";} ?>"><a href="#tab_2" data-toggle="tab">Visitor Info</a></li>
			  
                                   
                                </ul>

                                <div class="tab-content">
                                   <div class="tab-pane  <?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">

                                        <form id="defaultForm" method="POST" class="" action="<?php  echo base_url('hostelmanagement/visitorpassinfopost');?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Visitor Type</label>
                                                        <div class="">
                                                            <select class="form-control" name="visitor_type">
                                                                <option value="">NA</option>
                                                                <option value="Father">Father</option>
                                                                <option value="Mother">Mother</option>
                                                                <option value="Uncle">Uncle</option>
                                                                <option value="Aunty">Aunty</option>
                                                                <option value="Brother">Brother</option>
                                                                <option value="Sister">Sister</option>
                                                                <option value="Other">Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Visitor Name</label>
                                                        <div class="">
                                                            <input class="form-control" name="visitor_name" id="visitor_name" placeholder="Enter Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">From Location</label>
                                                        <div class="">
                                                            <input class="form-control" name="location" id="location" placeholder="Enter Location">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Contact Number</label>
                                                        <div class="">
                                                            <input class="form-control" name="contact_number" id="contact_number" placeholder="Enter Contact Number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Email Id</label>
                                                        <div class="">
                                                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Visit Time</label>
                                                        <div class="">
                                                            <input class="form-control" name="visit_time" id="visit_time" placeholder="">
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
                                                        <th>Visitor Type</th>
                                                        <th>Visitor Name</th>
                                                        <th>From Location</th>
                                                        <th>Contact Number</th>
                                                        <th>Email Address</th>
                                                        <th>Visitor Time</th>
                                                        <th>Status</th>
														<th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php $cnt=1;foreach($visitor_pass_info as $list){ ?>
                                                    <tr>
                                                        <td><?php echo $cnt;?></td>
                                                        <td><?php echo isset($list['visitor_type'])?$list['visitor_type']:''?></td>
                                                        <td><?php echo isset($list['visitor_name'])?$list['visitor_name']:''?></td>
                                                        <td><?php echo isset($list['location'])?$list['location']:''?></td>
                                                        <td><?php echo isset($list['contact_number'])?$list['contact_number']:''?></td>
                                                        <td><?php echo isset($list['email'])?$list['email']:''?></td>
                                                        <td><?php echo isset($list['visit_time'])?$list['visit_time']:''?></td>
                                                         <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
														 <td>
														 <a target="_blank" href="<?php echo base_url('hostelmanagement/prints/'.base64_encode($list['v_p_id'])); ?>"  data-toggle="tooltip" title="Print"  class="btn btn-info">Print</a>

														 <a href="<?php echo base_url('hostelmanagement/visitorpassinfoedit/'.base64_encode($list['v_p_id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
                                                       <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['v_p_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" data-toggle="modal" data-target="#myModal" title="Edit"><i class="fa fa-info-circle btn btn-warning"></i></a>		
			                                        <a href="javascript;void(0);" onclick="admindedelete('<?php echo base64_encode($list['v_p_id']) ?>');admindedeletemsg();" data-toggle="modal" data-target="#myModal" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
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
function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('hostelmanagement/visitorpassinfostatus/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('hostelmanagement/visitorpassinfodelete/'); ?>"+"/"+id);
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
			 
			visitor_type:{
			   validators: {
					notEmpty: {
						message: 'Visitor Type is required'
					}
				}
            },
			visitor_name:{
			   validators: {
					notEmpty: {
						message: 'Visitor Name is required'
					}
				}
            },
			
			email: {
                validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },
			contact_number:{
			  validators: {
					notEmpty: {
						message:'Contact Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10}$/,
					message:'Contact Number must be 10 digits'
					}
				}
            },
			location: {
                validators: {
					notEmpty: {
						message: ' From Location is required'
					}
				}
            },
			
			visit_time: {
                validators: {
					notEmpty: {
						message: ' Visit Time is required'
					}
				}
            }
			
			
			
			
			
        }
    });

});
</script>