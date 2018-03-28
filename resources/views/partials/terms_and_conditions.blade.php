<div class="modal fade" id="term_and_conditions" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title">Terms and Conditions</h4>
            </div>

            <!--Modal body-->
            <div class="modal-body">
                <h5 class="text-main">Please keep in mind while booking</h5>
                <p class="pad-btn text-md" style="text-align: justify;">Driver outstation allowance is
                    <span class="text-md text-bold text-main"> &#x20a6;{{\App\DriverFee::find(1)->value}}</span>.
                    This money is paid whenever a driver is staying overnight with the car
                    and this always happens when the booking lasts for more than one day,
                    or the booking is outside the state.
                </p>
                <p style="text-align: justify" class="text-md">
                    For bookings that are not within Lagos Metropolis. The vehicle will not be fueled.
                </p>
                <p style="text-align: justify" class="text-md">
                    Areas outside Lagos Metropolis are: Badagry, Ikorodu Town, Sango Ota, Ayobo, Ipaja, Agbara, Ijanikin, Mowe, Ibafo, Arepo,
                    Alagbado, Epe, Akute, Eleko, Lakowe.
                </p>
            </div>

            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            </div>
        </div>
    </div>
</div>