
<div id="content" class="col-lg-10 col-sm-10">

<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?= $admin_base_url; ?>">Home</a>
        </li>
        <li>
            <a href="#"><?= $title;?></a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="fa fa-list"></i> <?= $title;?>
                &nbsp;
                <span style="margin-left:800px;">
                <a href="javascript:void(0)" id="btnshowform" >
                <i class="fa fa-plus"></i> Add  
                </a>
                </span>
                </h2>

            </div>
            <div class="box-content">

           
               <div class="container" id="tbl">
              
               </div>
               

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="chaptermodal" srole="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			
			
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Content</h5>
						<button type="button" class="close modalhide" data-toggle="modal-close"><span>×</span>
						</button>
					</div>
					<form  id="addform" method="post">
					<div class="modal-body"  id="addbody">
					
                     
					 <div class="row">
                     <input type="hidden" id="certificateid" name="certificateid" value="0" class="form-control"/> 

                     <div class="col-md-8">
					 <label>Certificate Title</label><br/>
                     <input type="text" name="title" id="title" value="" class="form-control"/> 
                    </div>
					 
                    <div class="col-md-4">
					 <label>Program Date</label><br/>
                     <input type="text" name="programdate" id="programdate" value="" class="form-control" placeholder="10th Jan to 12th Jan"/> 
                    

					 </div>
                     
					 </div>
                     <div class="row">
                     <div class="col-md-6">
					 <label>Certificate for</label><br/>
                     <input type="text" name="name" id="name" value="" class="form-control"/> 
                    </div>

					  <div class="col-md-6">
					 <label>Course</label><br/>
                     <input type="text" name="course" id="course" value="" class="form-control"/> 
                    

					 </div>
					 </div>
                     <div class="row">

					  <div class="col-md-12">
					 <label>Main Content</label><br/>
                     <textarea  name="ccontent" id="ccontent" value="" class="form-control"></textarea> 
                    

					 </div>
					 </div>
                     <div class="row">

                        <div class="col-md-6">
                        <label>Footer 1</label><br/>
                        <textarea  name="footer1" id="footer1" value="" class="form-control"></textarea> 


                        </div>
                        <div class="col-md-6">
                        <label>Footer 2</label><br/>
                        <textarea  name="footer2" id="footer2" value="" class="form-control"></textarea> 


                        </div>

                        </div>
                        <div class="row">

                        <div class="col-md-6">
                        <label>Footer 3</label><br/>
                        <textarea  name="footer3" id="footer3" value="" class="form-control"></textarea> 


                        </div>
                        <div class="col-md-6">
                        <label>Footer 4</label><br/>
                        <textarea  name="footer4" id="footer4" value="" class="form-control"></textarea> 


                        </div>

                        </div>
                        <div class="row">
                        <div class="col-md-6">
                        <label>Background Image</label><br/>
                        <input type="file" id="file" name="file" >


                        </div>

                        </div>
					 <hr>
					 <div class="row">
					  <div class="col-md-2">
					  <button type="button" class="btn btn-success"  onclick="submitcontent()">Submit</button>
					  </div>
					 </div>
                     
					</div>
				
					
				</div>
			</form>
		</div>
	</div>


  




<?php  $this->load->view('script/content_script.php'); ?>
<!-- <script>
var base_url="<?= base_url();?>"
</script>
<script src="<?=base_url();?>assets/admin/myjs/content_script.js"></script>
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<script src="<?=base_url();?>assets/admin/js/table2excel.js"></script>
<script src="<?=base_url();?>assets/admin/js/mytableexport.js"></script> -->