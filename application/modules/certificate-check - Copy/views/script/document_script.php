<script>
    function check_document()
    {
        let dn=$('#dn').val();
        let dob=$('#dob').val();
        let ed=$('#ed').val();
        url = "<?php echo base_url('checkdocument/check') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{dn,dob,ed},
                               
                               
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
                                        $('#showfile').html('<a href="<?= base_url();?>upload/document/'+res.file+'" download><i class="fa fa-download"></i> Download Here.</a><br><br/>');
                                        
                                      
                                    }
                                    else if(res.status==false)
                                    {  $('#showfile').html('');

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
                                        $('#showfile').html('');
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
</script>