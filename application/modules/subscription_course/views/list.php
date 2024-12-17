<div class="col-md-8 rightcontainer" style="margin-top:10px;">
  <p><b style="color:green;"><?= $this->session->flashdata('success') ?></b></p>
  <p><b style="color:red;"><?= $this->session->flashdata('error') ?></b></p>
  <a href="javascript:void(0)" data-toggle="modal" data-target="#coursemodal"><i class="fa fa-plus"></i> Subscribe
    Course</a>
  <table class="table">
    <thead>
      <tr>
        <th>S.N.</th>
        <th>Subject Name</th>
        <th>Subscribed On</th>
        <th>Valid Till</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $sn = 0;
      foreach ($course as $data):
        $sn++; ?>

        <tr>
          <td><?= $sn; ?></td>
          <td><b><?= $data['subject_name']; ?></b><small><br />Class: <?= $data['classname']; ?><br />Program:
              <?= $data['levelname']; ?></small></td>
          <td><?= $data['pdate']; ?></td>
          <td><?= $data['edate']; ?></td>
          <td><?php if ($data['current_status'] == '1') { ?>
              <div class="alert alert-success">Active</div> <?php } else { ?>
              <div class="alert alert-danger">Expired</div><?php } ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>

</div>
</div>
</section>


<div class="modal" tabindex="-1" role="dialog" id="coursemodal">
  <div class="modal-dialog" role="document" style="max-width: 1080px!important;">
    <div class="modal-content" style="height:230px;    width: 850px;">
      <div class="modal-header">
        <h5 class="modal-title">Course Enrolled On:</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <div class="modal-body">
        <?php if (isset($form_url)): ?>
          <form id="subform" method="post">
          <?php endif; ?>
          <div class="row">
            <div class="col-md-3">
              <label>Select Course Type</label>

              <div class="form-group">
                <select id="class" name="class" class="form-control" style="cursor:pointer;" onchange="getclass()">
                  <option value='-1'>Please Select </option>

                  <?php foreach ($level as $list): ?>
                    <option value="<?= $list->level_id; ?>"><?= $list->name; ?></option>
                  <?php endforeach; ?>
                </select>

              </div>
            </div>
            <div class="col-md-3" id="sclass">
              <label>Select Level</label>

              <div class="form-group">
                <select id="classid" name="classid" class="form-control" style="cursor:pointer;"
                  onchange="getsubject()">
                  <option value='-1'>Please Select </option>
                </select>

              </div>
            </div>
            <div class="col-md-3" id="subject">
              <label>Select Subject</label>

              <div class="form-group">
                <select id="subjectid" name="subjectid" class="form-control" style="cursor:pointer;"
                  onchange="getpackage()">
                  <option value='-1'>Please Select </option>
                </select>

              </div>
            </div>
            <div class="col-md-3" id="spackage">
              <label>Select Package Type</label>

              <div class="form-group">
                <select id="package" name="package" class="form-control" style="cursor:pointer;">
                  <option value='-1'>Please Select </option>
                </select>
              </div>
            </div>

            <div class="col-md-3" id="">
              <label>Discount Voucher Code</label>

              <div class="form-group">
                <input type="text" class="form-control" id="vouchercode" name="vouchercode" />
              </div>
            </div>

            <div class="col-md-3" id="">
            <input type="text" class="form-control" id="applyPromoVal" name="applyPromo" style="display: none;" value="N" />
              <button type="button" id="applyPromo" class="btn btn-success">Apply Promo</button>
            </div>

            <div class="col-md-3" id="newPriceDiv" style="display: none; font-weight: bold; font-size: 16px; color: green;">
              <span>New Price: Rs. <span id="newPrice"></span></span>
            </div>

            <div class="col-md-3" id="oldPriceDiv" style="display: none; font-weight: bold; font-size: 16px; color: red;">
              <span>Old Price: Rs. <span id="oldPrice"></span></span>
            </div>


          </div>
          <div class="row">

            <div class="col-md-4 text-center ">
              <button id="btnsave" type="button" class=" btn btn-block mybtn btn-primary tx-tfm">Submit</button>
            </div>

          </div>
          <?php if (isset($form_url)): ?>
          </form>
        <?php endif; ?>
      </div>

    </div>
  </div>
</div>
<?php $this->load->view('script/newsubscription_script'); ?>
<script src="https://khalti.com/static/khalti-checkout.js"></script>