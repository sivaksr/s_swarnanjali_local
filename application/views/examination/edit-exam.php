<div class="content-wrapper">

   <section class="content">

      <div class="row">

        <!-- left column -->

        <div class="col-md-12">

          <!-- general form elements -->

          <div class="box box-primary">

            <div class="box-header with-border">

              <h3 class="box-title">Edit Exam</h3>

            </div>

            <!-- /.box-header -->

            <!-- form start -->

			<div style="padding:20px;">

			<div class="row">

			<form id="addexam_form" method="post" class="" action="<?php echo base_url('examination/editpost'); ?>">

				<input  type="hidden" name="id" value="<?php echo isset($detail['id'])?$detail['id']:''; ?>">

				<div class="col-md-6">

							<div class="form-group">

							<label class=" control-label"> Exam Type</label>

										<div class="">

											<select class="form-control"  id="exam_type" name="exam_type">

												<option value="">Select exam Type</option>

												<option value="Assignments" <?php if($detail['exam_type']=='Assignments'){ echo "selected"; } ?>> Assignments </option>

												<option value="Mid"<?php if($detail['exam_type']=='Mid'){ echo "selected"; } ?>>Mid</option>

												<option value="Quarterly" <?php if($detail['exam_type']=='Quarterly'){ echo "selected"; } ?>> Quarterly</option>

												<option value="Half Yearly" <?php if($detail['exam_type']=='Half Yearly'){ echo "selected"; } ?>> Half Yearly</option>

												<option value="Yearly" <?php if($detail['exam_type']=='Yearly'){ echo "selected"; } ?>> Yearly </option>

											</select>

										</div>

									</div>

                        </div>

						

						

                        

<div class="col-md-12" >	

<div class="row" style="padding-bottom:-20px;">	

	

<div class="col-sm-3 nopadding">

  <div class="form-group">

   <label> Select Class</label>

  </div>

</div>

<div class="col-sm-3 nopadding">

  <div class="form-group">

      <label> Select Subject</label>

  </div>

</div>

<div class="col-sm-2 nopadding">

  <div class="form-group">

     <label> Exam Date</label>

  </div>

</div>



<div class="col-sm-2 nopadding">

  <div class="form-group">

     <label>Exam Strat Time</label>

    </div>

  </div>
  <div class="col-sm-2 nopadding">

  <div class="form-group">

     <label>Exam End Time</label>

    </div>

  </div>

</div>

</div>

<div class="clear"></div>




<div class="col-md-12">	

<div class="row">	

	<div id="education_fields">



	</div>

<div class="col-sm-3 nopadding">



  <div class="form-group">

    <select class="form-control" id="class_id" name="class_id" onchange="get_class_wise_subjects(this.value);"> 

		<option value="">Select Class</option>

		<?php if(isset($class_list) && count($class_list)>0){ ?>

		<?php foreach($class_list as $list){ ?>

		<?php if($detail['class_id']==$list['id']){ ?>

		<option selected value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>

		<?php }else{ ?>

			<option value="<?php echo $list['id']; ?>"><?php echo $list['name'].' '.$list['section']; ?></option>

			<?php } ?>

			<?php } ?>

		<?php } ?>

		

	</select>

  </div>

	

</div>

	

<div class="col-sm-3 nopadding">

  <div class="form-group">

    <select id="subject" name="subject"   class="form-control">

	<option value="">Select Subject</option>

	<?php if(isset($subject_list) && count($subject_list)>0){ ?>

		<?php foreach($subject_list as $list){ ?>

		<?php if($detail['subject']==$list['id']){ ?>

		<option selected value="<?php echo $list['id']; ?>"><?php echo $list['subject']; ?></option>

		<?php }else{ ?>

			<option value="<?php echo $list['id']; ?>"><?php echo $list['subject']; ?></option>

			<?php } ?>

			<?php } ?>

		<?php } ?>

	</select>

  </div>

</div>

