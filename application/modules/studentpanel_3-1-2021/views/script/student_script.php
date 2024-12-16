<script>


//$('#studentwrapper').empty();
var studentwrapper=$('#studentwrapper');
console.log('outside');
var url='';
studentwrapper.html('Loading...');
if(localStorage.getItem('mode')=='paid')
{
    console.log('here');
if (localStorage.length > 0){
    console.log('inside length >0');
    if(localStorage.currenttopic)
    {
        showmenu();
    }
   else if(localStorage.currentchapter)
    {
        showtopic();
    }
    else if(localStorage.currentsubject)
    {
        showchapter();
    }
    else if(localStorage.currentclass)
    {
        showsubject();
    }
    else{
        console.log('else  insidde');
     mainwrap();

    }

}
else{
    console.log('else main');
     mainwrap();

}
}
else
{
    freecourse();
}

function mainwrap()
{
    
    url=base_url+"studentpanel/getsubject";
    $.when(requestmethod({}, url)).then(function(res){
        if(res.status==true)
        {
    
        studentwrapper.empty();
        studentwrapper.html(res.html);

        }

    })
}
function freecourse()
{
    
    url=base_url+"studentpanel/getfreecourse";
    $.when(requestmethod({}, url)).then(function(res){
        if(res.status==true)
        {
    
        studentwrapper.empty();
        studentwrapper.html(res.html);

        }

    })
}
function showsubject()
{
    localStorage.setItem('currentsubject','');
    localStorage.setItem('currentsubjectname','');
    localStorage.setItem('currentchapter','');
    localStorage.setItem('currentchaptername','');
    localStorage.setItem('currenttopic','');
    localStorage.setItem('currenttopicname','');
    
    url=base_url+"studentpanel/getsubject";
    $.when(requestmethod({classid:localStorage.getItem('currentclass')}, url)).then(function(res){
        if(res.status==true)
        {
    
        studentwrapper.empty();
        studentwrapper.html(res.html);
        

        }

    })
}


function showchapter()
{
    var data='';
    if(localStorage.getItem('mode')=='paid')
    {
        data={
            subject:localStorage.getItem('currentsubject'),
            class:localStorage.getItem('currentclass'),
            subjectname:localStorage.getItem('currentsubjectname'),
            classname:localStorage.getItem('currentclassname'),
           
            
        };
    }
    else
    {
        data={
            subject:'',
            class:'',
            subjectname:'',
            classname:'',
            level:localStorage.getItem('currentlevel'),
            levelname:localStorage.getItem('currentlevelname'),
            
        };
    }

    url=base_url+"studentpanel/getchapter";
  
    $.when(requestmethod(data, url)).then(function(res){
        if(res.status==true)
        {
        studentwrapper.empty();
        studentwrapper.html(res.html);

        }
        else
        {
            studentwrapper.empty();
        studentwrapper.html(res.message);
        }

    })
  
}
function getchapter(id)
{
    var type=$('.getchapter'+id).data('type');
    if(type=='f')
    {
        localStorage.setItem('currentlevel',$('.getchapter'+id).data('val'));
    localStorage.setItem('currentlevelname',$('.getchapter'+id).data('levelname'));
  
    localStorage.setItem('mode','free');
    

    }
    else
    {
    
        localStorage.setItem('currentclass',$('.getchapter'+id).data('classid'));
        localStorage.setItem('currentclassname',$('.getchapter'+id).data('classname'));
    localStorage.setItem('currentsubject',id);
    localStorage.setItem('currentsubjectname',$('.getchapter'+id).data('subjectname'));
    localStorage.setItem('currentchapter','');
    localStorage.setItem('currentchaptername','');
    localStorage.setItem('currenttopic','');
    localStorage.setItem('currenttopicname','');
    localStorage.setItem('currentlevel','');
     localStorage.setItem('currentlevelname','');
     localStorage.setItem('mode','paid');

    }
       
   
 

showchapter(); 
}

