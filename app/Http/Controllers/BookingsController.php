<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BookingDiscount;
use App\BookingPaymentInformation;
use App\DailyRentalRate;
use App\DriverFee;
use App\InterStateBookingRate;
use App\Mail\BookingPending;
use App\Mail\BookingSuccessful;
use App\Mail\FailedPayment;
use App\Mail\SuccessfulPayment;
use App\OfflinePayment;
use App\OnlinePayment;
use App\Services\InterswitchConfig;
use App\VehicleCategory;
use App\VehicleType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use nilsenj\Toastr\Facades\Toastr;
use App\User;

class BookingsController extends Controller
{

    public function __construct(){
        $this->InterswitchConfig = new InterswitchConfig();
    }

    public function index(){

        $inter_state_booking_rates = InterStateBookingRate::where('status' , 1)->get();
        $sort_s_b_r = $inter_state_booking_rates->toArray();
        $available_states = array_values(array_unique(array_column($sort_s_b_r, 'destination_state_id')));
        $driver_fee = DriverFee::find(1)->value;
        $daily_rates = DailyRentalRate::all();
        return view('pages.book.book',compact('inter_state_booking_rates','available_states','driver_fee','daily_rates'));
    }

    public function submitBooking(Request $r){

           if(auth()->guest()){
                 if (Auth::attempt([
                     'email'    => $r->login_email,
                     'password' => $r->login_password
                 ])
                 ){
                     session([
                         'email' => $r->login_email
                     ]);
                     Toastr::success("Login Successful");
                 }else{
                     Toastr::error("Sorry, your login information does not match");
                     return redirect(url('/book'));
                 }
             }

           $save = Booking::store($r->toArray());

           $driver_outstation_allowance = 0;
           $vehicle_type = $save->vehicle_type_id;
           $driver_fee = DriverFee::find(1)->value;
           $date_diff = strtotime($save->end_date) - strtotime($save->start_date);
           $discount = 0;
           $duration = round($date_diff / (60*60*24)) + 1;
           $find_discount = BookingDiscount::where('days',$duration)
               ->where('status',1)
               ->first();

           if(!is_null($find_discount) || !empty($find_discount)){
               $discount = $find_discount->value;
           }

            $daily_rental_rate_amount = 0;

            $daily_rental_rates = DailyRentalRate::where('vehicle_type_id',$vehicle_type)->first();
            if(($save->within_lagos_metro == 1) && ($save->fuel == 1) ){
                $daily_rental_rate = $daily_rental_rates->daily_rental_within_lagos_metropolis_with_fuel;
            }
            elseif(($save->within_lagos_metro == 1) && ($save->fuel == 0) ){
                $daily_rental_rate = $daily_rental_rates->daily_rental_within_lagos_metropolis_without_fuel;
            }
            elseif($save->within_lagos_metro == 0){
                $daily_rental_rate = $daily_rental_rates->daily_rental_outside_lagos_metropolis_without_fuel;
            }

            $driver_outstation_allowance = ($duration - 1) * $driver_fee;

           $vehicle_state_price = 0;
           if($save->destination_state_id != 24){
               $vehicle_category = VehicleType::find($save->vehicle_type_id)->category_id;
               $vehicle_state_price = InterStateBookingRate::where('destination_state_id',$save->destination_state_id)
                   ->where('vehicle_category_id',$vehicle_category)
                   ->first()->state_rental_rate_value;
               if($save->use_car == 1){
                   $daily_rental_rate_amount = $daily_rental_rate * ($duration - 1);
               }
               else{
                   $daily_rental_rate_amount = 0;
               }
           }
           else{
               if($duration > 1){
                   $vehicle_state_price = $daily_rental_rate;
                   $daily_rental_rate_amount = $daily_rental_rates->daily_rental_within_lagos_metropolis_without_fuel * ($duration - 1);
               }else{
                   $vehicle_state_price = 0;
                   $daily_rental_rate_amount = $daily_rental_rates->daily_rental_within_lagos_metropolis_without_fuel * $duration;
               }
           }

          $total_amount = ($driver_outstation_allowance + $vehicle_state_price + $daily_rental_rate_amount) - $discount;
          $data = [
               'driver_outstation_fee'         => $driver_outstation_allowance,
               'duration'                      => $duration,
               'vehicle_state_price'           => $vehicle_state_price,
               'daily_rental_rate_amount'      => $daily_rental_rate_amount,
               'discount'                      => $discount,
               'total_amount'                  => $total_amount,
               'booking_id'                    => $save->id
          ];
          $transaction_amount = ($total_amount * 100);
          $redirect_url = url('/payment/confirmation');
          $reference = str_random('6');
          $hash = $this->InterswitchConfig->transactionHash($reference,$transaction_amount,$redirect_url,$save->id);
          $booking_payment_information = BookingPaymentInformation::store($data);
          $transactionInfo = [
             'item_id'      => $this->InterswitchConfig->item_id,
             'product_id'   => $this->InterswitchConfig->product_id,
             'redirect_url' => $redirect_url,
             'amount'       => $transaction_amount,
             'hash'         => $hash,
             'action_url'   => $this->InterswitchConfig->requestActionUrl,
             'reference'    => $reference,
             'booking_id'   => $save->id
          ];
          session()->put('transactionInfo',$transactionInfo);
          return redirect(url('/booking/information'));
    }

