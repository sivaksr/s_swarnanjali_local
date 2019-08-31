 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Student Details  
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
		<div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            
            
              <!-- /.tab-pane -->
			<div class="modal-body">
			
					<a href="<?php echo base_url('student/editdetails/'.base64_encode($student_details['u_id'])); ?>" style="float:left;" ><i class="fa fa-pencil btn btn-primary"></i></a>	
					
				<a href="javascript;void(0);" style="float:right;" data-toggle="modal" data-target="#squarespaceModal<?php echo $student_details['u_id']; ?>"  title="View"><i class="fa fa-eye btn btn-success"></i></a>
              <?php if(isset($student_list)&& count($student_list)>0){ ?>
				<?php $cnt=1; foreach($student_list as $list){?>
				<div class="modal fade" id="squarespaceModal<?php echo $list['u_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
								<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-primary">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
										<h3 class="modal-title" id="lineModalLabel"><?php echo $list['name']; ?>&nbsp;&nbsp;Profile View</h3>
									</div>
									<div class="modal-body">
										
									   <div class="row">
											<div class="col-md-3 col-lg-3 " align="center">
											<?php if($userdetails['profile_pic']!=''){?>
											<img src="<?php echo base_url('assets/adminpic/'.$userdetails['profile_pic']);?>" class="img-circle img-responsive" alt="<?php echo htmlentities($userdetails['profile_pic']); ?>" />
											<?php }else{ ?>
											<img src="<?php echo base_url();?>assets/vendor/201811.svg" class="img-circle img-responsive" alt="User Image" />
											<?php } ?>
											</div>
										   
											<div class=" col-md-9 col-lg-9 "> 
											  
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Name of the Student</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['name'])?$list['name']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Class</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['class_name'])?$list['class_name']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Admission Number</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['roll_number'])?$list['roll_number']:''; ?>
												  </div>
											  </div>
											  <!--<div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Total Fee Amount</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['fee_amount'])?$list['fee_amount']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Fee Terms</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['fee_terms'])?$list['fee_terms']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Paid Amount</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['pay_amt'])?$list['pay_amt']:''; ?> ( <b><strong>Due  Amount </strong></b>: <?php echo $list['fee_amount']- $list['pay_amt'] ; ?>)
												  </div>
											  </div>-->
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Date of Join</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo date('d-m-Y',strtotime(htmlentities($list['doj'])));?>
												  </div>
											  </div> 
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Gender</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['gender'])?$list['gender']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Address</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['address'])?$list['address'].', ':''; ?>
												  <?php echo isset($list['current_city'])?$list['current_city'].', ':''; ?>
												  <?php echo isset($list['current_state'])?$list['current_state'].', ':''; ?>
												  <?php echo isset($list['current_country'])?$list['current_country'].', ':''; ?>
												  <?php echo isset($list['current_pincode'])?$list['current_pincode'].'.':''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Email</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['parent_email'])?$list['parent_email']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Name of the Parent</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['parent_name'])?$list['parent_name']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Mobile Number</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php echo isset($list['mobile'])?$list['mobile']:''; ?>
												  </div>
											  </div>
											  <div class="row">
												  <div class="col-md-6 col-xs-6 col-sm-6">
													<strong>Status</strong>
												  </div>
												  <div class="col-md-6 col-xs-6 col-sm-6">
												  <?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?>
												  </div>
											  </div>
										  </div>

									</div>
									<div class="modal-footer">
										<div class="btn-group btn-group-justified" role="group" aria-label="group button">
											<div class="">
												<button type="button" class="btn btn-danger btn-sm " data-dismiss="modal"  role="button">Close</button>
												<a href="<?php echo base_url('student/editdetails/'.base64_encode($list['u_id'])); ?>" class="btn btn-warning btn-sm"  role="button">Edit</a>
												
												<?php if($list['pay_amt'] < $list['fee_amount']){ ?>
												<a href="<?php echo base_url('student/payment/'.base64_encode($list['u_id'])); ?>" class="btn btn-primary btn-sm"  role="button">Payment</a>
												<?php } ?>
											</div>
											
										</div>
									</div>
								</div>
							  </div>
							</div>
							  
						<?php $cnt++;} ?>
				
				
				</div>
				<?php }?>
				
				
				
				<div class="row">
				<div class="col-md-2 col-lg-2 " align="center">
				<?php if($student_details['profile_pic']!=''){?>
				<img src="<?php echo base_url('assets/adminpic/'.$student_details['profile_pic']);?>" class="img-circle img-responsive" alt="<?php echo htmlentities($student_details['profile_pic']); ?>" />
				<?php }else{ ?>
				<img src="<?php echo base_url();?>assets/vendor/201811.svg" class="img-circle img-responsive" alt="User Image" />
				<?php } ?>
				</div>

				<div class=" col-md-6 col-lg-6 "> 

				<div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Name of the Student</strong>
				</div>
				<div class="col-md-6 col-xs-6 col-sm-6">
				:&nbsp;&nbsp;<?php echo isset($student_details['name'])?$student_details['name']:''?>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Gender</strong>
				</div>
				<div class="col-md-6 col-xs-6 col-sm-6">
				:&nbsp;&nbsp;<?php echo isset($student_details['gender'])?$student_details['gender']:''?>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Date of Birth</strong>
				</div>
				<div class="col-md-6 col-xs-6 col-sm-6">
				:&nbsp;&nbsp;<?php echo isset($student_details['dob'])?$student_details['dob']:''?>
				</div>
				</div>
				
				<div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Blood Group</strong>
				</div>
				<div class="col-md-6 col-xs-6 col-sm-6">
				:&nbsp;&nbsp;<?php echo isset($student_details['blodd_group'])?$student_details['blodd_group']:'' ?>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Address</strong>
				</div>
				<div class="col-md-6 col-xs-6 col-sm-6">
				:&nbsp;&nbsp;<?php echo isset($student_details['address'])?$student_details['address'].',':''; ?>
						<?php echo isset($student_details['current_city'])?$student_details['current_city'].',':''; ?>
						<?php echo isset($student_details['current_state'])?$student_details['current_state'].',':''; ?>
						<?php echo isset($student_details['current_country'])?$student_details['current_country'].',':''; ?>
						<?php echo isset($student_details['current_pincode'])?$student_details['current_pincode'].'.':''; ?>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Class</strong>
				</div>
				<div class="col-md-6 col-xs-6 col-sm-6">
				:&nbsp;&nbsp;<?php echo isset($student_details['classname'])?$student_details['classname']:''?>&nbsp;<?php echo isset($student_details['section'])?$student_details['section']:''?>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Date of Join</strong>
				</div>
				<div class="col-md-6 col-xs-6 col-sm-6">
				:&nbsp;&nbsp;<?php echo isset($student_details['doj'])?$student_details['doj']:'' ?>
				</div>
				</div> 
				<div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Admission Number</strong>
				</div>
				<div class="col-md-6 col-xs-6 col-sm-6">
				:&nbsp;&nbsp;<?php echo isset($student_details['roll_number'])?$student_details['roll_number']:''?>
				</div>
				</div>
				
				
				
				
				<div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Name of the Parent :</strong>
				</div>
				<div class="col-md-6 col-xs-3 col-sm-3">
				:&nbsp;&nbsp;<?php echo isset($student_details['parent_name'])?$student_details['parent_name']:'' ?>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Gender</strong>
				</div>
				<div class="col-md-6 col-xs-6 col-sm-6">
				:&nbsp;&nbsp;<?php echo isset($student_details['parent_gender'])?$student_details['parent_gender']:'' ?>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Parent Email</strong>
				</div>
				<div class="col-md-6 col-xs-6 col-sm-6">
				:&nbsp;&nbsp;<?php echo isset($student_details['parent_email'])?$student_details['parent_email']:'' ?>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Mobile Number</strong>
				</div>
				<div class="col-md-6 col-xs-6 col-sm-6">
				:&nbsp;&nbsp;<?php echo isset($student_details['mobile'])?$student_details['mobile']:'' ?>
				</div>
				</div>
              <div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Parent Education</strong>
				</div>
				<div class="col-md-6 col-xs-6 col-sm-6">
				:&nbsp;&nbsp;<?php echo isset($student_details['education'])?$student_details['education']:'' ?>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-xs-6 col-sm-6">
				<strong>Parent Profession</strong>
				</div>
				<div class="col-md-6 col-xs-6 col-sm-6">
				:&nbsp;&nbsp;<?php echo isset($student_details['profession'])?$student_details['profession']:'' ?>
				</div>
				</div>
				
				
				
				</div>

				</div>
  
            
    
              
              
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
	</section>
 </div>
 </div>

 