function showtopic()
{
    var data='';

    if(localStorage.getItem('mode')=='paid')
     {
        
        data={
        chapter:localStorage.getItem('currentchapter'),
        subject:localStorage.getItem('currentsubject'),
        class:localStorage.getItem('currentclass'),
        subjectname:localStorage.getItem('currentsubjectname'),
        classname:localStorage.getItem('currentclassname'),
        chaptername:localStorage.getItem('currentchaptername'),
        level:localStorage.getItem('currentlevel'),
        levelname:localStorage.getItem('currentlevelname'),

    };

     }
     else
     {
        data={
        chapter:localStorage.getItem('currentchapter_f'),
        subject:'',
        class:'',
        subjectname:'',
        classname:'',
        chaptername:localStorage.getItem('currentchaptername_f'),
        level:localStorage.getItem('currentlevel'),
        levelname:localStorage.getItem('currentlevelname'),

    };
    
     }
    url=base_url+"studentpanel/gettopic";
  
    $.when(requestmethod(data, url)).then(function(res){
        if(res.status==true)
        {
        studentwrapper.empty();
        studentwrapper.html(res.html);

        }

    })
}
function gettopic(id)
{
     if(localStorage.getItem('mode')=='paid')
     {
        localStorage.setItem('currentchapter',id);
    localStorage.setItem('currentchaptername',$('.gettopic'+id).data('chaptername'));
     }
     else
     {
        localStorage.setItem('currentchapter_f',id);
        localStorage.setItem('currentchaptername_f',$('.gettopic'+id).data('chaptername'));
     }
    
    localStorage.setItem('currenttopic','');
    localStorage.setItem('currenttopicname','');
    
 

showtopic(); 
}
function getmenu(id)
{
    
    if(localStorage.getItem('mode')=='paid')
     {
        localStorage.setItem('currenttopic',id);
        localStorage.setItem('currenttopicname',$('.getmenu'+id).data('topicname'));
     }
     else
     {
        localStorage.setItem('currenttopic_f',id);
        localStorage.setItem('currenttopicname_f',$('.getmenu'+id).data('topicname'));
     }
 

showmenu(); 
}
function showmenu()
{
    var data='';
   

    if(localStorage.getItem('mode')=='paid')
     {
        
        var data={
        topic:localStorage.getItem('currenttopic'),
        chapter:localStorage.getItem('currentchapter'),
        subject:localStorage.getItem('currentsubject'),
        class:localStorage.getItem('currentclass'),
        subjectname:localStorage.getItem('currentsubjectname'),
        classname:localStorage.getItem('currentclassname'),
        chaptername:localStorage.getItem('currentchaptername'),
        topicname:localStorage.getItem('currenttopicname'),
        level:localStorage.getItem('currentlevel'),
        levelname:localStorage.getItem('currentlevelname'),

    };
     }
     else
     {
        
        var data={
        topic:localStorage.getItem('currenttopic_f'),
        chapter:localStorage.getItem('currentchapter_f'),
        subject:'',
        class:'',
        subjectname:'',
        classname:'',
        chaptername:localStorage.getItem('currentchaptername_f'),
        topicname:localStorage.getItem('currenttopicname_f'),
        level:localStorage.getItem('currentlevel'),
        levelname:localStorage.getItem('currentlevelname'),

    };

    
     }
    url=base_url+"studentpanel/getcontent";
    
    $.when(requestmethod(data, url)).then(function(res){
        if(res.status==true)
        {
            localStorage.setItem('currentcontentid',res.contentid);
        studentwrapper.empty();
        studentwrapper.html(res.html);

        }

    })
}
function getcontent(id)
{

    url=base_url+"studentpanel/changecontent";
    var data={id};
    $.when(requestmethod(data, url)).then(function(res){
        if(res.status==true)
        {
            localStorage.setItem('currentcontentid',id);

           $('.tabcontenttitle').empty();
           $('.tabcontentdetail').empty();
           $('.tabcontenttitle').html(res.content.title);
           $('.tabcontentdetail').html(res.content.detail);
           $('#navtabfile').attr('data-val',id);
           $('#navtabvideo').attr('data-val',id);
           $('#navtabimage').attr('data-val',id);
        }

    })
}
function getcontentfile(id,type)
{
    url=base_url+"studentpanel/getcontentfile";
    var data={id,type};
    if(type=='f')
    {
        localStorage.setItem('currenttabfile',id);
    }
    else if(type=='v')
    {
        localStorage.setItem('currenttabvideo',id);
    }
    else if(type=='i')
    {
        localStorage.setItem('currenttabvideo',id);
    }
    $.when(requestmethod(data, url)).then(function(res){
        
        if(type=='f')
        {
            $('.tabfiletitle').empty();
            $('.tabfiletitle').html('Files related to '+localStorage.getItem('currenttopicname'));
            if(res.status==true)
            {
            $('.tabfiledetail').empty();
            $('.tabfiledetail').html(res.html);
            }
            else
            {
                $('.tabfiledetail').empty();
            $('.tabfiledetail').html(res.message);

            }
        }
        else if(type=='v')
        {
            $('.tabvideotitle').empty();
            $('.tabvideotitle').html('Videos related to '+localStorage.getItem('currenttopicname'));
            if(res.status==true)
            {
            $('.tabvideodetail').empty();
            $('.tabvideodetail').html(res.html);
            }
            else
            {
                $('.tabvideodetail').empty();
                 $('.tabvideodetail').html(res.message);

            }
        }
        else if(type=='i')
        {
            $('.tabimagetitle').empty();
            $('.tabimagetitle').html('Images related to '+localStorage.getItem('currenttopicname'));
            if(res.status==true)
            {
            $('.tabimagedetail').empty();
            $('.tabimagedetail').html(res.html);
            }
            else
            {
                $('.tabimagedetail').empty();
                 $('.tabimagedetail').html(res.message);

            }
        }

    })
}

