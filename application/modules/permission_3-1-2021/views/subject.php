
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
            <div class="col-md-3">
                <label>Level<sup style="color:red;">*</sup>

                 </label>
                <select id="level" name="level" class="form-control" style="cursor:pointer;" >
                <option value='-1'>Please Select</option>
                 <?php foreach($level as $llist):?>
                    <option value="<?=$llist->level_id;?>"><?=$llist->name;?></option>
                 <?php endforeach; ?>
                </select>
                </div>
         
                <div class="col-md-3">
                <label>Class<sup style="color:red;">*</sup>

                 </label>
                <select id="class" name="class" class="form-control" style="cursor:pointer;" >
                <option value='-1'>Please Select</option>
                
                </select>
                </div>
              
                
                <div class="col-md-2" style="margin-top:20px;">
                <button type="submit" id="btnsubmit" class="btn btn-primary">View</button>
                </div>

               </div>
               </form>
              <br/>
              
               <div class="container" id="tbl">


              
               </div>
               

            </div>
        </div>
    </div>
</div>








<?php  $this->load->view('script/subject_script.php'); ?>
