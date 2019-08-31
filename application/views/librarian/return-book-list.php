<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Renew / Return Book List</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
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
                  <th>Action</th>
                 
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
						  <a class="btn btn-warning btn-xs" href="" ><?php if($list['status']==1){ echo "Pending";}else if($list['status']==0){  echo "Return";}else if($list['status']==2){ echo "Renewal";} ?> </a> 
						  <!--<a class="btn btn-warning btn-sm" href="<?php echo base_url('librarian/return_book/'.base64_encode($list['i_b_id'])); ?>" >Return/Renew</a>-->
						
					  </td>
					  <?php if($list['status']!=0){?>
					  <td class="text-center">
					  
					<div>
					    <a  href="<?php echo base_url('librarian/returnbook/'.base64_encode($list['i_b_id'])); ?>" class="btn btn-primary btn-xs">Return </a> 
					</div>
					  
<br/>					
					<div>
						<a  href="<?php echo base_url('librarian/renewalbook/'.base64_encode($list['i_b_id'])); ?>" class="btn btn-danger btn-xs">Renewal </a> 
					</div>
					  </td>
					<?php }else{?>
					  <td class="text-center">
					<div>
					    <a  href="<?php echo base_url('librarian/returnbook/'.base64_encode($list['i_b_id'])); ?>" class="btn btn-primary btn-xs">Return </a> 
					</div>
					</td>
					<?php }?>
					</tr>
					<?php } ?>
				<?php } ?>
				</tbody>
                
                
              </table>
            </div>
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
            firstName: {
                group: '.col-lg-4',
                validators: {
                    notEmpty: {
                        message: 'The first name is required and cannot be empty'
                    }
                }
            },
            
            captcha: {
                validators: {
                    callback: {
                        message: 'Wrong answer',
                        callback: function(value, validator) {
                            var items = $('#captchaOperation').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
                            return value == sum;
                        }
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

