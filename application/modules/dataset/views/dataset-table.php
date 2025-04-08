<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/theme-style2.css">


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
  </tbody>
</table>

<script>
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

</script>

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