<div class="col-sm-2 nopadding">

  <div class="form-group">

      <input type="date" class="form-control" id="exam_date" name="exam_date"  placeholder="EX:DD-MM-YYYY" value="<?php echo isset($detail['exam_date'])?$detail['exam_date']:''?>">

  </div>

</div>

<div class="col-sm-2 nopadding">

  <div class="form-group">

    <input type="time" class="form-control" id="start_time" name="start_time" placeholder="EX:10 AM" value="<?php echo isset($detail['start_time'])?$detail['start_time']:''?>">

  </div>

</div>



<div class="col-sm-2 nopadding">

  <div class="form-group">

    <div class="input-group">

         <input type="time" class="form-control" id="to_time" name="to_time" placeholder="EX:01 PM" value="<?php echo isset($detail['to_time'])?$detail['to_time']:''?>">


	  <!--<div class="input-group-btn">

	  <a href="<?php echo base_url('examination/removeexam/'.base64_encode($lis['e_l_id'])); ?>" class="btn btn-danger" type="button" onclick="education_fields;"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a>

      </div>

	  <div class="input-group-btn">

        <button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>

      </div>-->

    </div>

  </div>

</div>

<div class="clear"></div>

</div>

</div>



	
	

</div>



</div>




  </div>

</div>

	

						<!--<div class="col-md-3">

							<div class="form-group">

							<label class=" control-label">Room No</label>

								<div class="">

									<input type="text" name="room_no" id="room_no" class="form-control" placeholder="Enter room No">

								</div>

							</div>

                        </div>

						<div class="col-md-3">

							<div class="form-group">

							<label class=" control-label">Invigilator</label>

										<div class="">

										<select class="form-control" id="teacher_id" name="teacher_id"> 

										<option value="">Select</option>

										<?php foreach($teachers_list as $list){ ?>

										<option value="<?php echo $list['u_id']; ?>"><?php echo $list['name']; ?></option>

										<?php } ?>



									</select>

										</div>

									</div>

                        </div>

					-->

							

						<div class="col-md-12">

							<div class="form-group">

							<label> &nbsp;</label>



							<div class="input-group ">

							  <button type="submit" class="btn btn-primary pull-right " name="signup" value="Sign up">Create Exam</button>

							</div>

							<!-- /.input group -->

						  </div>

                        </div>

					

						<div class="clearfix">&nbsp;</div>

						

						

						

						

					

						<div class="clearfix">&nbsp;</div>

						 

						

                    </form>

					</div>

					 </div>

					<div class="clearfix">&nbsp;</div>

	

          </div>

          <!-- /.box -->



         



        </div>

      

        </div>

        <!--/.col (right) -->

      </div>

      <!-- /.row -->

	  

    </section> 

   

</div>

<script>

var room = 1;

function education_fields() {

 

    room++;

    var objTo = document.getElementById('education_fields')

    var divtest = document.createElement("div");

	divtest.setAttribute("class", "form-group removeclass"+room);

	var rdiv = 'removeclass'+room;

    divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"> <select id="class_id" name="class_id[]" onchange="get_class_wise_subjects(this.value,'+room+');" class="form-control" ><option value="">Select</option><?php foreach ($class_list as $list){ ?><option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?><?php echo $list['section']; ?></option><?php }?></select></div></div><div class="col-sm-3 nopadding"><div class="form-group"><select class="form-control" id="subject" name="subject[]"><option value="">Subject</option> </select></div></div><div class="col-sm-2 nopadding"><div class="form-group"> <input type="text" class="form-control" name="exam_date[]" id="exam_date" value="" placeholder="EX:DD-MM-YYYY"></div></div><div class="col-sm-2 nopadding"><div class="form-group"> <input type="text" name="start_time[]" id="start_time" class="form-control" value="" placeholder="EX:10 AM"></div></div><div class="col-sm-2 nopadding"><div class="form-group"><div class="input-group"> <input type="text" name="to_time[]" id="to_time" class="form-control" value="" placeholder="EX:01 PM"><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';

    

    objTo.appendChild(divtest)

}

   function remove_education_fields(rid) {

	   $('.removeclass'+rid).remove();

   }

