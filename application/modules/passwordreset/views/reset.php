
<div class="col-md-8 rightcontainer" style="margin-top:10px;">
 <div class="row">
  <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" name="password"  class="form-control" id="password" aria-describedby="emailHelp" >
        </div>
  </div>
  <div class="col-md-6" >
        <div class="form-group">
                <label for="exampleInputEmail1">Re Password</label>
                <input type="password" name="repassword"  class="form-control" id="repassword" aria-describedby="emailHelp" >
            </div>
  </div>
 </div>
 
 <div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4 text-center ">
        <button type="button" class=" btn btn-block mybtn btn-success tx-tfm" onclick="update()">Reset Password</button>
    </div>
    <div class="col-md-4">
    </div>
    </div>


</div>

</div>
</div>
</section>

<?php $this->load->view('script/reset_script'); ?>



