<script>

function submit_answer(type)
{
    var url=base_url+"studentpanel/submitanswer";
    var data=$( "#answerform" ).serialize()+'&from=exam';
    $.when(requestmethod(data, url)).then(function(res){
        clearInterval(downloadTimer);
        localStorage.setItem('currentexercise','N');
       
        if(type=='e')
        {
            $('#examwrapper').empty();
            $('#examwrapper').html(res.message);

        }
        else
        {
                $('#examwrapper').empty();
                 $('#examwrapper').html(res.message);

        }

                


    });

}

function verifyans()
{
    var qn=$('#viewquizans').val();
    var url=base_url+"studentpanel/verifyanswer";
    var data={qn};
    $.when(requestmethod(data, url)).then(function(res){
        $('#examwrapper').empty();
         $('#examwrapper').html(res.html);

    });
    
}
function restorequiz(type)
{
    location.href=base_url+'/myexam';


}
function getexam(id)
{
    var date=$('.getexam'+id).data('val');
    var is_subj=$('.getexam'+id).data('issubj');
    var classid=$('.getexam'+id).data('classid');
    var subject=$('.getexam'+id).data('subjectid');
    var chapter=$('.getexam'+id).data('chapterid');
    var level=$('.getexam'+id).data('levelid');
    var examtypeid=$('.getexam'+id).data('examtypeid');

    var url=base_url+"myexam/getquestion";
    var data={date,is_subj,class:classid,subject,chapter,level,examtypeid};
    $.when(requestmethod(data, url)).then(function(res){
        
    $('#examwrapper').empty();
    $('#examwrapper').html(res.html);
               

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