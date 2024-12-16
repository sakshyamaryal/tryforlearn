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
            <i class="fa fa-plus"></i> Add Course
          </a><br><br/>
          <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
              <tr>
              <th class="my-th">S.N.</th>
              <th class="my-th">Course Name</th>
              <th class="my-th">Course Teacher</th>
              <th class="my-th">Start Date</th>
              <th class="my-th">End Date</th>
              <th class="my-th">Course Duration</th>
              <th class="my-th">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $sn=0; foreach($courses as $list): $sn++; ?>
              <tr>
              
              <td><?= $sn; ?></td>
              <td><?= $list['Name'] ; ?></td>
              <td><?= $list['Teacher'] ; ?></td>
              <td><?= $list['Start'] ; ?> </td>
              <td><?= $list['End'] ; ?> </td>
              <td><?= $list['Duration'] ; ?> </td>
             
              <td class="center">
                <a class="" href="#" style="color:green;" onclick="edit_form(<?= $list['C_ID'] ; ?>)">
                <i class="fa fa-edit"></i>
                </a>
                <a class="" href="#" style="color:red;" onclick="delete_form(<?= $list['C_ID'] ; ?>)">
                <i class="fa fa-trash" ></i></a>
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
        <h5 class="modal-title" id="label">Add Course</h5>
        <button type="button" class="close"  onclick="clear_ever()" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="row">
              <div class="col-md-6">
                  <input type="hidden" id="id" >
              <input type="text" class="form-control" id="cname" placeholder="Course Name" />
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" id="tname" placeholder="Teacher Name" />
              </div>
          </div>
          <br>
          <div class="row">
              <div class="col-md-6">
              <input type="date" class="form-control" id="start" placeholder="Course Start Date"  />

              </div>
              <div class="col-md-6">
              <input type="date" class="form-control" id="end" placeholder="Course End Date" />

              </div>
          </div><br>
          <div class="row">
            <div class="col-md-6">
              <input type="text" class="form-control" id="time" placeholder="Course Duration" />

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


<?php $this->load->view('script/course_script.php'); ?> 
   
   