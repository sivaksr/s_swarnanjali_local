<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Book Damage/Book Lost</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
			 <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
		 <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab==''){ echo "active";} ?>"><a href="#tab_1" data-toggle="tab">Book Damage / Book Lost
			</a></li>
              <li class="<?php if(isset($tab) && $tab==1){ echo "active";} ?>"><a href="#tab_2" data-toggle="tab">Book Damage / Book Lost List</a></li>
             
            </ul>
		 
            <div class="tab-content">
              <div class="tab-pane <?php if(isset($tab) && $tab==''){ echo "active";} ?>" id="tab_1">
              <form id="defaultForm" method="POST" class="" action="<?php echo base_url('librarian/book_damage_post'); ?>">
			
				<div class="clearfix"> &nbsp;</div>
 						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Class list</label>
								<div class="">
								<select id="class_id" name="class_id" onchange="get_student_list(this.value);" class="form-control" >
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
									<select id="student_id" name="student_id" onchange="get_student_issued_book_list(this.value);" class="form-control" >
									<option value="">Select</option>
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
								
								</select>
								</div>
							</div>
                        </div>
					
								<div class="col-md-4">
							<div class="form-group">
							<label class=" control-label">Return</label>
										<div class="">
											<select onchange="get_type(this.value);" class="form-control" name="return_type" id="return_type"> 
												<option value="">Select type</option>
													<option value="Amount">Amount </option>
													<option value="Replace Book">Replace Book </option>
											</select>
										</div>
									</div>
                        </div>
						<div class="col-md-4" id="retur_type_div">
							<div class="form-group">
								<label class=" control-label">Price</label>
								<div class="">
									<input placeholder="Enter Price"  class="form-control" name="price" id="price" >
								</div>
							</div>
                        </div>
					
						<div class="clearfix"> </div>						
						<div class="col-md-3">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
							  <button type="submit"  class="btn btn-primary " id="validateBtn" name="validateBtn" value="check">Submit Book</button> &nbsp;
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
                  <th>Class Name</th>
                  <th>Student Name</th>
				  <th>Book No</th>
                  <th>Return</th>
                  <th>Price</th>
                  <th>Create_at</th>
                  
                </tr>
                </thead>
                <tbody>
				
				<?php foreach($damage_book as $list){?>
                <tr>
                 <td><?php echo $list['name'].' '.$list['section']; ?></td>
                  <td><?php echo $list['username']; ?></td>
				  <td><?php echo $list['book_number']; ?></td>
                  <td><?php echo $list['return_type']; ?></td>
                  <td><?php echo $list['price']; ?></td>
                  <td><?php echo $list['create_at']; ?></td>
                  
                 
                </tr>
				
				<?php }?>
				</tbody>
                <tfoot>
                <tr>
                  <th>Class Name</th>
                  <th>Student Name</th>
				  <th>Book No</th>
                  <th>Return</th>
                  <th>Price</th>
                  <th>Create_at</th>
                  
               
                 
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
  
  <script type="text/javascript">
  
  function get_type(val){
	  
	  if(val=='Amount'){
		 $('#retur_type_div').show(); 
	  }else{
		  $('#retur_type_div').hide(); 
		  $('#price').val(''); 
	  }
	  
  }
  
 
  
$(document).ready(function() {
   
    $('#defaultForm').bootstrapValidator({
//      
        fields: {
			 class_id:{
			   validators: {
					notEmpty: {
						message: 'Class list is required'
					}
				}
            }, 
			student_id:{
			   validators: {
					notEmpty: {
						message: 'Student Name is required'
					}
				}
            },
			book_number:{
			   validators: {
					notEmpty: {
						message: 'Book No is required'
					}
				}
            },
			return_type:{
			   validators: {
					notEmpty: {
						message: 'Return is required'
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
            }
			
			
        }
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
   			url: "<?php echo base_url('librarian/student_list_class');?>",
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
</script>
