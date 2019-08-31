<?php //echo'<pre>';print_r($hostel_details);exit; ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Student Bus Payment Reports</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div style="padding:20px;">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
</a></li>
             
            </ul>
							
                                

                                <div class="tab-content">
                                    
             <div class="tab-pane active<?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">
                                       <form id="defaultForm" target="_blank"  method="POST"  class="" action="<?php echo base_url('student/printbuspayment');?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Form Date</label>
                                                        <div class="">
														<input type="text" name="fdate" id="fdate" class="form-control datepicker" autocomplete="off" placeholder="MM-DD-YYYY">
                                                        </div>
                                                    </div>
                                                </div>
												</div>
												<div class="row">
												
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">To Date</label>
                                                        <div class="">
														<input type="text" name="tdate" id="tdate" class="form-control datepicker" autocomplete="off" placeholder="MM-DD-YYYY">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                               
                                               
                                            </div>
											<br><br>
                                            <div class="clearfix"> </div>
                                            <div class="col-md-12">
                                                <div class="">
                                                    <button type="submit" class="btn btn-primary " id="" name="" value="">Go</button>
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
 $('.datepicker').datepicker({
      autoclose: true
    });
	


   $('#defaultForm').bootstrapValidator({
//       
        fields: {
          
			fdate: {
                validators: {
                   notEmpty: {
								message: 'Form Date is required'
						},
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The value is not a valid date'
                    }
                }
            },
			tdate: {
                validators: {
                   notEmpty: {
								message: 'To Date  is required'
						},
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The value is not a valid date'
                    }
                }
            },
			
		
			
        }
    });
	$('.datepicker').on('changeDate ', function(e) {
		$('#defaultForm').bootstrapValidator('revalidateField', 'fdate');
		});
		$('.datepicker').on('changeDate ', function(e) {
		$('#defaultForm').bootstrapValidator('revalidateField', 'tdate');
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
