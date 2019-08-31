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
              <h3 class="box-title"> Edit Class  Subjects</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){  echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Edit Class  Subjects</a></li>
 </a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane active<?php if(isset($tab) && $tab==''){  echo "active";} ?>" id="tab_1">
              	<div class="">
        <div class="control-group" id="fields">
           
            <div class="controls"> 
                <form id="defaultForm" name="defaultForm" method="post"  action="<?php echo base_url('classwise/editsubjectpost'); ?>">
				<input type="hidden" id="id" name="id" value="<?php echo isset($edit_class_wise_subjects['id'])?$edit_class_wise_subjects['id']:'' ?>">
					<div class="col-md-6">
							<div class="form-group">
								<label class=" control-label">Class List</label>
								<div class="">
									<select id="class_id" name="class_id" class="form-control"  required>
								<option value="">Select</option>
								<?php if(isset($class_list) && count($class_list)>0){ ?>
											<?php foreach($class_list as $list){ ?>
											
													<?php if($edit_class_wise_subjects['class_id']==$list['id']){ ?>
															<option selected value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
													<?php }else{ ?>
															<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
													<?php } ?>
											<?php } ?>
										<?php } ?>
								
								</select>
								</div>
							</div>
                        </div>
						<div class="clearfix"></div>
                       
                    <div class="form-group">
					<label class=" control-label">Subject Name</label>
                    <div class="entry input-group col-md-6 ">

                       <input class="form-control" name="subject" type="text" placeholder="Subject name" value="<?php echo isset($edit_class_wise_subjects['subject'])?$edit_class_wise_subjects['subject']:''?>" >						

						
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
		</div>
		 </div>
		<div class="clearfix"> </div>
	</div>
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
			subject: {
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
	$(".popid").attr("href","<?php echo base_url('transportation/status/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('transportation/delete/'); ?>"+"/"+id);
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
