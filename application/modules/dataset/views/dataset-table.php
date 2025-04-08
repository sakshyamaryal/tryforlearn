<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/theme-style2.css">

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.9/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.9/dist/sweetalert2.min.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>dataTables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>dataTables/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>dataTables/js/jquery.dataTables.columnFilter.js"></script>
<script type="text/javascript"
  src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
  <style>
  /* Existing styles */
  .table th,
  .table td {
    white-space: normal !important;
    word-wrap: break-word !important;
  }

  #dataTable {
    width: 100%;
    /* table-layout: fixed; */
  }

  /* New styles to make question column wider */
  #dataTable .exercise-question-list {
    width: 50% !important; /* Increased from 50% */
  }

  /* Adjust other columns to redistribute width */
  #dataTable th:not(.exercise-question-list) {
    width: auto;
  }

  /* Ensure text wrapping and overflow handling */
  #dataTable .exercise-question-list,
  #dataTable td:nth-child(2) {
    white-space: normal;
    overflow-wrap: break-word;
    word-wrap: break-word;
    word-break: break-word;
  }
</style>

<table class="table table-bordered table-hover table-striped pad-fixed-tbl mar-10-top dataTable no-footer"
  id="dataTable" data-filename="chapterlist" data-cols="[0,1]" style="width:100%">
  <thead id="tbl_data_thead">
    <tr>
      <th style="text-align:center;"><input type="checkbox" id="selectAllCheckbox" /><span>S.N.</span></th>
      <th style="text-align:center;">Name</th>
      <th style="text-align:center;">Title</th>
      <th style="text-align:center;">Course</th>
      <th style="text-align:center;">Class</th>
      <th style="text-align:center;">Subject</th>
      <th style="text-align:center;">Order</th>
      <th style="text-align:center;">Action</th>
    </tr>

  </thead>
  <tbody>
    <?php if (!empty($datasets)) { ?>
        <?php foreach ($datasets as $row) { ?>
            <tr>
                <td><input type="checkbox" id="<?= $row->setid; ?>" data-setid="<?= $row->setid; ?>" /><span class="sn-placeholder"></span></td>
                <td><?= $row->setname; ?></td>
                <td><?= $row->title; ?></td>
                <td><?= $row->level_name; ?></td> <!-- Display course name -->
                <td><?= $row->class_name; ?></td> <!-- Display class name -->
                <td><?= $row->subject_name; ?></td> <!-- Display subject name -->
                <td><?= $row->order; ?></td>
                <td>
                    <button id="view<?= $row->setid; ?>"><i class="fa fa-eye" title="View" aria-hidden="true"></i></button>
                    <button id="edit<?= $row->setid; ?>"><i class="fa fa-edit" title="Edit" aria-hidden="true"></i></button>
                    <button id="delete<?= $row->setid; ?>" class="delete-btn" data-setid="<?= $row->setid; ?>">
                        <i class="fa fa-trash" title="Delete" aria-hidden="true" style="color: red;"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">No datasets found.</td>
        </tr>
    <?php } ?>
  </tbody>

</table>

<!-- <script>
  function getdatasetdata(){
    var subject_id = $('#subject').val(); // Or from PHP if needed
    var class_id = $('#class').val(); // Or from PHP if needed
    // var dataurl = "<?= base_url('dataset/datasetdata'); ?>";
    var dataurl = "http://localhost/tryforlearn/dataset/datasetdata";
    $('#tbl').html(`
    <table id="dataTable" class="table table-bordered table-striped" width="100%">
        <thead>
          <tr>
            <th>S.N.</th>
            <th>Name</th>
            <th>Title</th>
            <th>Order</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
    </table>
  `);
    $('#dataTable').DataTable({
      "order": [],
      "serverSide": true,
      "processing": true,

      "destroy": true,
      "ajax": {
        "type": "POST",
        "url": dataurl,
        "data": { class_id: class_id, subject_id:subject_id },
        "dataSrc": "data"

      },
      initComplete: function () {
        console.log("dataTable initialized");
      },
      "language": {
        "emptyTable": "<p class='no_data_message'>No Content in a List</p>"
      },
      "fnCreatedRow": function (nRow, aData, iDataIndex) {
        $(nRow).attr('id', 'ch' + aData.chid);
      },
      "columnDefs": [
        { orderable: false, targets: 0 }
      ],
      "columns": [
        { "data": "sn" },
        { "data": "name" },
        { "data": "title" },
        { "data": "order" },

        { "data": "action" },


      ]

    });
    // $('#tbl').append($table);
  }
  getdatasetdata();

</script> -->

<!-- <script>
getDatasetData();

function getDatasetData() {
  var classid = $('#class').val(); // Or from PHP if needed
  var subjectid = $('#subject').val();
  var dataurl = "<?= base_url('dataset/datasetdata'); ?>";

  $('#dataTable').DataTable({
    destroy: true,
    ajax: {
      type: "POST",
      url: dataurl,
      data: {
        classid: classid,
        subjectid: subjectid
      }
    },
    language: {
      emptyTable: "<p class='no_data_message'>No Content in the List</p>"
    },
    columns: [
      { data: "sn" },
      { data: "name" },       // dataset name (setname)
      { data: "title" },
      { data: "order" },
      { data: "action" }
    ]
  });
}

</script>
<script src="data"></script> -->

<!-- <script>
  getnewdata();
  function getnewdata() {
    var classid = "<?= @$post['class']; ?>";
    var subject = "<?= @$post['subject']; ?>";
    var chapter = "<?= @$post['chapter']; ?>";
    var topic = "<?= @$post['topic']; ?>";
    var group = "<?= $post['group']; ?>";
    var toshow = "<?= $post['toshow']; ?>";
    var qtype = "<?= $post['qtype']; ?>";
    var examtypeid = "<?= $post['examtypeid']; ?>";
    var dataurl = "<?php echo base_url("exercise/getexercisedata/true") ?>";
    $table = $('#dataTable').DataTable({
      "destroy": true,
      "ajax": {
        "type": "POST",
        "url": dataurl,
        "data": { class: classid, subject, chapter, group, toshow, qtype, examtypeid, topic }

      },
      "language": {
        "emptyTable": "<p class='no_data_message'>No Content in a List</p>"
      },
      "fnCreatedRow": function (nRow, aData, iDataIndex) {
        $(nRow).attr('id', 'ch' + aData.chid);
      },
      "columnDefs": [
        { orderable: false, targets: 0 }
      ],
      "columns": [
        { "data": "sn" },
        { "data": "question" },
        { "data": "explanation" },
        { "data": "is_subj_obj" },
        { "data": "is_common" },
        { "data": "is_timer" },

        { "data": "action" },


      ]

    });

  }

  $(document).off('click', '#selectAllCheckbox');
  $(document).on('click', '#selectAllCheckbox', function () {
    const dataTable = $('#dataTable').DataTable();
    // Check if the checkbox is checked
    if ($(this).is(':checked')) {
      dataTable.page.len(-1).draw();
      // Check all checkboxes with the class 'replicate'
      $('.replicate').prop('checked', true);
    } else {
      const defaultPageLength = 10;
      dataTable.page.len(defaultPageLength).draw();
      // Uncheck all checkboxes with the class 'replicate'
      $('.replicate').prop('checked', false);
    }
  });


  $(document).off('click', '#btndeleteselected');
  $(document).on('click', '#btndeleteselected', function () {
    let checkedValues = '';
    $('.replicate').each(function () {
      if ($(this).is(':checked')) {
        checkedValues += $(this).val() + ','; // Add the value of the checked checkbox to the string
      }
    });

    // Remove the trailing comma if there are any checked values
    if (checkedValues.endsWith(',')) {
      checkedValues = checkedValues.slice(0, -1);
    }

    if (checkedValues === '') {
      toastr.warning('Please select at least one item to delete.', { timeOut: 5000 });
      return;
    }

    if (confirm('Are you sure you want to delete the selected items?')) {
      $.ajax({
        url: '<?= base_url(); ?>exercise/delete',
        type: 'POST',
        data: {
          "exercise": checkedValues,
          "condition": 'all'
        },
        beforeSend: function () {
          $('#loader').show();
        },
        success: function (res) {
          $('#loader').hide();
          let response = jQuery.parseJSON(res);
          if (response.type == 'success') {
            toastr.success(response.message, { timeOut: 5000 });
            getnewdata();
            $('#selectAllCheckbox').prop('checked', false);
            $('.replicate').prop('checked', false);
          } else {
            toastr.error(response.message, { timeOut: 5000 });
          }
        }
      });
    }
  });

</script> -->
<script>
  $(document).ready(function () {
    // Select/Deselect all checkboxes
    $('#selectAllCheckbox').on('change', function () {
        $('input[type="checkbox"]').prop('checked', this.checked);
    });

    // Handle Delete Selected Button Click
    $('#btndeleteselected').on('click', function () {
        var selectedDatasets = [];
        
        // Get the selected dataset IDs
        $('input[type="checkbox"]:checked').each(function () {
            selectedDatasets.push($(this).data('setid'));
        });
        
        if (selectedDatasets.length === 0) {
            toastr.error('Please select at least one dataset to delete.');
            return;
        }

        // Confirm the deletion
        var confirmationMessage = "Are you sure you want to delete these " + selectedDatasets.length + " datasets?";
        var isConfirmed = confirm(confirmationMessage);

        if (isConfirmed) {
            // Perform the deletion via AJAX
            $.ajax({
                url: '<?= base_url('dataset/delete_selected_datasets'); ?>', // Controller's function
                type: 'POST',
                data: { setids: selectedDatasets },
                success: function (response) {
                    var result = JSON.parse(response);
                    if (result.type === 'success') {
                        toastr.success(result.message);
                        // Remove the deleted rows from the table
                        $('input[type="checkbox"]:checked').each(function () {
                            $(this).closest('tr').remove();
                        });
                    } else {
                        toastr.error(result.message);
                    }
                },
                error: function () {
                    toastr.error('Error deleting datasets.');
                }
            });
        }
    });

    // Individual Delete Button Click
    $('.delete-btn').on('click', function () {
        var datasetId = $(this).data('setid');

        // Confirm the deletion
        var confirmationMessage = "Are you sure you want to delete this dataset?";
        var isConfirmed = confirm(confirmationMessage);

        if (isConfirmed) {
            // Perform the deletion via AJAX
            $.ajax({
                url: '<?= base_url('dataset/delete_individual_dataset'); ?>', // Controller's function
                type: 'POST',
                data: { setid: datasetId },
                success: function (response) {
                    var result = JSON.parse(response);
                    if (result.type === 'success') {
                        toastr.success(result.message);
                        // Remove the deleted row from the table
                        $('#delete' + datasetId).closest('tr').remove();
                    } else {
                        toastr.error(result.message);
                    }
                },
                error: function () {
                    toastr.error('Error deleting dataset.');
                }
            });
        }
    });
});
function updateSN() {
    var sn = 1; // Start SN from 1
    $('#dataTable tbody tr').each(function() {
        $(this).find('.sn-placeholder').text(sn); // Update SN in the placeholder
        sn++; // Increment SN for next row
    });
}

</script>