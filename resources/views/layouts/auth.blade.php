<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('page-title') | Novo Cars </title>


    <!--STYLESHEET-->
    <!--=================================================-->

@include('partials.css')


    <!--=================================================-->



    <!--Pace - Page Load Progress Par [OPTIONAL]-->



    <!--Demo [ DEMONSTRATION ]-->



    <!--=================================================

    REQUIRED
    You must include this in your project.


    RECOMMENDED
    This category must be included but you may modify which plugins or components which should be included in your project.


    OPTIONAL
    Optional plugins. You may choose whether to include it in your project or not.


    DEMONSTRATION
    This is to be removed, used for demonstration purposes only. This category must not be included in your project.


    SAMPLE
    Some script samples which explain how to initialize plugins or components. This category should not be included in your project.


    Detailed information and more samples can be found in the document.

    =================================================-->

</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
<div id="container" class="cls-container">
    <div id="bg-overlay" class="bg-img img-balloon"></div>
    <div class="cls-header cls-header-lg">
        <div class="cls-brand">
            <a class="box-inline" href="{{url('/login')}}">
                <img alt="Fodds Capital" src="{{asset('img/logo.png')}}" class="brand-icon" style="height: 100px;">
            </a>
        </div>
    </div>


    <!-- BACKGROUND IMAGE -->
    <!--===================================================-->

    <!-- REGISTRATION FORM -->
    <!--===================================================-->
    @yield('content')
    <!--===================================================-->


    <!-- DEMO PURPOSE ONLY -->
    <!--===================================================-->

    <!--===================================================-->



</div>
<!--===================================================-->
<!-- END OF CONTAINER -->



<!--JAVASCRIPT-->
<!--=================================================-->

<!--jQuery [ REQUIRED ]-->
@include('partials.javascript')

@yield('javascript')

{!! Toastr::render() !!}

</body>
</html>
