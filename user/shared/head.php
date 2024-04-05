<?php
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';
$side = "";
if (isset($_SESSION['owner'])) {
   $side = "Owner";
} elseif(isset($_SESSION['client'])) {
   $side = "Client";
}
?>
<!DOCTYPE html>
<html>

<head>
   <!-- Basic -->
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <!-- Site Metas -->
   <meta name="keywords" content="" />
   <meta name="description" content="" />
   <meta name="author" content="" />
   <link rel="shortcut icon" href="images/favicon.png" type="">
   <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
   <title>C-RENT '<?= $side ?>'</title>





   <link rel="stylesheet" href="<?= url("user/assets/css/bootstrap.min.css") ?>">
   <link rel="stylesheet" href="<?= url("user/assets/css/templatemo.css") ?>">
   <link rel="stylesheet" href="<?= url("user/assets/css/custom.css") ?>">

   <!-- Load fonts style after rendering the layout styles -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
   <link rel="stylesheet" href="<?= url("user/assets/css/all.min.css") ?>">




</head>

<body>