<style>
   .dat-help .col-md-6{
   -webkit-box-flex: 0;
   -webkit-flex: 0 0 50%;
   -ms-flex: 0 0 50%;
   flex: 0 0 50%;
   max-width: 80%;
   }
   .dataTables_info{
   display:none
   }
   #example_wrapper .col-sm-6 {
	width:100%
   }
   div.dataTables_filter {
    text-align: center;
	margin:10px
}
   #example_length{
   display:none
   }
   #example_paginate{
   display:none
   }
     .panel-group .panel {
        border-radius: 0;
        box-shadow: none;
        border-color: #EEEEEE;
    }

    

    .panel-title > a {
        display: block;
        padding: 10px;
        text-decoration: none;
    }

    .more-less {
        float: right;
        color: #212121;
    }

  
</style>
<div class="content-wrapper">
   <section class="content">
  
      <!-- start widget -->
      <div class="row">
         <div class="col-md-12 col-sm-12">
            <div class="card-box box-primary">
               <div class="box-header with-border">
              <h3 class="box-title">Announcement</h3>
            </div>
               <div class="card-body ">
                  <div class="panel tab-border card-topline-green">
                    
                     <div class="panel-body">
                        <div class="tab-content">
                          
						  
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	
          <?php if(isset($notification_list) && count($notification_list)>0){
			  foreach($notification_list as $List){ ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading1">
                <h4 class="panel-title">
					<?php if(isset($userdetails['role_id']) && $userdetails['role_id']!=1 && $userdetails['role_id']==2){ ?>

                    <a  onclick="opennotification('<?php echo $List['int_id']; ?>')" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1<?php echo $List['int_id']; ?>" aria-expanded="true" aria-controls="collapse1">
                        <i class="more-less glyphicon glyphicon-plus"></i><?php echo ucfirst(substr($List['comment'], 0, 10)); ?>
                        <span class="pull-right "><?php echo date('M j h:i A',strtotime(htmlentities($List['create_at'])));?> &nbsp;&nbsp;</span> 
                    </a>
					<?php }else if($userdetails['role_id']!=1 && $userdetails['role_id']!=2){ ?>
					<a  onclick="resourceopennotification('<?php echo $List['int_id']; ?>')" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1<?php echo $List['int_id']; ?>" aria-expanded="true" aria-controls="collapse1">
                        <i class="more-less glyphicon glyphicon-plus"></i><?php echo ucfirst(substr($List['comment'], 0, 10)); ?>
                        <span class="pull-right "><?php echo date('M j h:i A',strtotime(htmlentities($List['create_at'])));?> &nbsp;&nbsp;</span> 
                    </a>
					<?php } ?>
                </h4>
            </div>
            <div id="collapse1<?php echo $List['int_id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
                <div class="panel-body">
				<?php echo $List['comment']; ?>
                </div>
				
								  
            </div>
        </div>
		  <?php } ?>
		  <?php }else{ ?>
		  <div>No data Available</div>
		  <?php } ?>
        


    </div>
		 				
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            </div>
         </div>
      </div>
      <!-- end admited patient list -->
   </div>
