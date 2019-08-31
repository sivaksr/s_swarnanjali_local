<div class="content-wrapper">
   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            
            <!-- /.box-header -->
            <!-- form start -->
			<div style="padding:20px;">
            <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo isset($student_count)?$student_count:'&nbsp;'; ?></h3>
              

              <p>Total Students</p>
            </div>
            <div class="icon">
              <i class="fa fa-graduation-cap"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>82.5<sup style="font-size: 20px">%</sup></h3>

              <p>ATTENDENCE</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              
              <h3><?php echo isset($class_reacher)?$class_reacher:''; ?></h3>

              <p>Class Teacher</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo isset($classs_subject_list)?$classs_subject_list:'';?></h3>

              <p> Subject</p>
            </div>
            <div class="icon">
              <i class="fa fa-credit-card-alt"></i>
            </div>
            
          </div>
        </div>
	
		<div class="clearfix"> &nbsp; </div>	
		<hr>
		<div class="">
		     
			
			<div class="box-header">
              <h3 class="">My Classes</h3>
			  <br>
			  <div>
			  <?php if(isset($my_class_list) && count($my_class_list)>0){ ?>
			  <?php   foreach($my_class_list as $list){?>
			  <div class="col-md-2">
				  <div class="box box-primary collapsed-box">
					<div class="box-header with-border">
					  <h3 class="box-title"><?php echo isset($list['name'])?$list['name']:''; ?> &nbsp;<?php echo isset($list['section'])?$list['section']:''; ?></h3>
					</div>
				  </div>
				</div>
				
				<?php } ?>
				<?php }else{ ?>
				  <div class="col-md-2">
					No Classes Are found
				  </div>
				<?php } ?>
				
			  </div>
            </div>
			
			<hr>
			
            <div class="box-header">
              <h3 class="">Class Schedules</h3>
            </div>
            <!-- /.box-header -->
			
			<?php //echo count($weekday); ?>
			<?php //echo count($classschedules);exit; ?>
            <div class="box-body table-responsive">
			<?php if(isset($classschedules) && count($classschedules)>0){ ?>
              <table id="example1" class="table table-bordered table-striped">
				<thead>
                <tr>
                <th >TIMINGS</th>
				<th>Days</th>
                </tr>
                </thead>
				  <tbody>
                      <?php foreach($classschedules as $list){?>
							<tr>
								  <td>
								  <?php echo isset($list['timesheet'])?$list['timesheet']:''; ?>
								  </td>
								  <td>
									<div><strong class="text-primary">Day : </strong><?php echo isset($list['day'])?$list['day']:''; ?></div>
									<div><strong class="text-primary">Subject : </strong><?php echo isset($list['subject'])?$list['subject']:''; ?></div>
									<div><strong class="text-primary">Class :</strong><?php echo isset($list['name'])?$list['name']:''; ?> &nbsp;- <?php echo isset($list['section'])?$list['section']:''; ?></div>
									
								  </td>
								 
									
									
								
							</tr>
					<?php } ?>
					</tbody>
                <tfoot>
                <tr>
                <th >TIMINGS</th>
				<th >Days</th>
                </tr>
                </tfoot>
              </table>
			<?Php }else{ ?>
				No Class Schedules found
			<?php } ?>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
		
		
      </div>
	  <div class="clearfix"></div>
	  <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
		
        
      </div>

    </section>
					
					
					
      
   
</div>
  <script type="text/javascript">
 $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
		
		ele.each(function () {
		//console.log(dd);
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var title_str=$.trim($(this).text());
		//console.log(title_strs);
        var ids = title_str.split("_");
		var eventObject = {
			title: ids[1], // use the element's text as the event title
			id: ids[0], // use the element's text as the event title
        };
		//console.log(eventObject);
        // store the Event Object in the DOM element so we can get to it later
        var dd=$(this).data('eventObject', eventObject);
	// make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

	  });
	 
    }
	
    ini_events($('#external-events div.external-event'));
	//alert(ini_events);

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'Today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      //Random default events
      events: [
	  
	  <?php foreach($calendra_events as $list){ ?>
		  {
          title: '<?php echo $list['title']; ?>',
          start: new Date(<?php echo $list['year']; ?>, <?php echo $list['month']; ?>, <?php echo $list['date']; ?>),
          backgroundColor: "<?php echo $list['color']; ?>", //red
          borderColor: "<?php echo $list['color']; ?>" //red
        },
	  <?php } ?>
        
      ],
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
		
		var full_title=$(this).data('eventObject');
		//var title_str=full_title['title'];
        //var dd = title_str.split("_");
        var originalEventObject = full_title;
		var date22 = new Date(date['_d']);
		var currentdata=date22.toISOString().slice(0,10);
        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.timedate = currentdata;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");
		//console.log(copiedEventObject['backgroundColor']);
		//console.log(copiedEventObject['id']);
		jQuery.ajax({
					url: "<?php echo site_url('dashboard/save_add_event_calender');?>",
					data: {
						title: copiedEventObject['title'],
						event_id: copiedEventObject['id'],
						timedate: copiedEventObject['timedate'],
						color: copiedEventObject['backgroundColor'],
					},
					dataType: 'json',
					type: 'POST',
					success: function (data) {
						if(data.msg==1){
							console.log('successfully event added');
						}else if(data.msg==2){
							console.log('already added');
						}else{
							console.log('error occured');
						}
					}
				});
		
        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        var dd=$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':	')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }

      }
    });

    /* ADDING EVENTS */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
	  //alert(currColor);
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
      $('#color_type').empty();
      $('#color_type').val(currColor);
    });
    
  });
  
</script>

