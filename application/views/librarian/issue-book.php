<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Issue Book</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){ echo "active"; } ?>"><a href="#tab_1" data-toggle="tab">Issue Book</a></li>
              <li class="<?php if(isset($tab) && $tab==1){ echo "active"; } ?>"><a href="#tab_2" data-toggle="tab">Issued Books List</a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane <?php if(isset($tab) && $tab==''){ echo "active"; } ?>" id="tab_1">
              <form id="defaultForm1" method="post" class="" action="<?php echo base_url('librarian/issue_book_post'); ?>">
				<div class="col-md-12">
				<img style="width:250px;height:auto;margin:0 auto;" class="img-responsive thumbnail" src="https://forum.affinity.serif.com/uploads/monthly_2018_05/5b0029dccf77a_00860303002305UPC-ASST1.png.db7004fead686bd2bf77ed6257d25b53.png" alt="barcode">
				</div>
				<div class="clearfix"> &nbsp;</div>
 						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Scan</label>
								<div class="">
									<input class="form-control" placeholder="Enter Barcode No Manually" name="book_id" id="book_id">
								</div>
							</div>
                        </div>
						
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Class list</label>
								<div class="">
								<select id="class_id" name="class_id" onchange="get_student_list(this.value);"  class="form-control" >
								<option value="">Select</option>
								<?php foreach ($class_list as $list){ ?>
								<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>
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
								<option value="<?php echo $list['b_id']; ?>"><?php echo $list['book_number']; ?></option>
								<?php }?>
								</select>								</div>
							</div>
                        </div>
					
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">No. of Books Taken</label>
								<div class="">
									<input name="no_of_books" id="no_of_books" placeholder="No. of Books Taken" class="form-control" >
								</div>
							</div>
                        </div>
					
						<div class="col-md-4">
							<div class="form-group">
								<label>Date of Issue</label>

								<div class="input-group date" class="form-group ">
								  <div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								  </div>
								  <input type="text" name="date" class="form-control datepicker" id="datepicker" autocomplete="off"  placeholder="MM/DD/YYYY">
								</div>
								<!-- /.input group -->
							</div>
                        </div>	
						
						
						<div class="clearfix"> </div>						
						<div class="col-md-3">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
							  <button type="submit"  class="btn btn-primary " value="check">Issue Book</button>
							</div>
							<!-- /.input group -->
						  </div>
                        </div>
					
						<div class="clearfix">&nbsp;</div>
					</form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane <?php if(isset($tab) && $tab==1){ echo "active"; } ?>" id="tab_2">
				 <div class="clearfix"></div>
        
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Student Name</th>
                  <th>Student Roll No</th>
				  <th>Department</th>
                  <th>Book No</th>
                  <th>Book Title</th>
                  <th>No of Books Taken</th>
                  <th>Author</th>
                  <th>Publisher</th>
                  <th>Date Arrived</th>
                  <th>Date of Renewal</th>
                  <th>Date of Return</th>
                  <th>Status</th>
                 
                </tr>
                </thead>
                <tbody>
				<?php if(isset($issued_book_list) && count($issued_book_list)>0){ ?>
					<?php foreach($issued_book_list as $list){ ?>
					<tr>
					  <td><?php echo $list['name']; ?></td>
					  <td><?php echo $list['roll_number']; ?></td>
					  <td><?php echo $list['department']; ?></td>
					  <td><?php echo $list['book_number']; ?></td>
					  <td><?php echo $list['book_title']; ?></td>
					  <td><?php echo $list['no_of_books_taken']; ?></td>
					  <td><?php echo $list['author_name']; ?></td>
					  <td><?php echo $list['publisher']; ?></td>
					  <td><?php echo $list['issued_date']; ?></td>
					  <?php if($list['status']==2){?>
					  <td><?php echo $list['return_renew_date']; ?></td>
					  <?php }else{?>
					  <td></td>
					  <?php } ?>
					 <td><?php echo $list['return_date']; ?></td>
					 
					  <td>
						  <a class="btn btn-success btn-sm" href="" ><?php if($list['status']==1){ echo "Pending";}else if($list['status']==0){  echo "Return";}else if($list['status']==2){ echo "Renewal";} ?> </a> 
						  <!--<a class="btn btn-warning btn-sm" href="<?php echo base_url('librarian/return_book/'.base64_encode($list['i_b_id'])); ?>" >Return/Renew</a> -->
						
					  </td>
					</tr>
					<?php } ?>
				<?php } ?>
				</tbody>
                
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
  
  <script type="text/javascript">
  
$(document).ready(function() {
   
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
            },
			date: {
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
            }
        }
    });
    $('#datepicker').on('changeDate ', function(e) {
		$('#defaultForm1').bootstrapValidator('revalidateField', 'date');
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

