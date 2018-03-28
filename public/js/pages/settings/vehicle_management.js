$(function(){

    $('.edit_category').on('click',function(){
        var category_id = $(this).val();
        var name        = $('#name_'+category_id).text();
        $('#vehicle_category_id').val(category_id);
        $('#vehicle_category').val(name);
        $('#save_category').html('Edit');
        toastr.info('Vehicle category information populated');
    });

    $('.activate').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl + '/settings/activate/vehicle/'+id)
            .then(function(response){
                if(response.data == 1){
                    $('#type_status_'+id).html('<label class="label label-success"><i class="fa fa-check"></i> Active</label>');
                    toastr.success('Vehicle has been activated for booking');
                }else{
                    toastr.info('Unable to activate vehicle for booking');
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

    $('.deactivate').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl + '/settings/deactivate/vehicle/'+id)
            .then(function(response){
                if(response.data == 1){
                    $('#type_status_'+id).html('<label class="label label-danger"><i class="fa fa-times"></i> Not active</label>');
                    toastr.error('Vehicle has been deactivated');
                }else{
                    toastr.info('Unable to deactivate vehicle for booking');
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

});