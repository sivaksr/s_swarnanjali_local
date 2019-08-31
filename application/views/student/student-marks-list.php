
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Student Marks List
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Student Marks List</li>
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
                  <th>Exam Type</th>
                  <th>Subject</th>
                  <th>Marks Obtained</th>
                  <th>Maximum Marks</th>
                  <th>Remarks</th>
                  
                </tr>
                </thead>
                <tbody>
				<?php if(isset($marks_list) && count($marks_list)>0){ ?>
						<?php $cnt=1;foreach($marks_list as $list){ ?>
							<tr>
								  <td><?php echo $cnt; ?></td>
								  <td><?php echo isset($list['username'])?$list['username']:'' ?></td>
								  <td><?php echo isset($list['name'])?$list['name']:'' ?>-<?php echo isset($list['section'])?$list['section']:'' ?></td>
								  <td><?php echo isset($list['roll_number'])?$list['roll_number']:'' ?></td>
								  <td><?php echo isset($list['exam_type'])?$list['exam_type']:'' ?></td>
								  <td><?php echo isset($list['subject'])?$list['subject']:'' ?></td>
								  <td><?php echo isset($list['marks_obtained'])?$list['marks_obtained']:'' ?></td>
								  <td><?php echo isset($list['max_marks'])?$list['max_marks']:'' ?></td>
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
                  <th>Exam Type</th>
                  <th>Subject</th>
                  <th>Marks Obtained</th>
                  <th>Maximum Marks</th>
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