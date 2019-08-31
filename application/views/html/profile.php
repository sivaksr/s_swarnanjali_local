 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
			<?php if($userdetails['profile_pic']!=''){?>
						<img src="<?php echo base_url('assets/adminpic/'.$userdetails['profile_pic']);?>" class="profile-user-img img-responsive img-circle" alt="<?php echo htmlentities($userdetails['profile_pic']); ?>" />
					<?php }else{ ?>
						<img src="<?php echo base_url();?>assets/vendor/dp.png" class="profile-user-img img-responsive img-circle" alt="User Image" />
					<?php } ?>

              <h3 class="profile-username text-center"><?php echo isset($userdetails['name'])?$userdetails['name']:''; ?></h3>

              <p class="text-muted text-center"><?php echo isset($userdetails['role_name'])?$userdetails['role_name']:''; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo isset($userdetails['email'])?$userdetails['email']:''; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Mobile	</b> <a class="pull-right"><?php echo isset($userdetails['mobile'])?$userdetails['mobile']:''; ?></a>
                </li>
				<li class="list-group-item">
                   <a href="<?php echo base_url('profile/changepassword');?>" class="">Change Password</a>&nbsp;&nbsp;&nbsp;
                   <a href="<?php echo base_url('dashboard/logout');?>" class="pull-right">Sign Out</a>
                </li>
                
              </ul>

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Qualification</strong>

              <p class="text-muted">
                <?php echo isset($userdetails['qalification'])?$userdetails['qalification']:''; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo isset($userdetails['address'])?$userdetails['address']:''; ?></p>
			<hr>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> Information</h3>
              <a href="<?php echo base_url('profile/edit'); ?>" class=" pull-right btn btn-primary btn-sm"> Edit</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-user margin-r-5"></i> Name</strong>

              <p class="h4">
               <?php echo isset($userdetails['name'])?$userdetails['name']:''; ?>
              </p>

              <hr>  
			  <strong><i class="fa fa-university margin-r-5"></i>School Name</strong>

              <p class="h4">
               <?php echo isset($userdetails['scl_bas_name'])?$userdetails['scl_bas_name']:''; ?>
              </p>

              <hr>  
			  <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>

              <p class="h4">
               <?php echo isset($userdetails['email'])?$userdetails['email']:''; ?>
              </p>
			  <hr>  
			  <strong><i class="fa fa-mobile margin-r-5"></i> Mobile</strong>

              <p class="h4">
               <?php echo isset($userdetails['mobile'])?$userdetails['mobile']:''; ?>
              </p>

              <hr> 
			  <strong><i class="fa fa-graduation-cap margin-r-5"></i>Qualification</strong>
			  <p class="h4">
               <?php echo isset($userdetails['qalification'])?$userdetails['qalification']:''; ?> 
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo isset($userdetails['address'])?$userdetails['address']:''; ?></p>

              <hr>
			  <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p><?php echo isset($userdetails['notes'])?$userdetails['notes']:''; ?></p>
            </div>
            <!-- /.box-body -->
          </div>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

