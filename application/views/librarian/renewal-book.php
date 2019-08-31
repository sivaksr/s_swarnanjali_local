<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Renewal Book</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){ echo "active"; } ?>"><a href="#tab_1" data-toggle="tab">Renewal Book</a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane active<?php if(isset($tab) && $tab==''){ echo "active"; } ?>" id="tab_1">
              <form id="defaultForm1" method="post" class="" action="<?php echo base_url('librarian/renewalbook_post'); ?>">
      <input type="hidden" id="i_b_id" name="i_b_id" value="<?php echo $edit_renewal['i_b_id']; ?>">		

						<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Class list</label>
								<div class="">
								<select id="class_id" name="class_id" onchange="get_student_list(this.value);"  class="form-control" >
								<option value="">Select</option>
								<?php foreach ($class_list as $list){ ?>
								<?php if($list['id']==$edit_renewal['class_id']){ ?>
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
									<select id="student_id" name="student_id" class="form-control" >
									<option value="">Select</option>
								<?php foreach ($student_name as $list){ ?>
								<?php if($list['u_id']==$edit_renewal['student_id']){ ?>
									<option  selected value="<?php echo $list['u_id']; ?>"><?php echo $list['name']; ?></option>
								<?php }else{ ?>
									<option value="<?php echo $list['u_id']; ?>"><?php echo $list['name']; ?></option>
								<?php } ?>
							<?php }?>
									</select>
								</div>
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Book No</label>
								<div class="">
								<select id="book_number" name="book_number"  class="form-control" >
								<option value="">Select</option>
								<?php foreach ($book_list as $list){ ?>
								<?php if($list['b_id']==$edit_renewal['b_id']){ ?>
									<option  selected value="<?php echo $list['b_id']; ?>"><?php echo $list['book_number']; ?></option>
								<?php }else{ ?>
									<option value="<?php echo $list['b_id']; ?>"><?php echo $list['book_number']; ?></option>
								<?php } ?>
							<?php }?>
								
								
								</select>								</div>
							</div>
                        </div>
					
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">No. of Books Taken</label>
								<div class="">
									<input name="no_of_books" id="no_of_books" placeholder="No. of Books Taken"  value="<?php echo isset($edit_renewal['no_of_books_taken'])?$edit_renewal['no_of_books_taken']:''?>" class="form-control" >
								</div>
							</div>
                        </div>
					
						
						<div class="col-md-4">
							<div class="form-group">
								<label>Date of Issue</label>

								<div class="form-group">
								  
								  <input type="text" name="issued_date" class="form-control" id="datepicker" autocomplete="off" value="<?php echo isset($edit_renewal['issued_date'])?$edit_renewal['issued_date']:''?>"  placeholder="mm/dd/yyyy" >
								</div>
								<!-- /.input group -->
							</div>
                        </div>	
						
						<div class="col-md-4">
							<div class="form-group">
								<label>Date of Renewal Date</label>

								<div class="form-group">
								  
								  <input type="text" name="return_renew_date" class="form-control" id="datepicker1" autocomplete="off"   value="<?php echo isset($edit_renewal['return_renew_date'])?$edit_renewal['return_renew_date']:''?>"  placeholder="mm/dd/yyyy" >
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
							  <button type="submit"  class="btn btn-primary " value="check">Renewal Book</button>
							</div>
							<!-- /.input group -->
						  </div>
                        </div>
					
						<div class="clearfix">&nbsp;</div>
					</form>
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
  
  <script type="text/javascript">
  
$(document).ready(function() {
   $('#datepicker1').datepicker({
      autoclose: true
    });
    $('#defaultForm1').bootstrapValidator({
//      
        fields: {
            book_id: {
                validators: {
                    notEmpty: {
                        message: 'Scan Number is required'
                    },
					regexp: {
   					regexp: /^[a-zA-Z0-9. ]+$/,
   					message: 'Scan Number  by can only consist of alphanumeric, space and dot'
   					}
                }
            },
			class_id: {
                validators: {
                    notEmpty: {
                        message: 'Class list is required'
                    }
                }
            },
            student_id: {
                validators: {
                    notEmpty: {
                        message: 'Student Name list is required'
                    }
                }
            },
             book_number: {
                validators: {
                    notEmpty: {
                        message: 'Book Number is required'
                    },
					regexp: {
   					regexp: /^[a-zA-Z0-9. ]+$/,
   					message: 'Book Number  by can only consist of alphanumeric, space and dot'
   					}
                }
            },
			book_name: {
                validators: {
                    notEmpty: {
                        message: 'Book Name is required'
                    },
					regexp: {
   					regexp: /^[a-zA-Z0-9. ]+$/,
   					message: 'Book Name  by can only consist of alphanumeric, space and dot'
   					}
                }
            },issued_date: {
                validators: {
					notEmpty: {
								message: 'Date of Issue is required'
						},
					date: {
                        format: 'MM/DD/YYYY',
                        message: 'The value is not a valid date'
                    }
				
				}
            },
			no_of_books: {
                validators: {
                    notEmpty: {
                        message: 'No. of Books Taken is required'
                    },
					regexp: {
   					regexp:  /^[0-9]*$/,
   					message:'No. of Books Taken must be digits'
   					}
                }
            },
			return_renew_date: {
                                validators: {
				notEmpty: {
								message: 'Date of Renewal Date is required'
						},
					date: {
                        format: 'MM/DD/YYYY',
                        message: 'The value is not a valid date'
                    }
				
				}
            }
			
			
        }
    });
$('#datepicker').on('changeDate ', function(e) {
		$('#defaultForm1').bootstrapValidator('revalidateField', 'issued_date');
		});
		$('#datepicker1').on('changeDate ', function(e) {
		$('#defaultForm1').bootstrapValidator('revalidateField', 'return_renew_date');
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
   			url: "<?php echo base_url('librarian/get_student_list_class_wise');?>",
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
</script>

