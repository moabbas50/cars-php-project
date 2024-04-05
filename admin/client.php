<?php
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
auth();
include_once './shared/head.php';
include_once './shared/header.php';

if (isset($_GET['id'])) {
    $clientid = $_GET['id'];
    $selectclient = "SELECT * FROM `clients` WHERE id = $clientid ";
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
                    <div class="table-responsive">
                        <h5 class="card-title"><?= $rowc['name'] ?></h5>
                        <div class="card-body">
                            <h5 class="card-title">Revenue <span>| This Month</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>$3,264</h6>
                                    <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
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