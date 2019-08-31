<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Gate Pass & Info</title>
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
		<th colspan="8">Gate Pass & Info</th>
		
	  </tr>
	   <tr>
		<th>Date</th>
		<th>Gate Pass Number</th>
		<th>Class list</th>
		<th>Student Name</th>
		<th>Gate Pass in Hours</th>
		<th>Remarks</th>
	  </tr>
	 
	  
	 <?php if(isset($gate_pass) && count($gate_pass)>0){ ?>
	  <tr>
		<td><?php echo isset($gate_pass['date'])?$gate_pass['date']:''; ?></td>
		<td><?php echo isset($gate_pass['gate_pass_number'])?$gate_pass['gate_pass_number']:''; ?></td>
		<td><?php echo isset($gate_pass['name'])?$gate_pass['name']:''; ?>-<?php echo isset($gate_pass['section'])?$gate_pass['section']:''; ?></td>
		<td><?php echo isset($gate_pass['username'])?$gate_pass['username']:''; ?></td>
		<td><?php echo isset($gate_pass['gate_pass_hours'])?$gate_pass['gate_pass_hours']:''; ?></td>
		<td><?php echo isset($gate_pass['remarks'])?$gate_pass['remarks']:''; ?></td>
	  </tr>
	  <?php } ?>
	  	
	  
	</table>
	</div>
   
  </body>
</html>