
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  <?php if(isset($school_details['completed']) && $school_details['completed']==1){ ?>
			Edit School
	  <?php }else{ ?>
			Add School
	  <?php } ?>
         
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">
			<?php if(isset($school_details['completed']) && $school_details['completed']==1){ ?>
				Edit School
			<?php }else{ ?>
				Add School
			<?php } ?>
		</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
		<div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if(isset($tab) && $tab=='' || $tab==1){ echo "active"; }?>"><a href="#tab_1" data-toggle="tab">School Credentials</a></li>
              <li class="<?php if(isset($tab) && $tab==2){ echo "active"; }?>"><a href="#tab_2" data-toggle="tab">School Representative details</a></li>
              <li class="<?php if(isset($tab) && $tab==3){ echo "active"; }?>"><a href="#tab_3" data-toggle="tab">School Basic Details</a></li>
              <li class="<?php if(isset($tab) && $tab==4){ echo "active"; }?>"><a href="#tab_4" data-toggle="tab">School Financial Details</a></li>
              <li class="<?php if(isset($tab) && $tab==5){ echo "active"; }?>"><a href="#tab_5" data-toggle="tab">School Other Details</a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane <?php if(isset($tab) && $tab=='' || $tab==1){ echo "active"; }?>" id="tab_1">
                <form action="<?php echo base_url('school/addpost'); ?>" method="post" name="credentials" id="credentials" enctype="multipart/form-data">
							<?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							      <input type="hidden" id="school_id" name="school_id" value="<?php echo isset($school_details['s_id'])?$school_details['s_id']:'' ?>">
              
					<div class="row">
                        <div class="form-group col-md-6">
                           <label for="email">School Contact Number</label>
                           <input type="text" id="scl_con_number" name="scl_con_number" value="<?php echo isset($school_details['scl_con_number'])?$school_details['scl_con_number']:''; ?>" class="form-control"  placeholder="Enter Contact no" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Email Id</label>
                           <input type="text" id="scl_email_id" name="scl_email_id" value="<?php echo isset($school_details['scl_email_id'])?$school_details['scl_email_id']:''; ?>"  class="form-control"  placeholder="Enter Email Id" >
                        </div>
						<?php //echo '<pre>';print_r($hospital_id);exit; ?>
						<?php if(isset($school_details['s_id']) && $school_details['s_id'] !=''){ ?>
                       
						<?php }else{ ?>
							<div class="form-group col-md-6">
                           <label for="email">Password</label>
                           <input type="password" id="password" name="password" class="form-control"  placeholder="Enter Password" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Confirm Password</label>
                           <input type="password" id="confirmpassword" name="confirmpassword" class="form-control"  placeholder="Enter Confirm Password" >
                        </div>
						<?php }	?>
                     </div>
                     <div class="form-actions">
                        <div class="row">
                           <div class="col-md-6">
                           </div>
						   <div class="col-md-6">
                              <button type="submit" class="btn btn-info pull-right">Next</button>
                           </div>
                        </div>
                     </div>
                  </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane <?php if(isset($tab) && $tab==2){ echo "active"; }?>" id="tab_2">
                <form action="<?php echo base_url('school/addrepresentative'); ?>" method="post" name="representative" id="representative" class="" enctype="multipart/form-data">
                      	<?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							      <input type="hidden" id="school_id" name="school_id" value="<?php echo isset($school_details['s_id'])?$school_details['s_id']:'' ?>">
					 <div class="row">
                        <div class="form-group col-md-6">
                           <label for="email">Name of the Representative</label>
                           <input type="text" id="scl_representative" name="scl_representative" value="<?php echo isset($school_details['scl_representative'])?$school_details['scl_representative']:''; ?>" class="form-control" id="email" placeholder="Enter Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">School Representative Contact Number</label>
                           <div class="row">
                              <div class="col-md-4">
                                 <input type="text" id="scl_rep_contact" name="scl_rep_contact" value="<?php echo isset($school_details['scl_rep_contact'])?$school_details['scl_rep_contact']:''; ?>" class="form-control"  placeholder="Enter Landline no" >
                              </div>
                              <div class="col-md-8 row">
                                 <div class="col-md-4">
                                    <select id="mob_country_code" name="mob_country_code"  class="form-control">
                                       <option value="+91">+91</option>
                                    </select>
                                 </div>
                                 <div class="col-md-8">
                                    <input type="text" id="scl_rep_mobile" name="scl_rep_mobile" value="<?php echo isset($school_details['scl_rep_mobile'])?$school_details['scl_rep_mobile']:''; ?>" class="form-control"  placeholder="Enter Mobile no" >
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Email</label>
                           <input type="text" id="scl_rep_email" name="scl_rep_email" value="<?php echo isset($school_details['scl_rep_email'])?$school_details['scl_rep_email']:''; ?>" class="form-control"  placeholder="Enter email" >
                        </div>
                      <div class="form-group col-md-6">
                           <label for="email">National ID</label>
                           <input type="text" id="scl_rep_nationali_id" name="scl_rep_nationali_id" value="<?php echo isset($school_details['scl_rep_nationali_id'])?$school_details['scl_rep_nationali_id']:''; ?>" class="form-control"  placeholder="Aadhaar Id" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Address1</label>
                           <textarea type="textarea" id="scl_rep_add1" name="scl_rep_add1"  class="form-control"  placeholder="Enter Address" ><?php echo isset($school_details['scl_rep_add1'])?$school_details['scl_rep_add1']:''; ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Address2</label>
                           <textarea type="textarea" id="scl_rep_add2" name="scl_rep_add2"  class="form-control"  placeholder="Enter Address" ><?php echo isset($school_details['scl_rep_add2'])?$school_details['scl_rep_add2']:''; ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Pin code</label>
                           <div class="row">
                              <div class="col-md-6">
                                 <input type="text" id="scl_rep_zipcode" name="scl_rep_zipcode" value="<?php echo isset($school_details['scl_rep_zipcode'])?$school_details['scl_rep_zipcode']:''; ?>" class="form-control"  placeholder="Enter pin Code" >
                              </div>
                              <div class="col-md-6 row">
                                 <input type="text" id="scl_rep_city" name="scl_rep_city" value="<?php echo isset($school_details['scl_rep_city'])?$school_details['scl_rep_city']:''; ?>" class="form-control"  placeholder="Enter City" >
                              </div>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Nationality</label>
                           <div class="row">
                              <div class="col-md-6">
							  <?php $states = array ('Andhra Pradesh' => 'Andhra Pradesh', 'Arunachal Pradesh' => 'Arunachal Pradesh', 'Assam' => 'Assam', 'Bihar' => 'Bihar', 'Chhattisgarh' => 'Chhattisgarh', 'Goa' => 'Goa', 'Gujarat' => 'Gujarat', 'Haryana' => 'Haryana', 'Himachal Pradesh' => 'Himachal Pradesh', 'Jammu & Kashmir' => 'Jammu & Kashmir', 'Jharkhand' => 'Jharkhand', 'Karnataka' => 'Karnataka', 'Kerala' => 'Kerala', 'Madhya Pradesh' => 'Madhya Pradesh', 'Maharashtra' => 'Maharashtra', 'Manipur' => 'Manipur', 'Meghalaya' => 'Meghalaya', 'Mizoram' => 'Mizoram', 'Nagaland' => 'Nagaland', 'Odisha' => 'Odisha', 'Punjab' => 'Punjab', 'Rajasthan' => 'Rajasthan', 'Sikkim' => 'Sikkim', 'Tamil Nadu' => 'Tamil Nadu', 'Telangana' => 'Telangana', 'Tripura' => 'Tripura', 'Uttarakhand' => 'Uttarakhand','Uttar Pradesh' => 'Uttar Pradesh', 'West Bengal' => 'West Bengal', 'Andaman & Nicobar' => 'Andaman & Nicobar', 'Chandigarh' => 'Chandigarh', 'Dadra and Nagar Haveli' => 'Dadra and Nagar Haveli', 'Daman & Diu' => 'Daman & Diu', 'Delhi' => 'Delhi', 'Lakshadweep' => 'Lakshadweep', 'Puducherry' => 'Puducherry'); ?>
								  <select class="form-control" required="required" name="scl_rep_state" id="scl_rep_state">
								  <option value = "">Select State</option>
									<?php foreach($states as $key=>$state):
											if($school_details['scl_rep_state'] == $state):
											$selected ='selected=selected';
											else : 
											$selected = '';
											endif;
										 ?>
										<option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
									<?php endforeach; ?>
								  </select>  
                              </div>
                              <div class="col-md-6 row">
                                 <input type="text" id="scl_rep_country" name="scl_rep_country" value="<?php echo isset($school_details['scl_rep_country'])?$school_details['scl_rep_country']:''; ?>" class="form-control"  placeholder="Enter Country" >
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-actions">
                        <div class="row">
                           <div class="offset-md-10 col-md-2">
                              <a href="<?php echo base_url('school/add/'.base64_encode(1).'/'.base64_encode(isset($school_details['s_id'])?$school_details['s_id']:'')); ?>" class="btn btn-info">Back</a>
                              <button type="submit" class="btn btn-default">Next</button>
                           </div>
                        </div>
                     </div>
                  </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane <?php if(isset($tab) && $tab==3){ echo "active"; }?>" id="tab_3">
                 <form action="<?php echo base_url('school/basicdetails'); ?>" method="post" name="basicdetails" id="basicdetails" class="" enctype="multipart/form-data">
                     <?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							      <input type="hidden" id="school_id" name="school_id" value="<?php echo isset($school_details['s_id'])?$school_details['s_id']:'' ?>">

					 <div class="row">
                        <div class="form-group col-md-6">
                           <label for="email">School Identification Number(SIN)</label>
                           <input type="text"  class="form-control" value="<?php echo isset($school_details['s_id'])?$school_details['s_id']:'' ?>"  readonly="true" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Name of the School</label>
                           <input type="text" id="scl_bas_name" name="scl_bas_name" value="<?php echo isset($school_details['scl_bas_name'])?$school_details['scl_bas_name']:''; ?>" class="form-control" id="email" placeholder="Enter Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">School Contact Number</label>
                           <input type="text" id="scl_bas_contact" name="scl_bas_contact" value="<?php echo isset($school_details['scl_bas_contact'])?$school_details['scl_bas_contact']:''; ?>" class="form-control"  placeholder="Enter Contact no" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Email</label>
                           <input type="text" id="scl_bas_email" name="scl_bas_email" value="<?php echo isset($school_details['scl_bas_email'])?$school_details['scl_bas_email']:''; ?>" class="form-control"  placeholder="Enter email" >
                        </div>
                        <!--<div class="form-group col-md-6">
                           <label for="email">National ID</label>
                           <input type="text" id="scl_bas_nationali_id" name="scl_bas_nationali_id" value="<?php echo isset($school_details['scl_bas_nationali_id'])?$school_details['scl_bas_nationali_id']:''; ?>" class="form-control"  placeholder="National ID" >
                        </div>-->
                        <div class="form-group col-md-6">
                           <label for="email">Address1</label>
                           <textarea type="textarea" id="scl_bas_add1" name="scl_bas_add1"   class="form-control"  placeholder="Enter Address" ><?php echo isset($school_details['scl_bas_add1'])?$school_details['scl_bas_add1']:''; ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Address2</label>
                           <textarea type="textarea" id="scl_bas_add2" name="scl_bas_add2"  class="form-control"  placeholder="Enter Address" ><?php echo isset($school_details['scl_bas_add2'])?$school_details['scl_bas_add2']:''; ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Pin code</label>
                           <div class="row">
                              <div class="col-md-6">
                                 <input type="text" id="scl_bas_zipcode" name="scl_bas_zipcode" value="<?php echo isset($school_details['scl_bas_zipcode'])?$school_details['scl_bas_zipcode']:''; ?>" class="form-control"  placeholder="Enter pin Code" >
                              
							  </div>
                              <div class="col-md-6 row">
                                 <input type="text" id="scl_bas_city" name="scl_bas_city" value="<?php echo isset($school_details['scl_bas_city'])?$school_details['scl_bas_city']:''; ?>" class="form-control"  placeholder="Enter City" >
                              </div>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Nationality</label>
                           <div class="row">
                              <div class="col-md-6">
								<select class="form-control" required="required" name="scl_bas_state" id="scl_bas_state">
								  <option value = "">Select State</option>
									<?php foreach($states as $key=>$state):
											if($school_details['scl_bas_state'] == $state):
											$selected ='selected=selected';
											else : 
											$selected = '';
											endif;
										 ?>
										<option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
									<?php endforeach; ?>
								  </select> 
							  </div>
                              <div class="col-md-6 row">
                                 <input type="text" id="scl_bas_country" name="scl_bas_country" value="<?php echo isset($school_details['scl_bas_country'])?$school_details['scl_bas_country']:''; ?>" class="form-control"  placeholder="Enter Country" >
                              </div>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Upload Documents</label>
                           <div class="compose-editor">
                              <input type="file" id="scl_bas_document" class="form-control" name="scl_bas_document"class="default">
                           </div>
						   <?php if($school_details['scl_bas_document']!=''){ ?>
						   <a href="<?php echo base_url('assets/school_basicdetails/'.$school_details['scl_bas_document']); ?>">Download</a>
						   <?Php } ?>
                        </div>
						<div class="form-group col-md-6">
                           <label for="email">Upload Logo</label>
                           <div class="compose-editor">
                              <input type="file" id="scl_bas_logo" class="form-control" name="scl_bas_logo"class="default">
                           </div>
						   <?php if($school_details['scl_bas_logo']!=''){ ?>
						   <img src="<?php echo base_url('assets/school_basicdetails/'.$school_details['scl_bas_logo']); ?>" style="width:50px;hight:50px;padding :10px;">
						   <?Php } ?>
                        </div>
						<div class="form-group col-md-6">
                           <label for="email">School Working Month</label>
						   <select id="working_month" name="working_month" class="form-control">
								<?php $month = array ('1 Month' => '1 Month','2 Months' => '2 Months','3 Months' => '3 Months','4 Months' => '4 Months','5 Months' => '5 Months','6 Months' => '6 Months','7 Months' => '7 Months','8 Months' => '8 Months','9 Months' => '9 Months','10 Months' => '10 Months',); ?>
								  <option value = "">Select Month</option>
									<?php foreach($month as $key=>$state):
											if($school_details['working_month'] == $state):
											$selected ='selected=selected';
											else : 
											$selected = '';
											endif;
										 ?>
										<option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
									<?php endforeach; ?>
							</select> 
						 </div>
                     </div>
                     <div class="form-actions">
                        <div class="row">
                           <div class="offset-md-10 col-md-2">
                              <a href="<?php echo base_url('school/add/'.base64_encode(2).'/'.base64_encode(isset($school_details['s_id'])?$school_details['s_id']:'')); ?>" class="btn btn-info">Back</a>
                              <button type="submit" class="btn btn-default">Next</button>
                           </div>
                        </div>
                     </div>
                  </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane <?php if(isset($tab) && $tab==4){ echo "active"; }?>" id="tab_4">
                <form action="<?php echo base_url('school/financial'); ?>" method="post" name="financial" id="financial" class="" enctype="multipart/form-data">
                     <?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							      <input type="hidden" id="school_id" name="school_id" value="<?php echo isset($school_details['s_id'])?$school_details['s_id']:'' ?>">
  
					 <div class="row">
                        <div class="form-group col-md-6">
                           <label for="email">School Bank Holder Name</label>
                           <input type="text" id="bank_holder_name" name="bank_holder_name" value="<?php echo isset($school_details['bank_holder_name'])?$school_details['bank_holder_name']:''; ?>" class="form-control" id="email" placeholder=" School Bank Holder Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">School Bank Acc No</label>
                           <input type="text" id="bank_acc_no" name="bank_acc_no" value="<?php echo isset($school_details['bank_acc_no'])?$school_details['bank_acc_no']:''; ?>" class="form-control"  placeholder="School Bank Acc No" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">School Bank Name</label>
                           <input type="text" id="bank_name" name="bank_name" value="<?php echo isset($school_details['bank_name'])?$school_details['bank_name']:''; ?>" class="form-control"  placeholder="School Bank Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">School Bank IFSC Code</label>
                           <input type="text"  id="bank_ifsc" name="bank_ifsc" value="<?php echo isset($school_details['bank_ifsc'])?$school_details['bank_ifsc']:''; ?>" class="form-control"  placeholder="School Bank IFSC Code" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Upload Documents</label>
                           <div class="compose-editor">
                              <input type="file" id="bank_documents" name="bank_documents" class="form-control">
                           </div>
						   <?php if($school_details['bank_document']!=''){ ?>
						   <a href="<?php echo base_url('assets/school_basicdetails/'.$school_details['bank_document']); ?>">Download</a>
						   <?Php } ?>
                        </div>
                     </div>
                     <div class="form-actions">
                        <div class="row">
                            <div class="offset-md-10 col-md-2">
                              <a href="<?php echo base_url('school/add/'.base64_encode(3).'/'.base64_encode(isset($school_details['s_id'])?$school_details['s_id']:'')); ?>" class="btn btn-info">Back</a>
                              <button type="submit" class="btn btn-default">Next</button>
                           </div>
                        </div>
                     </div>
                  </form>
              </div>
              <!-- /.tab-pane -->
			  <div class="tab-pane <?php if(isset($tab) && $tab==5){ echo "active"; }?>" id="tab_5">
                <form action="<?php echo base_url('school/otherdetails'); ?>" method="post" name="otherdetails" id="otherdetails" class="" enctype="multipart/form-data">
                     <?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							     <input type="hidden" id="school_id" name="school_id" value="<?php echo isset($school_details['s_id'])?$school_details['s_id']:'' ?>">
    
					 <div class="row">
                        <div class="form-group col-md-6">
                           <label for="email">School KYC Details</label>
                           <input type="text" class="form-control"  value="<?php echo isset($school_details['kyc_doc1'])?$school_details['kyc_doc1']:''; ?>" id="kyc_doc1" name="kyc_doc1" placeholder="Document Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Upload </label>
                           <div class="compose-editor">
                              <input type="file" id="kyc_file1" name="kyc_file1" class="form-control" >
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">School KYC Details</label>
                           <input type="text"  id="kyc_doc2" name="kyc_doc2" value="<?php echo isset($school_details['kyc_doc2'])?$school_details['kyc_doc2']:''; ?>" class="form-control"  placeholder="Document Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Upload </label>
                           <div class="compose-editor">
                              <input type="file" id="kyc_file2" name="kyc_file2" class="form-control">
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">School KYC Details</label>
                           <input type="text" id="kyc_doc3" name="kyc_doc3" value="<?php echo isset($school_details['kyc_doc3'])?$school_details['kyc_doc3']:''; ?>" class="form-control"  placeholder="Document Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Upload </label>
                           <div class="compose-editor">
                              <input type="file" id="kyc_file3" name="kyc_file3" class="form-control" >
                           </div>
                        </div>
                     </div>
                     <div class="form-actions">
                        <div class="row">
                           <div class="offset-md-9 col-md-3">
                              <a href="<?php echo base_url('school/add/'.base64_encode(4).'/'.base64_encode(isset($school_details['s_id'])?$school_details['s_id']:'')); ?>" class="btn btn-info">Back</a>
                              <button type="submit" class="btn btn-default">Submit</button>
                           </div>
                        </div>
                     </div>
                  </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
	</section>
 </div>
 </div>
 <script>
