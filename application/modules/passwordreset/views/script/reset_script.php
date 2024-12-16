<script>
function update()
{

   
    let password=$('#password').val();
    let repassword=$('#repassword').val();
    
    if(password == "" || repassword == "" )
    {
        $('.modal-title').html("Error");
        let html="<div class='alert alert-danger'>Please Input All Fields</div>"
        $('.modal-body').html(html);
        $('#infomodal').modal('toggle');
        $('#infomodal').modal('show');
        setTimeout(function(){
        $('#infomodal').modal('hide');
        }, 1250);
    }
    else if(password != repassword)
    {
        $('.modal-title').html("Error");
        let html="<div class='alert alert-danger'>Password donot Match</div>"
        $('.modal-body').html(html);
        $('#infomodal').modal('toggle');
        $('#infomodal').modal('show');
        setTimeout(function(){
        $('#infomodal').modal('hide');
        }, 1250);

    }
    else
    {
        url = "<?php echo base_url('passwordreset/update') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{password,repassword},
                               
                               
                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    if(res.status==true)
                                    { 
                                        $('.modal-title').html("Success");
                                        let html="<div class='alert alert-success'>"+res.message+"</div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 2000);
                                        
                                      
                                    }
                                    else if(res.status==false)
                                    {
                                        $('.modal-title').html("Error");
                                        let html="<div class='alert alert-danger'>"+res.message+"</div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 1500); 
                                    }
                                    else
                                    {
                                        $('.modal-title').html("Error");
                                        let html="<div class='alert alert-danger'>Network Error</div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 1500);
                                    }
                                }
                            });
    }
}


</script>