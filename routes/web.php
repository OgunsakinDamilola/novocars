<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(url('/book'));
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');

Route::post('/updateProfile','ProfileController@updateProfileImageJs');
Route::get('/book', 'BookingsController@index')->name('book-vehicle');
Route::post('/submit/booking','BookingsController@submitBooking')->name('submit-booking');
Route::get('/booking/information','BookingsController@bookingInformation');
Route::post('/payment/confirmation','BookingsController@paymentOnlineConfirmation');
Route::get('/payment/confirmation/{reference}','BookingsController@paymentOfflineConfirmation');
Route::get('/payment/booking/confirmation','BookingsController@paymentBookingConfirmation');

Route::get('/get/vehicle/type/{id}','SettingsController@getVehicleType');

Route::get('/manage/profile/information','ProfileController@index')->name('profile');
Route::get('/vehicle/bookings','BookingsController@vehicleBookings')->name('vehicle-bookings');
Route::get('/transaction/logs','BookingsController@transactionLogs')->name('transaction-logs');
Route::get('/booking/preview/{id}','BookingsController@bookingPreview');
Route::post('/update/user/profile','ProfileController@updateUserProfile')->name('update-profile');
Route::post('/update/user/image','ProfileController@updateUserProfileImage')->name('update-profile-image');
Route::post('/update/user/password','ProfileController@updateUserProfilePassword')->name('update-profile-password');
Route::post('/requery/payment/booking','BookingsController@requeryPaymentBooking');
Route::post('confirm/offline/payment','BookingsController@confirmOfflinePayment');
Route::post('decline/offline/payment','BookingsController@declineOfflinePayment');

Route::group(['prefix' => 'settings', 'middleware' => 'role:admin'],function(){

    Route::get('/add/destination/states','SettingsController@states')->name('states');
    Route::get('/activate/destination/state/{id}','SettingsController@activateState');
    Route::get('/deactivate/destination/state/{id}','SettingsController@deActivateState');

    Route::get('/add/edit/fees/and/rates','SettingsController@fees')->name('fees');
    Route::post('/save/driver/outstation/fee','SettingsController@driverOutStationFee');

    Route::get('/manage/vehicles/information','SettingsController@vehiclesManagement')->name('vehicles');
    Route::post('/add/new/vehicle/category','SettingsController@addVehicleCategory')->name('save-vehicle-category');

    Route::post('/add/new/vehicle/type','SettingsController@addNewVehicle')->name('add-new-vehicle-type');
    Route::post('/edit/vehicle/image','SettingsController@editVehicleImage')->name('edit-vehicle-image');
    Route::post('/edit/vehicle/information','SettingsController@editVehicleInformation')->name('edit-vehicle-information');
    Route::get('/activate/vehicle/{id}','SettingsController@activateVehicle');
    Route::get('/deactivate/vehicle/{id}','SettingsController@deActivateVehicle');

    Route::get('/booking/discounts','SettingsController@bookingDiscount')->name('discounts');
    Route::post('/save/booking/discounts/','SettingsController@saveBookingDiscounts')->name('save-discount');
    Route::get('/get/booking/discount/{id}','SettingsController@getBookingDiscount');
    Route::get('/activate/booking/discount/{id}','SettingsController@activateBookingDiscount');
    Route::get('/deactivate/booking/discount/{id}','SettingsController@deActivateBookingDiscount');

    Route::post('/save/daily/rental/rate','SettingsController@saveDailyRentalRate')->name('save-daily-rental-rate');
    Route::get('/activate/daily/rental/rate/{id}','SettingsController@activateDailyRentalRate');
    Route::get('/deactivate/daily/rental/rate/{id}','SettingsController@deActivateDailyRentalRate');
    Route::get('/get/daily/rental/rate/{id}','SettingsController@getDailyRentalRate');

    Route::post('/save/driver/outstation/allowance/fee','SettingsController@saveDriverOutStationAllowanceFee')->name('save-driver-out-station-allowance-fee');

    Route::post('save/inter/state/booking/rates','SettingsController@saveInterStateBookingRates')->name('save-inter-state-booking-rates');
    Route::get('/activate/inter/state/booking/{id}','SettingsController@activateInterStateBooking');
    Route::get('/deactivate/inter/state/booking/{id}','SettingsController@deActivateInterStateBooking');
    Route::get('/get/inter/state/booking/{id}','SettingsController@getInterStateBooking');

});


Route::post('customLogin','AuthController@login');


Route::post('customRegister','AuthController@addMember');

