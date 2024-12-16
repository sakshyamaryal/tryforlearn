
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
             <div class="col-md-2">
                <label>Exam On: <sup style="color:red;">*</sup>

                </label>
                <select id="isself" name="isself" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <option value='Y'>Self Practise</option>
                <option value='N'>Exam</option>
                </select>

                </div>
                <div class="col-md-2" id="edate" style="display:none;">
                <label>Exam Type<sup style="color:red;">*</sup>

                 </label>
                <select id="examtypeid" name="examtypeid" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <?php foreach($examtype as $list):?>
                    <option value="<?=$list->examtypeid;?>"><?=$list->examtypename;?></option>
                 <?php endforeach; ?>
                </select>
                </div>
             <?php if($showclass=='Y'):?>
                <div class="col-md-2 ">
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
                <div class="col-md-2 echapter">
                <label>Chapter<sup style="color:red;">*</sup>

                 </label>
                <select id="chapter" name="chapter" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <?php foreach($chapter as $list):?>
                    <option value="<?=$list->chapterid;?>"><?=$list->chaptername;?></option>
                 <?php endforeach; ?>
                </select>
                </div>
               
               
                
               </div>
               <div class="row">
               
                <div class="col-md-2">
                <label>Exam Category

                </label>
                <select id="examtype" name="examtype" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <option value='S'>Subjective</option>
                <option value='O'>Objective</option>
                </select>

                </div>
                <div class="col-md-2">
                <label>Status

                </label>
                <select id="status" name="status" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <option value='S'>Submitted</option>
                <option value='O'>Not Submitted</option>
                </select>

                </div>
               <div class="col-md-2" style="margin-top:20px;">
                <button type="submit" id="btnsubmit" class="btn btn-primary">View</button>
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







<script>
var base_url="<?= base_url();?>"
</script>
<?php $this->load->view('script/exercise_script.php'); ?>

