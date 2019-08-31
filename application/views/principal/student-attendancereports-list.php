
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Attendence Reports For Students
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-body">
				  	<?php if(isset($student_attandance) && count($student_attandance)>0){ ?>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Class</th>
                  <th>Name</th>
                  <th>Admission Number</th>
				<?php if(isset($students_attandances['hours']) && count($students_attandances['hours'])>0){ ?>  
				  <?php foreach($students_attandances['hours'] as $lis){ ?>
                  <th><?php echo $lis['time']; ?></th>
				  <?php } ?>
                  
                <?php } ?>
                </tr>
                </thead>
                <tbody>
			
				<?php  foreach($student_attandance as $list){?>
							 <tr>
					<td><?php echo $list['class_name']; ?><?php echo $list['section']; ?></td>
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
			    <?php }else{ ?>
		  <div class="text-center">Current date No data Available</div>
		  <?php } ?>
            </div>
			
            <!-- /.box-body -->
          </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

<script>
 function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('school/status'); ?>"+"/"+id);
} 
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('school/delete'); ?>"+"/"+id);
}
function admindedeletemsg(id){
	$('#content1').html('Are you sure you want to delete?');
	
}

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