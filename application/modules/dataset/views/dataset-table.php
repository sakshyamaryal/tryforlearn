<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/theme-style2.css">

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.9/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.9/dist/sweetalert2.min.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

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
      <th style="text-align:center;">Time Period(m)</th>
      <th style="text-align:center;">Guidelines</th>
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
                <td><?= $row->time_period; ?> min</td>
                <td>
                  <ul style="padding-left: 18px; margin: 0;">
                    <?php
                      // Split the guideline string by newline (\n)
                      $guidelines = explode("\n", $row->guideline);
                      if (!empty($guidelines)) {
                        foreach ($guidelines as $g) {
                          echo '<li>' . htmlspecialchars(trim($g)) . '</li>';
                        }
                      }
                    ?>
                  </ul>
                </td>
                <td>
                    <button id="view<?= $row->setid; ?>" class="view-dataset-detail-btn" style="padding:0; border:none; background-color:transparent;"><i class="fa fa-eye" title="View" aria-hidden="true"></i></button>
                    <button id="edit<?= $row->setid; ?>" class="edit-btn" style="padding:0; border:none; background-color:transparent;"><i class="fa fa-edit" title="Edit" aria-hidden="true"></i></button>
                    <button id="delete<?= $row->setid; ?>" style="padding:0; border:none; background-color:transparent;" class="delete-btn" data-setid="<?= $row->setid; ?>">
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
<div class="modal fade" id="viewdatasetmodal" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="height: 60vh; min-height: 550px; overflow-y:auto;">
        <div class="modal-content" style="min-height: 550px; overflow-y:auto;">
            <div class="modal-header">
                <h5 class="modal-title">View Dataset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="addbody">
                <form id="viewform" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Dataset Name</label><br/>
                            <p id="setname"></p> <!-- Display dataset name here -->
                        </div>
                        <div class="col-md-12">
                            <label>Dataset Title</label><br/>
                            <p id="title"></p> <!-- Display dataset title here -->
                        </div>
                        <div class="col-md-6">
                            <label>Order</label><br/>
                            <p id="order"></p> <!-- Display order here -->
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-6">
                        <label>Time Period (in minutes)</label><br/>
                        <p id="time_period"></p> <!-- Display time period here -->
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <h5>Guidelines for Dataset Creation:</h5>
                            <ul id="guidelines-list">
                            </ul>
                        </div>
                    </div> -->
                    <!-- <div class="row mt-4">
                      <div class="col-md-12">
                          <h5>Questions in this Dataset:</h5>
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>SN</th>
                                      <th>Question</th>
                                      <th>Subject</th>
                                      <th>Class</th>
                                  </tr>
                              </thead>
                              <tbody id="dataset-question-table">
                              </tbody>
                          </table>
                      </div>
                    </div> -->
    <br>
                    <div class="row mt-4">
                            <button type="button" id="viewQuestionsBtn" class="btn btn-info" style="margin-left: 16px;">View Questions</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewquestionsmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="height: 80vh; min-height: 550px; overflow-y:auto; width:90%">
        <div class="modal-content" style="min-height: 550px; overflow-y:auto;height: 80vh;">
            <div class="modal-header">
                <h5 class="modal-title">Questions in Dataset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Question</th>
                            <th>Subject</th>
                            <th>Class</th>
                        </tr>
                    </thead>
                    <tbody id="view-dataset-question-table">
                        <!-- Questions will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- <div class="modal fade" id="editdatasetmodal" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="height: 60vh; min-height: 550px; overflow-y:auto;">
        <div class="modal-content" style="min-height: 550px; overflow-y:auto;">
            <div class="modal-header">
                <h5 class="modal-title">Edit Dataset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="addbody">
                <form id="editform" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Dataset Name</label><br/>
                            <input type="text" name="edit-setname" id="editsetname" class="form-control"/> 
                        </div>
                        <div class="col-md-12">
                            <label>Dataset Title</label><br/>
                            <input type="text" name="edit-title" id="edittitle" class="form-control"/> 
                        </div>
                        <div class="col-md-2">
                            <label>Order</label><br/>
                            <input type="number" name="edit-order" id="editorder" min="1" class="form-control"/> 
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-4">
                        <label>Time Period (in minutes)</label><br/>
                        <input type="number" name="edit-time_period" id="edittime_period" min="1" class="form-control"/>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Guidelines for Dataset Creation:</h5>
                            <ul name="edit-guidelines-list" id="edit-guidelines-list">
                            </ul>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div> -->
