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
        Quick Links: &nbsp;
        <a href="#">Certificate Type</a> &nbsp;|&nbsp; <a href="#">Generate Certificate</a> &nbsp;|&nbsp; <a href="#">Certification Trainee</a> &nbsp;|&nbsp; <a href="#">Certification Course</a>
        <br><br/>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="listing-tab" data-toggle="tab" href="#listing" role="tab" aria-controls="listing" aria-selected="true"><i class="fa fa-list-ol"></i> Certificate Type Listing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#add" role="tab" aria-controls="add" aria-selected="false"><i class="fa fa-plus-square"></i> Add Certificate Type</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent" style="margin-top:3rem;">
          <div class="tab-pane fade show active" id="listing" role="tabpanel" aria-labelledby="listing-tab">
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
                      <td><?= $list['Certificate Name'] ; ?></td>
                      <td><?= $list['Date of Issue'] ; ?></td>
                      <td><?= $list['Certificate Text'] ; ?></td>
                      <td><?= $list['Background'] ; ?> </td>
                      
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
          <div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">
              hell hello

          </div>
        </div>

        
      </div>
    </div>
  </div>
</div>



