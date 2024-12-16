<style>
    .box-content #grid{
        height:100% !important;
    }
    .k-grid-content{
        height:100% !important;
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
	<div class=" row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-list"></i> <?= $title;?></h2>

				</div>
				<div class="box-content">


                <h3 align="center">Import Data</h3>
                <form method="post" id="import_form" enctype="multipart/form-data" action="<?=base_url().'import/trainee/importtraineedata';?>">
                <p><label>Select Excel File</label>
                <input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>
                <br />
                <input type="submit" name="import" value="Import" class="btn btn-info" />
                </form>
				</div>
			</div>
		</div>
	</div>


