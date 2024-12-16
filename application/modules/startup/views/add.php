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
<form method="post" action="<?= $form_url; ?>" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-md-4">
            <label>Name:</label>
            <input type="text" class="form-control" id="name" name="name" <?php if(isset($startup)){?>value="<?=$startup->name; ?>" <?php } ?>>
        </div>
      
        <div class="form-group col-md-4">
            <label>Address:</label>
            <input type="text" class="form-control" id="address" name="address" <?php if(isset($startup)){?>value="<?=$startup->address; ?>" <?php } ?>>
        </div>
        <div class="form-group col-md-4">
            <label>Email:</label>
            <input type="email" class="form-control" id="email" name="email" <?php if(isset($startup)){?>value="<?=$startup->email; ?>" <?php } ?>>
        </div>
    </div>
    <div class="row">
    <div class="form-group col-md-4">
            <label>Contact Number:</label>
            <input type="text" class="form-control" id="phone" name="phone" <?php if(isset($startup)){?>value="<?=$startup->phone; ?>" <?php } ?>>
        </div>
    <div class="form-group col-md-8">
            <label>Description:</label>
            <textarea name="desc" style="width:100%"><?php if(isset($startup)){?><?=$startup->description; ?> <?php } ?></textarea>
        </div>
    </div>
    <div class="row">
    <div class="form-group col-md-6">
            <label>Service Bullet Point:</label>
            <textarea name="service" style="width:100%"><?php if(isset($startup)){?><?=$startup->service; ?> <?php } ?></textarea>
        </div>
    <div class="form-group col-md-6">
            <label>Teacher Bullet Point:</label>
            <textarea name="teacher" style="width:100%"><?php if(isset($startup)){?><?=$startup->teacher; ?> <?php } ?></textarea>
        </div>
    </div>
    <div class="row">
    <div class="form-group col-md-6">
            <label>Course Bullet Point:</label>
            <textarea name="course" style="width:100%"><?php if(isset($startup)){?><?=$startup->course; ?> <?php } ?></textarea>
        </div>
    <div class="form-group col-md-6">
            <label>Testomonial Bullet Point:</label>
            <textarea name="testomonial" style="width:100%"><?php if(isset($startup)){?><?=$startup->parents; ?> <?php } ?></textarea>
        </div>
    </div>
    <div class="row">
    <div class="form-group col-md-8">
            <label>Marketing Bullet Point:</label>
            <textarea name="marketing" style="width:100%"><?php if(isset($startup)){?><?=$startup->marketing_ling; ?> <?php } ?></textarea>
        </div>
    <div class="form-group col-md-4">
            <label>Select Image:</label>
            <input type="file" onclick="$('#fetchFile').click();" class="form-control" id="cimage" name="cimage" accept="image/*" >
        </div>
        <input type="hidden" name="image" <?php if(isset($startup)){?>value="<?=$startup->image; ?>" <?php } ?> >

    
    </div>
    <div class="row">
       <div class="form-group col-md-12">
            <label>Additional Information:</label>
            <textarea name="extra" style="width:100%"><?php if(isset($startup)){?><?=$startup->extra; ?> <?php } ?></textarea>
        </div>
  
    </div>
   
   
  <button type="submit" class="<?= $button_class ;?>"><?= $button_name ;?></button>
</form>

</div>
</div>
</div>
</div>
