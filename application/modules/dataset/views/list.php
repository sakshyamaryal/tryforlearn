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
            $( "#cogsform" ).submit(function( event ) {
     
                event.preventDefault();
                var class_id = $("#class").val();
                var subject_id = $("#subject").val();
                if (class_id === "-1" || subject_id === "-1") {
                    toastr.error("Please select both class and subject.");
                    return;
                }

                var dataurl = "<?= base_url(); ?>dataset/datasetdata";
                    // Recreate the table HTML before initializing DataTable
                $("#tbl").html(`
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
                $.ajax({
                    url: '<?= base_url(); ?>dataset/datasetdata',
                    type: 'POST',
                    data: $( "#cogsform" ).serialize(),
                    beforeSend: function () {
                                    $('#loader').show();
                                },
                    success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
                            if (response.type == 'success') {
                                $('#tbl').empty();
                                $('#tbl').html(response.html);
                            
                                
                            } else {
                                $('#tbl').empty();
                                toastr.error(response.message, {timeOut: 5000})
                            
                            }
                    }

                });

            });
        });
    </script>