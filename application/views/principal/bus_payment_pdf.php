<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Student Bus Payment Details</title>
  </head>
  <style>
	@font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}



#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}
#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
	padding:10px;
}


	</style>
  <body>
   
	<div class="table-responsive">
	
	<table style="width:100%">
	  <tr style="background:#ddd;line-height:25px">
		<th colspan="8">Student Bus Payment Details</th>
		
	  </tr>
	   <tr>
		<th>Class</th>
		<th>Name</th>
		<th>Adminssion Number</th>
		<th>Pay Amount</th>
		<th>Date</th>
	  </tr>
	 
	  
	 <?php if(isset($bus_payment_list) && count($bus_payment_list)>0){ ?>
	 <?php foreach($bus_payment_list as $list){?>
	  <tr>
		<td><?php echo isset($list['name'])?$list['name']:''; ?></td>
		<td><?php echo isset($list['username'])?$list['username']:''; ?></td>
		<td><?php echo isset($list['rollnumber'])?$list['rollnumber']:''; ?></td>
		<td><?php echo isset($list['pay_amount'])?$list['pay_amount']:''; ?></td>
		<td><?php echo date('d-M-Y',strtotime(htmlentities($list['create_at'])));?></td>
	  </tr>
	  <?php } ?>
	  <?php } ?>
	  
	  <tr>							
	<th></th>
	<th></th>
	<th></th>
	<th>Total:<?php echo isset($total_payment['paid_amount'])?$total_payment['paid_amount']:''; ?></th>
	<th></th>
	<th></th>
	
  </tr>	
	  
	  
	</table>
	</div>
   
  </body>
</html>