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


	<div class="modal fade" id="addLevel" srole="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<form action="<?php echo base_url(); ?>level/add" id="addUs" method="post" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"></h5>
						<button type="button" class="close" data-toggle="modal-close"><span>×</span>
						</button>
					</div>
					<div class="modal-body">


						<input type="hidden" name="level_id" id="level_id">

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label> Name</label>
									<div>
										<input type="text" class="form-control " placeholder="Level Name " name="name" id="name">
									</div>
								</div>

							</div>
							<div class="col-md-9">
								<div class="form-group">
									<label>Description</label>
									<div>
									<textarea name="description" id="description" style="width:100%"></textarea>
									</div>

								</div>
							</div>

							

						
						</div>

					


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-toggle="modal-close">
							<i class="fa fa-close"></i> Close
						</button>
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script type="text/x-kendo-template" id="template">
		<a id="add" class="btn btn-primary btn-sm "><span class="fa fa-plus" data-toggle="tooltip" title="Add"></span>Add</a>
		<a id="edit" class="btn btn-primary btn-sm k-grid-edit"><span class="fa fa-edit" data-toggle="tooltip" title="Edit"></span>
			Edit</a>
		<a id="delete" class="btn btn-primary btn-sm k-grid-delete" data-toggle="tooltip" title="Delete"><span class="fa fa-times"></span>
			Delete</a>
		<!-- <a id="view" class="btn btn-primary btn-sm k-grid-view" data-toggle="tooltip" title="View"><span class="fa fa-eye"></span>
			View</a> -->
		<a id="refresh" class="btn btn-primary btn-sm k-grid-refresh" data-toggle="tooltip" title="Refresh"><span class="fa fa-refresh "></span>
			Refresh</a>
	</script>


	<?php $this->load->view('script/level_script.php'); ?>
