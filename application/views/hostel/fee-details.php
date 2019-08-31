<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Fee Details </h3>
            </div>
        
			<div style="padding:20px;">
			 <div class="col-md-12">
			 <table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
                  <th>S. No</th>
                  <th>Name of the Student</th>
                  <th>Staff Name</th>
                  <th>Guardian Name</th>
                  <th>Guardian Contact Number</th>
                  <th>Total Amount</th>
                  <th>Amount Paid</th>
                  <th>Due Amount</th>
                </tr>
                </thead>
                <tbody>
				<?php if(isset($fee_list)&& count($fee_list)>0){?>
				<?php $cnt=1; foreach($fee_list as $list){?>
                <tr>
				
                  <td><?php echo $cnt;?></td>
                  <td><?php echo isset($list['username'])?$list['username']:''?></td>
                  <td><?php echo isset($list['staff_name'])?$list['staff_name']:''?></td>
                  <td><?php echo isset($list['guardian_name'])?$list['guardian_name']:''?></td>
                  <td><?php echo isset($list['g_contact_number'])?$list['g_contact_number']:''?></td>
                  <td><?php echo isset($list['total_amount'])?$list['total_amount']:''?></td>
                  <td><?php echo isset($list['paid_amount'])?$list['paid_amount']:''?></td>
                  <td><?php echo isset($list['due_amount'])?$list['due_amount']:''?></td>
                 
                </tr>
				
				<?php $cnt++;}?>
				<?php }?>
				</tbody>
             
              </table>
         
			</div>
       
        </div>
       
          <!-- /.box -->
		   <div class="clearfix"></div>
          </div>
		 
          </div>
          <!-- /.box -->

         

        </div>
      
     
	  
    </section> 
   
</div>
  
  
 
  </script>
  <script type="text/javascript">
  
$(document).ready(function() {
    $('#defaultForm').bootstrapValidator({
        
        fields: {
            
            student_name: {
                 validators: {
					notEmpty: {
						message: 'Student Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Student Name can only consist of alphanumeric, space and dot'
					}
					
				}
            },
			father_name: {
                 validators: {
					notEmpty: {
						message: 'Father Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Father Name can only consist of alphanumeric, space and dot'
					}
					
				}
            },
			
			contact_number: {
                 validators: {
					notEmpty: {
						message: 'Contact Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10}$/,
					message:'Contact Number must be 10 digits'
					}
				
				}
            },
			fee_occurrence: {
                 validators: {
					notEmpty: {
						message: 'Fee Occurrence is required'
					},
					
				}
            },
			total_amount: {
                 validators: {
					notEmpty: {
						message: 'Total Amount is required'
					},
					regexp: {
   					regexp:  /^[0-9]*$/,
   					message:'Total Amount must be digits'
   					}
					
				}
            },
			amount_paid: {
                 validators: {
					notEmpty: {
						message: 'Amount Paid is required'
					},
					regexp: {
   					regexp:  /^[0-9]*$/,
   					message:'Amount Paid must be digits'
   					}
					
				}
            },
			due_amount: {
                 validators: {
					notEmpty: {
						message: 'Due Amount is required'
					},
					regexp: {
   					regexp:  /^[0-9]*$/,
   					message:'Due Amount must be digits'
   					}
					
				}
            },
			payment_mode: {
                 validators: {
					notEmpty: {
						message: 'Payment Mode is required'
					},
					
				}
            }
			
            }
        })
     
});
</script>
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
