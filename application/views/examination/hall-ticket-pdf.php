<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Exam Hall ticket</title>
    
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
        padding-left: 5px;
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
							<?php if($student_details['scl_bas_logo']!=''){?>
                                <img src="<?php echo base_url('assets/school_basicdetails/'.$student_details['scl_bas_logo']);?>" style="width:auto; max-height:100px;">
							<?php }else{ ?>
							<img src="<?php echo base_url();?>assets/vendor/dummylogo.png" style="width:auto; max-height:100px;">
							<?php } ?>
						   </td>
                            
                            <td style="text-align:left">
                               <h1 ><?php echo isset($student_details['scl_bas_name'])?$student_details['scl_bas_name']:''?></h1>
							   <p><?php echo isset($student_details['scl_bas_add1'])?$student_details['scl_bas_add1']:''?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
		<table cellpadding="0" cellspacing="0" style="border:1px solid #aaa;border-bottom:0px solid #fff;">
            <tr >
			
                <td colspan="2" style="text-align:center;" >
				
                  <h4 style="text-decoration:underline"><?php echo isset($exam_type['exam_type'])?$exam_type['exam_type']:'' ?>Examination</h4>
                </td>
            </tr> 
			<tr class="top">
                <td>
				<table>
                  <tr>
						<td>Name </td>
						<th>: <?php echo isset($student_details['student_name'])?$student_details['student_name']:''?></th>
				  </tr>
				  <tr>
						<td>Father Name </td>
						<th>: <?php echo isset($student_details['parent_name'])?$student_details['parent_name']:''?></th>
				  </tr> 
				  <tr>
						<td>Classs </td>
						<th>: <?php echo isset($student_details['name'])?$student_details['name']:''?>&nbsp;&nbsp;<?php echo isset($student_details['section'])?$student_details['section']:''?></th>
				  </tr>
				  <tr>
						<td>Admission Number</td>
						<th>: <?php echo isset($student_details['roll_number'])?$student_details['roll_number']:''?></th>
				  </tr> 
				  </table> 
                </td>
				 <td>
				<table>
                  <tr>
				  
				    <td   class="title">
				   <?php if($student_details['profile_pic']!=''){?>
                                <img src="<?php echo base_url('assets/adminpic/'.$student_details['profile_pic']);?>" style="width:100px;">
                             <?php }else{ ?>
							 <img src="<?php echo base_url();?>assets/vendor/dp.png" style="width:100px;">
							  <?php } ?>
							</td>
				  
			
				  </tr>
				  </table>
                </td>
            </tr>
        </table>
		<table cellpadding="0" cellspacing="0" style="border:1px solid #aaa;border-bottom:0px solid #fff;">
           
			<tr class="top">
                <td><strong>Date of Birth </strong> : <?php echo isset($student_details['dob'])?$student_details['dob']:''?></td>
                <td><strong>Sex </strong> : <?php echo isset($student_details['gender'])?$student_details['gender']:''?></td>
            </tr>
        </table>
		<table cellpadding="0" cellspacing="0" style="border:1px solid #aaa;border-bottom:0px solid #fff;">
             <tr >
                <td colspan="2" style="text-align:center;" >
                  <h4 style="text-decoration:underline">Time Table</h4>
                </td>
            </tr> 
			
        </table>
		<?php if(isset($time_table_list)&& count($time_table_list)>0){?>
		<table class="table-sheet" style="border-collapse: collapse;">
             <tr style=" border: 1px solid black;">
                <th style=" border: 1px solid black;">Subject</th>
                <th style=" border: 1px solid black;">Timings</th>
                <th style=" border: 1px solid black;">Date</th>
                
            </tr> 
			<?php foreach($time_table_list as $list){?>
			<tr style=" border: 1px solid black;" >
				<td style=" border: 1px solid black;"><?php echo isset($list['subjects'])?$list['subjects']:''?></td>
				<td style=" border: 1px solid black;"><?php echo isset($list['start_time'])?$list['start_time']:''?>- <?php echo isset($list['to_time'])?$list['to_time']:''?></td>
				<td style=" border: 1px solid black;"><?php echo isset($list['exam_date'])?$list['exam_date']:''?></td>
			<?php }?>
            </tr> 	
			
			
        </table>
		<?php } ?>
		
		
    </div>

</body>
</html>
