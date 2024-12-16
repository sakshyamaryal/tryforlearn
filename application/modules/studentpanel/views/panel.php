
<div class="col-md-9 rightcontainer"  id="contentx" style="margin-top:10px;">

<h3 style="margin-left: 17px;">My Courses</h3>
<div class="row" id="studentwrapper">


</div>

</div>
</div>
</section>
<br/>
<br/>
<br/>
<br/>
<br/>
<script>
var base_url='<?=base_url();?>';
var type='<?= $type;?>';
localStorage.setItem('mode','paid');

if(type=='home')
{
    localStorage.setItem('currentclass','');
    localStorage.setItem('currentclassname','');
    localStorage.setItem('currentsubject','');
    localStorage.setItem('currentsubjectname','');
    localStorage.setItem('currentchapter','');
    localStorage.setItem('currentchaptername','');
    localStorage.setItem('currenttopic','');
    localStorage.setItem('currenttopicname','');
}
else if(type=='free')
{
    localStorage.setItem('mode','free');
}
</script>
<?php $this->load->view('script/student_script'); ?>

