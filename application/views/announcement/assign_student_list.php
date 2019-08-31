<div class="box-header">
	<h3 class="">List of Slots for All Teachers</h3>
</div>
<!-- /.box-header -->
<div class="box-body table-responsive">
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>
                <button style="border: none; background: transparent; font-size: 14px;" id="MyTableCheckAllButton">
                <i class="far fa-square"></i>  
                </button>
            </th>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Salary</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>$320,800</td>
        </tr>
        <tr>
            <td></td>
            <td>Garrett Winters</td>
            <td>Accountant</td>
            <td>Tokyo</td>
            <td>63</td>
            <td>$170,750</td>
        </tr>
        <tr>
            <td></td>
            <td>Ashton Cox</td>
            <td>Junior Technical Author</td>
            <td>San Francisco</td>
            <td>66</td>
            <td>$86,000</td>
        </tr>
        <tr>
            <td></td>
            <td>Cedric Kelly</td>
            <td>Senior Javascript Developer</td>
            <td>Edinburgh</td>
            <td>22</td>
            <td>$433,060</td>
        </tr>
        <tr>
            <td></td>
            <td>Airi Satou</td>
            <td>Accountant</td>
            <td>Tokyo</td>
            <td>33</td>
            <td>$162,700</td>
        </tr>
        <tr>
            <td></td>
            <td>Brielle Williamson</td>
            <td>Integration Specialist</td>
            <td>New York</td>
            <td>61</td>
            <td>$372,000</td>
        </tr>
        <tr>
            <td></td>
            <td>Herrod Chandler</td>
            <td>Sales Assistant</td>
            <td>San Francisco</td>
            <td>59</td>
            <td>$137,500</td>
        </tr>
        <tr>
            <td></td>
            <td>Rhona Davidson</td>
            <td>Integration Specialist</td>
            <td>Tokyo</td>
            <td>55</td>
            <td>$327,900</td>
        </tr>
        <tr>
            <td></td>
            <td>Colleen Hurst</td>
            <td>Javascript Developer</td>
            <td>San Francisco</td>
            <td>39</td>
            <td>$205,500</td>
        </tr>
        <tr>
            <td></td>
            <td>Sonya Frost</td>
            <td>Software Engineer</td>
            <td>Edinburgh</td>
            <td>23</td>
            <td>$103,600</td>
        </tr>
        <tr>
            <td></td>
            <td>Jena Gaines</td>
            <td>Office Manager</td>
            <td>London</td>
            <td>30</td>
            <td>$90,560</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Salary</th>
        </tr>
    </tfoot>
</table>
</table>
Count of Selected Records <span id="dvcount" style="margin-left:115px;">0</span>
<hr/>
<button id="export">Export</button>


</div>
                            <!-- /.box-body -->
<script>
 $(document).ready(function() {
  let runningTotal = 0;
  let table = $('#example').DataTable();
  $("#selectall").click(function() {
	  
    if (runningTotal == table.rows().count()) {
      table.rows().every(function(rowIdx, tableLoop, rowLoop) {
        let clone = table.row(rowIdx).data().slice(0);
        clone[[clone.length - 1]] = '<input type="checkbox" class="record">'
        table.row(rowIdx).data(clone);
      });
    } else {
      table.rows().every(function(rowIdx, tableLoop, rowLoop) {
        let clone = table.row(rowIdx).data().slice(0);
        clone[[clone.length - 1]] = '<input type="checkbox" class="record" checked="checked">'
        table.row(rowIdx).data(clone);
      });
    }
    runningTotal = 0;
    table.rows().every(function(rowIdx, tableLoop, rowLoop) {
      var data = this.data();
      if ($(data[data.length - 1]).prop("checked")) {
        runningTotal++
      }
    });
    $('#dvcount').html(runningTotal);
  });
  $('#example tbody').on("click", ".record", function() {
    let clone = table.row($(this).closest('tr')).data().slice(0);
    let checkbox = clone[clone.length - 1];
    if ($(checkbox).prop("checked")) {
      clone[[clone.length - 1]] = '<input type="checkbox" class="record">'
    } else {
      clone[[clone.length - 1]] = '<input type="checkbox" class="record" checked="checked">';
    }
    table.row($(this).closest('tr')).data(clone);
    runningTotal = 0;
    table.rows().every(function(rowIdx, tableLoop, rowLoop) {
      var data = this.data();
      if ($(data[data.length - 1]).prop("checked")) {
        runningTotal++
      }
    });
    $('#dvcount').html(runningTotal);
  });
  $("#export").on("click", function() {
    let exportedRows = [];
    table.rows().every(function(rowIdx, tableLoop, rowLoop) {
      let data = table.row(rowIdx).data()
      if ($(data[data.length - 1]).prop("checked")) {
        exportedRows.push(data.slice(0, -1));
      }
    });
    console.log(exportedRows);
  })

});

</script>

<?php exit; ?>