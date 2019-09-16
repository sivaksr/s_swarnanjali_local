<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Details</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    <!-- .invoice-box table tr td:nth-child(2) { -->
        <!-- text-align: right; -->
    <!-- } -->
    
    .invoice-box table tr.top table td {
        padding-bottom: 0px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
	   <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                   <table>
                        <tr>
                            <td  style="width:180px;" class="title">
							<?php if($student_list['scl_bas_logo']!=''){?>
                                <img src="<?php echo base_url('assets/school_basicdetails/'.$student_list['scl_bas_logo']);?>" style="width:auto; max-height:100px;">
								<?php }else{ ?>
								<img src="<?php echo base_url();?>assets/vendor/dummylogo.png" style="width:auto; max-height:100px;">
								<?php } ?>
							   </td>
                            
                            <td style="text-align:left">
                               <h1 ><?php echo isset($student_list['scl_bas_name'])?$student_list['scl_bas_name']:''?></h1>
							   <p><?php echo isset($student_list['scl_bas_add1'])?$student_list['scl_bas_add1']:''?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
	    
	
		<table cellpadding="0" cellspacing="0" style="border:1px solid #aaa;border-bottom:0px solid #fff;">
            <tr >
                <td  style="text-align:center;" >
                  <h4 style="text-decoration:underline">Personal Details</h4>
                </td>
            </tr> 
			<tr class="top">
                
				 <td>
				<table>
				  <tr>
				   <td  style="width:180px;" class="title">
				   <?php if($student_list['profile_pic']!=''){?>
                                <img src="<?php echo base_url('assets/adminpic/'.$student_list['profile_pic']);?>" style="width:25%;height:25%;">
                             <?php }else{ ?>
							 <img src="<?php echo base_url();?>assets/vendor/dp.png" style="width:25%;height:25%;">
							  <?php } ?>
							</td>
							
				
				 
				 </tr>
                  <tr>
						<td>Name of the Student</td>
						<th>: <?php echo isset($student_list['name'])?$student_list['name']:''?></th>
				  </tr>
				  <tr>
						<td>Gender</td>
						<th>: <?php echo isset($student_list['gender'])?$student_list['gender']:''?></th>
				  </tr> 
				  <tr>
						<td>Date Of Birth</td>
						<th>: <?php echo isset($student_list['dob'])?$student_list['dob']:''?></th>
				  </tr>
				  
				  <tr>
						<td>Address</td>
						<th style="max-width:200px;">: <?php echo isset($student_list['address'])?$student_list['address']:''?></th>
				  </tr> 
				 <tr>
						<td>City</td>
						<th>: <?php echo isset($student_list['current_city'])?$student_list['current_city']:''?></th>
				  </tr>
				  <tr>
						<td>State</td>
						<th>: <?php echo isset($student_list['current_state'])?$student_list['current_state']:''?></th>
				  </tr>
				  
				  <tr>
						<td>Country</td>
						<th>: <?php echo isset($student_list['current_country'])?$student_list['current_country']:''?></th>
				  </tr>
				  <tr>
						<td>Pincode</td>
						<th>: <?php echo isset($student_list['current_pincode'])?$student_list['current_pincode']:''?></th>
				  </tr>
				  <tr>
						<td>Blood Group</td>
						<th>: <?php echo isset($student_list['blodd_group'])?$student_list['blodd_group']:''?></th>
				  </tr>
				  
				  
				  </table>
                </td>
			
				
            </tr>
        </table>
		
		<table cellpadding="0" cellspacing="0" style="border:1px solid #aaa;border-bottom:0px solid #fff;">
            <tr >
                <td colspan="2" style="text-align:center;" >
                  <h4 style="text-decoration:underline">School Details</h4>
                </td>
            </tr> 
			<tr class="top">
                <td>
				<table>
                  <tr>
						<td>Date Of Join</td>
						<th>: <?php echo isset($student_list['doj'])?$student_list['doj']:''?></th>
				  </tr>
				  
				  </table>
                </td>
				 <td>
				<table>
                  <tr>
						<td>Class</td>
						<th>: <?php echo isset($student_list['classname'])?$student_list['classname']:''?><?php echo isset($student_list['section'])?$student_list['section']:''?></th>
				  </tr>
				  <tr>
						<td>Admission Number</td>
						<th>: <?php echo isset($student_list['roll_number'])?$student_list['roll_number']:''?></th>
				  </tr>
				  
				  <tr>
						<td>&nbsp;</td>
						<th>&nbsp;</th>
				  </tr>
			
				 
				  </table>
                </td>
				
            </tr>
        </table>
		<table cellpadding="0" cellspacing="0" style="border:1px solid #aaa;border-bottom:1px solid #aaa;">
						 <tr >
                <td colspan="5" style="text-align:center;" >
                  <h4 style="text-decoration:underline">Payment Details</h4>
                </td>
            </tr> 	
							<tbody>
							  <tr>
								<th>Date</th>
								<th>Fee (Rs) </th>
								<th>pay(Rs)</th>
								<th>Due (Rs)</th>
								
							  </tr>
							  <?php 
							  $total_pay='';
							  if(isset($student_list['payment_details']) && count($student_list['payment_details'])>0){ ?>
							  <?php foreach($student_list['payment_details'] as $list){ ?>
							  <tr>
								<td><?php echo date('d-M-Y',strtotime(htmlentities($list['create_at'])));?></td>
								<td><?php echo $list['fee_amount']; ?></td>
								<td><?php echo $list['pay_amount']; ?></td>
								<td><?php echo (($list['fee_amount'])-($list['pay_amount'])); ?></td>
							  </tr>
							 <?php $total_pay +=$list['pay_amount']; ?>
							 <?php $fee_amounts =$list['fee_amount']; ?>
							<?php } ?>
												  
							  <?php } ?>						  
							  
							 <tr>							
								<th>Total</th>
								<th><?php echo isset($fee_amounts)?$fee_amounts:''; ?></th>
								<th><?php echo isset($total_pay)?$total_pay:''; ?></th>
								<th><?php echo isset($student_list['payment_details'][0]['fee_amount'])?$student_list['payment_details'][0]['fee_amount']-$total_pay:''; ?></th>
								
							  </tr>	
							  
							 
							</tbody>
						  </table>
		<table cellpadding="0" cellspacing="0" style="border:1px solid #aaa;border-bottom:1px solid #aaa;">
            <tr >
                <td colspan="2" style="text-align:center;" >
                  <h4 style="text-decoration:underline">Parent Details</h4>
                </td>
            </tr> 
			<tr class="top">
                <td>
				<table>
                  <tr>
						<td>Name</td>
						<th>: <?php echo isset($student_list['parent_name'])?$student_list['parent_name']:''?></th>
				  </tr>
				  <tr>
						<td>Gender</td>
						<th>: <?php echo isset($student_list['parent_gender'])?$student_list['parent_gender']:''?></th>
				  </tr> 
				  <tr>
						<td>Email  Id</td>
						<th>: <?php echo isset($student_list['parent_email'])?$student_list['parent_email']:''?></th>
				  </tr>
				 
				  
				  </table>
                </td>
				 <td>
				<table>
                  <tr>
						<td>Mobile</td>
						<th>: <?php echo isset($student_list['mobile'])?$student_list['mobile']:''?></th>
				  </tr>
				  <!--<tr>
						<td>Education</td>
						<th>: <?php echo isset($student_list['education'])?$student_list['education']:''?></th>
				  </tr> 
				  <tr>
						<td>Profession</td>
						<th>: <?php echo isset($student_list['profession'])?$student_list['profession']:''?></th>
				  </tr>-->
			
				 
				  </table>
                </td>
				
            </tr>
        </table>
		
		
    </div>
</body>
</html>