function previewselected(val,type,count)
{
    
    $('.prevnextbtn').hide();
    var cf=$('#cf_'+type+'_'+val);
    var title=cf.data('title');
    var src='<?=base_url();?>upload/content/'+cf.data('file');
    var html='';
    if(parseInt(count)>1)
        {
            if(parseInt(val)==0 && parseInt(val)<parseInt(count))
            {
                html="<a class='btn btn-info' href='javascript:void(0)' style='cursor:pointer;' onclick='previewselected("+parseInt(val+1)+","+type+','+parseInt(count)+")'>Next</a>";
            }
            else if(parseInt(val+1)==parseInt(count) )
            {
                html="<a class='btn btn-info' href='javascript:void(0)' style='cursor:pointer;' onclick='previewselected("+parseInt(val-1)+","+type+','+parseInt(count)+")'>Previous</a>";
            }
            else if(parseInt(val)>0 && parseInt(val)<parseInt(count) )
            {
                html="<a class='btn btn-info' href='javascript:void(0)' style='cursor:pointer;' onclick='previewselected("+parseInt(val-1)+","+type+','+parseInt(count)+")'>Previous</a>&nbsp;<a class='btn btn-info' href='javascript:void(0)' style='cursor:pointer;' onclick='previewselected("+parseInt(val+1)+","+type+','+parseInt(count)+")'>Next</a>";
            }
            
        }
    $('#myModalLabel').html(title);
    $('#mypreviewbody').empty();
    if(type=='1')
    {
        $('#mypreviewbody').html('<iframe id="mydocxiframe" style="width:100%;height:400px;" src="https://docs.google.com/viewer?url='+src+'&embedded=true" frameborder="0"></iframe>');
		$('#mydocxiframe').on('load', () => {
			$('.waittime').hide();
        });
        // $('.prevnextbtn').html(html);
		// $('.prevnextbtn').show();
        // $('#preview-modal').modal('show');

    }else if(type=='2')
    {
        $('.waittime').hide();

        src=cf.data('file');
        
        $('#mypreviewbody').html('<iframe width="750" height="450" src="'+src+'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
        
    }
    else if(type=='3')
    {
        $('.waittime').hide();

        src=cf.data('file');
        
        $('#mypreviewbody').html('<img style="width:100%" src="'+base_url+'upload/content/'+src+'"/>');
        
    }
    $('.prevnextbtn').html(html);
		$('.prevnextbtn').show();
        $('#preview-modal').modal('show');
   
        

}
function beginexercise(no,type)
{
    let url=base_url+"studentpanel/getexercise";
    let data={no,type,
        chapter:localStorage.getItem('currentchapter'),
        subject:localStorage.getItem('currentsubject'),
        class:localStorage.getItem('currentclass')
       
    };
    $.when(requestmethod(data, url)).then(function(res){
       
        if(type=='exercise')
        {
            if(res.status==true) 
            {
                localStorage.setItem('currentexercise','Y');
                $('.exerciseintro').hide();
                 $('.tabexercisedetail').empty();
                 $('.tabexercisedetail').html(res.html);
            }
            else
            {
                
                $('.tabexercisedetail').empty();
                 $('.tabexercisedetail').html('No any exercises.');

            }
                

        }
        else
        {
            if(res.status==true) 
            {
                localStorage.setItem('currentexercise','Y');
                $('.quizintro').hide();
                 $('.tabquizdetail').empty();
                 $('.tabquizdetail').html(res.html);
            }
            else
            {
                $('.tabquizdetail').empty();
                 $('.tabquizdetail').html('No any quizes.');

            }

        }

    });

}
function submit_answer(type)
{
    var url=base_url+"studentpanel/submitanswer";
    var data=$( "#answerform" ).serialize();
    $.when(requestmethod(data, url)).then(function(res){
        clearInterval(downloadTimer);
        localStorage.setItem('currentexercise','N');
       
        if(type=='e')
        {
                 $('.tabexercisedetail').empty();
                 $('.tabexercisedetail').html(res.message);
                 $('.exerciseintro').show();

        }
        else
        {
                 if(res.ispractise=='Y')
                    {
                        $('.infobody').html(res.reportable);
                        $('#infomodal').modal('show');
                    }
                  
                 $('.tabquizdetail').empty();
                 $('.tabquizdetail').html(res.message);
                 $('.quizintro').show();

        }

                


    });

}

function verifyans()
{
    var qn=$('#viewquizans').val();
    var url=base_url+"studentpanel/verifyanswer";
    var data={qn};
    $.when(requestmethod(data, url)).then(function(res){
        $('.tabequiztitle').html('Answers');
                $('.quizintro').hide();

                $('.tabquizdetail').empty();
                 $('.tabquizdetail').html(res.html);

    });
    
}
function restorequiz(type)
{
    $('.quizintro').show();
    $('.tabquizdetail').empty();


}
function explanation(qid)
{
    var url=base_url+"studentpanel/getexplanation";
    var data={qid};
    $.when(requestmethod(data, url)).then(function(res){
      $('.infotitle').text('Explanation');

        $('.infobody').html(res.html);
        $('#infomodal').modal('show');

    });  
}

function requestmethod(postdata, url) {
	
	return $.ajax({
		url: url,
		type: 'post',
		headers: {
			
		},		
		dataType: 'json',
		data: postdata,
		enctype: 'multipart/form-data'
	});
}
</script>