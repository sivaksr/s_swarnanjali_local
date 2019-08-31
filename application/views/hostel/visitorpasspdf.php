<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Visitor Pass & Info</title>
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
		<th colspan="8">Visitor Pass & Info</th>
		
	  </tr>
	   <tr>
		<th>Visitor Type</th>
		<th>Visitor Name</th>
		<th>From Location</th>
		<th>Contact Number</th>
		<th>Email Address</th>
		<th>Visitor Time</th>
	  </tr>
	 
	  
	 <?php if(isset($usersData) && count($usersData)>0){ ?>
	  <tr>
		<td><?php echo isset($usersData['visitor_type'])?$usersData['visitor_type']:''; ?></td>
		<td><?php echo isset($usersData['visitor_name'])?$usersData['visitor_name']:''; ?></td>
		<td><?php echo isset($usersData['location'])?$usersData['location']:''; ?></td>
		<td><?php echo isset($usersData['contact_number'])?$usersData['contact_number']:''; ?></td>
		<td><?php echo isset($usersData['email'])?$usersData['email']:''; ?></td>
		<td><?php echo isset($usersData['visit_time'])?$usersData['visit_time']:''; ?></td>
	  </tr>
	  <?php } ?>
	  	
	  
	</table>
	</div>
   
  </body>
</html>