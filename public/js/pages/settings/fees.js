$(function(){

    $('#save_driver_fee').on('click',function(){
       buttonClicked('save_driver_fee',' Save',1);
       var type_id = $('#fee_type_id').val();
       var value =   $('#driver_fee').val();
       axios.post(baseUrl+'/settings/save/driver/outstation/fee',{
           type_id : type_id,
           value   : value
       })
           .then(function(response){
               buttonClicked('save_driver_fee',' Save',0);
               $('#drivers_fees').html(value);
               toastr.success('Driver outstation fee has been changed successfully');
           })
           .catch(function(error){
               buttonClicked('save_driver_fee',' Save',0);
               extractError(error);
           })
   });

    $('.edit_daily_rental_rate').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl+'/settings/get/daily/rental/rate/'+id)
            .then(function(response) {
                // console.log(response.data);
                $('select[name="vehicle_type_id"]>option[value="'+response.data.vehicle_type_id+'"]').prop('selected', true);
                $('input[name="daily_rental_within_lagos_metropolis_with_fuel"]').val(response.data.daily_rental_within_lagos_metropolis_with_fuel);
                $('input[name="daily_rental_within_lagos_metropolis_without_fuel"]').val(response.data.daily_rental_within_lagos_metropolis_without_fuel);
                $('input[name="daily_rental_outside_lagos_metropolis_without_fuel"]').val(response.data.daily_rental_outside_lagos_metropolis_without_fuel);
                $('input[name="rate_per_extra_hour"]').val(response.data.rate_per_extra_hour);
                $('input[name="airport_pick_up_drop_off_main_land"]').val(response.data.airport_pick_up_drop_off_main_land);
                $('input[name="airport_pick_up_drop_off_island"]').val(response.data.airport_pick_up_drop_off_island);
                toastr.info('Vehicle daily rental booking information populated');
            })
            .catch(function(error){
                extractError(error);
            })

    });

    $('.activate_daily_rental_rate').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl + '/settings/activate/daily/rental/rate/'+id)
            .then(function(response){
                if(response.data == 1){
                    $('#status_daily_rental_rate_'+id).html('<label class="label label-success"><i class="fa fa-check"></i> Active</label>');
                    toastr.success('Daily rental booking for the vehicle has been activated for the vehicle');
                }else{
                    toastr.info('Unable to activate daily rental booking for the vehicle');
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

    $('.deactivate_daily_rental_rate').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl + '/settings/deactivate/daily/rental/rate/'+id)
            .then(function(response){
                if(response.data == 1){
                    $('#status_daily_rental_rate_'+id).html('<label class="label label-danger"><i class="fa fa-times"></i> Not active</label>');
                    toastr.error('Daily rental booking for the vehicle has been deactivated');
                }else{
                    toastr.info('Unable to deactivate daily rental booking for the vehicle');
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

    $('.edit_inter_state_rate').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl+'/settings/get/inter/state/booking/'+id)
            .then(function(response) {
                console.log(response.data);
                $('select[name="destination_state_id"]>option[value="'+ response.data.destination_state_id +'"]').prop('selected', true);
                $('select[name="vehicle_category_id"]>option[value="'+ response.data.vehicle_category_id +'"]').prop('selected', true);
                $('input[name="state_rental_rate_value"]').val(response.data.state_rental_rate_value);
                toastr.info('Inter state rental booking rate information populated');
            })
            .catch(function(error){
                extractError(error);
            })

    });

    $('.activate_inter_state_rate').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl + '/settings/activate/inter/state/booking/'+id)
            .then(function(response){
                if(response.data == 1){
                    $('#inter_state_booking_'+id).html('<label class="label label-success"><i class="fa fa-check"></i> Active</label>');
                    toastr.success('Inter state rental booking for the vehicle has been activated for the vehicle');
                }else{
                    toastr.info('Unable to activate inter state rental booking for the vehicle');
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

    $('.deactivate_inter_state_rate').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl + '/settings/deactivate/inter/state/booking/'+id)
            .then(function(response){
                if(response.data == 1){
                    $('#inter_state_booking_'+id).html('<label class="label label-danger"><i class="fa fa-times"></i> Not active</label>');
                    toastr.error('Inter state rental booking for the vehicle has been deactivated');
                }else{
                    toastr.info('Unable to deactivate inter state rental booking for the vehicle');
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

});