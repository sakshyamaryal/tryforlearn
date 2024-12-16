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
        <select class="form-control" id="pmodule" style="width: 20%!important;" onchange="get_modules()">
        <option value="-1">Please Select Modules</option>

             

             <?php foreach($module_name as $mod){ ?>
           <option value="<?= $mod['module_id']; ?>"><?= $mod['module_name']; ?></option>
             <?php } ?>
       
           </select><br>
<br/>
<table class="table table-striped table-bordered  responsive">
<thead>
<tr>
<th class="my-th">S.N.</th>
<th class="my-th">Module Name</th>
<?php foreach($usertype as $val) : 
?>
<th class="my-th"><?= $val['user_type_name']; ?></th>
<?php endforeach; ?>

</tr>
</thead>
<tbody id="tbody">
<?php $sn=0; foreach($module_name as $module) : $sn++?>
<tr>
<td><?= $sn; ?></td>
<td><?= $module['module_name']; ?></td>
<?php foreach($usertype as $val) : ?>
<?php $check="" ; if(isset($permission[$val['typeid']."_".$module['module_id']])){
                        if($permission[$val['typeid']."_".$module['module_id']]=='1') {
                            $check="checked";
                        }else{
                            $check="";
                        } } ?>
<td><input type='checkbox' id='check<?php echo $module['module_id'].$val['typeid'];?>' onclick='set_permission(<?= $module["module_id"];?>,<?= $val["typeid"];?>)' <?php echo $check;?>></td>
<?php endforeach; ?>
</tr>
<?php endforeach; ?>  


</tbody>
</table>
</div>
</div>
</div>
</div>

<?php $this->load->view('script/permission_script.php'); ?>



   