
<script>
function get_program(id)
{
    let pid=$('#pid'+id).val();
    if(pid=='-1')
    {
        $('.modal-title').html("Error");
                                        let html="<div class='alert alert-danger'>Please Select First</div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 1500);
        
    }
    $('#spid'+id).hide();
    $('#cpid'+id).hide();
    $('#scpid'+id).hide();
    $('#unicid'+id).hide();
    
    url = "<?php echo base_url('studentregister/get_program') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{pid,id},
                               
                               

                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    console.log(res);

                                    if(res.status==true)
                                    { 
                                        $('#spid'+id).html(res.html);
                                    }
                                    $('#spid'+id).show();
    
                                }
                            });
   
}
function get_class(id)
{
    let fid=$('#pid'+id).val();
    let pid=$('#sid'+id).val();
    if(pid=='-1' )
    {
        $('.modal-title').html("Error");
                                        let html="<div class='alert alert-danger'>Please Select First</div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 1500);
        
    }
   
    url = "<?php echo base_url('studentregister/get_sprogram') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{fid,pid,id},
                               
                               

                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    console.log(res);

                                    if(res.status==true)
                                    { 
                                        $('#cpid'+id).html(res.html);
                                    }
                                   $('#cpid'+id).show();
    
                                }
                            });
   
}
function get_course(id)
{
    let fid=$('#pid'+id).val();
    let pid=$('#sid'+id).val();
    let scid=$('#scid'+id).val();
    
    if(pid=='-1')
    {
        $('.modal-title').html("Error");
                                        let html="<div class='alert alert-danger'>Please Select Correct</div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 1500);
        
    }
    else if(fid=='SCH' || fid=='REA')
    {
        return false;
    }
  
    url = "<?php echo base_url('studentregister/get_scprogram') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{scid,id},
                               
                               

                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    console.log(res);

                                    if(res.status==true)
                                    { 
                                        $('#scpid'+id).html(res.html);
                                    }
                               
                                    $('#scpid'+id).show();
                                }
                            });
   
}
function get_uni_subj(id)
{
    
    let scid=$('#cuniid'+id).val();
    
    if(scid=='-1')
    {
        $('.modal-title').html("Error");
                                        let html="<div class='alert alert-danger'>Please Select Correct</div>"
                                        $('.modal-body').html(html);
                                        $('#infomodal').modal('toggle');
                                        $('#infomodal').modal('show');
                                        setTimeout(function(){
                                        $('#infomodal').modal('hide');
                                        }, 1500);
        
    }
   
    url = "<?php echo base_url('studentregister/get_unisubprogram') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{scid,id},
                               
                               

                                success: function (response) {
                                    var res = jQuery.parseJSON(response);
                                    console.log(res);

                                    if(res.status==true)
                                    { 
                                        $('#unicid'+id).html(res.html);
                                    }
                       
                                $('#unicid'+id).show();
                                }
                            });
   
}





</script>