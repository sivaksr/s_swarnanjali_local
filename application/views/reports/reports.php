
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Reports
      </h1>
      <ol class="breadcrumb">
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header bg-primary">
            <div class="col-md-6">
				<select class="form-control" id="reports_id" name="reports_id" onchange="get_reports_wise_list(this.value);" >
				<option value="">Select Reports</option>
				<option value="Fee Report">Fee Report</option>
				<option value="Due Report">Due Report</option>
				<option value="Paid Report">Paid Report</option>
				</select>
            </div>
			<!--<div class="col-md-2">
				<button class="btn btn-sm btn-default">Print</button>
			</div>-->
			 </div>
		
            
            <!-- /.box-header -->
			
            <div id="student_data"  style="">
			</div>
			
           
            <!-- /.box-body -->
          </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div><script>
  
  function get_reports_wise_list(reports_id){
	  	if(reports_id!=''){
			jQuery.ajax({

			url: "<?php echo base_url('reports/add');?>",
			type: 'post',
			data: {
			reports_id: reports_id,
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