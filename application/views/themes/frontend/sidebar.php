<style>
    .p1[data-count]:after{
        position: absolute;
    /* right: 10%; */
    top: 8%;
    content: attr(data-count);
    font-size: 95%;
    padding: .2em;
    border-radius: 50%;
    line-height: 1em;
    color: white;
    background: rgba(255,0,0,.85);
    text-align: center;
    min-width: 1em;
}
.scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
}

    </style>
<div class="container">
<div class="row">

</div>
</div>

<section class=" ftco-no-pt ftc-no-pb">
<div class="container">
<div class="row">
<div class="col-md-3 leftcontainer">
    <div class="text  ftco-animate ">
        <div class="list-group" id="list-group" style="    width: 200px;">
            <span href="#" class="list-group-item active">
                <a href="<?= base_url(); ?>studentpanel/home" style="color:white;">
              <i class="fa fa-home"></i> My Dashboard  
              </a> <span class="minimizeit" style="float:right;cursor:pointer;"><i class="fa fa-minus"></i></span>
              <!--<button type="button" class="btn btn-default" style="margin-left: 20px;" data-toggle="dropdown"><i class="fa fa-bell p1 has-badge" data-count="0"></i></button>-->
              <!--      <ul class="dropdown-menu scrollable-menu" id="notimenu" role="menu">-->
                     
                        
              <!--      </ul>-->
            </span>

            
            <a href="<?= base_url(); ?>studentpanel" class="list-group-item">
                <i class="fa fa-book-open"></i> Switch to My Course
            </a>
            <a href="<?= base_url(); ?>studentpanel/allcourses" class="list-group-item">
                <i class="fa fa-book-open"></i> Other Courses
            </a>
            <a href="<?= base_url(); ?>subscription_course" class="list-group-item">
                <i class="fa fa-book-open"></i> Subscription List
            </a>
            <a href="<?= base_url(); ?>sevents" class="list-group-item">
                <i class="fa fa-calendar"></i> Events
            </a>
            <a href="<?= base_url(); ?>snotice" class="list-group-item">
                <i class="fa fa-comment"></i> Notices
            </a>
            <a href="<?= base_url(); ?>myexam" class="list-group-item">
                <i class="fa fa-file-signature"></i> Exam
            </a>
            <!-- <a href="<?= base_url(); ?>enrollexam/mcq" class="list-group-item">
                <i class="fa fa-file"></i> MCQ TEST
            </a> -->
            <a href="<?= base_url(); ?>mygrades" class="list-group-item">
                <i class="fa fa-marker"></i> Grades
            </a>
            <a href="<?= base_url(); ?>rank" class="list-group-item">
                <i class="fa fa-marker"></i> Rank
            </a>
            <!-- studentprofile -->
            <a href="<?= base_url(); ?>myprofile" class="list-group-item">
                <i class="fa fa-user"></i> My Profile
            </a>
            <a href="<?= base_url(); ?>passwordreset" class="list-group-item">
                <i class="fa fa-key"></i> Reset Password
            </a>
           
        </div>  
        <br><br/>
    </div>
</div>




<!--
// var header = document.getElementById("list-group");
// var btns = header.getElementsByClassName("list-group-item");
// for (var i = 0; i < btns.length; i++) {
//   btns[i].addEventListener("click", function() {
//   var current = document.getElementsByClassName("active");
//   current[0].className = current[0].className.replace(" active", "");
//   this.className += " active";
//   });
// }
-->

 <script>
    $('.showbar').hide();
    $('.minimize' ).click(function() {
        $('.dashboard-sidebar').hide();
        $('#contentx').removeClass("col-md-9 col-sm-9");
        $('#contentx').addClass("col-lg-12 col-md-12 col-sm-12");
        $('.showbar').show();

    });
    $('.showbar' ).click(function() {
        $('.showbar').hide();
        $('.dashboard-sidebar').show();
        $('#contentx').removeClass("col-lg-12 col-md-12 col-sm-12");
        $('#contentx').addClass("col-md-9 col-sm-9");
        

    });
    </script>