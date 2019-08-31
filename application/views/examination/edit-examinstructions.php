
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Exam Instructions</h3>
                    </div>

                    <!-- /.box-header -->
                    <!-- form start -->
                    <div style="padding:20px;">
                        <form id="defaultForm" method="post" class="m-b-30" action="<?php echo base_url('examinstructions/editpost'); ?>" enctype="multipart/form-data">
          <input type="hidden" name="e_i_id" id="e_i_id" value="<?php echo isset($edit_exam_instructions['e_i_id'])?$edit_exam_instructions['e_i_id']:''?>" >
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <table class="table table-bordered table-hover" id="tab_logic">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    Instructions
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr id='addr0'>
                                <td class="form-group">
                                    <input type="text" name='instructions' class="form-control" value="<?php echo isset($edit_exam_instructions['instructions'])?$edit_exam_instructions['instructions']:''?>" >
                                </td>
                                
                            </tr>
                            <tr id='addr1'></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="m-t-20 text-center">
                <button type="submit" class="btn btn-primary" name="signup" value="Sign up">ADD</button>
            </div>
        </form>

                        
						
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!--/.col (right) -->
    </section>
</div>


<script>
    $(document).ready(function() {
        var i = 1;
        $("#add_row").click(function() {
            $('#addr' + i).html("<td class='form-group'><input name='instructions[]' type='text'  class='form-control input-md'> </td>");

            $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
            i++;
        });
        $("#delete_row").click(function() {
            if (i > 1) {
                $("#addr" + (i - 1)).html('');
                i--;
            }
        });

    });
</script>



<script type="text/javascript">
$(document).ready(function() {
   $('#defaultForm').bootstrapValidator({
//     
        fields: {
            instructions: {
                validators: {
                    notEmpty: {
                        message: 'Exam Instructions is required'
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
