<script>
  var istemp = '<?= $istemp; ?>';
  var istrialsubscribed = '<?= $istrialsubscribed; ?>';

  $(document).ready(function (e) {
    if (istrialsubscribed == 'N' && istemp == 'Y') {
      $('#coursemodal').modal('show');
      $('#spackage').hide();

    }
  })
  function getclass() {
    $.ajax({
      url: '<?= base_url(); ?>subscription_course/getclass',
      type: 'POST',
      data: { levelid: $('#class').val() },
      success: function (response) {
        var response = jQuery.parseJSON(response);
        if (response.success == true) {
          $('#classid').empty();
          $('#classid').html(response.html);
        } else {
          $('#classid').empty();
          $('#classid').html(response.html);

          toastr.error(response.messages, { timeOut: 5000 })
        }
      }

    });
  }
  function getsubject() {
    $.ajax({
      url: '<?= base_url(); ?>subscription_course/getsubject',
      type: 'POST',
      data: { classid: $('#classid').val() },
      success: function (response) {
        var response = jQuery.parseJSON(response);
        $('#subjectid').empty();
        $('#subjectid').html(response.html);
      }

    });
  }
  function getpackage() {
    $.ajax({
      url: '<?= base_url(); ?>subscription_course/getpackagerate',
      type: 'POST',
      data: { subjectid: $('#subjectid').val() },
      success: function (response) {
        var response = jQuery.parseJSON(response);
        $('#package').empty();
        $('#package').html(response.html);
      }

    });

  }


  $('#btnsave').click(function (e) {
    purchasecourse();

  });

  function purchasecourse() {
    $.ajax({
      url: '<?= base_url(); ?>subscription_course/purchasecourse',
      type: 'POST',
      data: $("#subform").serialize(),
      success: function (resdata) {
        var response = jQuery.parseJSON(resdata);
        if (response.type == 'success') {
          // confirmsubscription(response.res);
          if (istrialsubscribed == 'N' && istemp == 'Y') {
            $('#coursemodal').modal('hide');

            $('#msg').html('Subscription Successfull');
            $('#successmodal').modal('show');
          }
          else {
            loadKhalti(response.res);

          }
        }
        else if (response.type == 'applyPromo') {
          $('#oldPriceDiv').css('display', 'block');
          $('#oldPrice').text(response.oldPrice);
          $('#newPriceDiv').css('display', 'block');
          $('#newPrice').text(response.newPrice);
          $('#applyPromoVal').val('N');
        }
        else {
          //alert(response.message);
          $('#errmsg').html(response.message);
          $('#errormodal').modal('show');
        }

      }

    });
  }

  function confirmsubscription(data) {
    $.ajax({
      url: '<?= base_url(); ?>subscription_course/confirmsubscribtion',
      type: 'POST',
      data: { levelid: data.levelid, classid: data.classid, subjectid: data.subjectid, package: data.package, amt: data.amt, txnid: data.txnid },
      success: function (response) {
        var response = jQuery.parseJSON(response);
        if (response.type == 'success') {
          //alert('success');
          $('#msg').html('Purchase Successfull');
          $('#successmodal').modal('show');
        }
        else {
          //alert('Couldnot Confirm Subscription.');
          $('#errmsg').html('Couldnot Confirm Subscription.');
          $('#errormodal').modal('show');
        }

      }

    });

  }
  function loadKhalti(data) {
    var newamt = parseFloat(data.amt) * 100;
    if (parseFloat(data.amt) < 10) // KHALTI MINIMUN TXN IS RS. 10 :: 
      newamt = 1000;

    var config = {
      // replace the publicKey with yours
      "publicKey": "live_public_key_70e761e3abb1432883c34621b6ce67f5",
      "productIdentity": data.txncode,
      "productName": "TryForLearn",
      "productUrl": "http://tryforlearn.com",
      "eventHandler": {
        onSuccess(payload) {
          // hit merchant api for initiating verfication
          //console.log(payload);
          updatetoken(data, payload.token, newamt);
        },
        onError(error) {
          // console.log(error);

        },
        onClose() {
          // console.log('widget is closing');
        }
      }
    };

    var checkout = new KhaltiCheckout(config);
    checkout.show({ amount: newamt });
  }
  function updatetoken(data, token, newamt) {
    var txnid = data.txnid;
    var url = "<?php echo base_url('subscription_course/updatetoken'); ?>";

    $.post(url, { txnid, token, newamt }, function (res) {
      var res = JSON.parse(res);
      // console.log(res);
      if (res.type == 'success') {
        verifykhaltitransaction(data, token, newamt);

      } else {
        // alert(res.message);
        $('#errmsg').html(response.message);
        $('#errormodal').modal('show');
      }
    });

  }
  function verifykhaltitransaction(data, token, amt) {
    var url = "<?php echo base_url('subscription_course/khaltiverify'); ?>";

    $.post(url, { token, amt }, function (res) {
      var res = JSON.parse(res);
      // console.log(res);
      var status = res.state;
      if (status.name.toLowerCase() == 'completed') {
        confirmsubscription(data);
      } else {
        $('#errmsg').html('Verification Failed');
        $('#errormodal').modal('show');
      }


    });

  }

  $(document).off('click', '#applyPromo');
  $(document).on('click', '#applyPromo', function () {
    $('#applyPromoVal').val('Y');
    purchasecourse();
  });


</script>