$(document).ready(function() {
    $('#credentials').bootstrapValidator({
        
        fields: {
            
            scl_con_number: {
              validators: {
					 notEmpty: {
						message: 'Mobile Number is required'
					},
                    regexp: {
					regexp:  /^[0-9]{10}$/,
					message:'Mobile Number must be 10 digits'
					}
                }
            },
			 scl_email_id: {
                validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },
			password: {
                validators: {
					notEmpty: {
						message: 'Password is required'
					},
					stringLength: {
                        min: 6,
                        message: 'Password  must be at least 6 characters'
                    },
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~'"\\|=^?$%*)(_+-]*$/,
					message: 'Password wont allow <>[]'
					}
				}
            },
           
            confirmpassword: {
					 validators: {
						 notEmpty: {
						message: 'Confirm Password is required'
					},
					identical: {
						field: 'password',
						message: 'password and confirm Password do not match'
					}
					}
				}
            }
        })
     
});
$(document).ready(function() {
    $('#representative').bootstrapValidator({
        
        fields: {
            
            scl_representative: {
                 validators: {
					notEmpty: {
						message: 'Representative Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Representative Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			 scl_rep_contact: {
                validators: {
					notEmpty: {
						message: 'landline Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'landline Number must be 10 to 14 digits'
					}
				
				}
            },scl_rep_mobile: {
                 validators: {
					notEmpty: {
						message: 'Contact Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Contact Number must be 10 to 14 digits'
					}
				
				}
            },scl_rep_email: {
                validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },scl_rep_nationali_id: {
                validators: {
					notEmpty: {
						message: 'National ID is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'National ID must be 10 to 14 digits'
					}
				
				}
            },scl_rep_add1: {
                validators: {
					notEmpty: {
						message: 'Address1 is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address1 wont allow <> [] = % '
					}
                }
            },scl_rep_add2: {
                validators: {
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address2 wont allow <> [] = % '
					}
                }
            },scl_rep_zipcode: {
              validators: {
					notEmpty: {
						message: 'Pin code is required'
					},
					regexp: {
					regexp: /^[0-9]{5,7}$/,
					message: 'Pin code  must be  5 to 7 characters'
					}
				}
            },scl_rep_city: {
               validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'City can only consist of alphabets and Space'
					}
				
				}
            },scl_rep_state: {
                validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'State can only consist of alphabets and Space'
					}
				
				}
            },
			scl_rep_country: {
                validators: {
					notEmpty: {
						message: 'Country is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Country can only consist of alphabets and Space'
					}
				
				}
            }
            }
        })
     
});
$(document).ready(function() {
    $('#basicdetails').bootstrapValidator({
        
        fields: {
            
            scl_bas_name: {
                 validators: {
					notEmpty: {
						message: 'Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			 scl_bas_contact: {
                validators: {
					notEmpty: {
						message: 'Contact Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message: 'Contact Number must be 10 to 14 digits'
					}
				
				}
            },scl_bas_email: {
                validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },scl_bas_nationali_id: {
                validators: {
					notEmpty: {
						message: 'National ID is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'National ID must be 10 to 14 digits'
					}
				
				}
            },scl_bas_add1: {
                validators: {
					notEmpty: {
						message: 'Address1 is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address1 wont allow <> [] = % '
					}
                }
            },scl_bas_add2: {
                validators: {
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address2 wont allow <> [] = % '
					}
                }
            },scl_bas_zipcode: {
              validators: {
					notEmpty: {
						message: 'Pin code is required'
					},
					regexp: {
					regexp: /^[0-9]{5,7}$/,
					message: 'Pin code  must be  5 to 7 characters'
					}
				}
            },scl_bas_city: {
               validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'City can only consist of alphabets and Space'
					}
				
				}
            },scl_bas_state: {
                validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'State can only consist of alphabets and Space'
					}
				
				}
            },
			scl_bas_country: {
                validators: {
					notEmpty: {
						message: 'Country is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'Country can only consist of alphabets and Space'
					}
				
				}
            },
			scl_bas_document: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            },
			working_month: {
                validators: {
					notEmpty: {
						message: 'School Working Months is required'
					}
				}
            },
			scl_bas_logo: {
                validators: {
					
					regexp: {
					regexp: "(.*?)\.(png|jpeg|jpg|gif)$",
					message: 'Uploaded file is not a valid. Only png,jpeg,jpg,gif files are allowed'
					}
				}
            }
            }
        })
     
});
$(document).ready(function() {
    $('#financial').bootstrapValidator({
        
        fields: {
            
            bank_holder_name: {
                 validators: {
					notEmpty: {
						message: 'Bank Holder Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'Bank Holder Name can only consist of alphabets and space'
					}
				}
            },
			 bank_acc_no: {
                validators: 
					{
					    notEmpty: 
						{
						    message: 'Bank Account is required'
					    },
						regexp: 
						{
					     regexp:  /^[0-9]{9,16}$/,
					     message:'Bank Account  must be 9 to 16 digits'
					    }
				}
            },bank_name: {
                validators: {
					notEmpty: {
						message: 'BankName is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'BankName can only consist  of alphabets and Space'
					}
				}
            },bank_ifsc: {
                validators: {
					notEmpty: {
						message: 'IFSC Code is required'
					},
					regexp: {
					 regexp: /^[A-Za-z0-9]{4}\d{7}$/,
					message: 'IFSC Code must be alphanumeric'
					}
				}
            },
			bank_documents: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            }
            }
        })
     
});
$(document).ready(function() {
    $('#otherdetails').bootstrapValidator({
        
        fields: {
            
            kyc_doc1: {
                 validators: {
					notEmpty: {
						message: 'Document Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Document Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			 kyc_file1: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            }
            }
        })
     
});
</script>