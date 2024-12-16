<style>
.collapsible {
  background-color: #007bff;
    color: white;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    margin-bottom: 5px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.collapsible:after {
  content: '\002B';
  color: white;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

/*.active:after {*/
/*  content: "\2212";*/
/*}*/

.content {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}




.modal-fullscreen {
  padding: 0 !important;
  
}
.modal-dialog {
    width: 100%;
    max-width:-webkit-fill-available;
    height: 100%;
    margin: 0;
    padding: 0;
  }
  
  .modal-content {
    height: auto;
    min-height: 100%;
    border: 0 none;
    border-radius: 0;
  }
  
  

</style>
<div class="col-md-8" style="margin-top:10px;">


<div class="row">

<video width="100%" height="400" controls controlsList="nodownload" preload="none">
  <source src="<?= $vid; ?>" >
  </video>  

</div><br><br/>
 
</div>

</div>
</div>
</section>









 






