<?php
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
auth();
include_once './shared/head.php';
include_once './shared/header.php';

if (isset($_GET['id'])) {
    $clientid = $_GET['id'];
    $selectclient = "SELECT * FROM `car-owners` WHERE id = $clientid ";
    $alldata1 = mysqli_query($con, $selectclient);
    $rowc = mysqli_fetch_assoc($alldata1);
}



?>
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= url('admin/index.php') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= url('admin/cars.php') ?>">Cars</a></li>
            <li class="breadcrumb-item"><a href="<?= url('admin/clients.php') ?>">Clients</a></li>
            <li class="breadcrumb-item"><a href="<?= url('admin/CarOwners.php') ?>">Cars Owners</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card info-card ">
                    <div class="card-body">
                        <h5 class="card-title"><?= $rowc['name'] ?></h5>
                        <div class="row">
                            <div class="card-body col-lg-6">
                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <h6 class="card-title">Email <a href="mailto:<?= $rowc['email'] ?>">| <?= $rowc['email'] ?></a></h6>
                                        <h6 class="card-title">Phone <a href="tel:<?= $rowc['phone'] ?>">| <?= $rowc['phone'] ?></a></h6>
                                        <h4 class="card-title">Number of Owned Cars | <?= $rowc['nums_owned_car'] ?></h4>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body col-lg-6">
                                <h5 class="card-title">Revenue <span>| Total </span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <h6>$<?= $rowc['profit'] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    </div>
</section>




<?php
include_once './shared/script.php';
?>