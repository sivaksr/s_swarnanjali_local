<style>
.entry:not(:first-of-type)
{
    margin-top: 10px;
}
.glyphicon
{
    font-size: 12px;
}
.input-group[class*=col-] {
    float: none;
    padding-right: 14px;
    padding-left: 14px;
}
</style>
<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Class  Subjects</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){  echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Add Class  Subjects</a></li>
               <li class="<?php if(isset($tab) && $tab==1){  echo "active";} ?>"><a href="#tab_2" data-toggle="tab">Class Subjects List
 </a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane <?php if(isset($tab) && $tab==''){  echo "active";} ?>" id="tab_1">
              	<div class="">
        <div class="control-group" id="fields">
           
            <div class="controls"> 
                <form id="" name="defaultForm" method="post"  action="<?php echo base_url('classwise/addsubjectpost'); ?>">
					<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Class List</label>
								<div class="">
									<select id="class_id" name="class_id" class="form-control"  required>
								<option value="">Select</option>
								<?php foreach($class_list as $list){ ?>
									<option   value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
									<?php }?>
								</select>
								</div>
							</div>
                        </div>
						<div class="clearfix"></div>

                    <div class="form-group">
					<label class=" control-label">Subject Name</label>

                    <div class="entry input-group col-md-6 ">

                       <input class="form-control" name="subject[]" type="text" placeholder="Subject name"  required>						
                    	<span class="input-group-btn">
						
                            <button class="btn btn-success btn-add" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
					</div>
					</div>
                    
                
         
            </div>
        </div>
		<div class="clearfix"> </div>						
						<div class="col-md-6">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
							  <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Add Subject</button>

							</div>
							<!-- /.input group -->
						  </div>
                        </div>
		</form>
		<div class="clearfix"> </div>
	</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane <?php if(isset($tab) && $tab==1){  echo "active";} ?>" id="tab_2">
				 <div class="clearfix"></div>
        
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Class List</th>
                  <th>Subject Name</th>
                  <th>status</th>
                  <th>Action</th>
                </tr>
                </thead>
				<?php if(isset($class_wise_subjects) && count($class_wise_subjects)>0){ ?>
                <tbody>
				<?php foreach($class_wise_subjects as $list){ ?>
					<tr>
					  <td><?php echo $list['name']; ?>-<?php echo $list['section']; ?></td>
					  <td>
					  <?php echo isset($list['subject'])?$list['subject']:''?>
					  </td>
				     <td><?php if($list['status']==1){ echo "Active";}else{  echo "Deactive"; } ?></td>
					   <td>
						<a href="<?php echo base_url('classwise/editsubject/'.base64_encode($list['id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
						<a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" data-toggle="modal" data-target="#myModal" title="Edit"><i class="fa fa-info-circle btn btn-warning"></i></a>
						<a href="javascript;void(0);" onclick="admindedelete('<?php echo base64_encode($list['id']) ?>');admindedeletemsg();" data-toggle="modal" data-target="#myModal" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
					</td>
					</tr>
				<?php } ?>
				</tbody>
                <?php } ?>
				
				
				
              </table>
            </div>
            <!-- /.box-body -->
          </div>
              </div>
              <!-- /.tab-pane -->
           
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
       
          <!-- /.box -->
		   <div class="clearfix"></div>
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
  
  <script>
$(document).ready(function() {
 
   $('#defaultForm').bootstrapValidator({
//       
        fields: {
            class_id: {
                validators: {
					notEmpty: {
						message: 'Class Name is required'
					}
					
				}
            },
			'subject[]': {
                validators: {
					notEmpty: {
						message: 'Subject Name is required'
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
  <script type="text/javascript">
   function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('classwise/subjectstatus/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('classwise/subjectdelete/'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
  
  $(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();
        var controlForm = $('.controls form:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('.entry:first').remove();
		e.preventDefault();
		return false;
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
