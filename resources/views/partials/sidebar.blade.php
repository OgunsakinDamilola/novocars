<nav id="mainnav-container">
    <div id="mainnav">
        <!--Menu-->
        <!--================================-->
<div id="mainnav-menu-wrap">
    <div class="nano">
        <div class="nano-content">

            <!--Profile Widget-->
            <!--================================-->
            <div id="mainnav-profile" class="mainnav-profile">
                    <div class="profile-wrap text-center">
                      <div class="pad-btm">
                        <img class="img-circle img-md" src="{{asset('img/logo.png')}}" alt="Profile Picture">
                      </div>
                    @if(auth()->user())
                        <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>
                            <p class="mnp-name">
                                {{auth()->user()->first_name}}
                                {{auth()->user()->middle_name}}
                                {{auth()->user()->last_name}}
                            </p>

                            <span class="mnp-desc">
                            {{auth()->user()->email}}
                        </span>
                        </a>
                    @endif
                    </div>
                @if(auth()->user())
                    <div id="profile-nav" class="collapse list-group bg-trans">
                        <a href="{{route('profile')}}" class="list-group-item">
                            <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
                        </a>
                        <a href="{{url('/logout')}}" class="list-group-item">
                            <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                        </a>
                    </div>
                @endif

            </div>


            <!--Shortcut buttons-->
            <!--================================-->
            <div id="mainnav-shortcut" class="hidden">
                <ul class="list-unstyled shortcut-wrap">
                    <li class="col-xs-3" data-content="My Profile">
                        <a class="shortcut-grid" href="#">
                            <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                <i class="demo-pli-male"></i>
                            </div>
                        </a>
                    </li>
                    <li class="col-xs-3" data-content="Messages">
                        <a class="shortcut-grid" href="#">
                            <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                <i class="demo-pli-speech-bubble-3"></i>
                            </div>
                        </a>
                    </li>
                    <li class="col-xs-3" data-content="Activity">
                        <a class="shortcut-grid" href="#">
                            <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                <i class="demo-pli-thunder"></i>
                            </div>
                        </a>
                    </li>
                    <li class="col-xs-3" data-content="Lock Screen">
                        <a class="shortcut-grid" href="#">
                            <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                <i class="demo-pli-lock-2"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!--================================-->
            <!--End shortcut buttons-->


            <ul id="mainnav-menu" class="list-group">

                <!--Category name-->

                <li class="list-header">
                    @if(auth()->user())
                        @foreach(auth()->user()->roles as $i => $role)
                            {{$role->display_name}}
                        @endforeach
                    @else
                    Guest
                    @endif
                </li>
                <li class="active-sub">
                    <a href="{{route('book-vehicle')}}">
                        <i class="fa fa-car"></i>
                        <span class="menu-title">Book Vehicle</span>
                    </a>
                </li>

                <li class="list-divider"></li>
                @if(auth()->user())
                <li class="@yield('activeDashBoard')">
                    <a href="{{url('/home')}}">
                        <i class="demo-pli-home"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <!--Menu list item-->
                <li class="@yield('activeProfile')">
                    <a href="{{route('profile')}}">
                        <i class="demo-pli-lock-user"></i>
                        <span class="menu-title">Profile</span>
                    </a>
                </li>
                @role('admin')
                <li class="@yield('activeSettings')">
                    <a href="#">
                        <i class="demo-pli-data-settings"></i>
                        <span class="menu-title">Settings</span>
                        <i class="arrow"></i>
                    </a>

                    <!--Submenu-->
                    <ul class="collapse">
                        <li class="@yield('activeFees')"><a href="{{route('fees')}}"> Fees / Rates</a></li>
                        <li class="@yield('activeStates')"><a href="{{route('states')}}"> States</a></li>
                        <li class="@yield('activeDiscounts')"><a href="{{route('discounts')}}">Booking Discounts</a></li>
                        <li class="@yield('activeVehicles')"><a href="{{route('vehicles')}}"> Vehicles</a></li>
                    </ul>
                </li>
                @endrole
                <!--Menu list item-->


                <!--Menu list item-->

                <li class="list-divider"></li>

                <!--Category name-->
                <!--Menu list item-->
                <li class="@yield('activeTransactionLogs')">
                    <a href="{{route('transaction-logs')}}">
                        <i class="fa fa-money"></i>
                        <span class="menu-title">Transaction Logs</span>
                    </a>
                </li>

                <!--Menu list item-->
                <li class="@yield('activeBookings')">
                    <a href="{{route('vehicle-bookings')}}">
                        <i class="demo-pli-information"></i>
                        <span class="menu-title">Bookings</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/logout')}}">
                        <i class="fa fa-sign-out"></i>
                        <span class="menu-title">Log Out</span>
                    </a>
                </li>
                @else
                    <li>
                        <a href="{{url('/login')}}">
                            <i class="fa fa-sign-in"></i>
                            <span class="menu-title">Login</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/register')}}">
                            <i class="fa fa-user-plus"></i>
                            <span class="menu-title">Register</span>
                        </a>
                    </li>
            @endif

                <!--Menu list item-->

            </ul>
        </div>
    </div>
</div>

    </div>
</nav>
<!--===================================================-->
<!--END MAIN NAVIGATION-->