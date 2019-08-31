<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Book</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab"> Edit Add  New Book
</a></li>
              
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">
              <form id="defaultForm" method="POST" class="" action="<?php echo base_url('librarian/edit_post'); ?>">
			  			<input type="hidden" id="b_id" name="b_id" value="<?php echo $book['b_id'] ?>">

       
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Book Number</label>
								<div class="">
									<input class="form-control" name="book_number" id="book_number" value="<?php echo isset($book['book_number'])?$book['book_number']:''; ?>">
								</div>
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Book Title</label>
								<div class="">
									<input class="form-control" name="book_title" id="book_title" value="<?php echo isset($book['book_title'])?$book['book_title']:''; ?>">
								</div>
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Author Name</label>
								<div class="">
									<input class="form-control" name="author_name" id="author_name" value="<?php echo isset($book['author_name'])?$book['author_name']:''; ?>">
								</div>
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Publisher</label>
								<div class="">
									<input class="form-control" name="publisher" id="publisher" value="<?php echo isset($book['publisher'])?$book['publisher']:''; ?>">
								</div>
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Category</label>
								<div class="">
									<input class="form-control" name="category" id="category" value="<?php echo isset($book['category'])?$book['category']:''; ?>">
								</div>
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">ISBN</label>
								<div class="">
									<input class="form-control" name="isbn" id="isbn" value="<?php echo isset($book['isbn'])?$book['isbn']:''; ?>">
								</div>
							</div>
                        </div>	
						
							<div class="col-md-4">
							<div class="form-group">
								<label>Date arrived</label>

								<div class="input-group date">
								  <div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								  </div>
								  <input type="text" name="date" class="form-control pull-right" placeholder="MM/DD/YYYY" id="datepicker" autocomplete="off" value="<?php echo isset($book['date'])?$book['date']:''; ?>">
								</div>
								<!-- /.input group -->
							</div>
                        </div>	
						
						
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Price</label>
								<div class="">
									<input class="form-control" name="price" id="price" value="<?php echo isset($book['price'])?$book['price']:''; ?>">
								</div>
							</div>
                        </div>	
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Quantity</label>
								<div class="">
									<input class="form-control" name="qty" id="qty" value="<?php echo isset($book['qty'])?$book['qty']:''; ?>">
								</div>
							</div>
                        </div>	
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Shelf No</label>
								<div class="">
									<input class="form-control" name="shelf_no" id="shelf_no" value="<?php echo isset($book['shelf_no'])?$book['shelf_no']:''; ?>">
								</div>
							</div>
                        </div>	
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Department</label>
								<div class="">
									<input class="form-control" name="department" id="department" value="<?php echo isset($book['department'])?$book['department']:''; ?>">
								</div>
							</div>
                        </div>		
<div class="clearfix"> </div>						
						<div class="col-md-3">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
							  <button type="submit"  class="btn btn-primary " name="validateBtn" id="validateBtn" value="check">Add Book</button>
							</div>
							<!-- /.input group -->
						  </div>
                        </div>
					
						<div class="clearfix">&nbsp;</div>
						
						
						
						
					
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
  
    $('#defaultForm').bootstrapValidator({
//      
        fields: {
			 book_number:{
			   validators: {
					notEmpty: {
						message: 'Book Number is required'
					}
				}
            }, 
			book_title:{
			   validators: {
					notEmpty: {
						message: 'Book Title is required'
					}
				}
            },
			author_name:{
			   validators: {
					notEmpty: {
						message: 'Author Name is required'
					}
				}
            },
			publisher:{
			   validators: {
					notEmpty: {
						message: 'Publisher is required'
					}
				}
            },
			category:{
			   validators: {
					notEmpty: {
						message:'Category is required'
					}
				}
            },
			isbn:{
			   validators: {
					notEmpty: {
						message:'ISBN is required'
					}
				}
            },
			date: {
                validators: {
					notEmpty: {
								message: 'Date arrived is required'
						},
					date: {
                        format: 'MM/DD/YYYY',
                        message: 'The value is not a valid date'
                    }
				
				}
            },
			price: {
                validators: {
					notEmpty: {
						message: 'Price is required'
					},regexp: {
   					regexp:  /^[0-9]*$/,
   					message:'Price must be digits'
   					}
				}
            },
			qty: {
                validators: {
					notEmpty: {
						message: 'Quantity is required'
					},regexp: {
   					regexp:  /^[0-9]*$/,
   					message:'Quantity must be digits'
   					}
				}
            },
			shelf_no: {
                validators: {
					notEmpty: {
						message: 'Shelf No is required'
					}
				}
            },
			department: {
                validators: {
					notEmpty: {
						message: 'Department is required'
					}
				}
            }
			
			 
			
			
			
        }
    });
$('#datepicker').on('changeDate ', function(e) {
		$('#defaultForm').bootstrapValidator('revalidateField', 'date');
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