</script>



  <script type="text/javascript">

   function admindeactive(id){

	$(".popid").attr("href","<?php echo base_url('examination/status'); ?>"+"/"+id);

} 

function adminstatus(id){

	if(id==1){

			$('#content1').html('Are you sure you want to Deactivate?');

		

	}if(id==0){

			$('#content1').html('Are you sure you want to activate?');

	}

}

  function admindedelete(id){

	$(".popid").attr("href","<?php echo base_url('examination/delete'); ?>"+"/"+id);

}

function admindedeletemsg(id){

	$('#content1').html('Are you sure you want to delete?');

	

}

$(document).ready(function() {

   

    $('#addexam_form').bootstrapValidator({

		fields: {

            exam_type: {

                validators: {

                    notEmpty: {

                        message: 'Exam Type is required'

                    }

                }

            },

			class_id[]: {

                validators: {

                    notEmpty: {

                        message: 'Class is required'

                    }

                }

            },

			'subject[]': {

                validators: {

                    notEmpty: {

                        message: 'Subject is required'

                    }

                }

            },

			exam_date[]: {

                validators: {

                    notEmpty: {

						message: 'Date of Birth is required'

					},

					date: {

                        format: 'DD-MM-YYYY',

                        message: 'The value is not a valid date'

                    }

                }

            },start_time[]: {

                validators: {

                    notEmpty: {

                        message: 'Start Time is required'

                    }

                }

            },to_time[]: {

                validators: {

                    notEmpty: {

                        message: 'End Time is required'

                    }

                }

            },room_no: {

                validators: {

                    notEmpty: {

                        message: 'Room Number is required'

                    },regexp: {

					regexp:  /^[0-9]*$/,

					message:'Room Number must be digits'

					}

                }

            },

			teacher_id: {

                validators: {

                    notEmpty: {

                        message: 'Invigilator is required'

                    }

                }

            }

        }

    });



    // Validate the form manually

    $('#validateBtn').click(function() {

        $('#defaultForm').bootstrapValidator('validate');

    });



    $('#resetBtn').click(function() {

        $('#defaultForm').data('bootstrapValidator').resetForm(true);

    });

});

</script>

<script>

function get_class_wise_subjects(class_id){

	//alert('haii');

	if(class_id !=''){

		    jQuery.ajax({

   			url: "<?php echo base_url('examination/get_class_wise_subjects');?>",

   			data: {

				class_id: class_id,

			},

   			type: "POST",

   			format:"Json",

   					success:function(data){

						

						if(data.msg=1){

							var parsedData = JSON.parse(data);

						//alert(parsedData.list.length);

							$('#subject').empty();

							$('#subject').append("<option>select</option>");

							for(i=0; i < parsedData.list.length; i++) {

								//console.log(parsedData.list);

							$('#subject').append("<option value="+parsedData.list[i].subject+">"+parsedData.list[i].subject+"</option>");                      

                    

								

							 

							}

						}

						

   					}

           });

	   }

}

</script>

<script>

function get_class_wise_subjects_one(class_id){

	//alert('haii');

	if(class_id !=''){

		    jQuery.ajax({

   			url: "<?php echo base_url('examination/get_class_wise_subjects');?>",

   			data: {

				class_id: class_id,

			},

   			type: "POST",

   			format:"Json",

   					success:function(data){

						

						if(data.msg=1){

							var parsedData = JSON.parse(data);

						//alert(parsedData.list.length);

							$('#subjects').empty();

							$('#subjects').append("<option>select</option>");

							for(i=0; i < parsedData.list.length; i++) {

								//console.log(parsedData.list);

							$('#subjects').append("<option value="+parsedData.list[i].subject+">"+parsedData.list[i].subject+"</option>");                      

                    

								

							 

							}

						}

						

   					}

           });

	   }

}

</script>

<script>

  $(function () {

    $("#example1").DataTable();

   

  });

</script>