<div class="modal fade" id="editdatasetmodal" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="height: 60vh; min-height: 550px; overflow-y:auto;">
        <div class="modal-content" style="min-height: 550px; overflow-y:auto;">
            <div class="modal-header">
                <h5 class="modal-title">Edit Dataset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="addbody">
                <form id="editform" method="post">
                    <input type="hidden" name="setid" id="editsetid">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Dataset Name</label><br/>
                            <input type="text" name="edit-setname" id="editsetname" class="form-control"/> 
                        </div>
                        <div class="col-md-12">
                            <label>Dataset Title</label><br/>
                            <input type="text" name="edit-title" id="edittitle" class="form-control"/> 
                        </div>
                        <div class="col-md-2">
                            <label>Order</label><br/>
                            <input type="number" name="edit-order" id="editorder" min="1" class="form-control"/> 
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-md-4">
                        <label>Time Period (in minutes)</label><br/>
                        <input type="number" name="edit-time_period" id="edittime_period" min="1" class="form-control"/>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Guidelines for Dataset Creation:</h5>
                            <ul id="edit-guidelines-list">
                                <!-- Input fields will be dynamically added here -->
                            </ul>
                        </div>
                    </div>
                    <div class="row my-3">
                          <button type="button" id="removeQuestionsBtn" class="btn btn-danger" style="margin-top: 26px;margin-bottom:12px;margin-left: 16px;">Remove Questions</button>
                  </div>


                    <div class="row">
                    <button type="submit" class="btn btn-primary" style="margin-left: 16px;">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="removequestionsmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="height: 80vh; width:90%; min-height: 550px; overflow-y:auto;">
        <div class="modal-content" style="min-height: 550px; overflow-y:auto; height:80vh;">
            <div class="modal-header">
                <h5 class="modal-title">Remove Questions from Dataset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Question</th>
                            <th>Subject</th>
                            <th>Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="remove-dataset-question-table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



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
//   $(document).ready(function () {
//     // View button click event
//     $('.view-dataset-detail-btn').on('click', function () {
//         var setId = $(this).attr('id').replace('view', ''); // Extract dataset ID from button ID
//         if (!setId) {
//             console.error('Invalid set ID');
//             return;
//         }
//         console.log("function called")
        
//         // Make AJAX request to fetch dataset details by ID
//         $.ajax({
//             url: "<?= base_url('dataset/get_dataset_details') ?>", // Update with your actual URL to get dataset details
//             type: "GET",
//             data: { setid: setId },  // Pass the setid to the controller
//             dataType: "json",
//             success: function (response) {
//                 console.log(response)
//                 if (response.status === 'success') {
//                     // Fill the modal fields with the dataset details
//                     var dataset = response.data;
//                     console.log(dataset)

//                     // Split the guidelines string into an array based on newline (\n)
//                     var guidelines = dataset.guideline ? dataset.guideline.split('\n') : [];
//                     console.log(guidelines)

//                     // Populate the modal fields
//                     $('#setname').text(dataset.setname);  // Display dataset name
//                     $('#title').text(dataset.title);      // Display dataset title
//                     $('#order').text(dataset.order);      // Display order
//                     $('#time_period').text(dataset.time_period);  // Display time period

//                     // Clear the previous guidelines and populate the new ones
//                     $('#guidelines-list').empty(); // Clear previous list items
//                     guidelines.forEach(function (guideline, index) {
//                         $('#guidelines-list').append('<li>' + guideline + '</li>'); // Add each guideline as a list item
//                     });

