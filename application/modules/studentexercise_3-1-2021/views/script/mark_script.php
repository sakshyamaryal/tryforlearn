<script>
$( "#marksform" ).submit(function( event ) {
     
     event.preventDefault();
    
                  $.ajax({
                     url: '<?= base_url(); ?>studentexercise/updatemark',
                     type: 'POST',
                     data: $( "#marksform" ).serialize(),
                     beforeSend: function () {
                                    $('#loader').show();
                                },
                     success: function (res) {
                        $('#loader').hide();
                        let response=jQuery.parseJSON(res);
							if (response.type == 'success') {
                                toastr.success(response.message, {timeOut: 5000})

							} else {
								toastr.error(response.message, {timeOut: 5000})
                             
							}
                     }

                 });

     });
</script>