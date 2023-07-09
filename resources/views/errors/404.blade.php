<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Error 404 | {{ Config('app.name')}} </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/error/style-400.css') }}" rel="stylesheet" type="text/css" />

    
</head>
<body class="error404 text-center">
    <div class="container-fluid  error-content">
        <div class="">
            <p class="mini-text mb-3">Ooops!</p>
            <h1 class="error-number" style="color:#ba484b;">404</h1>
            <p class="error-des mb-0">Page Not Found!</p>
            <p class="error-text mb-4 mt-1">This page is not available</p>
            <a href="{{ url('/')}}" class="btn btn-gradient-danger btn-rounded mt-4">Go Back</a>
        </div>
    </div>    
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

</body>
</html>