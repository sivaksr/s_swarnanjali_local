<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Due Reports</title>
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
   <?php if(isset($due_reports)&& count($due_reports)>0){?>
	<div class="table-responsive">
	
	<table style="width:100%">
	  <tr style="background:#ddd;line-height:25px">
		<th colspan="8">Due Reports</th>
		
	  </tr>
	   <tr>
		<th>S.NO</th>
		<th>Class</th>
		<th>Student Name</th>
		<th>Address</th>
		<th>Parent Name</th>
		<th>Phone Number</th>
		<th>Due Amount</th>
		<th>Fee Amount</th>
	  </tr>
	 
	  
	 <?php $cnt=1; foreach($due_reports as $list){?>
						<tr>
						
						  <th><?php echo $cnt;?></th>
						  <th><?php echo isset($list['class_name'])?$list['class_name']:''?>-<?php echo isset($list['section'])?$list['section']:''?></th>
						  <th><?php echo isset($list['name'])?$list['name']:''?></th>
						   <th>
						<?php echo isset($list['address'])?$list['address'].',':''; ?>
						<?php echo isset($list['current_city'])?$list['current_city'].',':''; ?>
						<?php echo isset($list['current_state'])?$list['current_state'].',':''; ?>
						<?php echo isset($list['current_country'])?$list['current_country'].',':''; ?>
						<?php echo isset($list['current_pincode'])?$list['current_pincode'].'.':''; ?>
						  </th>
						  <th><?php echo isset($list['parent_name'])?$list['parent_name']:''?></th>
						  <th><?php echo isset($list['mobile'])?$list['mobile']:''?></th>
						  <th><?php echo isset($list['due_amount'])?$list['due_amount']:''?></th>
						  <th><?php echo isset($list['fee_amount'])?$list['fee_amount']:''?></th>
						  
						</tr>
						<?php $cnt++;}?>
	  
	</table>
	</div>
	<?php }else{ ?>
 <div> No data available</div>
 <?php }?>      
   
  </body>
</html>