$(function(){

    $('.activate').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl + '/settings/activate/destination/state/'+id)
            .then(function(response){
                if(response.data.status == 1){
                    $('#status_'+id).html('<label class="label label-success"><i class="fa fa-check"></i> Active</label>');
                    toastr.success('State activated successfully as a destination state');
                }else{
                    toastr.error('Unable to activate state');
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

    $('.deactivate').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl + '/settings/deactivate/destination/state/'+id)
            .then(function(response){
                if(response.data.status == 0){
                    $('#status_'+id).html('<label class="label label-danger"><i class="fa fa-times"></i> Not active</label>');
                    toastr.success('State has been deactivated');
                }else{
                    toastr.error('Unable to deactivate state');
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

});