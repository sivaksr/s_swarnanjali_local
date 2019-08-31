<?php //echo'<pre>';print_r($hostel_details);exit; ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Home Work</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div style="padding:20px;">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){ echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Edit Home Work
</a></li>
             
            </ul>
							
                                

                                <div class="tab-content">
                                    
             <div class="tab-pane active<?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">
                                       <form id="defaultForm" method="POST" class="" action="<?php echo base_url('student/edithomeworkpost');?>">
                            <input type="hidden" name="h_w_id" id="h_w_id" value="<?php echo isset($edit_home_work['h_w_id'])?$edit_home_work['h_w_id']:'' ?>">              
											<div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Class</label>
                                                        <div class="">
														<select class="form-control" id="class_id" name="class_id" onchange="get_class_sujects(this.value);">
												<option value="">Select Class</option>
												<?php if(isset($class_list) && count($class_list)>0){ ?>
											<?php foreach($class_list as $list){ ?>
											
													<?php if($edit_home_work['class_id']==$list['class_id']){ ?>
															<option selected value="<?php echo $list['class_id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
													<?php }else{ ?>
															<option value="<?php echo $list['class_id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
													<?php } ?>
											<?php } ?>
										<?php } ?>
											</select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Subject</label>
                                                        <div class="">
														<select class="form-control" id="subjects" name="subjects">
											<option value="">Select</option>
											<?php if(isset($subject_list) && count($subject_list)>0){ ?>
											<?php foreach($subject_list as $list){ ?>
											
													<?php if($edit_home_work['subjects']==$list['id']){ ?>
															<option selected value="<?php echo $list['id']; ?>"><?php echo $list['subjects']; ?></option>
													<?php }else{ ?>
															<option value="<?php echo $list['id']; ?>"><?php echo $list['subjects']; ?></option>
													<?php } ?>
											<?php } ?>
										<?php } ?>
											</select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" control-label">Date of Home Work</label>
                                                        <div class="">
														<div class="input-group date">
														<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
												</div>
                                                            <input type="text" class="form-control" name="work_date" autocomplete="off" id="datepicker" placeholder="MM/DD/YYYY" value="<?php echo isset($edit_home_work['work_date'])?$edit_home_work['work_date']:'' ?>">
                                                        </div>
														</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
												<div class="form-group">
												<label>Home Work Submission Date</label>

												<div class="input-group date">
												<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right datechanges" autocomplete="off" id="datepicker1" autocomplete="off" name="work_sub_date" placeholder="MM/DD/YYYY" value="<?php echo isset($edit_home_work['work_sub_date'])?$edit_home_work['work_sub_date']:'' ?>">
												</div>

												</div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class=" control-label">Home Work</label>
                                                        <div class="">
                                                            <textarea class="form-control" name="work" id="work" placeholder="Enter Home Work" rows="5"><?php echo isset($edit_home_work['work'])?$edit_home_work['work']:'' ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"> </div>
                                            <div class="col-md-12">
                                                <div class="input-group pull-right">
                                                    <button type="submit" class="btn btn-primary " id="" name="" value="">Assign</button>
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
 $('#datepicker1').datepicker({
      autoclose: true
    });
	function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('student/homeworkstatus/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('student/homeworkdelete/'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
   $('#defaultForm').bootstrapValidator({
//       
        fields: {
            class_id: {
                 validators: {
					notEmpty: {
						message: 'Class is required'
					}
				}
            },
			subjects: {
                 validators: {
					notEmpty: {
						message: 'Subject is required'
					}
				}
            },
			work_date: {
                validators: {
					notEmpty: {
								message: 'Date of Home Work is required'
						},
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The value is not a valid date'
                    }
                }
            },
			work_sub_date: {
                validators: {
					notEmpty: {
								message: 'Home Work Submission Date is required'
						},
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The value is not a valid date'
                    }
                }
            },
            
            work: {
                 validators: {
					notEmpty: {
						message: 'Home Work is required'
					}
				}
            }
			
		
			
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
<script>
function get_class_sujects(class_id){
	  	if(class_id!=''){
			jQuery.ajax({

			url: "<?php echo base_url('student/get_teacher_class_subjects');?>",
			type: 'post',
			data: {
			class_id: class_id,
			},
			dataType: 'json',
				success: function (data) {
						$('#subjects').empty();
   						$('#subjects').append("<option value=''>select</option>");
   						for(i=0; i<data.list.length; i++) {
   							$('#subjects').append("<option value="+data.list[i].id+">"+data.list[i].subjects+"</option>");                      
                       }
				}
			
			});

	}
	  
  }
  </script>