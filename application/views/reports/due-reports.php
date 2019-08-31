
 <?php if(isset($due_reports)&& count($due_reports)>0){?>
<div class="box-body table-responsive" style="background:#fff;">
<a target="_blank" href="<?php echo base_url('reports/dueprint');?>"  style="float:right;" class="btn btn-primary">Print</a>

               <table id="example1" class="table table-bordered table-striped">
                <thead>
               <tr>
						  <th>S.NO</th>
						  <th>Class</th>
						  <th>Student Name</th>
						  <th>Address</th>
						  <th>Parent Name</th>
						  <th>Phone Number</th>
						  <th>Due Amount</th>
						  <th>Fee Amount</th>
						  
						</tr>
						</thead>
						<tbody>
						<?php $cnt=1; foreach($due_reports as $list){?>
						<tr>
						
						  <th><?php echo $cnt;?></th>
						  <th><?php echo isset($list['class_name'])?$list['class_name']:''?>-<?php echo isset($list['section'])?$list['section']:''?></th>
						  <th><?php echo isset($list['name'])?$list['name']:''?></th>
						  <th>
						<?php echo isset($list['address'])?$list['address'].',':''; ?>
						<?php echo isset($list['current_city'])?$list['current_city'].',':''; ?>
						<?php echo isset($list['current_state'])?$list['current_state'].',':''; ?>
						<?php echo isset($list['current_country'])?$list['current_country'].',':''; ?>
						<?php echo isset($list['current_pincode'])?$list['current_pincode'].'.':''; ?>
						  </th>
						  <th><?php echo isset($list['parent_name'])?$list['parent_name']:''?></th>
						  <th><?php echo isset($list['mobile'])?$list['mobile']:''?></th>
						  <th><?php echo isset($list['due_amount'])?$list['due_amount']:''?></th>
						  <th><?php echo isset($list['fee_amount'])?$list['fee_amount']:''?></th>
						  
						</tr>
						<?php $cnt++;}?>
					</tbody>
                <tfoot>
                <tr>
             <th>S.NO</th>
			 <th>Class</th>
			<th>Student Name</th>
			<th>Address</th>
			<th>Parent Name</th>
			<th>Phone Number</th>
			<th>Due Amount</th>
			<th>Fee Amount</th>
                </tr>
                </tfoot>
              </table>
            </div>
				
				
					
                
         <?php }else{ ?>
 <div> No data available</div>
 <?php }?>       
			  
 
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

           
					
					
		