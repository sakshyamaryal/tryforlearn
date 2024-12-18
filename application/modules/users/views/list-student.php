<div id="content" class="col-lg-10 col-sm-10">

	<div>
		<ul class="breadcrumb">
			<li>
				<a href="<?= $admin_base_url; ?>">Home</a>
			</li>
			<li>
				<a href="#"><?= $title; ?></a>
			</li>
		</ul>
	</div>
	<div class=" row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-list"></i> <?= $title; ?></h2>

				</div>
				<div class="box-content">

					<div id="grid"></div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="addUser" srole="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<form action="<?php echo base_url(); ?>users/subscribe" id="addUs" method="post" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Subscribe Student</h5>
						<button type="button" class="close" data-toggle="modal-close"><span>×</span>
						</button>
					</div>
					<div class="modal-body">


						<input type="hidden" name="userId" id="userId">

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Select Course Type</label>
									<div>
									<select id="class" name="class" class="form-control" style="cursor:pointer;" >
								<option value='-1'>Please Select </option>

									<?php foreach($level as $list):?>
										<option value="<?=$list->level_id;?>"><?=$list->name;?></option>
									<?php endforeach; ?>
									</select>
									</div>
								</div>

							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Class</label>
									<div>
									<select id="classid" name="classid" class="form-control" style="cursor:pointer;">
									<option value='-1'>Please Select </option>
									</select>		
								</div>

								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Subject</label>
									<div>
									<select id="subjectid" name="subjectid" class="form-control" style="cursor:pointer;">
									<option value='-1'>Please Select </option>
									</select>		
								</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Package Type</label>
									<div>
									<select id="package" name="package" class="form-control" style="cursor:pointer;">
									<option value='-1'>Please Select </option>
									</select>		
								</div>

								</div>
							</div>
							<div class="col-md-12">
							<div class="form-group">
							<label>Remarks</label>
							 <div>
							<textarea class="form-control" id="remarks" name="remarks"></textarea>
							</div>
							</div>	
							</div>

						
						
						</div>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary close" data-toggle="modal-close">
							<i class="fa fa-close"></i> Close
						</button>
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>



	   <!-- STUDENT DETAIL -->
	   <div class="modal fade" id="detailmodal" srole="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Student Detail</h5>
						<button type="button" class="close" data-toggle="modal-close"><span>×</span>
						</button>
					</div>
					<div class="modal-body">

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Full Name</label>
									<div>
									<p id="viewname"></p>
									</div>
								</div>

							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Adress</label>
									<div>
									<p id="viewaddress"></p>

									</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Phone</label>
									<div>
									<p id="viewphone"></p>

									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Email</label>
									<div>
									<p id="viewemail"></p>

	
								</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Username</label>
									<div>
									<p id="viewusername"></p>

	
								</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Preffered Language</label>
									<div>
									<p id="viewlanguage"></p>

	
								</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Guardian Detail</label>
									<div>
									<p id="viewguardian"></p>

	
								</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Guardian Number</label>
									<div>
									<p id="viewguardiannumber"></p>

	
								</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Institution Detail</label>
									<div>
									<p id="viewinstitution"></p>

	
								</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Institution Number</label>
									<div>
									<p id="viewinstitutionnumber"></p>

	
								</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Student Image</label>
									<div>
                                     <img id="viewimage" src="" style="width:40%;height:20%"  >
	
								</div>

								</div>
							</div>
						
						</div>
						<div class="row">
							<div class="col-md-3">
									<div class="form-group">
										<label>Student Differently Abeled</label>
										<div>
											<p id="is_differently_abled"></p>
											
										</div>

									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Document</label>
										<div>
											<a id="document" href="">View Documents</a>
											
										</div>

									</div>
								</div>
								

							</div>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary close" data-toggle="modal-close">
							<i class="fa fa-close"></i> Close
						</button>
					</div>
				</div>
		</div>
	</div>

	<script type="text/x-kendo-template" id="template">
	<a id="viewdetail" class="btn btn-primary btn-sm " data-toggle="tooltip" title="View Detail">
			View Detail</a>
		<a id="refresh" class="btn btn-primary btn-sm k-grid-refresh" data-toggle="tooltip" title="Refresh"><span class="fa fa-refresh "></span>
			Refresh</a>
	
		<a id="approve" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Approve">
			<span class="fa fa-check-circle"></span>
			Approve</a>
		<a id="subscribe" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Subscribe Paid Course">
			<span class="fa fa-check-circle"></span>
			Subscribe</a>
			<a id="delete" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete">
			<span class="fa fa-trash-circle"></span>
			Delete</a>
			<a id="save" class="btn btn-primary btn-sm k-grid-cancel-changes" data-toggle="tooltip" title="Cancel Changes"><span class="fa fa-ban "></span>
			Cancel Changes</a>
	</script>


	<?php $this->load->view('script/student_script.php'); ?>
