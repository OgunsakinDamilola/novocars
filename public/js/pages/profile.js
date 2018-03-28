$(function(){

   $('#update_customer_information').on('click',function(){
       buttonClicked('update_customer_information','Update Customer Information',1);
       var first_name       = $('input[name="customer_first_name"]').val();
       var last_name        = $('input[name="customer_last_name"]').val();
       var middle_name      = $('input[name="customer_middle_name"]').val();
       var phone_number     = $('input[name="customer_phone_number"]').val();
       var address          = $('textarea[name="customer_address"]').val();
       axios.post(baseUrl+'/update/user/profile',{
          customer_first_name   : first_name,
          customer_last_name    : last_name,
          customer_middle_name  : middle_name,
          customer_phone_number : phone_number,
          customer_address      : address
       })
           .then(function(response){
               buttonClicked('update_customer_information','Update Customer Information',0);
               toastr.success('Profile Information Updated Successfully');
               $('.customer_full_name').text(first_name+" "+middle_name+" "+last_name);
               console.log(response.data);
           })
           .catch(function(error){
               buttonClicked('update_customer_information','Update Customer Information',0);
               extractError(error);
           })
   });

   $('#update_password').on('click',function(){
       buttonClicked('update_password','Update',1);
       var password                = $('input[name="customer_new_password"]').val();
       var confirm_password        = $('input[name="customer_new_password_confirm"]').val();
      axios.post(baseUrl+"/update/user/password",{
          password              : password,
          password_confirmation : confirm_password
      })
          .then(function(response){
              buttonClicked('update_password','Update',0);
              toastr.success("Customer password uploaded successfully");
              console.log(response.data);
          })
          .catch(function(error){
              buttonClicked('update_password','Update',0);
              extractError(error);
          })
   });


   $('button[name="profile_upload"]').on('click',function(){
       buttonClicked('update_image','Update',1);
       var formData = new FormData();
       var imageFile = document.querySelector('#customer_profile_photo').files[0];
       formData.append('customer_profile_photo',imageFile);
       axios.post(baseUrl+'/updateProfile',formData ,{
           headers: {
               'Content-Type': 'multipart/form-data'
           }
       })
           .then(function(response){
               buttonClicked('update_image','Update',0);
               console.log(response.data);
               if(response.data == 0){
                   toastr.error("Sorry, unable to upload your profile photo");
               }else{
                   toastr.success("Profile image uploaded successfully");
                   $('#user_image').prop('src',baseUrl+"/"+response.data.profile_photo);
                   $('#customer_profile_photo').val("");
               }
           })
           .catch(function(error){
               buttonClicked('update_image','Update',0);
               extractError(error);
           })
   });
});