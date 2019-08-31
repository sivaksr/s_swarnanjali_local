<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Student List</title>
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
		<th colspan="8">Student List</th>
		
	  </tr>
	   <tr>
		<th>S.NO</th>
		<th>Name</th>
		<th>Gender</th>
		<th>Class</th>
		<th>Admission Number</th>
		<th>Mobile Number</th>
		<th>Parent Name</th>
		<th>Parent Email</th>
		<th>Bus Transport</th>
		<th>Date</th>
	  </tr>
	 
	  
	 <?php if(isset($student_list) && count($student_list)>0){ ?>
	 <?php $cnt=1;foreach($student_list as $list){?>
	  <tr>
		<td><?php echo $cnt; ?></td>
		<td><?php echo isset($list['name'])?$list['name']:''; ?></td>
		<td><?php echo isset($list['gender'])?$list['gender']:''; ?></td>
		<td><?php echo isset($list['classname'])?$list['classname']:''; ?><?php echo isset($list['section'])?$list['section']:''; ?></td>
		<td><?php echo isset($list['roll_number'])?$list['roll_number']:''; ?></td>
		<td><?php echo isset($list['mobile'])?$list['mobile']:''; ?></td>
		<td><?php echo isset($list['parent_name'])?$list['parent_name']:''; ?></td>
		<td><?php echo isset($list['parent_email'])?$list['parent_email']:''; ?></td>
		<td><?php echo isset($list['bus_transport'])?$list['bus_transport']:''; ?></td>
		<td><?php echo isset($list['create_at'])?$list['create_at']:''; ?></td>
	  </tr>
	  <?php $cnt++;} ?>
	 <?php } ?>
	  
	</table>
	</div>
   
  </body>
</html>