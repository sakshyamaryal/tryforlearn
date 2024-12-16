<script>
    function delete_form(val)
    {
        url = "<?php echo base_url('package/delete') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{id:val},
                                beforeSend: function () {
                                    $('#loader').show();
                                },
                               

                                success: function (response) {
                                    var res = jQuery.parseJSON(response);

                                    if(res.status==true)
                                    { 
                                        location.reload();

                                    }
                                    $('#loader').hide();


                                }
                            });
    }
</script>