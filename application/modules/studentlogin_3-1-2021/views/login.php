<div class="container">
        <div class="row justify-content-md-center justify-content-center">
            <div class="col-md-5">
            <div id="first">
                <div class="myform form ">
                     <div class="logo mb-3">
                         <div class="col-md-12 text-center">
                            <h1>Login</h1>
                         </div>
                    </div>
                    <b style="color:red;"><?=$this->session->flashdata('error')?></b>

                   <form action="<?= $form_url;?>" method="post" name="login">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Username</label>
                              <input type="text" name="username"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Username">
                           </div>
                           <div class="form-group">
                              <label for="exampleInputEmail1">Password</label>
                              <input type="password" name="password" id="password"  class="form-control" aria-describedby="emailHelp" placeholder="Enter Password">
                           </div>
                           
                           <div class="col-md-12 text-center ">
                              <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
                           </div>
                           
                          
                           <div class="form-group">
                              <p> <a href="javascript:void(0)" id="pwdrequest">Forgot Password?</a></p>
                           </div>
                        </form>
                 
                </div>
            </div>
          
        </div>
      </div>   
         

</div>
<?php $this->load->view('script/password_script');?>