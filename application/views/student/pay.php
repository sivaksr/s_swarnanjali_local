<style>
.wizard {
    margin: 20px auto;
    background: #fff;
}

    .wizard .nav-tabs {
        position: relative;
        margin: 40px auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #5bc0de;
    
}
.wizard li.active span.round-tab i{
    color: #5bc0de;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 33.33%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #5bc0de;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #5bc0de;
}

.wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 50px;
}

.wizard h3 {
    margin-top: 0;
}

@media( max-width : 585px ) {

    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}
.razorpay-payment-button{
		float:right;
		margin-left:5px;
		background:#3c8dbc;
		color:#fff;
		border-radius:5px;
		padding:5px 10px;
	}
</style>
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
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="active">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-credit-card"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>

                    
                </ul>
            </div>
			<?php //echo '<pre>';print_r($student_details);exit; ?>

                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="step1">
                        
						<div class=" col-md-6">
						<h3>Details</h3>
                        <table class="table table-bordered">
							
							<tbody>
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
								<th>Date</th>
								<th>Fee (Rs) </th>
								<th>pay(Rs)</th>
								<th>Due (Rs)</th>
								
							  </tr>
							  <?php 
							  $total_pay='';
							  if(isset($last_payment_details) && count($last_payment_details)>0){ ?>
							  <?php foreach($last_payment_details as $list){ ?>
							  <tr>
								<td><?php echo date('d-M-Y',strtotime(htmlentities($list['create_at'])));?></td>
								<td><?php echo $list['fee_amount']; ?></td>
								<td><?php echo $list['pay_amount']; ?></td>
								<td><?php echo (($list['fee_amount'])-($list['pay_amount'])); ?></td>
							  </tr>
							  <?php $total_pay +=$list['pay_amount']; ?>
							<?php } ?>
												  
							  <?php } ?>							  
							  
							 <tr>							
								<th>Toatl</th>
								<th><?php echo isset($last_payment_details[0]['fee_amount'])?$last_payment_details[0]['fee_amount']:''; ?></th>
								<th><?php echo isset($total_pay)?$total_pay:''; ?></th>
								<th><?php echo isset($last_payment_details[0]['fee_amount'])?$last_payment_details[0]['fee_amount']-$total_pay:''; ?></th>
								
							  </tr>	
							  
							 
							</tbody>
						  </table>
						    <form action="<?php echo base_url('payment/pay'); ?>" method="post">
							<div class="form-group col-md-12">
								<label class=" control-label"><h3>Enter your present pay Amount</h3></label>
								<div class="">
									<input type="hidden"  name="u_id" id="u_id"  value="<?php echo isset($student_details['u_id'])?$student_details['u_id']:''; ?>">
									<input type="text" class="form-control" name="amount" id="amount" placeholder="Enter amount here" value="<?php echo isset($last_payment_details[0]['fee_amount'])?$last_payment_details[0]['fee_amount']-$total_pay:''; ?>">
								
								</div>
								<div class="form-group" style="padding-top:10px;">
									<input type="text" required class="form-control" name="description" id="description" placeholder="Enter Description" value="">
								</div>
								
							</div>
							<div class="list-inline pull-right">
								<button type="submit" class="btn btn-primary next-step">Pay</button>
							</div>
						  </form>
						  </div>
						  </div>
						
                    </div>
                    <div class="tab-pane active" role="tabpanel" id="step2">
							<div class="table-responsive">
							<h3>Confirm your Payment</h3>
                        <table class="table table-bordered">
							<table class="table table-bordered">
							
							<tbody>
							  <tr>
								<th>Date</th>
								<th>Fee (Rs) </th>
								<th>pay(Rs)</th>
								<th>Due (Rs)</th>
								
							  </tr>
							  <?php 
							  $total_pay='';
							  if(isset($last_payment_details) && count($last_payment_details)>0){ ?>
							  <?php foreach($last_payment_details as $list){ ?>
							  <tr>
								<td><?php echo date('d-M-Y',strtotime(htmlentities($list['create_at'])));?></td>
								<td><?php echo $list['fee_amount']; ?></td>
								<td><?php echo $list['pay_amount']; ?></td>
								<td><?php echo (($list['fee_amount'])-($list['pay_amount'])); ?></td>
							  </tr>
							  <?php $total_pay +=$list['pay_amount']; ?>
							<?php } ?>
												  
							  <?php } ?>							  
							  
								<tr>							
								<th>Toatl</th>
								<th><?php echo isset($last_payment_details[0]['fee_amount'])?$last_payment_details[0]['fee_amount']:''; ?></th>
								<th><?php echo isset($total_pay)?$total_pay:''; ?></th>
								<th><?php echo isset($last_payment_details[0]['fee_amount'])?$last_payment_details[0]['fee_amount']-$total_pay:''; ?></th>
								
							  </tr>	
							  
							 
							</tbody>
						  </table>
							 
							 
							</tbody>
						  </table>
						  </div>
						  <hr>
							<div class="form-group col-md-6">
								<label class=" control-label"><h3>Enter your present pay Amount</h3></label>
								<div class="">
									<input type="text" class="form-control" name="amount" id="amount" placeholder="Enter amount here" readonly="true" value="<?php echo isset($details['amount'])?$details['amount']/100:''; ?>">
								
								</div>
								
								
							</div>
						  <div class="clearfix">&nbsp;</div>
						   <form  id="paymentform" name="paymentform" action="<?php echo base_url('payment/success'); ?>" method="POST">
											 <?php $csrf = array(
								'name' => $this->security->get_csrf_token_name(),
								'hash' => $this->security->get_csrf_hash()
									); ?>
										<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />

      
												<input type="hidden" name="u_id" id="u_id" value="<?php echo isset($student_details['u_id'])?$student_details['u_id']:''; ?>">
												<input type="hidden" name="pay_amount" id="pay_amount" value="<?php echo $details['amount'];?>">
											  <script
												src="https://checkout.razorpay.com/v1/checkout.js"
												data-key="<?php echo $details['key']?>"
												data-amount="<?php echo $details['amount']?>"
												data-currency="INR"
												data-name="<?php echo $details['name']?>"
												data-image="<?php echo $details['image']?>"
												data-description="<?php echo $details['description']?>"
												data-prefill.name="<?php echo $details['prefill']['name']?>"
												data-prefill.email="<?php echo $details['prefill']['email']?>"
												data-prefill.contact="<?php echo $details['prefill']['contact']?>"
												data-notes.shopping_order_id="3456"
												data-order_id="<?php echo $details['order_id']?>"
												<?php if ($details['display_currency'] !== 'INR') { ?> data-display_amount="<?php echo $details['amount']?>" <?php } ?>
												<?php if ($details['display_currency'] !== 'INR') { ?> data-display_currency="<?php echo $details['display_currency']?>" <?php } ?>
											  >
											  </script>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">

                        <div class="text-center">
							<i style= "font-size:150px;color:#4caf50" class="fa fa-check-circle" aria-hidden="true"></i>
							 <h2>Thank You!</h2>
							 <h3>Your Payment is Successfully Done.</h3>
						</div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                           
                        </ul>
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

 
 <script>
$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

</script>