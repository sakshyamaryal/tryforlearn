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
	<div class=" row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-list"></i> <?= $title;?></h2>

				</div>
				<div class="box-content">

<!--					<a class="" href="--><?//= base_url(); ?><!--pages/add"  style="color:green;">-->
<!--						<i class="fa fa-plus"></i> Add Page-->
<!---->
<!--					</a>-->
					<div id="grid"></div>
					<input type="hidden" id='uploadedVideo'/>

				</div>
			</div>
		</div>
	</div>

	<script type="text/x-kendo-template" id="template">
		<a  class="btn btn-primary btn-sm k-grid-add"  href="<?= base_url(); ?>pages/add"><span class="fa fa-plus" data-toggle="tooltip" title="Add"></span>Add</a>
	</script>
	<?php $this->load->view('script/video_script.php'); ?>
