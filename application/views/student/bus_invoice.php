<!doctype html>

<?php //echo '<pre>';print_r($billing_details);exit; ?>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Fee invoice</title>
    
    <style>
	.page-invoice{
	    
			position:relative;
	}
    .invoice-box {
   
        <!-- margin: auto; -->
        <!-- padding: 30px; -->
        <!-- border: 1px solid #eee; -->
        <!-- box-shadow: 0 0 10px rgba(0, 0, 0, .15); -->
        font-size: 14px;
        line-height: 20px;
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
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 10px;
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
	table, td, th {    
    border: 1px solid #ddd;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 10px;
}
    </style>
</head>

<body>
    <div class="page-invoice">
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0" >
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?php echo base_url('assets/school_basicdetails/'.$school_details['scl_bas_logo']); ?>" style=" width:100px;">
                            </td>
							<td>
                               <h1 style="text-align:center;"><?php echo $school_details['scl_bas_name']; ?> </h1>
                               <p style="text-align:center;color:#F80"><?php echo $school_details['scl_bas_add1']; ?></p>
                            </td>
                            
                          
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                       <h2 style="text-align:center;">Student Bus Payment</h1>							  
							  
                             <div>
								<strong>BILL TO : </strong> <?php echo isset($details['username'])?$details['username']:''; ?>, 
							 </div>
							  <div>
								<strong>Admission Number: </strong> <?php echo isset($details['roll_number'])?$details['roll_number']:''; ?>, 
							 </div>
							 <div>
								<strong>Student Parent Name: </strong> <?php echo isset($details['parent_name'])?$details['parent_name']:''; ?>, 
							 </div>
							 <div>
								<strong>Student Parent Mobile Number: </strong> <?php echo isset($details['mobile'])?$details['mobile']:''; ?>, 
							 </div>
							 <div>
								<strong>Student Parent Email: </strong> <?php echo isset($details['parent_email'])?$details['parent_email']:''; ?>, 
							 </div>
							 <div>
								<strong>Student Address: </strong>
								<?php echo isset($details['address'])?$details['address'].',':''; ?>
								<?php echo isset($details['current_city'])?$details['current_city'].',':''; ?>
								<?php echo isset($details['current_state'])?$details['current_state'].',':''; ?>
								<?php echo isset($details['current_country'])?$details['current_country'].',':''; ?>
								<?php echo isset($details['current_pincode'])?$details['current_pincode'].'.':''; ?>
							 </div>
							 <div>
								<strong>School Email:  </strong> <?php echo isset($school_details['scl_bas_email'])?$school_details['scl_bas_email']:''; ?>,
							 </div> 
							 <div>
								<strong>School Mobile:  </strong> <?php echo isset($school_details['scl_bas_contact'])?$school_details['scl_bas_contact']:''; ?> 
							 </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
		<h2>INVOICE </h2>


<table class="bodered-table">
  <tr>
    <td>Invoice# </td>
    <td colspan="3">INV-PT-<?php echo isset($user_details['id'])?$user_details['id']:''; ?></td>
  
  </tr>
  <tr>
    <td>Invoice Date </td>
    <td colspan="3"><?php echo date('M-d-Y'); ?></td>
  
  </tr>
  <tr>
    <td>Payment Mode </td>
    <td colspan="3"><?php echo $details['payment_type']; ?></td>
  
  </tr>
  <tr>
    <th># </th>
    <th>Student Name</th>
    <th>Price</th>
  </tr>
  <tr>
    <td>1 </td>
    <td><?php echo isset($details['username'])?$details['username']:''; ?></td>
    <td><?php echo isset($details['payamount'])?$details['payamount']:''; ?></td>
  </tr> 
   

  <tr>
    <td colspan="2"> Total </td>
    <td>Rs. <?php echo $details['payamount']; ?></td>
  </tr> 
  <tr>
    <th colspan="2">Pay Price </th>
    <th>Rs. <?php echo $details['payamount']; ?></th>
  </tr>
  <tr>
     <th colspan="2">Paid Amount </th>
    <th>Rs. <?php echo $details['payamount']; ?></th>
  </tr> 
  
  

</table>
<p style="text-align:center;margin-top:50px;">This is a system generated invoice and hence physical signature is not required</p>


    </div>
	<div style="clear:both">&nbsp;</div>
	<br>
	
	
	<div style="background:#333;width:100%;">
		<p style="color:#fff;padding:10px 20px;text-align:center;">School Address:
		 <?php echo isset($school_details['scl_bas_add1'])?$school_details['scl_bas_add1'].',':''; ?>
		 <?php echo isset($school_details['scl_bas_add2'])?$school_details['scl_bas_add2'].',':''; ?>
		 <?php echo isset($school_details['scl_bas_city'])?$school_details['scl_bas_city'].',':''; ?>
		 <?php echo isset($school_details['scl_bas_state'])?$school_details['scl_bas_state'].',':''; ?>
		 <?php echo isset($school_details['scl_bas_country'])?$school_details['scl_bas_country'].',':''; ?>
		 <?php echo isset($school_details['scl_bas_zipcode'])?$school_details['scl_bas_zipcode'].'.':''; ?>
  </p>
	</div>
    </div>
</body>
</html>