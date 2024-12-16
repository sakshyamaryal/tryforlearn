<style>
.note {
  background: #e4e6f7;
  border: 1px solid #728dbd;
  padding: 1rem;
}
ul.breadcrumb {
  padding: 10px 16px;
  list-style: none;
  background-color: #eee;
}
ul.breadcrumb li {
  display: inline;
  font-size: 18px;
}
ul.breadcrumb li+li:before {
  padding: 8px;
  color: black;
  content: "/\00a0";
}
ul.breadcrumb li a {
  color: #0275d8;
  text-decoration: none;
}
ul.breadcrumb li a:hover {
  color: #01447e;
  text-decoration: underline;
}

</style>
<div class="col-md-9 rightcontainer" style="margin-top:10px;">

    <div class="row">
    <div class="col-md-12 col-sm-12">
    <ul class="breadcrumb">
    <li><a href="<?=base_url();?>studentpanel">Home</a>
    </li>
    
    <li><a href="<?=base_url();?>myprofile"><?=$title;?> </a>
    </li>
    </ul>
    </div>
    </div>
<div class="row">
<div class="col-md-12 col-sm-12" style="margin-top:5px;" id="profilewrapper">
             

</div>
<div><br/><br/>
</section>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<script>
var base_url='<?=base_url();?>';
</script>
<?php $this->load->view('script/profile_script');?>


<div id="addmodal" class="modal modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  
    <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                    </div>
                     <span class="waittime">Loading..</span>
                    <div class="modal-body" id="mypreviewbody">
                      
                    </div>
                    <div class="modal-footer">
                    <span class="prevnextbtn">
                    </span>

                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
      
    </div>
  </div>
</div>