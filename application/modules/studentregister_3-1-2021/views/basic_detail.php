<div class="container">
           
                     <div class="logo mb-3">
                         <div class="col-md-12 text-center">
                            <h1>Basic Detail</h1>
                         </div>
                    </div>
                    <b style="color:green;"><?=$this->session->flashdata('success')?></b>
                    <b style="color:red;"><?=$this->session->flashdata('error')?></b>
                   <?php if(isset($form_url)): ?>
                   <form action="<?= $form_url;?>" method="post" >
                   <?php endif;?>
                      <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Parents Detail</label>
                              <input type="text" name="pd"  class="form-control" id="pd" aria-describedby="emailHelp" placeholder="Parents Detail">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Parents Number</label>
                              <input type="text" name="pn"  class="form-control" id="pn" aria-describedby="emailHelp" placeholder="Parents Contact Number">
                           </div>
                        </div>
                       </div>

                       <div class="row">
                       <div class="col-md-6">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Institution Detail</label>
                              <input type="text" name="gd"  class="form-control" id="gd" aria-describedby="emailHelp" placeholder="Recent Institution Detail">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Citizenship Number(Any Identification) </label>
                              <input type="text" name="gn"  class="form-control" id="gn" aria-describedby="emailHelp" placeholder="Citizenship Number">
                           </div>
                        </div>
                       </div>

                       <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Extra Information</label>
                              <textarea name="extra"  class="form-control" id="extra" aria-describedby="emailHelp"></textarea>
                           </div>
                        </div>
                      
                       </div> 
                                          
                           
                        
                           <div class="row">
                           
                           <div class="col-md-4 text-center ">
                              <button type="button" class=" btn btn-block mybtn btn-primary tx-tfm" onclick="submit(<?= $student_id; ?>)">Submit</button>
                           </div>
                           <?php if($secondary_button==true): ?>
                           <div class="col-md-4">
                            <button type="button" class=" btn btn-block mybtn btn-warning tx-tfm" onclick="skip()">Add Later</button>
                           </div>
                           <?php endif; ?>
                           </div>
                           <br><br/>
                          
                        <?php if(isset($form_url)): ?>
                        </form>
                         <?php endif; ?>
                 
          
         

</div>
<?php $this->load->view('script/register_script') ;?>