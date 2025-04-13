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
  #dataTable_previous, #dataTable_next{
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    border: 1px solid #ddd;
    padding: 6px 12px;
    cursor: pointer;
    margin-right: 2.5px;
  }
</style>

<div id="content" class="col-lg-10 col-sm-10">

	<div>
		<ul class="breadcrumb">
			<li>
				<a href="<?= $admin_base_url; ?>">Home</a>
			</li>
			<li>
				<a href="#"><?= $title;?></a>
			</li>
		</ul>
	</div>
	<!-- <div class=" row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-list"></i> <?= $title;?></h2>

				</div>
				<div class="box-content">
					<div id="grid"></div>

				</div>
			</div>
		</div>
	</div> -->

  <div class=" row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="fa fa-list"></i> <?= $title;?> sdgfsdfsdf</h2>

            </div>
            <div class="box-content">
            <form id="cogsform">
            
                <div class="row">
                    <input type="hidden" id="toshow" name="toshow" value="<?=@$showclass;?>" />
                    <input type="hidden" id="levelid" name="levelid" value="<?=@$levelid;?>" />
                    <input type="hidden" id="qtype" name="qtype" value="<?=@$qtype;?>" />
                    <?php if($showclass=='Y'):?>
                
                    <div class="col-md-2">
                    <label>
                    Courses<sup style="color:red;">*</sup>

                    </label>
                    <select id="course" name="course" class="form-control" style="cursor:pointer;" >
                        <option value="1">School Courses</option>
                        <option value="2">University Courses</option>
                        <option value="3">Entrance Courses</option>
                        <option value="4">PBL Courses</option>
                        <option value="5">ICT Courses</option>
                        <option value="6">Aayog Courses</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Class<sup style="color:red;">*</sup>

                    </label>
                    <select id="course" name="course" class="form-control" style="cursor:pointer;" >
                    <option value='-1'>Please Select</option>
                    <?php foreach($class as $list):?>
                        <option value="<?=$list->classid;?>"><?=$list->name;?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Subject<sup style="color:red;">*</sup>

                    </label>
                    <select id="subject" name="subject" class="form-control" style="cursor:pointer;">
                    <option value='-1'>Please Select </option>
                    <?php foreach($subjects as $list):?>
                        <option value="<?=$list->subject_id;?>"><?=$list->subject_name;?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <?php endif;?>
                <?php if($qtype=='N')
                { ?>
                 <div class="col-md-2">
                <label>Exam Type<sup style="color:red;">*</sup>

                 </label>
                <select id="examtypeid" name="examtypeid" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <?php foreach($examtype as $ex): ?>
                      <option value="<?=$ex->examtypeid;?>"><?=$ex->examtypename;?></option>
                      <?php endforeach; ?>
                </select>
                </div>

               <?php } else { ?> 
                <div class="col-md-2">
                <label>Courses<sup style="color:red;">*</sup>

                 </label>
                <select id="course" name="course" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                    <option value="1">School Courses</option>
                    <option value="2">University Courses</option>
                    <option value="3">Entrance Courses</option>
                    <option value="4">PBL Courses</option>
                    <option value="5">ICT Courses</option>
                    <option value="6">Aayog Courses</option>
                </select>
                </div>
                <div class="col-md-2">
                <label>Class<sup style="color:red;">*</sup>

                 </label>
                <select id="class" name="class" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <?php foreach($classes as $list):?>
                    <option value="<?=$list->classid;?>"><?=$list->name;?></option>
                 <?php endforeach; ?>
                </select>
                </div>
                <div class="col-md-2">
                <label>
                    Subject
                 </label>
                <select id="subject" name="subject" class="form-control" style="cursor:pointer;">
                    <option value='-1'>Please Select </option>
                    <?php foreach($subjects as $list):?>
                        <option value="<?=$list->subject_id;?>"><?=$list->subject_name;?></option>
                    <?php endforeach; ?>
                </select>
                </div>
               <?php } ?>
               
                <!-- <div class="col-md-2">
                <label>Group<sup style="color:red;">*</sup>

                 </label>
                <select id="group" name="group" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <?php foreach($group as $list):?>
                    <option value="<?=$list->groupid;?>"><?=$list->groupname;?></option>
                 <?php endforeach; ?>
                </select>
                </div> -->

                <div class="col-md-2">
                <label>Migrate to Group (Only if needed to migrate)

                 </label>
                <select id="migrategroup" name="migrategroup" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <?php foreach($group as $list):?>
                    <option value="<?=$list->groupid;?>"><?=$list->groupname;?></option>
                 <?php endforeach; ?>
                </select>
                </div>
               
                
                <div class="col-md-8" style="margin-top:20px;">
                <button type="submit" id="btnsubmit" class="btn btn-primary">View</button>
                <button type="button" id="btnshowform" class="btn btn-success">Add</button>
                <button type="button" id="btndeleteselected" class="btn btn-warning">Delete Selected</button>
                </div>
               </div>
            </form>
               <br>
              
               <div class="container" id="tbl">
                    <?php $this->load->view('dataset/dataset-table', ['datasets' => $datasets]); ?>
               </div>
               

            </div>
        </div>
    </div>