//                     $('#dataset-question-table').empty();
//                       response.questions.forEach((row, index) => {
//                           $('#dataset-question-table').append(`
//                               <tr>
//                                   <td>${index + 1}</td>
//                                   <td>${row.question}</td>
//                                   <td>${row.subject_name}</td>
//                                   <td>${row.class_name}</td>
//                               </tr>
//                           `);
//                       });

//                     // Show the modal
//                     $('#viewdatasetmodal').modal('show');
//                 } else {
//                     alert('Error fetching dataset details.');
//                 }
//             },
//             error: function () {
//                 alert('Error occurred while fetching dataset details.');
//             }
//         });
//     });
//   });

$(document).ready(function() {
    // Store questions globally when fetching dataset details
    var viewQuestions = [];

    // When opening viewdatasetmodal, store questions
    $(document).on('click', '.view-dataset-detail-btn', function () {
        var setId = $(this).attr('id').replace('view', '');
        if (!setId) {
            console.error('Invalid set ID');
            return;
        }

        $.ajax({
            url: "<?= base_url('dataset/get_dataset_details') ?>",
            type: "GET",
            data: { setid: setId },
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    var dataset = response.data;

                    $('#setname').text(dataset.setname);
                    $('#title').text(dataset.title);
                    $('#order').text(dataset.order);
                    $('#time_period').text(dataset.time_period);

                    $('#guidelines-list').empty();
                    var guidelines = dataset.guideline ? dataset.guideline.split('\n') : [];
                    guidelines.forEach(function (g) {
                        $('#guidelines-list').append('<li>' + g + '</li>');
                    });

                    // Store questions for later when clicking View Questions
                    viewQuestions = response.questions || [];

                    $('#viewdatasetmodal').modal('show');
                } else {
                    alert('Error fetching dataset details.');
                }
            },
            error: function () {
                alert('Error occurred while fetching dataset details.');
            }
        });
    });

    // When View Questions button clicked
    $('#viewQuestionsBtn').on('click', function() {
        $('#view-dataset-question-table').empty();

        if (viewQuestions.length > 0) {
            viewQuestions.forEach(function(q, index) {
                $('#view-dataset-question-table').append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${q.question}</td>
                        <td>${q.subject_name}</td>
                        <td>${q.class_name}</td>
                    </tr>
                `);
            });
        } else {
            $('#view-dataset-question-table').append('<tr><td colspan="4" class="text-center">No questions found.</td></tr>');
        }

        $('#viewquestionsmodal').modal('show');
    });
});

  //this
//   $(document).ready(function () {
//     // Handle edit button click
//     $(document).on('click', '.edit-btn', function () {
//         var setId = $(this).attr('id').replace('edit', '');
//         if (!setId) {
//             console.error('Invalid set ID');
//             return;
//         }

//         console.log("Edit function called");

//         $.ajax({
//             url: "<?= base_url('dataset/get_dataset_details') ?>",
//             type: "GET",
//             data: { setid: setId },
//             dataType: "json",
//             success: function (response) {
//                 console.log(response);
//                 if (response.status === 'success') {
//                     var dataset = response.data;

//                     var guidelines = dataset.guideline ? dataset.guideline.split('\n') : [];

//                     $('#editsetid').val(dataset.setid);
//                     $('#editsetname').val(dataset.setname);
//                     $('#edittitle').val(dataset.title);
//                     $('#editorder').val(dataset.order);
//                     $('#edittime_period').val(dataset.time_period);

//                     $('#edit-guidelines-list').empty();
//                     for (var i = 0; i < 3; i++) {
//                         var guideline = guidelines[i] || '';
//                         $('#edit-guidelines-list').append(
//                             '<li><input type="text" class="form-control mb-2" name="guideline[]" value="' + guideline + '"/></li>'
//                         );
//                     }

//                     // Clear and populate the question table
//                     $('#remove-dataset-question-table').empty();
//                     if (response.questions && response.questions.length > 0) {
//                         response.questions.forEach((row, index) => {
//                             $('#remove-dataset-question-table').append(`
//                                 <tr data-eid="${row.eid}">
//                                     <td>${index + 1}</td>
//                                     <td>${row.question}</td>
//                                     <td>${row.subject_name}</td>
//                                     <td>${row.class_name}</td>
//                                     <td>
//                                         <button type="button" class="btn btn-danger btn-sm remove-question-btn" data-eid="${row.eid}" data-setid="${row.setid}">
//                                             Remove
//                                         </button>
//                                     </td>
//                                 </tr>
//                             `);
//                         });
//                     } else {
//                         $('#remove-dataset-question-table').append('<tr><td colspan="5" class="text-center">No questions found.</td></tr>');
//                     }

//                     $('#editdatasetmodal').modal('show');
//                 } else {
//                     alert('Error fetching dataset details. Rojesh');
//                 }
//             },
//             error: function () {
//                 alert('Error occurred while fetching dataset details.');
//             }
//         });
//     });

//     // Submit update form
//     $('#editform').submit(function (e) {
//         e.preventDefault();

//         var formData = $(this).serialize();

//         $.ajax({
//             url: "<?= base_url('dataset/update_dataset') ?>",
//             type: "POST",
//             data: formData,
//             dataType: "json",
//             success: function (response) {
//                 if (response.status === 'success') {
//                     alert('Dataset updated successfully');
//                     $('#editdatasetmodal').modal('hide');
//                     location.reload(); // Optional: reload the dataset list
//                 } else {
//                     alert('Error updating dataset.');
//                 }
//             },
//             error: function () {
//                 alert('Error occurred while updating dataset.');
//             }
//         });
//     });
//   });

//   $(document).ready(function() {
//     // Open remove questions modal and populate the table
//     $('#removeQuestionsBtn').on('click', function() {
//         // Clear previous questions in the remove questions modal
//         $('#remove-dataset-question-table').empty();

//         // Get the questions data from the edit dataset modal
//         var questions = []; // Initialize an empty array

//         // Iterate over the table rows in the edit modal to get questions
//         $('#remove-dataset-question-table tr').each(function(index) {
//             var question = $(this).find('td:eq(1)').text();
//             var subject = $(this).find('td:eq(2)').text();
//             var className = $(this).find('td:eq(3)').text();
//             var eid = $(this).data('eid');
//             var setid = $('#editsetid').val();

//             // Push the row data into the questions array
//             questions.push({
//                 eid: eid,
//                 question: question,
//                 subject: subject,
//                 className: className
//             });
//         });

//         // Populate the remove questions modal with data
//         questions.forEach(function(q, index) {
//             $('#remove-dataset-question-table').append(
//                 `<tr data-eid="${q.eid}">
//                     <td>${index + 1}</td>
//                     <td>${q.question}</td>
//                     <td>${q.subject}</td>
//                     <td>${q.className}</td>
//                     <td>
//                         <button type="button" class="btn btn-danger btn-sm remove-question-btn" data-eid="${q.eid}" data-setid="${setid}">Remove</button>
//                     </td>
//                 </tr>`
//             );
//         });

//         // Show the modal
//         $('#removequestionsmodal').modal('show');
//     });
//   });

    $(document).ready(function () {
        var loadedQuestions = []; // Store the loaded questions globally

        // Handle edit button click
        $(document).on('click', '.edit-btn', function () {
            var setId = $(this).attr('id').replace('edit', '');
            if (!setId) {
                console.error('Invalid set ID');
                return;
            }

            console.log("Edit function called");

            $.ajax({
                url: "<?= base_url('dataset/get_dataset_details') ?>",
                type: "GET",
                data: { setid: setId },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.status === 'success') {
                        var dataset = response.data;

                        var guidelines = dataset.guideline ? dataset.guideline.split('\n') : [];

                        $('#editsetid').val(dataset.setid);
                        $('#editsetname').val(dataset.setname);
                        $('#edittitle').val(dataset.title);
                        $('#editorder').val(dataset.order);
                        $('#edittime_period').val(dataset.time_period);

                        $('#edit-guidelines-list').empty();
                        for (var i = 0; i < 3; i++) {
                            var guideline = guidelines[i] || '';
                            $('#edit-guidelines-list').append(
                                '<li><input type="text" class="form-control mb-2" name="guideline[]" value="' + guideline + '"/></li>'
                            );
                        }

                        // Store questions into the global array
                        loadedQuestions = response.questions || [];

                        $('#editdatasetmodal').modal('show');
                    } else {
                        alert('Error fetching dataset details.');
                    }
                },
                error: function () {
                    alert('Error occurred while fetching dataset details.');
                }
            });
        });

        // Submit update form
        $('#editform').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "<?= base_url('dataset/update_dataset') ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Dataset updated successfully');
                        $('#editdatasetmodal').modal('hide');
                        location.reload(); // Reload dataset list
                    } else {
                        alert('Error updating dataset.');
                    }
                },
                error: function () {
                    alert('Error occurred while updating dataset.');
                }
            });
        });

        // Handle Remove Questions Button
        $('#removeQuestionsBtn').on('click', function() {
            // Clear previous questions in the remove questions modal
            $('#remove-dataset-question-table').empty();

            var setid = $('#editsetid').val();

            if (loadedQuestions.length > 0) {
                loadedQuestions.forEach(function(row, index) {
                    $('#remove-dataset-question-table').append(`
                        <tr data-eid="${row.eid}">
                            <td>${index + 1}</td>
                            <td>${row.question}</td>
                            <td>${row.subject_name}</td>
                            <td>${row.class_name}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-question-btn" data-eid="${row.eid}" data-setid="${setid}">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    `);
                });
            } else {
                $('#remove-dataset-question-table').append('<tr><td colspan="5" class="text-center">No questions found.</td></tr>');
            }

            $('#removequestionsmodal').modal('show');
        });
    });

  $(document).on('click', '.remove-question-btn', function (e) {
    e.preventDefault();
      const eid = $(this).data('eid');
      const setid = $(this).data('setid');
      const row = $(this).closest('tr');

      if (confirm('Are you sure you want to remove this question from the dataset?')) {
          $.ajax({
              url: "<?= base_url('dataset/remove_question_from_dataset') ?>",
              type: "POST",
              data: { eid, setid },
              dataType: "json",
              success: function (res) {
                  if (res.status === 'success') {
                      row.remove(); // Remove the row from the table
                  } else {
                      alert('Failed to remove question.');
                  }
              },
              error: function () {
                  alert('An error occurred while removing the question.');
              }
          });
      }
  });

  // $(document).ready(function() {
  //   $('#removeQuestionsBtn').on('click', function() {
  //       // First, clear previous questions
  //       $('#remove-dataset-question-table').empty();
  //       var ques = [];

  //       // Get all current questions from edit modal table
  //       $('#remove-dataset-question-table tr').each(function(index) {
  //           var question = $(this).find('td:eq(1)').text();
  //           var subject = $(this).find('td:eq(2)').text();
  //           var className = $(this).find('td:eq(3)').text();
  //           var eid = $(this).data('eid');
  //           var setid = $('#editsetid').val();

  //           questions.push({
  //               eid: eid,
  //               question: question,
  //               subject: subject,
  //               className: className
  //           });

  //           $('#remove-dataset-question-table').append(`
  //               <tr data-eid="${eid}">
  //                   <td>${index + 1}</td>
  //                   <td>${question}</td>
  //                   <td>${subject}</td>
  //                   <td>${className}</td>
  //                   <td>
  //                       <button type="button" class="btn btn-danger btn-sm remove-question-btn" data-eid="${eid}" data-setid="${setid}">Remove</button>
  //                   </td>
  //               </tr>
  //           `);
  //       });

  //       // Open the Remove Questions modal
  //       $('#removequestionsmodal').modal('show');
  //   });
  // });






  function updateSN() {
    $('#remove-dataset-question-table tr').each(function (index) {
        $(this).find('td:first').text(index + 1);
    });
  }

  $(document).on('click', '.remove-question-btn', function () {
        $(this).closest('tr').remove();
        updateSN();
    });

</script>