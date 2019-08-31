<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Syllabus List</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
            	
				<div >
					
					<!-- /.box-header -->
					<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>Class</th>
						   <th>File</th>
						   <th>Status</th>
						  <th>Action</th>
						
						</tr>
						</thead>
						<tbody>
						<?php foreach($exam_syllabus_list as $list){?>
						<tr>
						   <td><?php echo isset($list['name'])?$list['name']:''?><?php echo isset($list['section'])?$list['section']:''?></td>
						    <td>
							 <?php if($list['document']!=''){ ?>
							<a  href="<?php echo base_url('assets/syllabus/'.$list['document']); ?> " class="btn btn-sm btn-primary">Download</a>
							<?php } ?>
							
							</td>
						    <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
						   <td class="">
					<a href="<?php echo base_url('examination/syllabusedit/'.base64_encode($list['e_s_id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
					<a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['e_s_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" data-toggle="modal" data-target="#myModal" title="Edit"><i class="fa fa-info-circle btn btn-warning"></i></a>
					<a href="javascript;void(0);" onclick="admindedelete('<?php echo base64_encode($list['e_s_id']) ?>');admindedeletemsg();" data-toggle="modal" data-target="#myModal" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
					</td>
						</tr>
						
						</tbody>
						<?php } ?>
					  </table>
					  <div class="clearfix">&nbsp;</div>
					
					</div>
					<!-- /.box-body -->
				  </div>
		
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
  <script type="text/javascript">
  $(document).ready(function(){
    $("#attentdence").click(function(){
        $(".attentdence-table").toggle();
    });
});
  
  </script>
  <script type="text/javascript">
  function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('examination/syllabusstatus/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('examination/syllabusdelete/'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
  
  
  
  
$(document).ready(function() {
   $('#defaultForm').bootstrapValidator({
//     
        fields: {
			student_id:{
			 validators: {
                    notEmpty: {
                        message: 'Student Name is required'
                    }
                }
            },
			
            exam_type: {
                validators: {
                    notEmpty: {
                        message: 'Exam Type is required'
                    }
                }
            },
			class_id: {
                validators: {
                    notEmpty: {
                        message: 'Class is required'
                    }
                }
            },
			subject: {
                validators: {
                    notEmpty: {
                        message: 'Subject is required'
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
<script>
function get_student_list(class_id){
	if(class_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('Examination/class_student_list');?>",
   			data: {
				class_id: class_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#student_id').empty();
							$('#student_id').append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#student_id').append("<option value="+parsedData.list[i].u_id+">"+parsedData.list[i].name+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}

function get_student_allsubjects_list(student_id){
	if(student_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('Examination/get_student_allsubjects_list');?>",
   			data: {
				student_id: student_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						
						if(data.msg=1){
							var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#subject').empty();
							$('#subject').append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#subject').append("<option value="+parsedData.list[i].name+">"+parsedData.list[i].subject+"</option>");                      
                    
								
							 
							}
						}
						
   					}
           });
	   }
}









</script>