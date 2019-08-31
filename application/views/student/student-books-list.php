
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Student Books List
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Student Books List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>Admission Number</th>
                  <th>Student Name</th>
                  <th>Class</th>
                  <th>Books</th>
                  
                  
                </tr>
                </thead>
                <tbody>
				<?php if(isset($student_books_list) && count($student_books_list)>0){ ?>
							<tr>
								  <td><?php echo isset($student_books_list['roll_number'])?$student_books_list['roll_number']:'' ?></td>
								  <td><?php echo isset($student_books_list['username'])?$student_books_list['username']:'' ?></td>
								  <td><?php echo isset($student_books_list['name'])?$student_books_list['name']:'' ?>-<?php echo isset($student_books_list['section'])?$student_books_list['section']:'' ?></td>
								  <td>
								  <?php if(isset($student_books_list['books_list']) && count($student_books_list['books_list'])>0){?>
								  <?php foreach($student_books_list['books_list'] as $list){?>
								 <h5><li><?php echo $list['books']. '<br>'; ?></li></h5>
								  <?php }?>
								  <?php }else{?>
								  <div>No books available</div>
								  <?php }?>
								  </td>
							</tr>
						
				
				<?Php } ?>
                
                
                </tbody>
                <tfoot>
                  <tr>
                  <th>Admission Number</th>
                  <th>Student Name</th>
                  <th>Class</th>
                  <th>Books</th>
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