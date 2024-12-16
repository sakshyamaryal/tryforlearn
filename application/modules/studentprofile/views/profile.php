

<div class="col-md-8" style="margin-top:10px;">

 <div class="row">

  <div class="col-md-6">

        <div class="form-group">

            <label for="exampleInputEmail1">Full Name</label>

            <input type="text" name="name"  class="form-control" id="name" aria-describedby="emailHelp" placeholder="Your Full Name" value="<?= $profile->fullname; ?>">

        </div>

  </div>

  <div class="col-md-6" >

        <div class="form-group">

                <label for="exampleInputEmail1">Address</label>

                <input type="text" name="address"  class="form-control" id="address" aria-describedby="emailHelp" placeholder="Your Full Address" value="<?= $profile->address; ?>">

            </div>

  </div>

 </div>

 <div class="row">

       <div class="col-md-6">

            <div class="form-group">

                <label for="exampleInputEmail1">Contact Number</label>

                <input type="text" name="phone"  class="form-control" id="phone" aria-describedby="emailHelp" placeholder="Your Contact Number" value="<?= $profile->phone; ?>">

            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">

                <label for="exampleInputEmail1">Email Address</label>

                <input type="email" name="email"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="Your Email Address" value="<?= $profile->email; ?>">

            </div>

        </div>

 </div>

 <div class="row">

    <div class="col-md-4">

    </div>

    <div class="col-md-4 text-center ">

        <button type="button" class=" btn btn-block mybtn btn-primary tx-tfm" onclick="update()">Update Profile</button>

    </div>

    <div class="col-md-4">

    </div>

    </div>

    <p style="margin-top:5px;"><a href="javascript:void(0)" onclick="modalshow()">Click Here to Update Extra Details of Yours</a></p>





</div>



</div>

</div>

</section>



<div class="modal" tabindex="-1" role="dialog" id="updateextra">

  <div class="modal-dialog" role="document" style="max-width: 600px!important;">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Detail Information</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

         

      </div>

      <small id="success" style="padding-left: 15px;color: green;"></small>

      <small id="error" style="padding-left: 15px;color: red;"></small>

      <div class="modal-body">

      

      <div class="row">

                        <div class="col-md-6">

                           <div class="form-group">

                              <label for="exampleInputEmail1">Parents Detail</label>

                              <input type="text" name="pd"  class="form-control" id="pd" aria-describedby="emailHelp" placeholder="Parents Detail" value="<?=$extra->parents_detail ;?>">

                           </div>

                        </div>

                        <div class="col-md-6">

                           <div class="form-group">

                              <label for="exampleInputEmail1">Parents Number</label>

                              <input type="text" name="pn"  class="form-control" id="pn" aria-describedby="emailHelp" placeholder="Parents Contact Number" value="<?=$extra->parents_number ;?>">

                           </div>

                        </div>

                       </div>



                       <div class="row">

                       <div class="col-md-6">

                           <div class="form-group">

                              <label for="exampleInputEmail1">Institution Detail</label>

                              <input type="text" name="gd"  class="form-control" id="gd" aria-describedby="emailHelp" placeholder="Recent Institution Details" value="<?=$extra->guardian_detail ;?>">

                           </div>

                        </div>

                        <div class="col-md-6">

                           <div class="form-group">

                              <label for="exampleInputEmail1">Citizenship Number</label>

                              <input type="text" name="gn"  class="form-control" id="gn" aria-describedby="emailHelp" placeholder="Citizenship Number" value="<?=$extra->guardian_number ;?>">

                           </div>

                        </div>

                       </div>



                       <div class="row">

                        <div class="col-md-12">

                           <div class="form-group">

                              <label for="exampleInputEmail1">Extra Information</label>

                              <textarea name="extra"  class="form-control" id="extra" aria-describedby="emailHelp"><?=$extra->extra ;?></textarea>

                           </div>

                        </div>

                      

                       </div> 

                                          

                           

                        

                        <div class="row">

                           

                           <div class="col-md-4 text-center ">

                              <button type="button" class=" btn btn-block mybtn btn-success tx-tfm" onclick="update_extra()">Update</button>

                           </div>

                        </div>

      </div>

      

    </div>

  </div>

</div>

<?php $this->load->view('script/profile_script'); ?>







