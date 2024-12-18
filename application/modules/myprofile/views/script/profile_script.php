<script>
$(document).ready(function(){
   
    loaddata();

    
});
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#simage').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
            }


function loaddata()
{
    $('#profilewrapper').html('Loading your Info...');
    var url=base_url+"myprofile/getdetail";
    $.when(requestmethod({}, url)).then(function(res){
                $('#profilewrapper').empty();
                 $('#profilewrapper').html(res.html);

    });
}

function editmyprofile()
{ 
    var url=base_url+"myprofile/showmodal";
    $.when(requestmethod({}, url)).then(function(res){
                 $('.waittime').hide();
                $('#mypreviewbody').empty();
                 $('#mypreviewbody').html(res.html);
                 $('#addmodal').modal('show');


    });
}
function updatemyprofile()
{ 
    var file_data = $('#file').prop('files')[0];
    var user_verification_file = $('#verification_file_url').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('fname', $('#fname').val());
    form_data.append('cnum', $('#cnum').val());
    form_data.append('email', $('#email').val());
    form_data.append('address', $('#address').val());
    form_data.append('parent_detail', $('#parent_detail').val());
    form_data.append('parent_number', $('#parent_number').val());
    form_data.append('institution', $('#institution').val());
    form_data.append('citizenship', $('#citizenship').val());
    form_data.append('extra_information', $('#extra_information').val());
    form_data.append('language', $('#language').val());
    form_data.append('user_verification_file', user_verification_file);

    var url=base_url+"myprofile/updatemyprofile";
    $.when(requestmethod(form_data, url)).then(function(res){
                 $('#addmodal').modal('hide');
                 loaddata();


    });
}
function requestmethod(postdata, url) {
	
	return $.ajax({
		url: url,
		type: 'post',
		headers: {
			
		},		
		dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
		data: postdata,
		enctype: 'multipart/form-data'
	});
}
</script>