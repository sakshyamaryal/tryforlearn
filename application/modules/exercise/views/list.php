
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
             <input type="hidden" id="qtype" name="qtype" value="<?=@$qtype;?>" />
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
                <?php if($qtype=='N')
                { ?>
                 <div class="col-md-2">
                <label>Exam Type<sup style="color:red;">*</sup>

                 </label>
                <select id="examtypeid" name="examtypeid" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <?php foreach($examtype as $ex): ?>
                      <option value="<?=$ex->examtypeid;?>"><?=$ex->examtypename;?></option>
                      <?php endforeach; ?>
                </select>
                </div>

               <?php } else { ?> 
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
                <label>Topic

                 </label>
                <select id="topic" name="topic" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                    <option value="-1">Please select</option>
                </select>
                </div>
               <?php } ?>
               
                <div class="col-md-2">
                <label>Group<sup style="color:red;">*</sup>

                 </label>
                <select id="group" name="group" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <?php foreach($group as $list):?>
                    <option value="<?=$list->groupid;?>"><?=$list->groupname;?></option>
                 <?php endforeach; ?>
                </select>
                </div>

                <div class="col-md-2">
                <label>Migrate to Group (Only if needed to migrate)

                 </label>
                <select id="migrategroup" name="migrategroup" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <?php foreach($group as $list):?>
                    <option value="<?=$list->groupid;?>"><?=$list->groupname;?></option>
                 <?php endforeach; ?>
                </select>
                </div>
               
                
                <div class="col-md-8" style="margin-top:20px;">
                <button type="submit" id="btnsubmit" class="btn btn-primary">View</button>
                <button type="button" id="btnshowform" class="btn btn-success">Add</button>
                <button type="button" id="btnreplicate" class="btn btn-success">Replicate to Next Course</button>
                <button type="button" id="btnmigrate" class="btn btn-success">Migrate to Topic</button>
                <button type="button" id="btndataset" class="btn btn-success">Add in Datasets</button>
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




<div class="modal fade" id="exammodal" srole="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			
			
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Copy Question</h5>
						<button type="button" class="close modalhide" data-toggle="modal-close"><span>×</span>
						</button>
					</div>
					<form  id="addform" method="post">
					<div class="modal-body"  id="addbody">
					
                     <div class="row">
					  <div class="col-md-3">
					 <label>Select Exam Type</label><br/>
					 <select class="form-control" id="examtype" name="examtype">
                      <?php foreach($examtype as $ex): ?>
                      <option value="<?=$ex->examtypeid;?>"><?=$ex->examtypename;?></option>
                      <?php endforeach; ?>
                     </select>
					 </div>
                     <div class="col-md-3">
                     <label>Select Exam Date</label><br/>
                      <input type="date" class="form-control" id="qdate" value="<?=date('Y-m-d');?>" />
                     </div>
					 </div>
					
					 <hr>
					 <div class="row">
					  <div class="col-md-2">
					  <button type="button" class="btn btn-success" id="btnschedule" onclick="submitques()">Submit</button>
					  </div>
					 </div>
                     
					</div>
				
					
				</div>
			</form>
		</div>
	</div>



    
<div class="modal fade" id="replicatemodal" srole="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			
			
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Replicate Question</h5>
						<button type="button" class="close modalhide" data-toggle="modal-close"><span>×</span>
						</button>
					</div>
					<form  id="replicateform" method="post">
					<div class="modal-body"  id="replicatebody">
					
                     <div class="row">
					  <div class="col-md-2">
					 <label>Select Course</label><br/>
					 <select class="form-control" id="coursetype" name="coursetype">
                      <option value="-1">Please Select</option>
                      <?php foreach($levellist as $li):?>
                      <option value="<?=$li->level_id;?>"><?=$li->name;?></option>
                      <?php endforeach;?>
                    
                     </select>
					 </div>
                     <div class="col-md-2 replicateclass">
                     <label>Select Class</label><br/>
                     <select class="form-control" id="replicateclass" name="replicateclass">
                      </select>
                     </div>
                     <div class="col-md-2 replicatesubject">
                     <label>Select Subject</label><br/>
                     <select class="form-control" id="replicatesubject" name="replicatesubject">
                      </select>
                     </div>
                     <?php if($qtype=='N')
                        { ?>
                        <div class="col-md-2">
                        <label>Exam Type<sup style="color:red;">*</sup>

                        </label>
                        <select id="replicateexamtype" name="replicateexamtype" class="form-control" style="cursor:pointer;">
                        <option value='-1'>Please Select </option>
                        <?php foreach($examtype as $ex): ?>
                            <option value="<?=$ex->examtypeid;?>"><?=$ex->examtypename;?></option>
                            <?php endforeach; ?>
                        </select>
                        </div>

                    <?php } else { ?> 
                     <div class="col-md-2 replicatechapter">
                     <label>Select Chapter</label><br/>
                     <select class="form-control" id="replicatechapter" name="replicatechapter">
                      </select>
                     </div>
                     <div class="col-md-2 replicatetopic">
                     <label>Select Topic</label><br/>
                     <select class="form-control" id="replicatetopic" name="replicatetopic">
                      </select>
                     </div>
                     <?php } ?>

                     <div class="col-md-2">
                    <label>Group<sup style="color:red;">*</sup>

                    </label>
                    <select id="replicategroup" name="replicategroup" class="form-control" style="cursor:pointer;">
                    <option value='-1'>Please Select </option>
                    <?php foreach($group as $list):?>
                        <option value="<?=$list->groupid;?>"><?=$list->groupname;?></option>
                    <?php endforeach; ?>
                    </select>
                    </div>

                    <div class="col-md-2">
                     <label>Select Exam Date</label><br/>
                      <input type="date" class="form-control" id="replicatedate" value="<?=date('Y-m-d');?>" />
                     </div>

					 </div>
					
					 <hr>
					 <div class="row">
					  <div class="col-md-2">
					  <button type="button" class="btn btn-success" id="btnquesreplicate" onclick="replicatequestion()">Submit</button>
					  </div>
					 </div>
                     
					</div>
				
					
				</div>
			</form>
		</div>
</div>





    <div class="modal fade" id="datasetmodal" srole="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			
			
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Copy Question</h5>
						<button type="button" class="close modalhide" data-toggle="modal-close"><span>×</span>
						</button>
					</div>
					<form  id="addform" method="post">
					<div class="modal-body"  id="addbody">
					
                     <div class="row">
					  <div class="col-md-3">
					 <label>Select Datasets</label><br/>
					 <select class="form-control" id="dataset" name="dataset">
                      <?php foreach($dataset as $ex): ?>
                      <option value="<?=$ex->setid;?>"><?=$ex->setname;?> (<?=$ex->title;?> )</option>
                      <?php endforeach; ?>
                     </select>
					 </div>
                    
					 </div>
					
					 <hr>
					 <div class="row">
					  <div class="col-md-2">
					  <button type="button" class="btn btn-success" id="btnaddindataset" onclick="submitdatasetques()">Submit</button>
					  </div>
					 </div>
                     
					</div>
				
					
				</div>
			</form>
		</div>
	</div>



    

    <?php  $this->load->view('script/exercise_script.php'); ?>
