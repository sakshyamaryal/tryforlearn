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
<a class="" href="<?= base_url(); ?>package"  style="color:blue;">
    <i class="fa fa-list"></i> List Package
    
</a><br>
<?php if($this->session->flashdata('error')!=null): ?>
<div class="label-danger label label-default  col-md-12">
<?=$this->session->flashdata('error')?>
</div>
<?php endif ; ?>
<?php if($this->session->flashdata('success')!=null): ?>
<div class="label-success label label-default">
<?=$this->session->flashdata('success')?>
</div>
<?php endif ; ?>
<br>
<br/>
<form method="post" action="<?= $form_url; ?>">
    <div class="row">
        <div class="form-group col-md-4">
            <label>Package Name:</label>
            <input type="text" class="form-control" id="name" name="name" <?php if(isset($package)){?>value="<?=$package->package_name; ?>" <?php } ?>>
        </div>
        <div class="form-group col-md-8">
            <label>Short Description:</label>
            <textarea name="descp" style="width:100%"><?php if(isset($package)){?><?=$package->descp; ?> <?php } ?></textarea>
        </div>
    </div>

 
  <button type="submit" class="<?= $button_class ;?>"><?= $button_name ;?></button>
</form>

</div>
</div>
</div>
</div>