
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Student Payment  
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Student Payment </li>
      </ol>
    </section>

    <!-- Main content -->
	<section class="content ">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary" style="padding:20px;">
					<div class="wizard">
            <h1>Student Payment</h1>
            
			<?php //echo '<pre>';print_r($student_details);exit; ?>

                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                        
						<div class=" col-md-6">
						<h3>Details</h3>
                        <table class="table table-bordered">
							
							<tbody>
							<tr>
								<th>School Name</th>
								<td><?php echo isset($student_details['scl_bas_name'])?$student_details['scl_bas_name']:''; ?></td>
							  </tr>
							  <tr>
								<th>Name</th>
								<td><?php echo isset($student_details['name'])?$student_details['name']:''; ?></td>
							  </tr>
							  <tr>
								<th>Class</th>
								<td><?php echo isset($student_details['classname'])?$student_details['classname']:''; ?>&nbsp;&nbsp;<?php echo isset($student_details['section'])?$student_details['section']:''; ?></td>
							  </tr>
							  <tr>
								<th>Partent Name</th>
								<td><?php echo isset($student_details['parent_name'])?$student_details['parent_name']:''; ?></td>
							  </tr>
							  <tr>
								<th>Address</th>
								<td>
								<?php echo isset($student_details['address'])?$student_details['address'].',':''; ?>
								<?php echo isset($student_details['current_city'])?$student_details['current_city'].',':''; ?>
								<?php echo isset($student_details['current_state'])?$student_details['current_state'].',':''; ?>
								<?php echo isset($student_details['current_country'])?$student_details['current_country'].',':''; ?>
								<?php echo isset($student_details['current_pincode'])?$student_details['current_pincode'].'.':''; ?>
								</td>
							  </tr>
							 
							</tbody>
						  </table>
						  </div>
						  
						  
						  <div class=" col-md-6">
						<h3>Payment</h3>
						<div class="table-responsive">
                        <table class="table table-bordered">
							
							<tbody>
							  <tr>
								
								<th>Month</th>
								<th>Fee (Rs) </th>
								<th>pay(Rs)</th>
								<th>Due (Rs)</th>
								
							  </tr>
							  <?php 
							  $total_pay='';
							  if(isset($payment_details) && count($payment_details)>0){ ?>
							  <?php $cnt=1; foreach($payment_details as $list){ ?>
							  <tr>
							   
								<td><?php echo date('d-M-Y',strtotime(htmlentities($list['create_at'])));?></td>
								<td><?php echo $list['fee_amount']; ?></td>
								<td><?php echo $list['pay_amount']; ?></td>
								<td><?php echo (($list['fee_amount'])-($list['pay_amount'])); ?></td>
							  </tr>
							  <?php $total_pay +=$list['pay_amount']; ?>
							<?php $cnt++;} ?>
												  
							  <?php } ?>							  
							  
							 <tr>
                               					 
								<th>Total</th>
								<th><?php echo isset($payment_details[0]['fee_amount'])?$payment_details[0]['fee_amount']:''; ?></th>
								<th><?php echo isset($total_pay)?$total_pay:''; ?></th>
								<th><?php echo isset($payment_details[0]['fee_amount'])?$payment_details[0]['fee_amount']-$total_pay:''; ?></th>
								
							  </tr>	
							  
							 
							</tbody>
						  </table>
						    
						  </div>
						  </div>
						
                    </div>
                    
                  
                  
                    <div class="clearfix"></div>
                </div>
            
        </div>
				</div>
			</div>
		</div>
	</section>
 </div>
 </div>

 
 
