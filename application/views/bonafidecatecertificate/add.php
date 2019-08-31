<?php //echo'<pre>';print_r($hostel_details);exit; ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Bonafide Certificate</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div style="padding:20px;">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
							<ul class="nav nav-tabs">

             
            </ul>
							
                          
                                                <div class="input-group pull-right">
                                                   <a Target="_blank" href="<?php echo base_url('bonafidecatecertificate/prints');?>"  class="btn btn-primary">Print</a>
                                                </div>
                                               

                                <div class="tab-content">
                                    
             <div class="tab-pane active<?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">
                                       <form id="defaultForm" method="POST"  class="" action="<?php echo base_url('bonafidecatecertificate/addpost');?>">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class=" control-label">Title</label>
                                                        <div class="">
														<input type="text" class="form-control" id="title" name="title"  placeholder="Enter Title" value="<?php echo isset($details['title'])?$details['title']:''; ?>">
												
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                               <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class=" control-label">Adminssion Number</label>
                                                        <div class="">
														<input type="text" class="form-control" id="adminssion_number" name="adminssion_number"  placeholder="Enter Adminssion Number" value="<?php echo isset($details['adminssion_number'])?$details['adminssion_number']:''; ?>">
												
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class=" control-label">Paragraph</label>
                                                        <div class="">
                                                            <textarea class="form-control" name="paragraph" id="paragraph" placeholder="Enter paragraph" rows="5"><?php echo isset($details['paragraph'])?$details['paragraph']:''; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"> </div>
                                            <div class="col-md-12">
                                                <div class="input-group pull-right">
                                                    <button type="submit" class="btn btn-primary " id="signup" name="signup" value="submit">Add</button>
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
 
	
   $('#defaultForm').bootstrapValidator({
//       
        fields: {
            title: {
                 validators: {
					notEmpty: {
						message: 'Title is required'
					}
				}
            },
			adminssion_number: {
                 validators: {
					notEmpty: {
						message: 'Adminssion Number is required'
					}
				}
            },
			paragraph: {
                 validators: {
					notEmpty: {
						message: 'Paragraph is required'
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
