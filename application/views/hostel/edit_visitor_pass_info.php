<?php //echo'<pre>';print_r($hostel_details);exit; ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Edit Visitor Pass & Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div style="padding:20px;">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">

			   <li class="<?php if(isset($tab) && $tab==''){ echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Edit Visitor info
</a></li>
                                   
                                </ul>

                                <div class="tab-content">
             <div class="tab-pane active" id="tab_1">

                                        <form id="defaultForm" method="POST" class="" action="<?php  echo base_url('hostelmanagement/visitorpassinfoeditpost');?>">
                                       <input type="hidden" id="v_p_id" name="v_p_id" value="<?php echo isset($edit_visitor_pass_info['v_p_id'])?$edit_visitor_pass_info['v_p_id']:'' ?>">

										   <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Visitor Type</label>
                                                        <div class="">
                                                            <select class="form-control" name="visitor_type" value="<?php echo isset($edit_visitor_pass_info['visitor_type'])?$edit_visitor_pass_info['visitor_type']:'' ?>">
                                                                <option value="">NA</option>
                                                                <option value="Father" <?php if($edit_visitor_pass_info['visitor_type']=='Father'){ echo "selected"; } ?>>Father</option>
                                                                <option value="Mother" <?php if($edit_visitor_pass_info['visitor_type']=='Mother'){ echo "selected"; } ?> >Mother</option>
                                                                <option value="Uncle" <?php if($edit_visitor_pass_info['visitor_type']=='Uncle'){ echo "selected"; } ?>>Uncle</option>
                                                                <option value="Aunty" <?php if($edit_visitor_pass_info['visitor_type']=='Aunty'){ echo "selected"; } ?>>Aunty</option>
                                                                <option value="Brother" <?php if($edit_visitor_pass_info['visitor_type']=='Brother'){ echo "selected"; } ?>>Brother</option>
                                                                <option value="Sister" <?php if($edit_visitor_pass_info['visitor_type']=='Sister'){ echo "selected"; } ?>>Sister</option>
                                                                <option value="Other" <?php if($edit_visitor_pass_info['visitor_type']=='Other'){ echo "selected"; } ?>>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Visitor Name</label>
                                                        <div class="">
                                                            <input class="form-control" name="visitor_name" id="visitor_name" placeholder="Enter Name" value="<?php echo isset($edit_visitor_pass_info['visitor_name'])?$edit_visitor_pass_info['visitor_name']:'' ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">From Location</label>
                                                        <div class="">
                                                            <input class="form-control" name="location" id="location" placeholder="Enter Location" value="<?php echo isset($edit_visitor_pass_info['location'])?$edit_visitor_pass_info['location']:'' ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Contact Number</label>
                                                        <div class="">
                                                            <input class="form-control" name="contact_number" id="contact_number" placeholder="Enter Contact Number" value="<?php echo isset($edit_visitor_pass_info['contact_number'])?$edit_visitor_pass_info['contact_number']:'' ?>"> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Email Id</label>
                                                        <div class="">
                                                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?php echo isset($edit_visitor_pass_info['email'])?$edit_visitor_pass_info['email']:'' ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Visit Time</label>
                                                        <div class="">
                                                            <input class="form-control" name="visit_time" id="visit_time" placeholder="" value="<?php echo isset($edit_visitor_pass_info['visit_time'])?$edit_visitor_pass_info['visit_time']:'' ?>">
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