<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Attendence Report</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
            <form id="defaultForm1" method="POST" class="" action="<?php echo base_url('academic_mangement/attendance'); ?>">
						<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label">Class</label>
										<div class="">
											<select class="form-control" name="class_id" id="class_id"> 
												<option value="">Select Class</option>
												<?php foreach($class_list as $list){ ?>
													<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
												<?php } ?>
												
											</select>
										</div>
									</div>
                        </div>
							
						<div class="col-md-4">
							<div class="form-group">
                <label> Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="date" class="form-control pull-right" id="datepicker" required>
                </div>
                <!-- /.input group -->
              </div>
                        </div>		
						<div class="col-md-3">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
							  <button type="submit"  class="btn btn-primary " name="submit" value="check">Check</button>
							</div>
							<!-- /.input group -->
						  </div>
                        </div>
					
						<div class="clearfix">&nbsp;</div>
						
						
						
						
					
						<div class="clearfix">&nbsp;</div>
						 
						
                    </form>
					<div class="clearfix">&nbsp;</div>
					<?php if(isset($student_attandance) && count($student_attandance)>0){ ?>
		<div class="box attentdence-table" style="">
            <div class="box-header">
              <h3 class="">Attendence Report </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Roll No</th>
				  <?php foreach($class_time as $list){ ?>
                  <th><?php echo $list['form_time'].'-'.$list['to_time']; ?></th>
				  <?php } ?>
                  
                
                </tr>
                </thead>
                <tbody>
				<?php foreach($student_attandance as $list){ ?>
					 <tr>
					<td><?php echo $list['name']; ?></td>
					<td><?php echo $list['roll_number']; ?> </td>
					<?php $count='';$cnt=1;foreach($list['hours_list'] as $lis){ ?>
					<td><?php echo $lis['attendence']; ?></td>
					<?php 
							$count=$cnt;
							$cnt++;
						}
				    ?>
					<?php for($d=$count;$d<count($class_time);$d++){ ?>
						<td>&nbsp;
						</td>
					<?php } ?>
					
					 </tr>
				<?php } ?>
               
				 
				
					
                
                </tbody>
              
              </table>
            </div>
            <!-- /.box-body -->
          </div>
		  
		  <?php }else{ ?>
		  <div class="text-center">Current date No data Available</div>
		  <?php } ?>
          <!-- /.box -->
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

