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
            <i class="fa fa-plus"></i> Add Student
        </a><br><br/>
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
          <thead>
            <tr>
              <th class="my-th">S.N.</th>
              <th class="my-th">Student Name</th>
              <!-- <th class="my-th">Organization</th> -->
              <th class="my-th">Phone</th>
              <!-- <th class="my-th">Email</th> -->
              <th class="my-th">Citizenship No.</th>
              <th class="my-th">Document No.</th>
              <th class="my-th">Status</th>
              <th class="my-th">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $sn=0; foreach($students as $list): $sn++; ?>
                <tr>
                
                <td><?= $list['SC_ID'] ; ?></td>
                <td><?= $list['Name'] ; ?></td>
                <!-- <td><?= $list['Organization'] ; ?></td> -->
                <td><?= $list['Phone'] ; ?> </td>
                <!-- <td><?= $list['Email'] ; ?> </td> -->
                <td><?= $list['Citizenship'] ; ?> </td>
                <td><?= $list['Document_Number'] ; ?> </td>
                <td>
                  <?php if($list['Status']=='1'){?> <span class="label-success label label-default">Active</span>
                <?php } 
                else{
                  ?>
                  <span class="label-danger label label-default">Inactive</span>
                
                <?php } ?>

              </td>
                <td class="center">
             
                <a class="" href="#" style="color:green;" onclick="edit_form(<?= $list['SC_ID'] ; ?>)">
                <i class="fa fa-edit"></i>
                
                </a>
                <a class="" href="#" style="color:red;" onclick="delete_form(<?= $list['SC_ID'] ; ?>)">
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
        <h5 class="modal-title" id="label">Add Student</h5>
        <button type="button" class="close"  onclick="clear_ever()" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-md-6">
                  <input type="hidden" id="id" >
              <input type="text" class="form-control" id="doc" placeholder="Document Number" />
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" id="title" placeholder="Salutation or Title" />
              </div>
          </div>
          <br>
          <div class="row">
              <div class="col-md-6">
                  <input type="hidden" id="id" >
              <input type="text" class="form-control" id="name" placeholder="Student Name" />
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" id="org" placeholder="Organization Name" />
              </div>
          </div>
          <br>
          <div class="row">
              <div class="col-md-6">
              <input type="text" class="form-control" id="phone" placeholder="Phone Number"  />

              </div>
              <div class="col-md-6">
              <input type="email" class="form-control" id="email" placeholder="Email Address" />

              </div>
          </div><br>
          <div class="row">
            <div class="col-md-6">
              <input type="text" class="form-control" id="citizen" placeholder="Citizenship Number" />

              </div>
              <div class="col-md-6">
              <select class="form-control" id="status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            
                </select>
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


<?php $this->load->view('script/student_script.php'); ?> 
   
   