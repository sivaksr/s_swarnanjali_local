<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Total Student List</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
            
					<div class="clearfix">&nbsp;</div>
					
					<div class="">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Reg No</th>
                  <th>Class</th>
                  <th>Section</th>
                  <th>Roll No</th>
                  <th>Contact No</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Bayapu</td>
                  <td>H0001234</td>
                  <td>1st</td>
                  <td>1st - B</td>
                  <td>I123456</td>
                  <td>xxxxxxx</td>
                  <td>design@gmail.com</td>
                 
                  <td>
					<a href="#" class="btn btn-warning btn-sm">Edit</a>
					<a class="btn btn-danger btn-sm">Delete</a>
				  </td>
                </tr>
				<tr>
                  <td>Bayapu</td>
                  <td>H0001234</td>
                  <td>1st</td>
                  <td>1st - B</td>
                  <td>I123456</td>
                  <td>xxxxxxx</td>
                  <td>design@gmail.com</td>
                 
                  <td>
					<a href="#" class="btn btn-warning btn-sm">Edit</a>
					<a class="btn btn-danger btn-sm">Delete</a>
				  </td>
                </tr>
				<tr>
                  <td>Bayapu</td>
                  <td>H0001234</td>
                  <td>1st</td>
                  <td>1st - B</td>
                  <td>I123456</td>
                  <td>xxxxxxx</td>
                  <td>design@gmail.com</td>
                 
                  <td>
					<a href="#" class="btn btn-warning btn-sm">Edit</a>
					<a class="btn btn-danger btn-sm">Delete</a>
				  </td>
                </tr>
				<tr>
                  <td>Bayapu</td>
                  <td>H0001234</td>
                  <td>1st</td>
                  <td>1st - B</td>
                  <td>I123456</td>
                  <td>xxxxxxx</td>
                  <td>design@gmail.com</td>
                 
                  <td>
					<a href="#" class="btn btn-warning btn-sm">Edit</a>
					<a class="btn btn-danger btn-sm">Delete</a>
				  </td>
                </tr>
				
					
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Reg No</th>
                  <th>Class</th>
                  <th>Section</th>
                  <th>Roll No</th>
                  <th>Contact No</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
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

