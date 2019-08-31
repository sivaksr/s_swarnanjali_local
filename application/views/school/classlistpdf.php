<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Class List</title>
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
		<th colspan="8">Class List</th>
		
	  </tr>
	   <tr>
		<th>S.NO</th>
		 <th>Day</th>
         <th>Slot Time</th>
         <th>Class</th>
		 <th>Teacher Module</th>
         <th>subject</th>
         <th>Teacher</th>
	  </tr>
	 
	  
	 <?php if(isset($time_slot_list) && count($time_slot_list)>0){ ?>
		<?php $count=1; foreach($time_slot_list as $list){ ?> 
	  <tr>
		<td><?php echo $count; ?></td>
		<td><?php echo isset($list['day'])?$list['day']:''; ?></td>
		<td><?php echo isset($list['form_time'])?$list['form_time']:''; ?>-<?php echo isset($list['to_time'])?$list['to_time']:''; ?></td>
		<td><?php echo isset($list['name'])?$list['name']:''; ?>-<?php echo isset($list['section'])?$list['section']:''; ?></td>
		<td><?php echo isset($list['modules'])?$list['modules']:''; ?></td>
		<td><?php echo isset($list['subjects'])?$list['subjects']:''; ?></td>
		<td><?php echo isset($list['teachers'])?$list['teachers']:''; ?></td>
	  </tr>
	 <?php $count++;} ?>
	  <?php } ?>
	  	
	  
	</table>
	</div>
   
  </body>
</html>