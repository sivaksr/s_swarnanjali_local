<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Renew / Return Book</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
				<form id="defaultForm1" method="POST" class="" action="<?php echo base_url('librarian/return_bookpost'); ?>">
				<input  type="hidden" name="issued_book_id" id="issued_book_id" value="<?php echo $issued_book_details['i_b_id']; ?>">
				<div class="clearfix"> &nbsp;</div>
				<div class="row">
 						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Class list</label>
								<div class="">
								<select readonly="true" id="class_id" name="class_id" onchange="get_student_list(this.value);" class="form-control" >
								<option value="">Select</option>
								<?php foreach ($class_list as $list){ ?>
									<?php if($issued_book_details['class_id']==$list['id']){ ?>
									<option selected value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
										<?php }else{ ?>
									<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
									<?php } ?>
								<?php }?>
								</select>
								</div>
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Student Name</label>
								<div class="">
									<select id="student_id" name="student_id"  onchange="get_student_issued_book_list(this.value);" class="form-control" >
									<option value="<?php echo $issued_book_details['student_id']; ?>"><?php echo $issued_book_details['name']; ?></option>
									</select>
								</div>
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Book No</label>
								<div class="">
								<select id="book_number" name="book_number"  class="form-control" >
								<option value="<?php echo $issued_book_details['b_id']; ?>"><?php echo $issued_book_details['book_number']; ?></option>
								
								</select>
								</div>
							</div>
                        </div>
						</div>
						<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Type</label>
								<div class="">
								<select id="type" name="type"  class="form-control" >
								<option value="">Select</option>
								<option value="1">Renew</option>
								<option value="0">Return</option>
								</select>
								</div>
							</div>
                        </div>
							
						<div class="col-md-4">
							<div class="form-group">
								<label>Date of Issue</label>

								<div class="input-group date">
								  <div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								  </div>
								  <input type="text" name="issued_date" readonly="true" class="form-control pull-right" value="<?php echo $issued_book_details['issued_date']; ?>" id="issued_date">
								</div>
								<!-- /.input group -->
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Fine,if any</label>

						<div class="">
									<input placeholder="Enter Fine Amount" class="form-control" name="fine_if_any" id="fine_if_any" value="<?php echo isset($fine_amt)?$fine_amt:''; ?>">
								</div>
								<!-- /.input group -->
							</div>
                        </div>							
					
					</div>
						
						<div class="clearfix"> </div>						
						<div class="col-md-3">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
							  <button type="submit"  class="btn btn-primary " name="submit" value="check">Return Book</button>
							</div>
							<!-- /.input group -->
						  </div>
                        </div>
					
						<div class="clearfix">&nbsp;</div>
						
						
						
						
					
						<div class="clearfix">&nbsp;</div>
						 
						
                    </form>
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
  
  <script type="text/javascript">
  
$(document).ready(function() {
   
    $('#defaultForm1').bootstrapValidator({
//      
        fields: {
           class_id: {
                validators: {
                    notEmpty: {
                        message: 'Class name is required'
                    }
                }
            },
            student_id: {
                validators: {
                    notEmpty: {
                        message: 'Student Name is required'
                    }
                }
            }, 
			book_number: {
                validators: {
                    notEmpty: {
                        message: 'Book Number  is required'
                    }
                }
            },
			type: {
                validators: {
                    notEmpty: {
                        message: 'Type is required'
                    }
                }
            }
        }
    });

    // Validate the form manually
    $('#validateBtn').click(function() {
        $('#defaultForm1').bootstrapValidator('validate');
    });

    $('#resetBtn').click(function() {
        $('#defaultForm1').data('bootstrapValidator').resetForm(true);
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
   			url: "<?php echo base_url('librarian/get_student_list_class_wise');?>",
   			data: {
				class_id: class_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
								var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#student_id').empty();
							$('#student_id').append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#student_id').append("<option value="+parsedData.list[i].u_id+">"+parsedData.list[i].name+"</option>");                      
						}
						
   					}
           });
	   }
}
function get_student_issued_book_list(student_id){
	if(student_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('librarian/get_student_issued_book_list');?>",
   			data: {
				student_id: student_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
								var parsedData = JSON.parse(data);
						//alert(parsedData.list.length);
							$('#book_number').empty();
							$('#book_number').append("<option>select</option>");
							for(i=0; i < parsedData.list.length; i++) {
								//console.log(parsedData.list);
							$('#book_number').append("<option value="+parsedData.list[i].b_id+">"+parsedData.list[i].book_number+"</option>");                      
						}
						
   					}
           });
	   }
}
function get_book_issued_date(book_id){
	if(book_id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('librarian/get_book_issued_date');?>",
   			data: {
				book_id: book_id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
							var parsedData = JSON.parse(data);
						if(parsedData.msg=1){
							$('#issued_bbok_id').empty();
							$('#issued_bbok_id').val(parsedData.i_b_id);
							$('#issued_date').empty();
							$('#issued_date').val(parsedData.issued_date);
							$('#fine_if_any').empty();
							$('#fine_if_any').val(parsedData.fine_amt);
						}
						//alert(parsedData.list.length);
				}
           });
	   }
}
</script>
