
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
                <div class="col-md-3">
                <label>Class<sup style="color:red;">*</sup>

                 </label>
                <select id="class" name="class" class="form-control" style="cursor:pointer;" >
                <option value='-1'>Please Select</option>
                 <?php foreach($class as $list):?>
                    <option value="<?=$list->classid;?>"><?=$list->name;?></option>
                 <?php endforeach; ?>
                </select>
                </div>
                <div class="col-md-3">
                <label>Subject<sup style="color:red;">*</sup>

                 </label>
                <select id="subject" name="subject" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                </select>
                </div>
                <?php endif;?>
                <div class="col-md-3">
                <label>Chapter<sup style="color:red;">*</sup>

                 </label>
                <select id="chapter" name="chapter" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <?php foreach($chapter as $list):?>
                    <option value="<?=$list->chapterid;?>"><?=$list->chaptername;?></option>
                 <?php endforeach; ?>
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
						<h5 class="modal-title">Add Topic</h5>
						<button type="button" class="close modalhide" data-toggle="modal-close"><span>×</span>
						</button>
					</div>
					<form  id="addform" method="post">
					<div class="modal-body"  id="addbody">
					
                     
					 <div class="row">
                     <input type="hidden" id="topicid" name="topicid" value="0" class="form-control"/> 

					  <div class="col-md-12">
					 <label>Topic Name</label><br/>
                     <input type="text" name="topicname" id="topicname" value="" class="form-control"/> 
                    

					 </div>
					 <div class="col-md-2">
					 <label>Priority</label><br/>
                     <input type="number" name="priority" id="priority" min="1" value="" class="form-control"/> 
                    

					 </div>
					 </div>
					 <hr>
					 <div class="row">
					  <div class="col-md-2">
					  <button type="button" class="btn btn-success" id="btnsubmit" onclick="submittopic()">Submit</button>
					  </div>
					 </div>
                     
					</div>
				
					
				</div>
			</form>
		</div>
	</div>






<?php  $this->load->view('script/topic_script.php'); ?>
