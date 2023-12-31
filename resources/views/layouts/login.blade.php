<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>{{config('app.name')}}</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $ruta }}../resources/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $ruta }}../resources/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $ruta }}../resources/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $ruta }}../resources/assets/img/favicons/bitacora_almacen.ico">
    <link rel="manifest" href="{{ $ruta }}../resources/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="{{ $ruta }}../resources/assets/img/favicons/mstile-150x150.png">
    <link href="{{ $ruta }}../resources/vendors/choices/choices.min.css" rel="stylesheet">
    <link href="{{ $ruta }}../resources/vendors/prism/prism-okaidia.css" rel="stylesheet">
    <link href="{{ $ruta }}../resources/vendors/flatpickr/flatpickr.min.css" rel="stylesheet" />
    @yield('css')
    <meta name="theme-color" content="#ffffff">
    <script src="{{ $ruta }}../resources/assets/js/config.js"></script>
    <script src="{{ $ruta }}../resources/vendors/overlayscrollbars/OverlayScrollbars.min.js"></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="{{ $ruta }}../resources/assets/css/sweetalert.min.css" rel="stylesheet">
    <link href="{{ $ruta }}../resources/vendors/overlayscrollbars/OverlayScrollbars.min.css" rel="stylesheet">
    <link href="{{ $ruta }}../resources/assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
    <link href="{{ $ruta }}../resources/assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="{{ $ruta }}../resources/assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
    <link href="{{ $ruta }}../resources/assets/css/user.min.css" rel="stylesheet" id="user-style-default">
    <link href="{{ $ruta }}../resources/vendors/dropzone/dropzone.min.css" rel="stylesheet" />
    <script>
      var isRTL = JSON.parse(localStorage.getItem('isRTL'));
      if (isRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
      }
    </script>
  </head>


  <body>

      @yield('content')


  
  
      <!-- ===============================================-->
      <!--    JavaScripts-->
      <!-- ===============================================-->
    <script src="{{ $ruta }}../resources/vendors/choices/choices.min.js"></script>
    <script src="{{ $ruta }}../resources/vendors/prism/prism.js"></script>
    <script src="{{ $ruta }}../resources/assets/js/sweetalert.min.js"></script>
    <script src="{{ $ruta }}../resources/vendors/popper/popper.min.js"></script>
    <script src="{{ $ruta }}../resources/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="{{ $ruta }}../resources/vendors/anchorjs/anchor.min.js"></script>
    <script src="{{ $ruta }}../resources/vendors/is/is.min.js"></script>
    <script src="{{ $ruta }}../resources/vendors/echarts/echarts.min.js"></script>
    <script src="{{ $ruta }}../resources/vendors/fontawesome/all.min.js"></script>
    <script src="{{ $ruta }}../resources/vendors/lodash/lodash.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ $ruta }}../resources/vendors/list.js/list.min.js"></script>
    <script src="{{ $ruta }}../resources/assets/js/theme.js"></script>
    <script src="{{ $ruta }}../resources/vendors/dropzone/dropzone.min.js"></script>
    <script src="{{ $ruta }}../resources/assets/js/flatpickr.js"></script>
    <script src="{{ $ruta }}../resources/assets/charts/highcharts.js"></script>
    @yield('script')
  
    </body>
  
  </html>