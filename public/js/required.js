$(function(){

    $("[data-toggle='tooltip']").tooltip();

    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

    $('.datepicker').datepicker({
        showClose        : true,
        autoclose        : true,
        minDate          : today,
        defaultDate      : today,
        startDate        : today,
        sideBySide       : true,
        toolbarPlacement : "top"
    });

    $('.datetimepicker').datetimepicker({
        showClose : true,
        showClear : true,
        sideBySide : true,
        autoclose  : true
    });

    $('.dataTable').dataTable({"bSort" : false});

    var loader = '<div class="progress">'+
        '<div class="indeterminate"></div>'+
        '</div>';


    $(".special_select").select2({
        placeholder: "Select an option",
        allowClear: true
    });


    $('input[name="start_date"]').on('change paste keyup',function(){

        var selected_date = $(this).val();
        $('input[name="end_date"]').val(selected_date);

        $('input[name="end_date"]').datepicker({
            showClose   : true,
            autoclose   : true,
            minDate     : selected_date,
            setDate     : selected_date,
            startDate   : selected_date,
            defaultDate : selected_date
        }).val(selected_date);

    });

});

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function validateFormWithIds(ids) {
    if (Array.isArray(ids))
    {
        for(var i=0; i<ids.length; i++)
        {
            var result = 0;
            if($("#"+ids[i]).val() == "" || $("#"+ids[i]).val() == null)
            {
                $("#"+ids[i]).css("border-color", "red");
                result++;
            }else{
                $("#"+ids[i]).css("border-color", "green");
            }
        }
        if (result > 0){
            toastr["error"]("Please fill all highlighted field(s)");
            return false;
        }
    }else if(typeof ids === 'string')
    {
        if($("#"+ids).val() == "" || $("#"+ids).val() == null)
        {
            $("#"+ids).css("border-color", "red");
        }
        toastr["error"]("Please fill the highlighted field");
        return false;
    }
    return true;
}

function validateFormWithClasses(classes) {
    if (Array.isArray(classes))
    {
        for(var i=0; i < classes.length; i++)
        {
            var result = 0;
            if(Array.isArray($("."+classes[i]))){
                for(var j=0; j < $("."+classes[i]).length; j++){
                    if($("."+classes[i][j]).val() == "" || $("."+classes[i][j]).val() == null)
                    {
                        $("."+classes[i][j]).css("border-color", "red");
                        result++;
                    }else{
                        $("."+classes[i][j]).css("border-color", "green");
                    }
                }
                if (result > 0){
                    toastr.error("Please fill all highlighted field(s)");
                    return false;
                }
            }else{
                if($("."+classes[i]).val() == "" || $("."+classes[i]).val() == null)
                {
                    $("."+classes[i]).css("border-color", "red");
                    result++;
                }else{
                    $("."+classes[i]).css("border-color", "green");
                }
            }

        }
        if (result > 0){
            toastr.error("Please fill all highlighted field(s)");
            return false;
        }
    }else if(typeof classes === 'string')
    {
        if(Array.isArray($("."+classes))){
            for(var k=0; k < $("."+classes).length; k++){
                if($("."+classes[k]).val() == "" || $("."+classes[k]).val() == null)
                {
                    $("."+classes[k]).css("border-color", "red");
                    toastr.error("Please fill all highlighted field(s)");
                    return false;
                }else{
                    $("."+classes).css("border-color", "green");
                }

            }
        }else{
            if($("."+classes).val() == "" || $("."+classes).val() == null)
            {
                $("."+classes).css("border-color", "red");
                toastr.error("Please fill all highlighted field(s)");
                return false;
            }else{
                $("."+classes).css("border-color", "green");
            }

        }
    }
    return true;
}

function buttonClicked(button_id,button_text,option){
    if(option === 1){
        var appendInfo = '<i class="fa fa-refresh fa-spin"></i> '+button_text;
        $('#'+button_id).html(appendInfo);
        $('#'+button_id).prop('disabled',true);
    }else if(option === 0){
        var appendInfo = button_text;
        $('#'+button_id).html(appendInfo);
        $('#'+button_id).prop('disabled',false);
    }

}

function buttonClassClicked(button_class,button_text,option){
    if(option === 1){
        var appendInfo = '<i class="fa fa-refresh fa-spin"></i> '+button_text;
        $('.'+button_class).html(appendInfo);
        $('.'+button_class).prop('disabled',true);
    }else if(option === 0){
        var appendInfo = button_text;
        $('.'+button_class).html(appendInfo);
        $('.'+button_class).prop('disabled',false);
    }

}

function extractError(error) {
    for(var error_log in error.response.data.errors) {
        var err = error.response.data.errors[error_log];
        toastr.error(err);
    }
}

function labelInfo(data){
    return '<label class="label label-info">'+data+'</label>';
}

function labelSuccess(data){
    return '<label class="label label-success">'+data+'</label>';
}

function labelWarning(data){
    return '<label class="label label-warning">'+data+'</label>';
}

function labelDanger(data){
    return '<label class="label label-danger">'+data+'</label>';
}
