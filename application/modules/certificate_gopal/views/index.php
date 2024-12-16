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
                    <th class="my-th">Certificate Name</th>
                    <th class="my-th">Date of Issue</th>
                    <th class="my-th">Certificate Text</th>
                    <th class="my-th">Background</th>
                    <th class="my-th">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach($trainee as $list): ?>
                      <tr>
                      
                      <td><?= $list['CE_ID'] ; ?></td>
                      <td><?= $list['Certificate_Name'] ; ?></td>
                      <td><?= $list['Date_of_issue'] ; ?></td>
                      <td><?= $list['Certificate_Text'] ; ?></td>
                      <!-- <td><?= $list['Background'] ; ?> </td> -->
                      <td><img src="<?php echo base_url(); ?>/upload/background/<?= $list['Background']; ?>" alt="" width="150" /> </td>
                      
                      <td class="center">
                        <a class="" href="#" style="color:green;" onclick="edit_form(<?= $list['CE_ID'] ; ?>)">
                          <i class="fa fa-edit"></i>
                        </a>
                        <a class="" href="#" style="color:red;" onclick="delete_form(<?= $list['CE_ID'] ; ?>)">
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
        <h5 class="modal-title" id="label">Add Course</h5>
        <button type="button" class="close"  onclick="clear_ever()" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="row">
              <div class="col-md-6">
                  <input type="hidden" id="id" >
              <input type="text" class="form-control" id="cname" placeholder="Certificate Name" />
              </div>
              <div class="col-md-6">
                <input type="date" class="form-control" id="issue"/>
              </div>
              
          </div>
          <br>
          <div class="row">
              <div class="col-md-12">
              <textarea name="text" id="text" style="width: 100%;max-width:100%;">Certificate Text Goes Here</textarea>

              </div>
              
          </div><br>
          <div class="row">
            <div class="col-md-6">
              <textarea name="footer1" id="footer1" style="width:100%;max-width:100%;">Footer 1</textarea>
              </div>
              <div class="col-md-6">
              <textarea name="footer2" id="footer2" style="width:100%;max-width:100%;">Footer 2</textarea>
              </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <textarea name="footer3" id="footer3" style="width:100%;max-width:100%;">Footer 3</textarea>
              </div>
              <div class="col-md-6">
              <textarea name="footer3" id="footer4" style="width:100%;max-width:100%;">Footer 4</textarea>
              </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <input type="file" name="image" class="form-control" id="background"/>
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


<?php $this->load->view('script/certificate_script.php'); ?> 
   




