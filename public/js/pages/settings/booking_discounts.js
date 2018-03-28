$(function(){

    $('.activate').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl + '/settings/activate/booking/discount/'+id)
            .then(function(response){
                if(response.data == 1){
                    $('#status_'+id).html('<label class="label label-success"><i class="fa fa-check"></i> Active</label>');
                    toastr.success('Booking discount activated successfully');
                }else{
                    toastr.error('Unable to activate booking discount');
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

    $('.deactivate').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl + '/settings/deactivate/booking/discount/'+id)
            .then(function(response){
                if(response.data == 1){
                    $('#status_'+id).html('<label class="label label-danger"><i class="fa fa-times"></i> Not active</label>');
                    toastr.success('Booking discount deactivated');
                }else{
                    toastr.error('Unable to deactivate booking discount');
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

    $('.edit').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl+'/settings/get/booking/discount/'+id)
            .then(function(response){
                console.log(response.data);
                $('#discount_id').val(response.data.id);
                $('#booking_days').val(response.data.days);
                $('#discount_value').val(response.data.value);
                toastr.info('Discount info populated');
            })
            .catch(function(error){
                extractError(error);
            })
    });

});