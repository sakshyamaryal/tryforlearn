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
<a class="" href="<?= base_url(); ?>package/add"  style="color:green;">
    <i class="fa fa-plus"></i> Add Package
    
</a>
<br>
<br/>
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
<thead>
<tr>
<th class="my-th">S.N.</th>
<th class="my-th">Package Name</th>
<th class="my-th">Action</th>

</tr>
</thead>
<tbody id="tbody">
<?php $sn=0; foreach($package as $data) : $sn++?>
<tr>
<td><?= $sn; ?></td>
<td><?= $data['package_name']; ?></td>
<td class="center">
 
    <a class="" href="<?=base_url();?>package/edit/<?= $data['package_id'] ; ?>" style="color:green;">
    <i class="fa fa-edit"></i>
    
    </a>
    <a class="" href="#" style="color:red;" onclick="delete_form(<?= $data['package_id'] ; ?>)">
    <i class="fa fa-trash" ></i>
    
    </a>
    </td>

</tr>
<?php endforeach; ?>  


</tbody>
</table>
</div>
</div>
</div>
</div>

<?php $this->load->view('script/package_script.php'); ?>
