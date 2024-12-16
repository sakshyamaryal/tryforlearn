<div class="container">
           
                     <div class="logo mb-3">
                         <div class="col-md-12 text-center">
                            <h1>Course Enrolled For :</h1>
                         </div>
                    </div>
                    <b style="color:green;"><?=$this->session->flashdata('success')?></b>
                    <b style="color:red;"><?=$this->session->flashdata('error')?></b>
                   <?php if(isset($form_url)): ?>
                   <form action="<?= $form_url;?>" method="post" >
                   <?php endif;?>
                      <div class="row">
                        <div class="col-md-3">
                           <div class="form-group">
                             <select class="form-control" id="pid1"  name="pid" onchange="get_program('1')">
                             <option value="-1">Please Select</option>
                              <option value="UNI">University</option>
                              <option value="SCH">School</option>
                              <option value="REA">Reasoning</option>

                             


                             </select>
                           </div>
                        </div>
                        <div class="col-md-2" id="spid1">
                              </div>
                              <div class="col-md-2" id="cpid1">
                              </div>
                              <div class="col-md-2" id="scpid1">
                              </div>
                              <div class="col-md-2" id="unicid1">
                              </div>
                       
                       </div>
                     <div class="row">
                           
                           <div class="col-md-4 text-center ">
                              <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm" onclick="submit(<?= $student_id; ?>)">Submit</button>
                           </div>
                          
                           </div>
                           <br><br/>
                          
                        <?php if(isset($form_url)): ?>
                        </form>
                         <?php endif; ?>
                 
          
         

</div>
<?php $this->load->view('script/course_script') ;?>