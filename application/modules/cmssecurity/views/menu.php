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
<a class="" href="#" data-toggle="modal" data-target="#bmodal" style="color:green;">
    <i class="fa fa-plus"></i> Add Menu
    
</a><br>
<br/>
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
<thead>
<tr>
<th class="my-th">S.N.</th>
<th class="my-th">Module Name</th>
<th class="my-th">Parent Module</th>
<th class="my-th">Controller Link</th>
<th class="my-th">Font Awesome Icons</th>
<th class="my-th">Bar</th>
<th class="my-th">Display Order</th>
<th class="my-th">Status</th>
<th class="my-th">Action</th>
</tr>
</thead>
<tbody>
    <?php $sn=0; foreach($menu as $list): $sn++; ?>
    <tr>
    <td><?= $sn ; ?></td>
    <td><?= $list['module_name'] ; ?></td>
    <td><?php if($list['parent_module']!='0'){
     $this->db->select('module_name');
    $this->db->from('modules');
    $this->db->where('module_id',$list['parent_module']);
    $name=$this->db->get()->row(); echo $name->module_name ; }else { echo "------------------"; } ?></td>
    <td><?= $list['controller_fname'] ; ?></td>
    <td><?= $list['fonticon'] ; ?> &nbsp; <i class="<?= $list['fonticon'] ; ?>"></i></td>
    <td><?php if($list['bar_type']=='1'){ echo "Side Bar for Admin" ;}else { echo "Top Bar for Frontend" ;} ; ?></td>
    <td><?= $list['display_order'] ; ?></td>
    <td><?php if($list['is_active']=='1'){?> <span class="label-success label label-default">Active</span>
    <?php } ?></td>
    <td class="center">
 
    <a class="" href="#" style="color:green;" onclick="edit_form(<?= $list['module_id'] ; ?>)">
    <i class="fa fa-edit"></i>
    
    </a>
    <a class="" href="#" style="color:red;" onclick="delete_form(<?= $list['module_id'] ; ?>)">
    <i class="fa fa-trash" ></i>
    
    </a>
    </td>

    </tr>
    <?php endforeach ;?>


</tbody>
</table>
</div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="bmodal" tabindex="-1" role="dialog" aria-labelledby="bmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label">Add</h5>
        <button type="button" class="close"  onclick="clear_ever()" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="row">
              <div class="col-md-6">
                  <input type="hidden" id="id" >
              <input type="text" class="form-control" id="name" placeholder="Module Name" />
              </div>
              <div class="col-md-6">
              <select class="form-control" id="pmodule">
              <option value="0">----------</option>
             

                  <?php foreach($menu_modules as $mod){ ?>
                <option value="<?= $mod['module_id']; ?>"><?= $mod['module_name']; ?></option>
                  <?php } ?>
            
                </select>

              </div>
          </div>
          <br>
          <div class="row">
              <div class="col-md-6">
              <input type="text" class="form-control" id="fname" placeholder="Controller Function Name"  />

              </div>
              <div class="col-md-6">
              <input type="text" class="form-control" id="font" placeholder="Font Awesome Icon" />

              </div>
          </div><br>
          <div class="row">
              <div class="col-md-6">
              <select class="form-control" id="bar">
                <option value="1">Side Bar for Admin</option>
                <option value="2">Top Bar for Frontend</option>
            
                </select>
              </div>
              <div class="col-md-6">
              <input type="number" class="form-control" id="order" placeholder="Display Order"  />

              </div>
          </div>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" id="btnsubmit" onclick="load()" class="btn btn-primary">Submit</button>
        <button type="button" id="btnupdate" onclick="load()" class="btn btn-success" style="display:none;">Update</button>
      </div>
    </div>
  </div>
</div>


<?php $this->load->view('script/menu_script.php'); ?>
   
   