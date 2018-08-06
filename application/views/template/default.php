<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="<?= assets_url("images/favicon.png"); ?>"> -->
    <title><?= APPNAME ?></title>
    <link href="<?= assets_url("bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
</head>
<body>
    <?= $this->load->view(($page == "") ? "default" : $page); ?>
    <script src="<?= assets_url("jquery/jquery-3.3.1.min.js"); ?>"></script>
</body>
</html>