    public function bookingInformation(){

        $transactionInfo = session()->get('transactionInfo');
        $bookingInfo = Booking::find($transactionInfo['booking_id']);
        $bookingPaymentInfo = BookingPaymentInformation::where('booking_id',$transactionInfo['booking_id'])->first();
        return view('pages.book.booking_summary',compact('transactionInfo','bookingInfo','bookingPaymentInfo'));

    }

    public function paymentOnlineConfirmation(Request $r){
        if(isset($_POST['txnref'])){
            $txnRef = $_POST['txnref'];
            $transactionInfo = OnlinePayment::where('reference',$txnRef)->first();
            if(empty($transactionInfo) || is_null($transactionInfo)){
                $transactionStatus = [
                    'booking_id' => 0,
                    'email' => '0',
                    'reference' => $txnRef,
                    'amount'    => $transactionInfo->amount,
                    'response_code' => 00,
                    'response_description' => "Transaction with this transaction reference is not found in out database",
                    'response_full' => '0',
                    'payment_status' => 0,
                ];
            }
            else{
                $userInfo = auth()->user();
                $transactionStatus = $this->InterswitchConfig->requery($txnRef,$transactionInfo->amount);
                $transactionStatus['email'] = $userInfo->email;
                $bookingPaymentInfo = BookingPaymentInformation::where('booking_id',$transactionInfo->booking_id)->first();
                OnlinePayment::store($transactionStatus);

                $bookingInfo = Booking::find($transactionInfo->booking_id);

                if($transactionStatus['payment_status'] == 1){
                    $bookingInfo->payment_status = 1;
                    $bookingInfo->update();
                    $bookingPaymentInfo->payment_status = 1;
                    $bookingPaymentInfo->update();
                    try{

                        Mail::to($userInfo)->send(new SuccessfulPayment($userInfo,$transactionStatus));
                    }
                    catch(Exception $e){
                        Toastr::info('Your payment was successful but we are unable to send you a payment success email');
                    }
                    try{
                        Mail::to($userInfo)->send(new BookingSuccessful($userInfo,$bookingInfo,$bookingPaymentInfo));
                    }
                    catch(Exception $e){
                        Toastr::info('Could not sen email containing booking information, visit your booking page for more info');
                    }

                }elseif($transactionStatus['payment_status'] == 0){
                    try{
                        Mail::to($userInfo)->send(new FailedPayment($userInfo,$transactionStatus));
                    }
                    catch(Exception $e){
                        Toastr::error('Your payment failed and we could not send an email containing the details to you');
                    }
                }
            }
        }
        else{
            $transactionStatus = [
                'email' => '0',
                'booking_id' => 0,
                'amount'    => 0,
                'reference' => 0,
                'status' => 0,
                'response_code' => 00,
                'response_description' => "Transaction reference can not be empty",
                'response_full' => '0',
                'payment_status' => 0,
            ];
        }
        session()->put('transactionStatus',$transactionStatus);
        return redirect(url('/payment/booking/confirmation'));
    }

    public function paymentOfflineConfirmation($reference){
        $transactionInfo = OnlinePayment::where('reference',$reference)->first();
        $userInfo = auth()->user();
        $bookingInfo = Booking::find($transactionInfo->booking_id);
        $bookingPaymentInfo = BookingPaymentInformation::where('booking_id',$transactionInfo->booking_id)->first();
        $transactionStatus = [
            'booking_id' => $transactionInfo->booking_id,
            'email' => '0',
            'reference' => $reference,
            'amount'    => $transactionInfo->amount,
            'response_code' => 00,
            'response_description' => "Booking on hold, booking will be confirmed upon manual confirmation of user's payment",
            'response_full' => '0',
            'payment_status' => 2,
        ];
        OfflinePayment::store($transactionStatus);
        $transactionInfo = OnlinePayment::where('reference',$reference)->delete();
        try{
            Mail::to($userInfo)->send(new BookingPending($userInfo,$bookingInfo,$bookingPaymentInfo));
        }catch(Exception $e){
            Toastr::error("Unable to send pending booking email");
        }
        session()->put('transactionStatus',$transactionStatus);
        return redirect(url('/payment/booking/confirmation'));
    }

    public function paymentBookingConfirmation(){

        $transactionStatus = session()->get('transactionStatus');
        $transactionInfo = session()->get('transactionInfo');
        $bookingInfo = Booking::find($transactionInfo['booking_id']);
        $bookingPaymentInfo = BookingPaymentInformation::where('booking_id',$transactionInfo['booking_id'])->first();
        return view('pages.book.booking_end',compact('transactionInfo','bookingInfo','bookingPaymentInfo','transactionStatus'));

    }

    public function vehicleBookings(){
        return view('pages.bookings.bookings');
    }

