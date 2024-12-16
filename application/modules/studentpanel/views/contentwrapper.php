 <!-- <link rel="stylesheet" href="<?=base_url();?>assets/frontend/css/bootstrap_4.min.css"> -->
<!-- <script src="<?=base_url();?>assets/frontend/js/bootstrap_3.41.min.js"></script>  -->

<style>

.note {
  background: #e0e0bb;
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
.iframe-container {
    .overlay {
      display: none;
    }
    .overlay-bottom-right{
      /* position: relative !important;
      margin-top: 20px;
      background: none !important; */
      display: none;

    }
}

</style>

<div class="col-md-12 col-sm-12">
<ul class="breadcrumb">
<?php if($mode=='paid')
{ ?>
  <li><a href="javascript:void(0)" onclick="showsubject()"><?=@$post['classname']?></a>
  </li>
 
  <li><a href="javascript:void(0)" data-classid="<?=@$post['class']?>" data-classname="<?=@$post['classname']?>" data-val="<?= @$post['subject']; ?>" data-subjectname="<?=@$post['subjectname']?>" class="getchapter<?= @$post['subject']; ?>" onclick="getchapter(<?= @$post['subject']; ?>)"><?=@$post['subjectname']?></a>
  </li>
  <?php }else { ?>
  <li><a href="javascript:void(0)" data-type="f" data-val="<?= $post['level']; ?>" data-levelname="<?= $post['levelname']; ?>"  class="getchapter<?= $post['level']; ?>" onclick="getchapter(<?= @$post['level']; ?>)"><?=@$post['levelname']?></a>
  </li>
 
  <?php  } ?>
  <li><a href="javascript:void(0)" data-val="<?= @$post['chapter']; ?>" data-chaptername="<?=@$post['chaptername']?>" class="gettopic<?= @$post['chapter']; ?>" onclick="gettopic(<?= @$post['chapter']; ?>)"><?=@$post['chaptername']?></a>
  </li>
  <li><a href="javascript:void(0)" data-val="<?= @$post['topic']; ?>" data-topicname="<?=@$post['topicname']?>" class="getmenu<?= @$post['topic']; ?>" onclick="getmenu(<?= @$post['topic']; ?>)"><?=@$post['topicname']?></a>
  </li>
</ul>
</div>

<div class="col-md-12 col-sm-12">

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#tabcontent" id="navtabcontent">Content</a></li>
    <li><a data-toggle="tab" href="#tabfile" id="navtabfile" data-val="<?= @$content->contentid;?>">File</a></li>
    <li><a data-toggle="tab" href="#tabvideo" id="navtabvideo" data-val="<?= @$content->contentid;?>">Videos</a></li>
    <li><a data-toggle="tab" href="#tabimage" id="navtabimage" data-val="<?= @$content->contentid;?>">Images</a></li>
    <li><a data-toggle="tab" href="#tabexercise">Exercise</a></li>
    <li><a data-toggle="tab" href="#tabquiz">Quiz</a></li>
    <li><a data-toggle="tab" href="#tabgrades" id="navtabgrades">Grades(Chapter wise)</a></li>
  </ul>

  <div class="tab-content">
    <div id="tabcontent" class="tab-pane fade in active">
      <h3 class="tabcontenttitle"><?= @$content->title;?></h3>
        <span class="tabcontentdetail"><?= @$content->detail;?></span><br/>
        <button type="button" class="btn btn-primary" id="prev_button">Previous</button>
        <button type="button" class="btn btn-primary" id="next_button">Next</button>
        <span id="page_number" class="pull-right">Page 1 of 1</span>
      </div>
    <div id="tabfile" class="tab-pane fade ">

      <h3 class="tabfiletitle">Files Related to this content</h3>
      <span class="tabfiledetail"></span>
    </div>
    <div id="tabvideo" class="tab-pane fade">
      <h3 class="tabvideotitle">Videos Related to this content</h3>
      <span class="tabvideodetail"></span>
      </div>
    <div id="tabimage" class="tab-pane fade">
    <h3 class="tabimagetitle">Images Related to this content</h3>
      <span class="tabimagedetail"></span>
      </div>
      <div id="tabgrades" class="tab-pane fade">
      <h3 class="tabgradestitle">Grade is based on Chapter</h3>
      <span class="tabgradedetail"></span>
      </div>
      <div id="tabexercise" class="tab-pane fade">
      <h3 class="tabexercisetitle">Practise Sets Of Question</h3>
      <span class="tabexercisedetail"></span>
          <div class="row exerciseintro" >
          <div class="col-md-4 col-sm-4">
            <label style="color:red">Please Select Number Of Question to Attempt<br/>
            <!-- <small>Note: No. of Question will be per Group</small> -->
          </label>
            
            </div>
            
          </div>
          <div class="row exerciseintro" >
          <div class="col-md-2 col-sm-2">
              <select id="optqtype" class="form-control exerciseopt">
              <option value="5">5 Questions</option>
              <option value="10">10 Questions</option>
              <option value="20">20 Questions</option>
              <option value="30">30 Questions</option>
              </select>
              </div>
              <div class="col-md-4 col-sm-4" style="    margin-top: 5px;">
              <button id="startgame" type="button" class="btn btn-success startgame" data-val="exercise">Start Now</button>
              </div>
          </div>

         
        </div>

        <div id="tabquiz" class="tab-pane fade">
      <h3 class="tabequiztitle">Play Quiz</h3>
      <span class="tabquizdetail"></span>
          <div class="row quizintro" >
          <div class="col-md-4 col-sm-4">
            <label style="color:red">Please Select Number Of Question to Attempt<br/>
            <!-- <small>Note: No. of Question will be per Group</small> -->
            </label>
            
            </div>
            
          </div>
          <div class="row quizintro" >
          <div class="col-md-2 col-sm-2">
              <select id="optquiztype" class="form-control quizopt">
              <option value="5">5 Questions</option>
              <option value="10">10 Questions</option>
              <option value="20">20 Questions</option>
              <option value="30">30 Questions</option>
              </select>
              </div>
              <div class="col-md-4 col-sm-4" style="    margin-top: 5px;">
              <button id="startquiz" type="button" class="btn btn-success startgame" data-val="quiz">Play Now</button>
              </div>
          </div>

         
        </div>


      </div>
  </div>
</div>

 
  
  <script>
 
 
  
  var arr = [<?=@$listid;?>];
var i = 0;
var itemsPerPage = 1;
var currentPage = 0;
$('#prev_button').hide();
$('#next_button').hide();


function updatePagination(currentpage, next= false , previous = false) {
    var totalPages = Math.ceil(arr.length / itemsPerPage);
    if (!next && !previous) {
      currentPage =currentPage + 1;
    }else if (next) {
      if (totalPages > 1) {
        currentPage =currentPage + 1;      
      }
    }else if (previous) {
      if (totalPages > 1) {
        currentPage =currentPage - 1;      
      }
    }
    
    
    $('#page_number').text('Page ' + (currentPage) + ' of ' + totalPages);
}

updatePagination(currentPage);

if(arr.length>1)
{
$('#next_button').show();
}
function nextItem() {
    i = i + 1; 
    $('#prev_button').show();
    if(i+1==arr.length)
    {
    $('#next_button').hide();

    }
    updatePagination(i, true, false);
    return arr[i]; 
}


function prevItem() {
   $('#next_button').show();
    if (i-1 === 0) { // i would become 0
      $('#prev_button').hide();

    }
    i = i - 1; // decrease by one
    updatePagination(i, false, true);
    return arr[i]; // give us back the item of where we are now
}
$('#next_button').click(function(e){
  var cid=nextItem();
  getcontent(cid);
});

$('#prev_button').click(function(e){
  var cid=prevItem();
getcontent(cid);
});
// $('#navtabcontent').click(function(e){
// $('.tab-pane').removeClass('active');
// $('.tab-pane').removeClass('in');
// $('#tabcontent').addClass('active');
// $('#tabcontent').addClass('in');
// });
function checkRefresh()
{
	// Get the time now and convert to UTC seconds
	var today = new Date();
	var now = today.getUTCSeconds();

	// Get the cookie
	var cookie = document.cookie;
	var cookieArray = cookie.split('; ');

	// Parse the cookies: get the stored time
	for(var loop=0; loop < cookieArray.length; loop++)
	{
		var nameValue = cookieArray[loop].split('=');
		// Get the cookie time stamp
		if( nameValue[0].toString() == 'SHTS' )
		{
      var cookieTime = parseInt( nameValue[1] );
		}
		// Get the cookie page
		else if( nameValue[0].toString() == 'SHTSP' )
		{

      var cookieName = nameValue[1];

		}
	}

	if( cookieName &&
		cookieTime &&
		cookieName == escape(base_url) &&
		Math.abs(now - cookieTime) < 5 )
	{
    //console.log('refresh in 5');
        if(localStorage.currentexercise)
      {
        if(localStorage.getItem('currentexercise')=='Y')
        {
              //clearInterval(downloadTimer);
              if(typeof downloadTimer === 'undefined')
              {
              }
              else{
                clearInterval(downloadTimer);
              }

              localStorage.setItem('currentexercise','N');
                    $('.exerciseintro').show();
                    $('.tabexercisedetail').empty();
                    $('.quizintro').show();
                    $('.tabquizdetail').empty();
        }
      }
    
  }	
  else
  {
    //console.log('refresh in else');
    if(typeof downloadTimer === 'undefined')
              {
              }
              else{
                clearInterval(downloadTimer);
              }

       localStorage.setItem('currentexercise','N');
       $('.exerciseintro').show();
       $('.tabexercisedetail').empty();
       $('.quizintro').show();
       $('.tabquizdetail').empty();

  }
  return false;

	
}
var refresh_prepare = 1;
function prepareForRefresh()
{
  //console.log('refresh record');
	if( refresh_prepare > 0 )
	{
		// Turn refresh detection on so that if this
		// page gets quickly loaded, we know it's a refresh
		var today = new Date();
		var now = today.getUTCSeconds();
		document.cookie = 'SHTS=' + now + ';';
    document.cookie = 'SHTSP=' + escape(base_url) + ';';
	}
	else
	{
		// Refresh detection has been disabled
		document.cookie = 'SHTS=;';
		document.cookie = 'SHTSP=;';
	}
}
$("ul").click(function(){
  
  checkRefresh();
});
$('#navtabfile').click(function(e){
  
  var contentid=$(this).attr('data-val');
  if(localStorage.currenttabfile)
  {
     if(contentid!=localStorage.getItem('currenttabfile'))
     {
       getcontentfile(contentid,'f');
     }
     else
     {
       var text=$('.tabfiledetail').html();
          if(text.length<1)
          {
            getcontentfile(contentid,'f');
          }
     }

  }else
  {
    getcontentfile(contentid,'f');
  }

});

$('#navtabvideo').click(function(e){
  
  
  var contentid=$(this).attr('data-val');
  if(localStorage.currenttabvideo)
  {
     if(contentid!=localStorage.getItem('currenttabvideo'))
     {
       getcontentfile(contentid,'v');
     }
     else
     {
       var text=$('.tabvideodetail').html();
          if(text.length<1)
          {
            getcontentfile(contentid,'v');
          }
     }

  }else
  {
    getcontentfile(contentid,'v');
  }

});

$('#navtabimage').click(function(e){
  
  
  var contentid=$(this).attr('data-val');
  if(localStorage.currenttabimage)
  {
     if(contentid!=localStorage.getItem('currenttabimage'))
     {
       getcontentfile(contentid,'i');
     }
     else
     {
       var text=$('.tabimagedetail').html();
          if(text.length<1)
          {
            getcontentfile(contentid,'i');
          }
     }

  }else
  {
    getcontentfile(contentid,'i');
  }

});
$('.startgame').click(function(e){
  
    var type=$(this).data('val');
    var opt=$('.'+type+'opt').val();
    prepareForRefresh();


    beginexercise(opt,type);
});
$('#navtabgrades').click(function(e){
  
  getgrades(localStorage.getItem('currentchapter'));


});


  </script>


  <!-- Preview Start -->
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

<!--  Preview end -->

<div class="modal modal-fullscreen" tabindex="-1" role="dialog" id="topicmodal">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Documents & Files of <b id="tname"></b></h5>&nbsp;&nbsp;&nbsp;<b></b>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>



     

      </div>

      <div class="modal-body" id="topicbody">

      </div>

      

    </div>

  </div>

</div>