
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
           
                <div class="col-md-2" id="edate" >
                <label>Exam Type<sup style="color:red;">*</sup>

                 </label>
                <select id="examtypeid" name="examtypeid" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <?php foreach($examtype as $list):?>
                    <option value="<?=$list->examtypeid;?>"><?=$list->examtypename;?></option>
                 <?php endforeach; ?>
                </select>
                </div>
             <?php if($showclass=='Y'){?>
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
            
              
                 <?php }?>
           
               
               
                <div class="col-md-2">
                <label>Exam Category<sup style="color:red;">*</sup>

                </label>
                <select id="examtype" name="examtype" class="form-control" style="cursor:pointer;">
                <option value='-1'>Please Select </option>
                <option value='S'>Subjective</option>
                <option value='O'>Objective</option>
                </select>

                </div>
               
               <div class="col-md-2" style="margin-top:20px;">
                <button type="submit" id="btnsubmit" class="btn btn-primary">View</button>
                <button type="button" id="btnsync" class="btn btn-success">Sync</button>

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
<?php $this->load->view('script/report_script.php'); ?>

