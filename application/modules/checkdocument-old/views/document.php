<div class="container">
        <div class="row justify-content-md-center justify-content-center">
            <div class="col-md-5">
            <div id="first">
                <div class="myform form ">
                     <div class="logo mb-3">
                         <div class="col-md-12 text-center">
                            <h1>Check Document</h1>
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
                              <label for="exampleInputEmail1">Validation Number</label>
                              <input type="text" name="dob" id="dob"  class="form-control" aria-describedby="emailHelp" placeholder="Validation No. Provided to Us">
                           </div>
                         </div>
                         <div class="col-md-4">
                         <div class="form-group">
                              <label for="exampleInputEmail1">Phone</label>
                              <input type="text" name="ed" id="ed"  class="form-control" aria-describedby="emailHelp"  placeholder="Enter your Phone ">
                           </div>
                         </div>
      </div>
     <!--  <div class="row">
          <div class="col-md-4" id="showfile">
          </div>

      </div> -->

                           <div class="col-md-4 text-center ">
                              <button type="button" style="width:50%!important;" class=" btn btn-block mybtn btn-success tx-tfm" onclick="check_document()">Check</button>
                           </div><br><br/>
                           
         

</div>

<?php $this->load->view('script/document_script'); ?>