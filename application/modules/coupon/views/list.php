<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />

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


	<div class="modal fade" id="addUniversity" srole="dialog" data-keyboard="false" data-backdrop="static"
		aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<form action="<?php echo base_url(); ?>coupon/add" id="addUs" method="post" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"></h5>
						<button type="button" class="close" data-toggle="modal-close"><span>×</span>
						</button>
					</div>
					<div class="modal-body">


						<input type="hidden" name="vouchercodeid" id="vouchercodeid">

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Level</label>
									<div>
										<select class="form-control" id="levelid" name="levelid">
											<option value="-1">Please Select</option>
											<?php foreach ($levellist as $li): ?>
												<option value="<?= $li->level_id; ?>"><?= $li->name; ?></option>
											<?php endforeach; ?>
										</select>
									</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Class</label>
									<div>
										<select class="form-control" id="classid" name="classid">
											<option value="-1">Please Select</option>

										</select>
									</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Subject</label>
									<div>
										<select class="form-control" id="subjectid" name="subjectid[]"
											multiple="multiple" style="width: fit-content">
											<option value="-1">Please Select</option>

										</select>
									</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Package</label>
									<div>
										<select id="package" name="package[]" class="form-control" multiple="multiple"
											style="width: fit-content">
											<option value="1month">1 Month</option>
											<option value="3month">3 Months</option>
											<option value="6month">6 Months</option>
											<option value="1year">1 Year</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Max Limit Uses</label>
									<div>
										<input type="text" class="form-control " name="limit" id="limit">
									</div>
								</div>

							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Discount Coupon</label>
									<div>
										<input type="text" class="form-control " name="vouchercode" id="vouchercode">
									</div>
								</div>

							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Discount Type</label>
									<div>
										<select class="form-control" id="discounttype" name="discounttype">
											<option value="p">Percent</option>
											<option value="a">Amount</option>


										</select>
									</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Discount </label>
									<div>
										<input type="number" class="form-control " name="discountamount"
											id="discountamount">
									</div>
								</div>

							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Valid till</label>
									<div>
										<input type="date" class="form-control " name="validity" id="validity">
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


	<?php $this->load->view('script/coupon_script.php'); ?>