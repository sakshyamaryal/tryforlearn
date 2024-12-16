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
				<a id="addreport" class="btn btn-primary btn-sm k-grid-plus"><span class="fa fa-plus" data-toggle="tooltip" title="Add Report"></span>
			     Generate Report</a>
				 <?php if($type=='sub'){ ?>
				 <a id="viewans" class="btn btn-success btn-sm k-grid-eye"><span class="fa fa-eye" data-toggle="tooltip" title="View Answer"></span>
			     View Answer</a>
				 <?php } ?>

					<div id="grid"></div>

				</div>
			</div>
		</div>
	</div>

	<script type="text/x-kendo-template" id="template">
		<!-- <a id="edit" class="btn btn-primary btn-sm k-grid-edit"><span class="fa fa-edit" data-toggle="tooltip" title="Edit"></span>
			Edit</a> -->
		<a id="delete" class="btn btn-primary btn-sm k-grid-delete" data-toggle="tooltip" title="Delete"><span class="fa fa-times"></span>
			Delete</a>
		<!-- <a id="view" class="btn btn-primary btn-sm k-grid-view" data-toggle="tooltip" title="View"><span class="fa fa-eye"></span>
			View</a> -->
		<a id="refresh" class="btn btn-primary btn-sm k-grid-refresh" data-toggle="tooltip" title="Refresh"><span class="fa fa-refresh "></span>
			Refresh</a>
	</script>
	<?php if($type=='sub'){ 
		 $this->load->view('script/examsub_script.php'); 
		 }else{
			$this->load->view('script/exam_script.php'); 

		 } ?>

	<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalans">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="modalans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Submitted Answer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="ansbody">
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
