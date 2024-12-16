<div class="container" style="padding-top:8rem;padding-bottom: 10rem;">
        <div class="row justify-content-md-center justify-content-center">
            <div class="col-md-5">
            <div id="first">
                <div class="myform form ">
                     <div class="logo mb-3">
                         <div class="col-md-12 text-center">
                            <h1>Check Document</h1><br><br>
                         </div>
                    </div>
                    <b style="color:red;"><?=$this->session->flashdata('error')?></b>
                   
                          
                      
                 
                </div>
            </div>
          
        </div>
      </div>   
      <div class="row">
                         <div class="col-md-4">
                         <div class="form-group">
                              <label for="exampleInputEmail1">Document Number</label>
                              <input type="text" name="dn"  class="form-control" id="dn" aria-describedby="emailHelp" placeholder="Enter Document Number">
                           </div>
                         </div>
                         <div class="col-md-4">
                         <div class="form-group">
                              <label for="exampleInputEmail1">Citizenship Number</label>
                              <input type="text" name="cn" id="cn"  class="form-control" aria-describedby="emailHelp" placeholder="Citizenship Number">
                           </div>
                         </div>
                            <div class="col-md-4">
                         <div class="form-group">
                              <label for="exampleInputEmail1">Contact Number</label>
                              <input type="text" name="phone" id="phone"  class="form-control" aria-describedby="emailHelp" placeholder="Contact Number">
                           </div>
                         </div>
                         <!--<div class="col-md-4">-->
                         <!--<div class="form-group">-->
                         <!--     <label for="exampleInputEmail1">Last Exam / Training Date</label>-->
                         <!--     <input type="date" name="ed" id="ed"  class="form-control" aria-describedby="emailHelp"  placeholder="Enter Last Exam / Training Date">-->
                         <!--  </div>-->
                         <!--</div>-->
      </div>
      <div class="row">
          <div class="col-md-4" id="showfile">
          </div>

      </div>

                           <div class="col-md-4 text-center ">
                              <button type="button" style="width:50%!important;" class=" btn btn-block mybtn btn-success tx-tfm" onclick="check_document()">Check</button>
                           </div><br><br/>
                           
         

</div>

<?php $this->load->view('script/document_script'); ?>