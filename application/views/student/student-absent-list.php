
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Student Absent List
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Student Absent List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Student Name</th>
                  <th>Class</th>
                  <th>Admission Number</th>
                  <th>Class Teacher</th>
                  <th>Subject</th>
                  <th>Time</th>
                  <th>Date</th>
                  <th>Attendance</th>
                  <th>Remarks</th>
                  
                </tr>
                </thead>
                <tbody>
				<?php if(isset($absent_list) && count($absent_list)>0){ ?>
						<?php $cnt=1;foreach($absent_list as $list){ ?>
							<tr>
								  <td><?php echo $cnt; ?></td>
								  <td><?php echo isset($list['username'])?$list['username']:'' ?></td>
								  <td><?php echo isset($list['name'])?$list['name']:'' ?>-<?php echo isset($list['section'])?$list['section']:'' ?></td>
								  <td><?php echo isset($list['roll_number'])?$list['roll_number']:'' ?></td>
								  <td><?php echo isset($list['teacher'])?$list['teacher']:'' ?></td>
								  <td><?php echo isset($list['subject'])?$list['subject']:'' ?></td>
								  <td><?php echo isset($list['timings'])?$list['timings']:'' ?></td>
								  <td><?php echo date('d-M-Y',strtotime(htmlentities($list['created_at'])));?></td>
								  <td><?php echo isset($list['attendence'])?$list['attendence']:'' ?></td>
								  <td><?php echo isset($list['remarks'])?$list['remarks']:'' ?></td>
							</tr>
						<?php $cnt++;} ?>
				
				<?Php } ?>
                
                
                </tbody>
                <tfoot>
                  <tr>
                  <th>S.No</th>
                  <th>Student Name</th>
                  <th>Class</th>
                  <th>Admission Number</th>
				   <th>Class Teacher</th>
                  <th>Subject</th>
                  <th>Time</th>
                  <th>Date</th>
                  <th>Attendance</th>
                  <th>Remarks</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

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