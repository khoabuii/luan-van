<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link rel="icon" type="image/ico" href="{{asset('/admin/img/admin.png')}}" />
    <link rel="stylesheet" href="{{asset('/admin/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/admin/css/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/admin/css/uniform.css')}}" />
    <link rel="stylesheet" href="{{asset('/admin/css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('/admin/css/fullcalendar.css')}}" />
    <link rel="stylesheet" href="{{asset('/admin/css/matrix-style.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />
    <link rel="stylesheet" href="{{asset('admin/css/matrix-media.css')}}" />
    <link href="{{asset('admin/fonts/css/font-awesome.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('/admin/css/jquery.gritter.css')}}" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    {{-- ckeditor --}}
    <script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>

    {{-- onesignal --}}
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
            appId: "8ccfdafd-0148-4566-969d-bb60a2b11328",
            });
        });
    </script>
</head>
<body>
@include('layouts.adminLayout.admin_header')

@include('layouts.adminLayout.admin_sidebar')

@yield('content')

@include('layouts.adminLayout.admin_footer')
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
<script src="{{asset('/admin/js/bootstrap-wysihtml5.js')}}"></script>
<script src="{{asset('/admin/js/jquery.min.js')}}"></script>
<script src="{{asset('/admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/admin/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/admin/js/jquery.uniform.js')}}"></script>
<script src="{{asset('/admin/js/select2.min.js')}}"></script>
<script src="{{asset('/admin/js/jquery.validate.js')}}"></script>
<script src="{{asset('/admin/js/matrix.js')}}"></script>
<script src="{{asset('/admin/js/matrix.form_validation.js')}}"></script>
<script src="{{asset('/admin/js/matrix.tables.js')}}"></script>
<script src="{{asset('/admin/js/matrix.popover.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
      $( "#expiry_date" ).datepicker({
          minDate:0,
          dateFormat: 'yy-mm-dd'
        });
    } );
</script>
<script>
    jQuery(function($){
        $('body').addClass('loading');
    });

    $(window).load(function(){
        $('.flexslider').flexslider({
            animation: "fade",
            controlNav: true,
            directionNav: true,
            start: function(slider){
                $('body').removeClass('loading');
            }
        });
    });
</script>
</body>
</html>
