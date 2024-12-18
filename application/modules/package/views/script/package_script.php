<script>
    function delete_form(val)
    {
        let checkedValues = [];
        $('.rowCheckBox').each(function () {
        if ($(this).is(':checked')) {
            checkedValues.push($(this).closest("td").next("td").text());
        }
        });

        if(!val){
            data = checkedValues;
        }
        else{
            data = val;
        }
        url = "<?php echo base_url('package/delete') ?>";
                            $.ajax({
                                type: 'post',
                               
                                url: url,
                                data:{id:data},
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

    $(document).off('click', '#selectAllCheckbox').on('click', '#selectAllCheckbox', function () {
        const isChecked = $(this).is(":checked");

        $(".rowCheckBox").each(function () {
            $(this).prop("checked", isChecked);
        });
    });

    $(document).off('click', '#delete').on('click', '#delete', function () {
        delete_form(false);
    });
</script>