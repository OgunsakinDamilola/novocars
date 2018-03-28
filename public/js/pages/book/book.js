$(function(){
    var fuel = '<div class="form-group" id="fuel_option">\n' +
        '                                                        <div class="col-md-12">\n' +
        '                                                            <p class="text-main text-bold">Would you like us to fuel the car?</p>\n' +
        '                                                            <div class="checkbox pad-btm text-left">\n' +
        '                                                                <input type="radio" id="yes_fuel" class="magic-radio" name="fuel" value="1">\n' +
        '                                                                <label for="yes_fuel">Yes, I want the car fueled. <small>(Extra charges apply)</small></label>\n' +
        '\n' +
        '                                                                <input type="radio" id="no_fuel" class="magic-radio" name="fuel" checked value="0">\n' +
        '                                                                <label for="no_fuel">No, I don\'t want the car fueled</label>\n' +
        '\n' +
        '                                                                <input type="radio" class="hidden" name="fuel" value="2">\n' +
        '\n' +
        '                                                            </div>\n' +
        '                                                        </div>\n' +
        '                                                    </div>';

    var use_in_destination = '<div class="form-group" id="use_in_destination_option">\n' +
        '                                                        <div class="col-md-12">\n' +
        '                                                            <p class="text-main text-bold">Will you be using the vehicle within your destination town ?</p>\n' +
        '                                                            <div class="checkbox pad-btm text-left">\n' +
        '                                                                <input type="radio" id="yes_use_car" class="magic-radio" name="use_car" value="1">\n' +
        '                                                                <label for="yes_use_car">Yes, I will. <small>(Extra charges apply)</small></label>\n' +
        '\n' +
        '                                                                <input type="radio" id="no_use_car" class="magic-radio" name="use_car" checked value="0">\n' +
        '                                                                <label for="no_use_car">No, I will not</label>\n' +
        '\n' +
        '                                                                <input type="radio" class="hidden" name="use_car" required value="2">\n' +
        '\n' +
        '\n' +
        '                                                            </div>\n' +
        '                                                        </div>\n' +
        '                                                    </div>';

    var lagos_metropolis = '<div class="form-group" id="lagos_metropolis_option">\n' +
        '                                                        <div class="col-md-12">\n' +
        '                                                            <p class="text-main text-bold">Is your destination within Lagos Metropolis ?</p>\n' +
        '                                                            <div class="checkbox pad-btm text-left">\n' +
        '                                                                <input type="radio" id="within" class="magic-radio" name="within_lagos_metro" value="1">\n' +
        '                                                                <label for="within">Yes</label>\n' +
        '\n' +
        '                                                                <input type="radio" id="not_within" class="magic-radio" name="within_lagos_metro" checked value="0">\n' +
        '                                                                <label for="not_within">No </label>\n' +
        '\n' +
        '                                                                <input type="radio" class="hidden" name="within_lagos_metro" value="2">\n' +
        '                                                            </div>\n' +
        '                                                        </div>\n' +
        '                                                    </div>';

    var destination_location = '<div class="form-group" id="destination_location">\n' +
        '                                                        <label>Enter the location within lagos</label>\n' +
        '                                                        <input type="text" value="Ikeja" class="form-control" name="destination_location"/>\n' +
        '                                                    </div>';



    $('select[name="vehicle_type"]').on('change',function(){
        var id = $(this).val();
        axios.get(baseUrl +'/get/vehicle/type/'+id)
            .then(function(response){
               console.log(response.data);
               $('#vehicle_image').attr('src', baseUrl+response.data.image_path);
            })
            .catch(function(error){
                extractError(error);
            });
    });

    $('select[name="destination_state_id"]').on('change',function(){
        var id = $(this).val();
        if(id == 24){
            $('#all_options').append(fuel);

            $('#use_in_destination_option').fadeOut('slow',function(){
                $(this).remove();
            });
            $('#all_options').append(lagos_metropolis);

            $('#all_options').append(destination_location);

        }else if(id != 24){
            $('#fuel_id').fadeOut('slow',function(){
                $(this).remove();
            });
            $('#all_options').append(use_in_destination);

            $('#lagos_metropolis_option').fadeOut('slow',function(){
                $(this).remove();
            })
            $('#within_lagos_metro').fadeOut('slow',function(){
                $(this).remove();
            })
            $('#destination_location').fadeOut('slow',function(){
                $(this).remove();
            })
        }
    });

    $('#show_register_form').on('click',function(){
        $('#register_field').fadeIn('slow',function(){
           $(this).toggleClass('hidden');
        });
    });

    $('#login_button').on('click',function(){
        buttonClicked('login_button','Login',1);
        var email = $('input[name="login_email"]').val();
        var password = $('input[name="login_password"]').val();

        axios.post(baseUrl+'/customLogin',{
            email     : email,
            password  : password
        })
            .then(function(response){
                buttonClicked('login_button','Login',0);
              console.log(response.data);
              if(response.data === false){
                  toastr.error('Incorrect login details. Please try again');
              }else{
                  toastr.success('Login Successful.');
                  $('#login_field').fadeIn('slow',function(){
                      $(this).remove();
                  });
                  $('#register_field').fadeIn('slow',function(){
                      $(this).remove();
                  });
                  $('#agree_field').removeClass('hidden');
              }
            })
            .catch(function(error){
                buttonClicked('login_button','Login',0);
               extractError(error);
            })
    });

    $('#register_button').on('click',function(){
        buttonClicked('register_button','Register',1);
        var first_name   = $('input[name="register_first_name"]').val();
        var middle_name  = $('input[name="register_middle_name"]').val();
        var last_name    = $('input[name="register_last_name"]').val();
        var email        = $('input[name="register_email"]').val();
        var phone        = $('input[name="register_phone_number"]').val();

        axios.post(baseUrl+'/customRegister',{
            first_name   : first_name,
            middle_name  : middle_name,
            last_name    : last_name,
            email        : email,
            phone_number : phone
        })

            .then(function(response){
                buttonClicked('register_button','Register',0);
                console.log(response.data);
                if(response.data === false){

                }else{
                    toastr.success('Your registration was successful and you have been logged in successfully.');
                    $('#login_field').fadeIn('slow',function(){
                        $(this).remove();
                    });
                    $('#register_field').fadeIn('slow',function(){
                        $(this).remove();
                    });
                    $('#agree_field').removeClass('hidden');
                }
            })

            .catch(function(error){
                buttonClicked('register_button','Register',0);
                extractError(error);
            })
    });

});