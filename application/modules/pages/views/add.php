<?php
//include('./fckeditor/fckeditor.php');
//$sBasePath = base_url() . 'fckeditor/';
//$oFCKeditor = new FCKeditor('description');
//$oFCKeditor->BasePath = $sBasePath;
?>
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


					<form action="<?php echo base_url(); ?>pages/addPage" id="addPage" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" id="id">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="address">Name</label>
									<input type="text" name="pageName" id="pageName" class="form-control">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="address">Status</label>
									<input type="text" style="width: 100%" name="status" id="status">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">

									<input name="files" id="files" type="file"/>
									<div class="demo-hint">Maximum allowed file size is <strong>4MB</strong>.
										You can only upload <strong>GIF</strong>, <strong>JPG</strong>,
										<strong>PNG</strong> files.
									</div>


								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
		<textarea id="description" name="description" rows="10" cols="30" style="height:440px" aria-label="editor"></textarea>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success btn-sm" name="save" id="save">
								<i class="fa fa-save"></i> Save
							</button>
						</div>
					</form>


				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function () {
			$("#description").kendoEditor({
				resizable: {
					content: true,
					toolbar: true
				}
			});
			var status_data = [{name: "inactive", value: "0"}, {name: "Active", value: "1"}];
			$("#files").kendoUpload({
				multiple: false,
				validation: {
					allowedExtensions: [".gif", ".jpg", ".png", ".jpeg"],
					maxFileSize: 4194304
				}
			});

			$("#status").kendoDropDownList({
				dataTextField: 'name',
				dataValueField: 'value',
				dataSource: status_data,

			});
		})

		function validateField() {
			$("#addPage").validate({
				rules: {
					"pageName": {
						required: true,
					}

				},
				messages: {
					"pageName": {
						required: "Please enter page name",
					}

				},
			});

		}


		$("#addPage").unbind('submit').bind('submit', function (e) {
			e.preventDefault();
			validateField();
			if ($(this).valid() == true) {

				var form = $(this);
				var url = form.attr('action');
				var type = form.attr('method');
				var formData = new FormData($(this)[0]);
				var upload = $("#files").getKendoUpload();
				var files = upload.getFiles();
				if (files.length > 0) {
					formData.append('files', files[0].rawFile);
				}
				$.ajax({
					url: url,
					type: type,
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					async: false,
					success: function (response) {

						if (response.success == true) {
							window.location.href = "<?php echo  base_url(); ?>/pages";

						} else {
							toastr.warning(response.messages, {timeOut: 5000})
						}

					}
				});


			} else {
				return false;
			}
		});


	</script>