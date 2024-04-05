<?php
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
auth();
include_once './shared/head.php';
include_once './shared/header.php';
$index = 0;
$select = "SELECT * FROM `cars` WHERE `is_active`='yes' ";
$alldata = mysqli_query($con, $select);
$row1 = mysqli_fetch_assoc($alldata);
// car owner
if($row1){
$carOWnerId = $row1['car_owner_id'];
$Ownerselected = "SELECT * FROM `car-owners` WHERE id = $carOWnerId ";
$Owner = mysqli_query($con, $Ownerselected);
$row2 = mysqli_fetch_assoc($Owner);
}
if (isset($_GET['case'])) {
    if ($_GET['case'] == 'delete') {
        $carid = $_GET['id'];
        $delete = "DELETE FROM  `cars`  WHERE `id` = '$carid' ";
        $deleteq = mysqli_query($con, $delete);
        redirect('admin/cars.php');
    }
}
if (isset($_GET['case'])) {
    if ($_GET['case'] == 'Suspension') {
        $carid = $_GET['id'];
        $update = "UPDATE  `cars` SET `is_active` = 'Suspension' WHERE `id` = '$carid' ";
        $uptodate = mysqli_query($con, $update);
        redirect('admin/cars.php');
    }
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
                        <h5 class="card-title">All Cars</h5>

                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Car Model</th>
                                    <th scope="col">Car Number</th>
                                    <th scope="col">Cost | day</th>
                                    <th scope="col">Car Owner </th>
                                    <th scope="col">ِAction</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php foreach ($alldata as $data) : ?>
                                    <tr>
                                        <td><?= $index++ ?></th>
                                        <td><?= $data['car_model'] ?>
                                            <a href="car.php?id=<?= $data['id'] ?>">see more...</a>
                                        </td>
                                        <td><?= $data['car_number'] ?></td>
                                        <td><?= $data['cost_per_day'] ?></td>
                                        <td><a href="CarOwner.php?id=<?= $row2['id'] ?>"><?= $row2['name'] ?></a></td>
                                        <td><a class="btn btn-warning" href="./cars.php?case=Suspension&id=<?= $data['id'] ?>">Suspension</a> <a class="btn btn-danger" href="cars.php?case=delete&id=<?= $data['id'] ?>">Delet</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <!-- Revenue Card -->
        <div class="col-lg-6 ">
            <div class="card info-card revenue-card">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div>

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
    </div><!-- End Top Selling -->

    </div>
    </div><!-- End Left side columns -->


    </div>
</section>




<?php
include_once './shared/script.php';
?>