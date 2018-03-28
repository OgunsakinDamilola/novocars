$(function(){

    $('.requery').on('click',function(){
       var reference = $(this).val();
       var row = $(this).closest('tr');
        $(row).find('.requery').prop('disabled',true);
       axios.post(baseUrl+'/requery/payment/booking',{
           reference : reference
       })
           .then(function(response){
               $(row).find('.requery').prop('disabled',false);
               if(response.data.payment_status == 0){
                   toastr.error(response.data.response_description);
               }else if(response.data.payment_status == 1){
                   toastr.success(response.data.response_description);
               }
               $('#response_code_'+reference).text(response.data.response_code);
               $('#response_description_'+reference).text(response.data.response_description);
           })
           .catch(function(error){
               $(row).find('.requery').prop('disabled',false);
               toastr.error('Sorry, Unable to run requery on this transaction');
               extractError(error);
           })
    });

    $('.confirm_payment').on('click',function(){
        var reference = $(this).val();
        var row = $(this).closest('tr');
        $(row).find('.confirm_payment,.decline_payment').prop('disabled',true);
        axios.post(baseUrl+'/confirm/offline/payment',{
            reference : reference
        })
            .then(function(response){
                $(row).find('.confirm_payment,.decline_payment').prop('disabled',false);
                if(response.data != 0){
                    toastr.info('Request successful');
                    if(response.data.payment_status == 1){
                        var info = labelSuccess('Successful');
                    }else if(response.data.payment_status == 0){
                        var info = labelDanger('Failed');
                    }else if(response.data.payment_status == 2){
                        var info = labelWarning('Pending');
                    }
                   $("#offline_payment_status_"+reference).html(info);
                }else{
                    toastr.error('Unable to confirm payment status');
                }
                console.log(response.data);
            })
            .catch(function(error){
                $(row).find('.confirm_payment,.decline_payment').prop('disabled',false);
                toastr.error('Sorry, unable to confirm payment. Slow internet');
                extractError(error);
            })

    });

    $('.decline_payment').on('click',function(){
        var reference = $(this).val();
        var row = $(this).closest('tr');
        $(row).find('.confirm_payment,.decline_payment').prop('disabled',true);
        axios.post(baseUrl+'/decline/offline/payment',{
            reference : reference
        })
            .then(function(response){
                $(row).find('.confirm_payment,.decline_payment').prop('disabled',false);
                if(response.data != 0){
                    toastr.info('Request successful');
                    if(response.data.payment_status == 1){
                        var info = labelSuccess('Successful');
                    }else if(response.data.payment_status == 0){
                        var info = labelDanger('Failed');
                    }else if(response.data.payment_status == 2){
                        var info = labelWarning('Pending');
                    }
                    $("#offline_payment_status_"+reference).html(info);
                }else{
                    toastr.error('Unable to confirm payment status');
                }
                console.log(response.data);
            })
            .catch(function(error){
                toastr.error('Sorry, unable to confirm payment. Slow internet');
                $(row).find('.confirm_payment,.decline_payment').prop('disabled',false);
                extractError(error);
            })

    });

});