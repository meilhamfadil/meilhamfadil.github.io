<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= assets_url("images/favicon.png"); ?>">
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <link href="<?= assets_url("css/style.min.css"); ?>" rel="stylesheet">
    <link href="<?= assets_url("css/app.css"); ?>" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="error-box">
            <div class="error-body text-center">
                <h1 class="error-title text-danger">404</h1>
                <h3 class="text-uppercase error-subtitle">HALAMAN TIDAK DITEMUKAN!</h3>
                <p class="text-muted m-t-30 m-b-30">KLIK TOMBOL UNTUK KEMBALI KE HOME</p>
                <a href="<?= base_url(); ?>" class="btn btn-danger btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
        </div>
    </div>
    <script src="<?= assets_url("libs/jquery/dist/jquery.min.js"); ?>"></script>
    <script src="<?= assets_url("libs/popper.js/dist/umd/popper.min.js"); ?>"></script>
    <script src="<?= assets_url("libs/bootstrap/dist/js/bootstrap.min.js"); ?>"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>
</body>
</html>