    public function transactionLogs(){
        $userOnlinePayments = OnlinePayment::where('user_id',auth()->user()->id)
            ->where('payment_status','!=','2')
            ->get();
        $userOfflinePayments = OfflinePayment::where('user_id',auth()->user()->id)->get();
        return view('pages.others.transaction_logs',compact('userOnlinePayments','userOfflinePayments'));
    }

    public function bookingPreview($id){
        $bookingInfo = Booking::find($id);
        $bookingPaymentInfo = BookingPaymentInformation::where('booking_id',$id)->first();
        $redirect_url = url('/payment/confirmation');
        $reference = str_random('6');
        $transaction_amount = $bookingPaymentInfo->total_amount * 100;
        $hash = $this->InterswitchConfig->transactionHash($reference,$transaction_amount,$redirect_url,$id);
        $transactionInfo = [];
        if($bookingInfo->payment_status != 1){
            if(strtotime($bookingInfo->start_date) > strtotime(date('Y-m-d'))){
            $transactionInfo = [
                'item_id'      => $this->InterswitchConfig->item_id,
                'product_id'   => $this->InterswitchConfig->product_id,
                'redirect_url' => $redirect_url,
                'amount'       => $transaction_amount,
                'hash'         => $hash,
                'action_url'   => $this->InterswitchConfig->requestActionUrl,
                'reference'    => $reference,
                'booking_id'   => $id
            ];
            }
        }
        return view('pages.book.booking_preview',compact('bookingInfo','bookingPaymentInfo','transactionInfo'));
    }

    public function requeryPaymentBooking(Request $r){
        $txnRef = $r->reference;
        $transactionInfo = OnlinePayment::where('reference',$txnRef)->first();
        if(empty($transactionInfo) || is_null($transactionInfo)){
            $transactionStatus = [
                'booking_id' => 0,
                'email' => '0',
                'reference' => $txnRef,
                'amount'    => $transactionInfo->amount,
                'response_code' => 00,
                'response_description' => "Transaction with this transaction reference is not found in out database",
                'response_full' => '0',
                'payment_status' => 0,
                'user_id'        => '0'
            ];
        }
        else{
            $userInfo = auth()->user();
            $transactionStatus = $this->InterswitchConfig->requery($txnRef,$transactionInfo->amount);
            $transactionStatus['email'] = $userInfo->email;
            $bookingPaymentInfo = BookingPaymentInformation::where('booking_id',$transactionInfo->booking_id)->first();
            OnlinePayment::store($transactionStatus);

            $bookingInfo = Booking::find($transactionInfo->booking_id);

            if($transactionStatus['payment_status'] == 1){
                $bookingInfo->payment_status = 1;
                $bookingInfo->update();
                $bookingPaymentInfo->payment_status = 1;
                $bookingPaymentInfo->update();
                try{

                    Mail::to($userInfo)->send(new SuccessfulPayment($userInfo,$transactionStatus));
                }
                catch(Exception $e){
                    Toastr::info('Your payment was successful but we are unable to send you a payment success email');
                }
                try{
                    Mail::to($userInfo)->send(new BookingSuccessful($userInfo,$bookingInfo,$bookingPaymentInfo));
                }
                catch(Exception $e){
                    Toastr::info('Could not send email containing booking information, visit your booking page for more info');
                }

            }elseif($transactionStatus['payment_status'] == 0){
                try{
                    Mail::to($userInfo)->send(new FailedPayment($userInfo,$transactionStatus));
                }
                catch(Exception $e){
                    Toastr::error('Your payment failed and we could not send an email containing the details to you');
                }
            }
        }
        return json_encode($transactionStatus,true);
    }

    public function confirmOfflinePayment(Request $r){
       $reference = $r->reference;
       $payment = OfflinePayment::where('reference',$reference)->first();
       $payment->payment_status = 1;
       $updatePayment = $payment->update();
       $bookingInfo = Booking::find($payment->booking_id);
       $userInfo = User::find($bookingInfo->user_id);
       $bookingPaymentInfo = BookingPaymentInformation::where('booking_id',$bookingInfo->id)->first();
       $bookingInfo->payment_status = 1;
       $updateBooking = $bookingInfo->update();
       if($updateBooking && $updatePayment){
           try{
               Mail::to($userInfo)->send(new BookingSuccessful($userInfo,$bookingInfo,$bookingPaymentInfo));
           }
           catch(Exception $e){
               Toastr::info('Could not send email containing booking information, visit your booking page for more info');
           }
           return $payment;
       }else{
           return 0;
       }
    }

    public function declineOfflinePayment(Request $r){
        $reference = $r->reference;
        $payment = OfflinePayment::where('reference',$reference)->first();
        $payment->payment_status = 0;
        $updatePayment = $payment->update();
        $bookingInfo = Booking::find($payment->booking_id);
        $bookingInfo->payment_status = 0;
        $updateBooking = $bookingInfo->update();
        if($updateBooking && $updatePayment){
            return $payment;
        }else{
            return 0;
        }
    }

}
