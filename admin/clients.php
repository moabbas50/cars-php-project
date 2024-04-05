<?php
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
auth();
include_once './shared/head.php';
include_once './shared/header.php';
$index = 0;
$select = "SELECT * FROM `clients` ";
$alldata = mysqli_query($con, $select);


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
                        <h5 class="card-title">All Cars</h5>

                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Client email</th>
                                    <th scope="col">Client phone</th>
                                    <th scope="col">Client image </th>
                                    <th scope="col">Client National id Img</th>

                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php foreach ($alldata as $data) : ?>
                                    <tr>
                                        <td><?= $index++ ?></th>
                                        <td><?= $data['name'] ?></td>
                                        <td><?= $data['email'] ?></td>
                                        <td><?= $data['phone'] ?></td>
                                        <td><img src="/<?= $data['image'] ?>" alt=""> </td>
                                        <td><img src="/<?= $data['img_national_id'] ?>" alt=""> </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>




<?php
include_once './shared/script.php';
?>