<?php

namespace App\Http\Controllers;

use App\BookingDiscount;
use App\DailyRateTypes;
use App\DailyRentalRate;
use App\DestinationState;
use App\DriverFee;
use App\Fee;
use App\FeeType;
use App\InterStateBookingRate;
use App\State;
use App\VehicleCategory;
use App\VehicleType;
use Illuminate\Http\Request;
use nilsenj\Toastr\Facades\Toastr;

class SettingsController extends Controller
{
    public function states(){
        $states = State::all();
        return view('pages.settings.states',compact('states'));
    }

    public function activateState($id){
        $state = State::find($id);
        $state->status = 1;
        $state->update();
        return $state;
    }

    public function deActivateState($id){
        $state = State::find($id);
        $state->status = 0;
        $state->update();
        return $state;
    }

    public function fees(){
        $available_states = State::where('status',1)->get();
        $vehicle_categories = VehicleCategory::all();
        $vehicle_types      = VehicleType::all();
        $daily_rate_types   = DailyRateTypes::all();
        $daily_rental_rates = DailyRentalRate::all();
        $driver_fee  = DriverFee::find(1);
        $inter_state_booking_rates = InterStateBookingRate::all();
        return view('pages.settings.fees',compact('available_states','vehicle_categories','vehicle_types','daily_rate_types','daily_rental_rates','driver_fee','inter_state_booking_rates'));
    }

    public function driverOutStationFee(Request $r){
        $fee = Fee::store($r);
        return $fee;
    }

    public function vehiclesManagement(){
        $vehicle_categories = VehicleCategory::all();
        $vehicle_types      = VehicleType::all();
        return view('pages.settings.vehicle_management',compact('vehicle_categories','vehicle_types'));
    }

    public function addVehicleCategory(Request $r){
       $save = VehicleCategory::store($r);
       if($save){
           Toastr::success('Vehicle category saved successfully');
       }else{
          Toastr::error('Could not save or update vehicles category');
       }
       return back();
    }

    public function addNewVehicle(Request $r){
       $save = VehicleType::store($r);
       if($save){
           Toastr::success("New vehicle added successfully");
       }else{
           Toastr::error('Sorry, Unable to add new vehicle');
       }
       return back();
    }

    public function editVehicleImage(Request $r){
        $image = $r->file('new_vehicle_image');
        $imageName = time().$image->getClientOriginalName();
        $image_path = '/images/gallery/vehicles/'.$imageName;
        $image->move(public_path('/images/gallery/vehicles/'),$imageName);
        $vehicle_type = VehicleType::find($r->vehicle_id);
        $vehicle_type->image_path = $image_path;
        $update =$vehicle_type->update();
        if($update){
            Toastr::success('Vehicle image updated successfully');
        }else{
            Toastr::error('Unable to update vehicle image');
        }
        return back();
    }

    public function editVehicleInformation(Request $r){
        $vehicle_type = VehicleType::find($r->vehicle_id);
        $vehicle_type->category_id = $r->edit_vehicle_category;
        $vehicle_type->name        = $r->new_vehicle_name;
        $update = $vehicle_type->update();
        if($update){
           Toastr::success('Vehicle information edited successfully');
        }else{
           Toastr::error('Sorry, unable to edit vehicle information');
        }
        return back();
    }

    public function activateVehicle($id){
        $vehicle_type = VehicleType::find($id);
        $vehicle_type->status = 1;
        $update = $vehicle_type->update();
        if($update){
            return 1;
        }else{
            return 0;
        }

    }

    public function deActivateVehicle($id){
        $vehicle_type = VehicleType::find($id);
        $vehicle_type->status = 0;
        $update = $vehicle_type->update();
        if($update){
            return 1;
        }else{
            return 0;

        }
    }

    public function bookingDiscount(){
        $booking_discounts = BookingDiscount::orderBy('id','desc')->get();
        return view('pages.settings.booking_discounts',compact('booking_discounts'));
    }

    public function saveBookingDiscounts(Request $r){
        $saveBookingDiscounts = BookingDiscount::store($r);
        if($saveBookingDiscounts){
            Toastr::success('Booking discount saved successfully');
        }else{
            Toastr::error('Unable to save booking discount');
        }

        return back();
    }

    public function getBookingDiscount($id){
        return BookingDiscount::find($id);
    }

    public function activateBookingDiscount($id){
        $bookingDiscount = $this->getBookingDiscount($id);
        $bookingDiscount->status = 1;
        $update = $bookingDiscount->update();
        if($update){
            return 1;
        }
        return 0;
    }

    public function deActivateBookingDiscount($id){
        $bookingDiscount = $this->getBookingDiscount($id);
        $bookingDiscount->status = 0;
        $update = $bookingDiscount->update();
        if($update){
            return 1;
        }
        return 0;
    }

    public function saveDailyRentalRate(Request $r){
        $save = DailyRentalRate::store($r);
        if($save){
        Toastr::success('Daily rental rate saved successfully');
        }else{
            Toastr::error('Unable to save daily rental rate');
        }
        return back();
    }

    public function activateDailyRentalRate($id){
       $dailyRentalRate = DailyRentalRate::find($id);
       $dailyRentalRate->status = 1;
       $update = $dailyRentalRate->update();
       if($update){
           return 1;
       }
       return 0;
    }

    public function deActivateDailyRentalRate($id){
        $dailyRentalRate = DailyRentalRate::find($id);
        $dailyRentalRate->status = 0;
        $update = $dailyRentalRate->update();
        if($update){
            return 1;
        }
        return 0;
    }

    public function getDailyRentalRate($id){
       return DailyRentalRate::find($id);
    }

    public function saveDriverOutStationAllowanceFee(Request $r){
        $save = DriverFee::store($r);
        if($save){
            Toastr::success('Driver outstation allowance fee saved');
        }else{
            Toastr::error('Sorry, Unable to save driver outstation allowance fee');
        }
        return back();
    }

    public function saveInterStateBookingRates(Request $r){
        $save = InterStateBookingRate::store($r);
        if($save){
           Toastr::success('Interstate booking rate saved successfully');
        }else{
            Toastr::error('Unable to save inter state booking rate');
        }
        return back();
    }

    public function getInterStateBooking($id){
        return InterStateBookingRate::find($id);
    }

    public function activateInterStateBooking($id){
        $interStateBooking = $this->getInterStateBooking($id);
        $interStateBooking->status = 1;
        $update = $interStateBooking->update();
        if($update){
            return 1;
        }
        return 0;
    }

    public function deActivateInterStateBooking($id){
        $interStateBooking = $this->getInterStateBooking($id);
        $interStateBooking->status = 0;
        $update = $interStateBooking->update();
        if($update){
            return 1;
        }
        return 0;
    }

    public function getVehicleType($id){
        return VehicleType::find($id);
    }


}
