  <style>
  fc-time{
	display:none !important;  
  }
  hideClass
{ display:none; }

showClass
{ display:block; }
  </style>
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard</h1>
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
              <h3><?php echo isset($student_list['total_count']) ?$student_list['total_count']:''; ?></h3>

              <p>Total Students</p>
            </div>
            <div class="icon">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo isset($teachers_list['total_count']) ?$teachers_list['total_count']:''; ?></h3>

              <p>Total Teachers</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo isset($student_list['total_count']) ?$student_list['total_count']:''; ?></h3>

              <p>Parents</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo isset($total_money['total_count']) ?$total_money['total_count']:''; ?></h3>

              <p>Total Earnings</p>
            </div>
            <div class="icon">
              <i class="fa fa-credit-card-alt"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
		<div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Draggable Events</h4>
            </div>
            <div class="box-body">
              <!-- the events -->
              <div id="external-events">
			  <?php if(isset($event_list) && count($event_list)>0){ ?>
				  <?php foreach($event_list as $list){ ?>
				  <?php if($list['color']!=''){
							$color=$list['color'];
						}else{ 
							$color='rgb(0, 115, 183)';
						} 
				  ?>
					<!--<div id="event_id<?php echo $list['id']; ?>" class="external-event" style="background-color:<?php echo $color; ?>;color:#fff"><b style="display:none"><?php echo $list['id'].'_'; ?></b><?php echo $list['event']; ?> <span style="position:absolute;right:5px;top:5px;"><a href="javascript:void(0);" onclick="remove_event('<?php echo $list['id']; ?>');"><i class="fa fa-close" style="color:#fff"></i></a></span> </div>-->
				  <div id="event_id<?php echo $list['id']; ?>" class="external-event" style="background-color:<?php echo $color; ?>;color:#fff"><b style="display:none"><?php echo $list['id'].'_'; ?></b><?php echo $list['event']; ?> <span style="position:absolute;right:5px;top:5px;"><a href="<?php echo base_url('dashboard/removeevent/'.base64_encode($list['id'])); ?>"><i class="fa fa-close" style="color:#fff"></i></a></span> </div>

				  <?php } ?>
			  <?php } ?>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Create Event</h3>
            </div>
            <div class="box-body">

              <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                <ul class="fc-color-picker" id="color-chooser">
                  <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="#00bfff" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                </ul>
              </div>
              <!-- /btn-group -->
			  <form id="addevent"  name="addevent" action="<?php echo base_url('dashboard/addevent'); ?>" method="post">

              <div class="input-group">
                <input  type="text" name="event_name" id="event_name" class="form-control" placeholder="Event Title">
				<input  type="hidden" id="color_type" name="color_type" value="">
                <div class="input-group-btn">
                  <button  type="submit" class="btn btn-primary btn-flat">Add</button>
                </div>
                <!-- /btn-group -->
              </div>
			  </form>
              <!-- /input-group -->
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <script>
  function remove_event(id){
	  if(id!=''){
		 jQuery.ajax({
					url: "<?php echo site_url('dashboard/remove_events');?>",
					data: {
						event_id: id,
					},
					dataType: 'json',
					type: 'POST',
					success: function (data) {
					if(data.msg==1){
						jQuery('#event_id'+id).hide();
					}
				 }
				});
			}
	  
  }
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
	  
	  <?php foreach($calendra_events as $list){
			//echo '<pre>';print_r($list);exit;
	  ?>
		  {
			  
		  id: '<?php echo $list['c_id']; ?>',
          title: '<?php echo $list['title']; ?>',
          start: new Date(<?php echo $list['year']; ?>, <?php echo $list['month']; ?>, <?php echo $list['date']; ?>),
          backgroundColor: "<?php echo $list['color']; ?>", //red
          borderColor: "<?php echo $list['color']; ?>",//red
		  className: 'show<?php echo $list['c_id']; ?>',
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

      },
	  eventClick: function(event, jsEvent, ui, view) {
		   						$(this).hide();

				jQuery.ajax({
					url: "<?php echo site_url('dashboard/delete_add_event_calender');?>",
					data: {
						c_id: event['id'],
					},
					dataType: 'json',
					type: 'POST',
					success: function (data) {
						if(data.msg==1){
							console.log('successfully event delete');
						}else if(data.msg==2){
							console.log('already added');
						}else{
							console.log('error occured');
						}
					}
				});
		  
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
  
  
  
  
  $(document).ready(function() {
   
    $('#addevent').bootstrapValidator({
		fields: {
            event_name: {
                validators: {
                    notEmpty: {
                        message: 'Event Name is required'
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


