<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Student
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header bg-primary">
            <div class="col-md-6">
              <select class="form-control" id="class_id" name="class_id" onchange="class_wide_student(this.value);">
				<option value="">Select Class Name</option>
				<?php foreach($class_list as $list){ ?>
					<option value="<?php echo $list['class_id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
				<?php } ?>
			 </select>
            </div>
			<!--<div class="col-md-2">
				<button class="btn btn-sm btn-default">Print</button>
			</div>-->
			 </div>
		
            
            <!-- /.box-header -->
			
            <div id="student_data" class="col-md-12" style="">
			</div>
			
           
            <!-- /.box-body -->
          </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div><script>
  
  function class_wide_student(class_id){
	  	if(class_id!=''){
			jQuery.ajax({

			url: "<?php echo base_url('student/get_class_wise_student_list');?>",
			type: 'post',
			data: {
			class_id: class_id,
			},
			dataType: 'html',
			success: function (data) {
			$("#student_data").empty();
			$("#student_data").append(data);
			}
			
			});

	}
	  
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