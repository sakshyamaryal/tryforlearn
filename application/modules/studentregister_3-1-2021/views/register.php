<div class="container">
           
                     <div class="logo mb-3">
                         <div class="col-md-12 text-center">
                            <h1>Register</h1>
                         </div>
                    </div>
                    <b style="color:red;"><?=$this->session->flashdata('error')?></b>

                   <form action="<?= $form_url;?>" method="post" name="register">
                      <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Full Name</label>
                              <input type="text" name="name"  class="form-control" id="name" aria-describedby="emailHelp" placeholder="Your Full Name" value="<?php echo set_value('name'); ?>">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Address</label>
                              <input type="text" name="address"  class="form-control" id="address" aria-describedby="emailHelp" placeholder="Your Full Address" value="<?php echo set_value('address'); ?>">
                           </div>
                        </div>
                       </div>

                       <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Contact Number</label>
                              <input type="text" name="phone"  class="form-control" id="phone" aria-describedby="emailHelp" placeholder="Your Contact Number" value="<?php echo set_value('phone'); ?>">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Email Address</label>
                              <input type="email" name="email"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="Your Email Address" value="<?php echo set_value('email'); ?>">
                           </div>
                        </div>
                       </div>

                       <div class="row">
                       <div class="col-md-6">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Preffered Language</label>
                              <select class="form-control" id="language" name="langauge">
                                <option value="ENG">English </option>
                                <option value="NEP">Nepali </option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Username</label>
                              <input type="text" name="username"  class="form-control" id="username" aria-describedby="emailHelp" placeholder="This will be your logged in Username" value="<?php echo set_value('username'); ?>">
                           </div>
                        </div>
                      
                       </div> 
                       <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Password</label>
                              <input type="password" name="password"  class="form-control" id="password" aria-describedby="emailHelp" placeholder="">
                           </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Re Enter Password</label>
                              <input type="password" name="repassword" id="repassword"  class="form-control" aria-describedby="emailHelp" >
                           </div>
                        </div>
                      
                       </div>                      
                           
                          
                           <div class="form-group">
                              <p class="text-center">By signing up you accept our <a href="#">Terms Of Use</a></p>
                           </div>
                           <div class="row">
                           <div class="col-md-4">
                           </div>
                           <div class="col-md-4 text-center ">
                              <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Register</button>
                           </div>
                           <div class="col-md-4">
                           </div>
                           </div>
                           <br><br/>
                          
                           
                        </form>
                 
          
         

</div>