</div>

	<!-- <!-- <script type="text/x-kendo-template" id="template">
		<a  class="btn btn-primary btn-sm "  href="<?= base_url(); ?>pages/add"><span class="fa fa-plus" data-toggle="tooltip" title="Add"></span>Add</a>
		<a id="edit" class="btn btn-primary btn-sm k-grid-edit"><span class="fa fa-edit" data-toggle="tooltip" title="Edit"></span>
			Edit</a>
		<a id="delete" class="btn btn-primary btn-sm k-grid-delete" data-toggle="tooltip" title="Delete"><span class="fa fa-times"></span>
			Delete</a>
		<!-- <a id="view" class="btn btn-primary btn-sm k-grid-view" data-toggle="tooltip" title="View"><span class="fa fa-eye"></span>
			View</a> -->
		<!-- <a id="refresh" class="btn btn-primary btn-sm k-grid-refresh" data-toggle="tooltip" title="Refresh"><span class="fa fa-refresh "></span>
			Refresh</a>
	</script> -->
	<!-- <?php $this->load->view('script/dataset_script.php'); ?>  -->
    <div class="modal fade" id="datasetmodal" srole="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document" style="height: 60vh; min-height: 550px; overflow-y:auto;">
			
			
				<div class="modal-content" style="min-height: 550px; overflow-y:auto;">
					<div class="modal-header">
						<h5 class="modal-title">Add Dataset</h5>
						<button type="button" class="close modalhide" data-toggle="modal-close"><span>×</span>
						</button>
					</div>
                    <div class="modal-body"  id="addbody">
					    <form id="addform" method="post">
                        
                        
                            <div class="row">

                                <div class="col-md-12">
                                    <label>Dataset Name</label><br/>
                                    <input type="text" name="add_setname" id="add_setname" value="" class="form-control"/> 
                                </div>
                                <div class="col-md-12">
                                    <label>Dataset Title</label><br/>
                                    <input type="text" name="add_title" id="add_title" value="" class="form-control"/> 
                                </div>
                                <div class="col-md-2">
                                    <label>Order</label><br/>
                                    <input type="number" name="add_order" id="add_order" min="1" value="" class="form-control"/> 
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-4">
                                <label>Time Period (in minutes)</label><br/>
                                <input type="number" name="add_time_period" id="add_time_period" min="1" value="" class="form-control"/>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>
                                        Guidelines for Dataset Creation:
                                    </h5>
                                    <label>Guideline 1:</label><br/>
                                    <input type="text" name="guideline[]" class="form-control mb-2" placeholder="Guideline 1" />
                                    <label>Guideline 2:</label><br/>
                                    <input type="text" name="guideline[]" class="form-control mb-2" placeholder="Guideline 2" />
                                    <label>Guideline 3:</label><br/>
                                    <input type="text" name="guideline[]" class="form-control mb-2" placeholder="Guideline 3" />

                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12" style="margin-top: 12px;">
                                <button type="button" class="btn btn-success" id="btnsubmit" onclick="submitdataset()">Submit</button>
                            </div>
                            </div>
                        </form>
                        
                    </div>
				
					
				</div>
		</div>
    </div>

    <script>
        $(document).ready(function () {
            $('#course').on('change', function () {
                var level_id = $(this).val();
                if (level_id != -1) {
                    $.ajax({
                        url: '<?= base_url(); ?>dataset/get_classes_by_level',
                        type: 'GET',
                        data: { level_id: level_id },
                        dataType: 'json',
                        success: function (response) {
                            $('#class').empty().append('<option value="-1">Please Select</option>');
                            $.each(response, function (index, item) {
                                $('#class').append(
                                    $('<option></option>').val(item.classid).text(item.name)
                                );
                            });
                        },
                        error: function () {
                            toastr.error('Error fetching class data.');
                        }
                    });
                } else {
                    $('#class').empty().append('<option value="-1">Please Select</option>');
                }
            });
            $('#class').on('change', function () {
                var class_id = $(this).val();
                if (class_id != -1) {
                    $.ajax({
                        url: '<?= base_url(); ?>dataset/get_subjects_by_class',
                        type: 'GET',
                        data: { class_id: class_id },
                        dataType: 'json',
                        success: function (response) {
                            $('#subject').empty().append('<option value="-1">Please Select</option>');
                            $.each(response, function (index, item) {
                                $('#subject').append(
                                    $('<option></option>').val(item.subject_id).text(item.subject_name)
                                );
                            });
                        },
                        error: function () {
                            toastr.error('Error fetching class data.');
                        }
                    });
                } else {
                    $('#subject').empty().append('<option value="-1">Please Select</option>');
                }
            });
            // $('#btnsubmit').on('click', function (e) {
            //     e.preventDefault();
            //     console.log('btnsubmit clicked');

            //     var class_id = $('#class').val();
            //     var subject_id = $('#subject').val();

            //     if (class_id == '-1' || subject_id == '-1') {
            //             alert('Please select both class and subject.');
            //             return;
            //     }

            //     var dataurl = '<?= base_url(); ?>dataset/datasetdata';

            //     // Create the table structure (if not already present in HTML)
            //     $('#tbl').html(`<table id="dataTable" class="table table-bordered table-striped" width="100%"><thead></thead><tbody></tbody></table>`);

            //     // Initialize DataTable
            //     $('#dataTable').DataTable({
            //             "destroy": true,
            //             "ajax": {
            //                     "type": "POST",
            //                     "url": dataurl,
            //                     "data": { classid: class_id, subjectid: subject_id }
            //             },
            //             "language": {
            //                     "emptyTable": "<p class='no_data_message'>No Content in a List</p>"
            //             },
            //             // "fnCreatedRow": function (nRow, aData, iDataIndex) {
            //             //         $(nRow).attr('id', 'ch' + aData.chid);
            //             // },
            //             "columnDefs": [
            //                     { orderable: false, targets: 0 }
            //             ],
            //             "order": [[1, "asc"]], // Explicitly set initial sorting to the second column
            //             "columns": [
            //                     { "data": "sn", "title": "S.N." },
            //                     { "data": "name", "title": "Name" },
            //                     { "data": "title", "title": "Title" },
            //                     { "data": "order", "title": "Order" },
            //                     { "data": "action", "title": "Action" }
            //             ]
            //     });
            // });
            // $( "#cogsform" ).submit(function( event ) {
     
            //     event.preventDefault();
            //     var class_id = $("#class").val();
            //     var subject_id = $("#subject").val();
            //     if (class_id === "-1" || subject_id === "-1") {
            //         toastr.error("Please select both class and subject.");
            //         return;
            //     }

            //     var dataurl = "<?= base_url(); ?>dataset/datasetdata";
            //     // Recreate the table HTML before initializing DataTable
            //     $.ajax({
            //         url: '<?= base_url(); ?>dataset/datasetdata',
            //         type: 'POST',
            //         data: $( "#cogsform" ).serialize(),
            //         beforeSend: function () {
            //             $('#loader').show();
            //         },
            //         success: function (res) {
            //             $('#loader').hide();
            //             let response=jQuery.parseJSON(res);
            //             if (response.type == 'success') {
            //                     $('#tbl').html(response.html);
            //                     $('#dataTable').DataTable({"ordering": false});
                        
                                
            //             } else {
            //                     $('#tbl').empty();
            //                     toastr.error(response.message, {timeOut: 5000})
                        
            //             }
            //         },
            //         error: function () {
            //             $('#loader').hide();
            //             toastr.error("Something went wrong.");
            //         }

            //     });

            // });
            var dataTable = $('#dataTable').DataTable({
                "processing": true,
                "serverSide": true,  // Enable server-side processing if needed
                "ajax": {
                    "url": "<?= base_url(); ?>dataset/datasetdata", // Use your actual URL here
                    "type": "POST",
                    "data": function(d) {
                        // You can send the current form data (class_id, subject_id) when the DataTable is loaded
                        d.class_id = $('#class').val();
                        d.subject_id = $('#subject').val();
                    }
                },
                "pageLength": 10,  // Default number of rows per page
                "lengthMenu": [10, 25, 50, 100],  // Dropdown options for the number of rows per page
                "order": [[0, 'asc']],  // Order the table by first column by default
                "language": {
                    "emptyTable": "No datasets found"
                },
                "responsive": true
            });

            // $("#cogsform").submit(function(event) {
            //     event.preventDefault();

            //     var class_id = $("#class").val();
            //     var subject_id = $("#subject").val();

            //     // Check if both class and subject are selected
            //     if (class_id === "-1" || subject_id === "-1") {
            //         toastr.error("Please select both class and subject.");
            //         return;
            //     }

            //     var dataurl = "<?= base_url(); ?>dataset/datasetdata"; // Your URL to fetch data

            //     // Show loader before making the AJAX call
            //     $.ajax({
            //         url: dataurl,
            //         type: 'POST',
            //         data: $("#cogsform").serialize(),  // Serialize form data for the POST request
            //         beforeSend: function() {
            //             $('#loader').show();  // Show loader during the AJAX request
            //         },
            //         success: function(res) {
            //             $('#loader').hide();  // Hide loader after the response
            //             let response = jQuery.parseJSON(res);

            //             // If the request was successful, update the table content
            //             if (response.type == 'success') {
            //                 $('#tbl').html(response.html);  // Replace the table body with new data

            //                 // Reinitialize DataTable after updating the table
            //                 var table = $('#dataTable').DataTable({
            //                     "ordering": false,  // Disable sorting if necessary
            //                     "pageLength": 10,   // Default rows per page
            //                     "lengthMenu": [10, 25, 50, 100],  // Options for entries per page
            //                     "order": [[0, 'asc']],  // Default ordering
            //                     "language": {
            //                         "emptyTable": "No datasets found"
            //                     },
            //                     "responsive": true,
            //                     "searching": true  // Enable search functionality
            //                 });

            //                 // Handle dynamic search filtering
            //                 $('#dataTable_filter input').on('keyup', function() {
            //                     table.search(this.value).draw();
            //                 });

            //                 // Optionally, handle page-length change (number of rows per page)
            //                 $('#dataTable_length select').on('change', function() {
            //                     var pageLength = $(this).val();
            //                     table.page.len(pageLength).draw();
            //                 });
            //             } else {
            //                 // Handle errors if no datasets are found or another error occurs
            //                 $('#tbl').empty();
            //                 toastr.error(response.message, { timeOut: 5000 });
            //             }
            //         },
            //         error: function() {
            //             $('#loader').hide();  // Hide loader in case of error
            //             toastr.error("Something went wrong.");  // Show error message
            //         }
            //     });
            // });
            $("#cogsform").submit(function(event) {
                event.preventDefault();

                var class_id = $("#class").val();
                var subject_id = $("#subject").val();

                // Check if both class and subject are selected
                if (class_id === "-1" || subject_id === "-1") {
                    toastr.error("Please select both class and subject.");
                    return;
                }

                var dataurl = "<?= base_url(); ?>dataset/datasetdata"; // Your URL to fetch data

                // Show loader before making the AJAX call
                $.ajax({
                    url: dataurl,
                    type: 'POST',
                    data: $("#cogsform").serialize(),  // Serialize form data for the POST request
                    beforeSend: function() {
                        $('#loader').show();  // Show loader during the AJAX request
                    },
                    success: function(res) {
                        $('#loader').hide();  // Hide loader after the response
                        let response = jQuery.parseJSON(res);

                        // If the request was successful, update the table content
                        if (response.type == 'success') {
                            $('#tbl').html(response.html);  // Replace the table body with new data

                            // Reinitialize DataTable after updating the table
                            var table = $('#dataTable').DataTable({
                                "ordering": false,  // Disable sorting if necessary
                                "pageLength": 10,   // Default rows per page
                                "lengthMenu": [10, 25, 50, 100],  // Options for entries per page
                                "order": [[0, 'asc']],  // Default ordering
                                "language": {
                                    "emptyTable": "No datasets found"
                                },
                                "responsive": true,
                                "searching": true  // Enable search functionality
                            });

                            // Handle dynamic search filtering
                            $('#dataTable_filter input').on('keyup', function() {
                                table.search(this.value).draw();
                            });

                            // Optionally, handle page-length change (number of rows per page)
                            $('#dataTable_length select').on('change', function() {
                                var pageLength = $(this).val();
                                table.page.len(pageLength).draw();
                            });

                            // Update Serial Numbers (SN)
                            updateSN();
                        } else {
                            // Handle errors if no datasets are found or another error occurs
                            $('#tbl').empty();
                            toastr.error(response.message, { timeOut: 5000 });
                        }
                    },
                    error: function() {
                        $('#loader').hide();  // Hide loader in case of error
                        toastr.error("Something went wrong.");  // Show error message
                    }
                });
            });

            // Function to update SN values in the table after AJAX call
            function updateSN() {
                var sn = 1; // Start SN from 1
                $('#dataTable tbody tr').each(function() {
                    $(this).find('.sn-placeholder').text(sn); // Update SN in the placeholder
                    sn++; // Increment SN for next row
                });
            }
            updateSN(); // Initial call to set SN on page load


        });
        $('#btnshowform').click(function(e){
            let courseid=$('#course').val();
            let classid=$('#class').val();
            let subject=$('#subject').val();
            if(parseInt(classid)<'1' && parseInt(subject)<'1' && parseInt(courseid)<'1')
            {
                toastr.error('Please Select Course, Class and Subject', {timeOut: 5000});
                return false;

            }
            $('#chaptername').val('');
            $('#chapterid').val('0');
            $('.modal-title').html('Add Dataset');

            $('#datasetmodal').modal('show');

        });
        
        $('.modalhide').click(function(){
            $('#datasetmodal').modal('hide');
        });
        function submitdataset() {
            const setnameEl = document.getElementById('add_setname');
            const titleEl = document.getElementById('add_title');
            const orderEl = document.getElementById('add_order');
            const timeEl = document.getElementById('add_time_period');

            console.log("Setname element: ", setnameEl);
            console.log("Title element: ", titleEl);
            console.log("Order element: ", orderEl);
            console.log("Time element: ", timeEl);

            console.log("Setname value: ", setnameEl?.value);
            console.log("Title value: ", titleEl?.value);
            console.log("Order value: ", orderEl?.value);
            console.log("Time value: ", timeEl?.value);

            const guidelines = $("input[name='guideline[]']")
                .map(function () {
                    return $(this).val().trim();
                })
                .get();
            const guidelineText = guidelines.join("\n");

            const timePeriod = $('#add_time_period').val().trim(); // Get the time_period value

            // Log for debugging
            console.log("Guidelines: ", guidelineText);
            console.log("Time Period: ", timePeriod);

            // Prepare data to send in the AJAX request
            const data = {
                course: $('#course').val(),
                class: $('#class').val(),
                subject: $('#subject').val(),
                add_setname: $('#add_setname').val(),
                add_title: $('#add_title').val(),
                add_order: $('#add_order').val(),
                add_time_period: timePeriod, // Add time_period to data
                guideline: guidelineText, // Convert the guidelines array to JSON
            };

            $.ajax({
                url: "<?= base_url('dataset/save_dataset') ?>",
                type: "POST",
                data: data,
                dataType: "json",
                success: function (response) {
                    if (response.status == 'success') {
                        alert('Dataset saved successfully!');
                        $('#datasetmodal').modal('hide');
                        // Optionally reload the list
                    } else {
                        alert(response.message || 'Something went wrong.');
                    }
                },
                error: function () {
                    alert('Error occurred while saving the dataset.');
                }
            });
        }


    </script>