</div>
<script>
function returnvalidation(){
	var ids=$('#schools_ids').val();
	var msg =$('#comments').val();
	if(ids!='' && msg!=''){
		document.getElementById("addnotifications").submit();
	}else if(ids==''){
		alert('please  select and submit schools list in any one');
		return false;
	}else if(msg==''){
		alert('Comment is required');
		return false;
	}
	
	
}
   //
   // Updates "Select all" control in a data table
   //
   function updateDataTableSelectAllCtrl(table){
      var $table             = table.table().node();
      var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
      var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
      var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);
   
      // If none of the checkboxes are checked
      if($chkbox_checked.length === 0){
         chkbox_select_all.checked = false;
         if('indeterminate' in chkbox_select_all){
            chkbox_select_all.indeterminate = false;
         }
   
      // If all of the checkboxes are checked
      } else if ($chkbox_checked.length === $chkbox_all.length){
         chkbox_select_all.checked = true;
         if('indeterminate' in chkbox_select_all){
            chkbox_select_all.indeterminate = false;
         }
   
      // If some of the checkboxes are checked
      } else {
         chkbox_select_all.checked = true;
         if('indeterminate' in chkbox_select_all){
            chkbox_select_all.indeterminate = true;
         }
      }
   }
   
   $(document).ready(function (){
      // Array holding selected row IDs
      var rows_selected = [];
      var table = $('#example').DataTable({
        'columnDefs': [{
      'targets': 0,
      'searchable': false,
      'orderable': false,
      'width': '1%',
      'className': 'dt-body-center',
      'render': function (data, type, full, meta){
          return '<input type="checkbox">';
      }
   }],
         'order': [1, 'asc'],
         'rowCallback': function(row, data, dataIndex){
            // Get row ID
            var rowId = data[0];
            // If row ID is in the list of selected row IDs
            if($.inArray(rowId, rows_selected) !== -1){
               $(row).find('input[type="checkbox"]').prop('checked', true);
               $(row).addClass('selected');
            }
         }
      });
   
      // Handle click on checkbox
      $('#example tbody').on('click', 'input[type="checkbox"]', function(e){
         var $row = $(this).closest('tr');
   
         // Get row data
         var data = table.row($row).data();
   
         // Get row ID
         var rowId = data[0];
   
         // Determine whether row ID is in the list of selected row IDs 
         var index = $.inArray(rowId, rows_selected);
   
         // If checkbox is checked and row ID is not in list of selected row IDs
         if(this.checked && index === -1){
            rows_selected.push(rowId);
   
         // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
         } else if (!this.checked && index !== -1){
            rows_selected.splice(index, 1);
         }
   
         if(this.checked){
            $row.addClass('selected');
         } else {
            $row.removeClass('selected');
         }
   
         // Update state of "Select all" control
              updateDataTableSelectAllCtrl(table);
   
         // Prevent click event from propagating to parent
         e.stopPropagation();
      });
   
      // Handle click on table cells with checkboxes
      $('#example').on('click', 'tbody td, thead th:first-child', function(e){
         $(this).parent().find('input[type="checkbox"]').trigger('click');
      });
   
      // Handle click on "Select all" control
      $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
         if(this.checked){
            $('tbody input[type="checkbox"]:not(:checked)', table.table().container()).trigger('click');
         } else {
            $('tbody input[type="checkbox"]:checked', table.table().container()).trigger('click');
         }
   
         // Prevent click event from propagating to parent
         e.stopPropagation();
      });
   
      // Handle table draw event
      table.on('draw', function(){
         // Update state of "Select all" control
         updateDataTableSelectAllCtrl(table);
      });
       
      // Handle form submission event 
      $('#frm-example').on('submit', function(e){
         var form = this;
   
         // Iterate over all selected checkboxes
         $.each(rows_selected, function(index, rowId){
            // Create a hidden element 
            $(form).append(
                $('<input>')
                   .attr('type', 'hidden')
                   .attr('name', 'id[]')
                   .val(rowId)
            );
         });
   
         // FOR DEMONSTRATION ONLY     
         
         // Output form data to a console     
         //$('#example-console').text($(form).serialize());
        // console.log("Form submission", $(form).serialize());
   	  var $data=$(form).serialize();
	  
	  //console.log($data);return false;
	  $('#schools_ids').val($data);
   	   jQuery.ajax({
   			url: "<?php echo base_url('Announcement/getschoolssname');?>",
   			data:$data,
   			type: "POST",
   			format:"Json",
   					success:function(data){
   					var parsedData = JSON.parse(data);
   					$('#example-console').text(parsedData.names_list);
   					$('#schools_ids').val(parsedData.ids);
   					}
           });
         // Remove added elements
         $('input[name="id\[\]"]', form).remove();
          
         // Prevent actual form submission
         e.preventDefault();
      });
   });
</script>
<script>
function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>