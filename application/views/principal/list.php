
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Principal assign instructions for teachers List
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Principal assign instructions for teachers List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Teacher Modules</th>
                  <th>Teachers</th>
                  <th>Mobile Numbers</th>
                  <th>Instractions</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
				<?php if(isset($teacher_list)&& count($teacher_list)>0){?>
				<?php $cnt=1; foreach($teacher_list as $list){?>
							<tr>
							<td><?php echo $cnt;?></td>
							<td><?php echo isset($list['modules'])?$list['modules']:'' ?></td>	 
							<td>
							<?php if(isset($list['teacher'])&& count($list['teacher'])>0){?>
							<?php foreach($list['teacher'] as $lis) { ?>
							<li><?php echo $lis['name']. '<br>'; ?></li>
							<?php } ?>
							<?php } ?>
							</td>	 
							<td>
							<?php if(isset($list['teacher'])&& count($list['teacher'])>0){?>
							<?php foreach($list['teacher'] as $lis) { ?>
							<li><?php echo $lis['mobile']. '<br>'; ?></li>
							<?php } ?>
							<?php } ?>
							</td>	 
							<td><?php echo isset($list['instractions'])?$list['instractions']:'' ?></td>	 
							<td><?php echo isset($list['created_at'])?$list['created_at']:'' ?></td>	 
							 
								 
							</tr>
				<?php $cnt++;}?>
                
                <?php }?>
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
			
			<div style="padding:10px">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 style="pull-left" class="modal-title">Confirmation</h4>
			</div>
			<div class="modal-body">
			<div class="alert alert-danger alert-dismissible" id="errormsg" style="display:none;"></div>
			  <div class="row">
				<div id="content1" class="col-xs-12 col-xl-12 form-group">
				Are you sure ? 
				</div>
				<div class="col-xs-6 col-md-6">
				  <button type="button" aria-label="Close" data-dismiss="modal" class="btn  blueBtn">Cancel</button>
				</div>
				<div class="col-xs-6 col-md-6">
                <a href="?id=value" class="btn  blueBtn popid" style="text-decoration:none;float:right;"> <span aria-hidden="true">Ok</span></a>
				</div>
			 </div>
		  </div>
      </div>
      
    </div>
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