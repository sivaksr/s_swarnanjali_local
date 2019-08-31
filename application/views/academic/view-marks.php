<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Exam Marks</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
            <form id="defaultForm" method="post" class="" action="assign-class.php">
						<div class="col-md-3">
							<div class="form-group">
							<label class=" control-label">Class</label>
										<div class="">
											<select class="form-control">
												<option>Select Class</option>
												<option> 1st  </option>
												<option> 2nd</option>
												<option> 3rd </option>
												<option> 4th</option>
												<option> 5th</option>
												
											</select>
										</div>
									</div>
                        </div>
							<div class="col-md-3">
							<div class="form-group">
							<label class=" control-label"> Section</label>
										<div class="">
											<select class="form-control">
												<option>Select section</option>
												<option> Ist - A </option>
												<option> 2nd -B</option>
												<option> 3rd -C </option>
												<option> 4th - A</option>
												<option> 5th</option>
											</select>
										</div>
									</div>
                        </div>	
						<div class="col-md-3">
							<div class="form-group">
							<label class=" control-label"> Subject</label>
										<div class="">
											<select class="form-control">
												<option>Mathamtics</option>
												<option> Science </option>
												<option> Social</option>
												<option> English </option>
												<option> Telugu</option>
												<option> Hindi</option>
											</select>
										</div>
									</div>
                        </div>
						<div class="col-md-3">
							<div class="form-group">
							<label class=" control-label"> Exam Type</label>
										<div class="">
											<select class="form-control">
												<option>Select exam Type</option>
												<option>Mid</option>
												<option> Assignments </option>
												<option> Quterly</option>
												<option> Yearly </option>
												
											</select>
										</div>
									</div>
                        </div>
							
						<div class="col-md-12">
							<div class="form-group">
							<label> &nbsp;</label>

							<div class="input-group ">
							  <div  id="attentdence" class="btn btn-primary pull-right " name="signup" value="Sign up">Search</div>
							</div>
							<!-- /.input group -->
						  </div>
                        </div>
					
						<div class="clearfix">&nbsp;</div>
						
						
						
						
					
						<div class="clearfix">&nbsp;</div>
						 
						
                    </form>
					<div class="clearfix">&nbsp;</div>
					
		<div class="box attentdence-table" style="display:none">
            <div class="box-header">
              <h3 class="">Enter marks Here </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
			<form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Roll No</th>
				  <th>Name</th>
                  <th>Subject</th>
                  <th>Type</th>
                  <th>Marks Obtained</th>
                  <th>Maximum Marks</th>
                  <th>Remarks</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>I00216 </td>
				  <td>Bayapureddy</td>
                  <td>Telugu </td>
                  <td>Mid </td>
                  <td>80</td>
                  <td>100 </td>
                  <td>Good </td>
                </tr>
				<tr>
                  <td>I00216 </td>
				  <td>Bayapureddy</td>
                  <td>Telugu </td>
                  <td>Mid </td>
                  <td>80</td>
                  <td>100 </td>
                  <td>Good </td>
                </tr>
				<tr>
                  <td>I00216 </td>
				  <td>Bayapureddy</td>
                  <td>Telugu </td>
                  <td>Mid </td>
                  <td>80</td>
                  <td>100 </td>
                  <td>Good </td>
                </tr>
				<tr>
                  <td>I00216 </td>
				  <td>Bayapureddy</td>
                  <td>Telugu </td>
                  <td>Mid </td>
                  <td>80</td>
                  <td>100 </td>
                  <td>Good </td>
                </tr>
				<tr>
                  <td>I00216 </td>
				  <td>Bayapureddy</td>
                  <td>Telugu </td>
                  <td>Mid </td>
                  <td>80</td>
                  <td>100 </td>
                  <td>Good </td>
                </tr>
				<tr>
                  <td>I00216 </td>
				  <td>Bayapureddy</td>
                  <td>Telugu </td>
                  <td>Mid </td>
                  <td>80</td>
                  <td>100 </td>
                  <td>Good </td>
                </tr>
				
									
                
                </tbody>
				
              </table>
			  <div class="clearfix">&nbsp;</div>
               <button class="btn btn-primary col-md-offset-4">Update Marks</button>
			 
			  </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          </div>
          <!-- /.box -->

         

        </div>
      
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
	  
    </section> 
   
</div>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#attentdence").click(function(){
        $(".attentdence-table").toggle();
    });
});
  
  </script>
  <script type="text/javascript">
$(document).ready(function() {
    // Generate a simple captcha
    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    };
    $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));

    $('#defaultForm').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            firstName: {
                group: '.col-lg-4',
                validators: {
                    notEmpty: {
                        message: 'The first name is required and cannot be empty'
                    }
                }
            },
            lastName: {
                group: '.col-lg-4',
                validators: {
                    notEmpty: {
                        message: 'The last name is required and cannot be empty'
                    }
                }
            },
            username: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    },
                    remote: {
                        type: 'POST',
                        url: 'remote.php',
                        message: 'The username is not available'
                    },
                    different: {
                        field: 'password,confirmPassword',
                        message: 'The username and password cannot be the same as each other'
                    }
                }
            },
            email: {
                validators: {
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                    identical: {
                        field: 'confirmPassword',
                        message: 'The password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and cannot be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
            },
            birthday: {
                validators: {
                    date: {
                        format: 'YYYY/MM/DD',
                        message: 'The birthday is not valid'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required'
                    }
                }
            },
            'languages[]': {
                validators: {
                    notEmpty: {
                        message: 'Please specify at least one language you can speak'
                    }
                }
            },
            'programs[]': {
                validators: {
                    choice: {
                        min: 2,
                        max: 4,
                        message: 'Please choose 2 - 4 programming languages you are good at'
                    }
                }
            },
            captcha: {
                validators: {
                    callback: {
                        message: 'Wrong answer',
                        callback: function(value, validator) {
                            var items = $('#captchaOperation').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
                            return value == sum;
                        }
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
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

