<?php //echo'<pre>';print_r($book);exit;?>
<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Book</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){ echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Add  New Book
</a></li>
              <li class="<?php if(isset($tab) && $tab==1){ echo "active";} ?>"><a href="#tab_2" data-toggle="tab">Book Details </a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane <?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">
              <form id="defaultForm" method="POST" class="" action="<?php echo base_url('librarian/add_book_post'); ?>">
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Book Number</label>
								<div class="">
									<input class="form-control" name="book_number" id="book_number">
								</div>
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Book Title</label>
								<div class="">
									<input class="form-control" name="book_title" id="book_title">
								</div>
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Author Name</label>
								<div class="">
									<input class="form-control" name="author_name" id="author_name">
								</div>
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Publisher</label>
								<div class="">
									<input class="form-control" name="publisher" id="publisher">
								</div>
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Category</label>
								<div class="">
									<input class="form-control" name="category" id="category">
								</div>
							</div>
                        </div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">ISBN</label>
								<div class="">
									<input class="form-control" name="isbn" id="isbn">
								</div>
							</div>
                        </div>	
						
							
						<div class="col-md-4">
							<div class="form-group">
								<label> Date arrived</label>

								<div class="input-group date">
								  <div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								  </div>
								  <input type="text" name="date" class="form-control pull-right" id="datepicker" autocomplete="off" placeholder="MM/DD/YYYY">
								</div>
								<!-- /.input group -->
							</div>
                        </div>	
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Price</label>
								<div class="">
									<input class="form-control" name="price" id="price">
								</div>
							</div>
                        </div>	
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Quantity</label>
								<div class="">
									<input class="form-control" name="qty" id="qty">
								</div>
							</div>
                        </div>	
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Shelf No</label>
								<div class="">
									<input class="form-control" name="shelf_no" id="shelf_no">
								</div>
							</div>
                        </div>	
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Department</label>
								<div class="">
									<input class="form-control" name="department" id="department">
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
              <!-- /.tab-pane -->
              <div class="tab-pane <?php if(isset($tab) && $tab==1){ echo "active";} ?>" id="tab_2">
				 <div class="clearfix"></div>
        
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Book No</th>
                  <th>ISBN</th>
                  <th>Book Title</th>
                  <th>Author</th>
                  <th>Publisher</th>
                  <th>Date Arrived</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Shelf No</th>
                  <th>Department</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach($book_list as $list){ ?>
                <tr>
				
                  <td><?php echo $list['book_number']; ?></td>
                  <td><?php echo $list['isbn']; ?></td>
                  <td><?php echo $list['book_title']; ?></td>
                  <td><?php echo $list['author_name']; ?></td>
                  <td><?php echo $list['publisher']; ?></td>
                  <td><?php echo $list['date']; ?></td>
                  <td><?php echo $list['price']; ?></td>
                  <td><?php echo $list['qty']; ?></td>
                  <td><?php echo $list['shelf_no']; ?></td>
                  <td><?php echo $list['department']; ?></td>
				 <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
                 
				   <td>
					<a href="<?php echo base_url('librarian/edit/'.base64_encode($list['b_id'])); ?>"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
					<a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['b_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" data-toggle="modal" data-target="#myModal" title="Edit"><i class="fa fa-info-circle btn btn-warning"></i></a>
					<a href="javascript;void(0);" onclick="admindedelete('<?php echo base64_encode($list['b_id']) ?>');admindedeletemsg();" data-toggle="modal" data-target="#myModal" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
					</td>

				  
                </tr>            
				<?php } ?>
			
				</tbody>
				 <tfoot>
                <tr>
                  <th>Book No</th>
                  <th>ISBN</th>
                  <th>Book Title</th>
                  <th>Author</th>
                  <th>Publisher</th>
                  <th>Date Arrived</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Shelf No</th>
                  <th>Department</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                 </tfoot>
                
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
  function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('librarian/status/'); ?>"+"/"+id);
} 

function admindedelete(id){
	$(".popid").attr("href","<?php echo base_url('librarian/delete/'); ?>"+"/"+id);
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


  
  
  
  
  
  
  
  
  
  
  
  
  
  