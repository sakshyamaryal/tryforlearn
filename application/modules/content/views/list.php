<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML"></script>-->
<script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"> </script>
<script type="text/x-mathjax-config">
   MathJax.Hub.Config({
      tex2jax: { inlineMath: [["$","$"],["\\(","\\)"]] },
      "HTML-CSS": {
        linebreaks: { automatic: true, width: "container" }          
      }              
   });
</script>
    

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
                <h2><i class="fa fa-list"></i> <?= $title;?></h2>

            </div>
            <div class="box-content">
            <form id="cogsform">
            
            <div class="row">
            <input type="hidden" id="toshow" name="toshow" value="<?=@$showclass;?>" />
             <input type="hidden" id="levelid" name="levelid" value="<?=@$levelid;?>" />
              <?php if($showclass=='Y'):?>
             
                <div class="col-md-2">
                <label>Class<sup style="color:red;">*</sup>

                 </label>
                <select id="class" name="class" class="form-control" style="cursor:pointer;" >
                <option value='-1'>Please Select</option>
                 <?php foreach($class as $list):?>
                    <option value="<?=$list->classid;?>"><?=$list->name;?></option>
                 <?php endforeach; ?>
                </select>
                </div>
                <div class="col-md-2">
                <label>Subject<sup style="color:red;">*</sup>

                 </label>
                <select id="subject" name="subject" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                </select>
                </div>
                 <?php endif;?>
                <div class="col-md-2">
                <label>Chapter<sup style="color:red;">*</sup>

                 </label>
                <select id="chapter" name="chapter" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <?php foreach($chapter as $list):?>
                    <option value="<?=$list->chapterid;?>"><?=$list->chaptername;?></option>
                 <?php endforeach; ?>
                </select>
                </div>
                <div class="col-md-2">
                <label>Topic<sup style="color:red;">*</sup>

                 </label>
                <select id="topic" name="topic" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                </select>
                </div>
               
                
                <div class="col-md-2" style="margin-top:20px;">
                <button type="submit" id="btnsubmit" class="btn btn-primary">View</button>
                <button type="button" id="btnshowform" class="btn btn-success">Add</button>
                </div>

                
            
                
               </div>
               </form>
               <br>
             
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
					     
                     <input type="hidden" id="contentid" name="contentid" value="0" class="form-control"/> 

					  <div class="col-md-10">
					 <label>Title</label><br/>
                     <input type="text" name="title" id="title" value="" class="form-control"/> 
                    </div>
                    <div class="col-md-2">
					 <label>Order Number</label><br/>
                     <input type="number" name="orderby" id="orderby" value="1" class="form-control"/> 
                    

					 </div>
                     
					 </div>
                     <div class="row">

					  <div class="col-md-8">
					 <label>Title In Nepali</label><br/>
                     <input type="text" name="titlenep" id="titlenep" value="" class="form-control"/> 
                    </div>
                    <div class="col-md-2">
					 <label>Type</label><br/>
            <select class="form-control" id="type" name="type">
               <option value="default">Content</option>
               <option value="applet">Applet</option>

            </select>                    

					 </div>
           <div class="col-md-2">
					 <label>Applet in</label><br/>
            <select class="form-control" id="appletin" name="appletin">
               <option value="p">Potrait</option>
               <option value="l">Landscape</option>

            </select>                    

					 </div>
                    
                     
					 </div>
           <div class="row">
            <div class="col-md-2">
              <label>Copy Same As English in Nepali field</label>
              <input type="checkbox" id="checkbox_copy" name="checkbox_copy" value="Y" >
                </div>
               
                </div>
                     <div class="row">

					  <div class="col-md-12">
					 <label>Description</label><br/>
                     <textarea  name="description" id="description" value="" class="form-control"></textarea> 
                     	<!--<div id="description" contenteditable="true"></div>-->
                    

					 </div>
					 </div>

                     <div class="row">

					  <div class="col-md-12">
					 <label>Description In Nepali</label><br/>
                     <textarea  name="descriptionnep" id="descriptionnep" value="" class="form-control"></textarea> 
                    

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


    <!-- FOR FILE UPLOAD -->

    <div class="modal fade" id="filemodal" srole="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			
			
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add FIle</h5>
						<button type="button" class="close modalhide" data-toggle="modal-close"><span>×</span>
						</button>
					</div>
					<form  id="addfileform" method="post">

					<div class="modal-body"  id="addbody">
                    <input type="hidden" id="filecontentid" name="filecontentid" value="0" class="form-control"/> 

					<div class="row">
                    <div class="col-md-8">
                     <label>What kind of File it is ?</label>
                     <input type="radio"  name="fradio" value="file" onclick="change_type('1')">File
                     <input type="radio" name="fradio" value="video" onclick="change_type('2')">Video

                    </div>
                    </div>
                     
					 <div class="row">

					  <div class="col-md-10">
					 <label>Title</label><br/>
                     <input type="text" name="filetitle" id="filetitle" value="" class="form-control"/> 
                    </div>
                    <div class="col-md-2">
					 <label>Order Number</label><br/>
                     <input type="number" name="fileorderby" id="fileorderby" value="1" class="form-control"/> 
                    

					 </div>
                     
					 </div>
                     <div class="row" id="filerow">

					  <div class="col-md-12">
					 <label>Upload File:</label><br/>
                    <input type="file" id="file" name="file" />

					 </div>
					 </div>
                     <div class="row" id="videorow">

					  <div class="col-md-12">
					 <label>Youtube Link:</label><br/>
                     <input type="text" name="link" id="link" value="" class="form-control"/> 

					 </div>
           <div class="col-md-6" style="display: flex; margin-top: 20px;">
           <br>
					 <label>Only For App</label>
              <input type="checkbox" name="onlyForApp" id="onlyForApp" class="form-control" style="width: 15%"/> 

					 </div>
					 </div>
					 <hr>
					 <div class="row">
					  <div class="col-md-2">
					  <button type="button" class="btn btn-success" id="btnsubmit" onclick="submitfile()">Submit</button>
					  </div>
					 </div>
                     
					</div>
				
					
				</div>
			</form>
		</div>
	</div>


    <!-- FOR FILE VIEW -->
    <div class="modal fade" id="viewfilemodal" srole="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			
			
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">View File</h5>
						<button type="button" class="close modalhide" data-toggle="modal-close"><span>×</span>
						</button>
					</div>
                    <div class="modal-body" id="viewfilebody">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="close modalhide" data-toggle="modal-close">Close
						</button>
                    </div>
                    </div>
					
		</div>
	</div>



    <div id="preview-modal" class="modal modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  
    <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Modal title</h4>
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





<?php  $this->load->view('script/content_script.php'); ?>
