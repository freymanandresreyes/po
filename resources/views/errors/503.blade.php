<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{!! asset('assets/images/favicon.png ') !!}" >
    <title>ORGANIZACION BLESS S.A.S</title>

    <!-- Custom CSS -->
    <link href=" {!! asset('dist/css/style.min.css') !!}" rel="stylesheet">
    <!-- page css -->
    <link href="{!! asset('dist/css/pages/error-pages.css ') !!}" rel="stylesheet">
    <link href=" {!! asset('css/personalizado.css') !!}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="skin-blue fixed-layout">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->

    <div class="container">
      <div class="row">


      <div class="col-12 img-error">
        <img class="img-responsive" src="{!! asset('assets/images/error/503.png') !!}" alt="">
      </div>
        <div class="col-12">
            <div class="error-body text-center">

                <h3 class="text-uppercase">503 Error!</h3>
                <p class="text-muted m-t-30 m-b-30">EL SERVIDOR WEB ACTUALMENTE NO ESTA DISPONIBLE PARA MANEJAR LA SOLICITUD.</p>
                <a href="{{ url('/') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Ir al inicio</a>
              </div>

        </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src=" {!! asset('assets/node_modules/jquery/jquery-3.2.1.min.js') !!}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src=" {!! asset('assets/node_modules/popper/popper.min.js') !!}"></script>
    <script src=" {!! asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
    <!--Wave Effects -->
    <script src=" {!! asset('dist/js/waves.js') !!}"></script>
</body>

</html>
