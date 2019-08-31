
<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Fee List</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Fee List</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Student Fee List </h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- table start -->
                    <div style="padding:20px;">
                        <form id="defaultForm" method="post" class="" action="<?php echo base_url('student/fee'); ?>">
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label class=" control-label">Class</label>
                                    <div class="">
                                        <select id="class_id" name="class_id" class="form-control" >
                                           <option value="">Select Class</option>
											<?php foreach($class_list as $list){ ?>
											<option value="<?php echo $list['id'];?>"><?php echo $list['name'].' '.$list['section'];?></option>
											<?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-4 text-center">
                                <br>
                                <button  type="submit" class="btn btn-primary " name="signup" value="Sign up">Search</button>
                            </div>
                            <div class="clearfix">&nbsp;</div>
                        </form>

                        <div style="padding:20px;">
						<?php if(isset($class_details) && count($class_details)>0){ ?>
                            <div class="table-responsive">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Class List</th>
                                            <th>Father's name</th>
                                            <th>Mobile Number</th>
                                            <th>Total Fee</th>
                                            <th>Amount Paid</th>
                                            <th>Due Amount</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($class_details as $list){ ?>
                                        <tr>
                                             <td><?php echo isset($list['username'])?$list['username']:'' ?></td>
                                            <td><?php echo isset($list['name'])?$list['name']:'' ?><?php echo isset($list['section'])?$list['section']:'' ?></td>
                                            <td><?php echo isset($list['parent_name'])?$list['parent_name']:'' ?></td>
                                            <td><?php echo isset($list['mobile'])?$list['mobile']:'' ?></td>
                                            <td><?php echo isset($list['fee_amount'])?$list['fee_amount']:'' ?></td>
                                            <td><?php echo isset($list['pay_amount'])?$list['pay_amount']:'' ?></td>
                                           <td><?php echo $list['fee_amount'] - $list['pay_amount']?></td>

                                            
                                        </tr>
                                       
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
							<?php }else{ ?>
                       <div> No data available</div>
                          <?php }?>
							
							
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!--/.col (right) -->
    </section>
</div>
<script type="text/javascript">
  function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('transportation/studentstatus/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('transportation/studentdelete/'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
 
$(document).ready(function() {
   
    $('#defaultForm').bootstrapValidator({
//      
        fields: {
			 class_id:{
			   validators: {
					notEmpty: {
						message: 'Class  is required'
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