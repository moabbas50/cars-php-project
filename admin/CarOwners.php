<?php
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
auth();
include_once './shared/head.php';
include_once './shared/header.php';
$index = 0;

// car owner
$Ownerselected = "SELECT * FROM `car-owners`  WHERE `is_blocked` = 'unblock' ";
$Owners = mysqli_query($con, $Ownerselected);
$owner = mysqli_fetch_assoc($Owners);
if ($owner) {
    $ownerid = $owner['id'];
}
foreach ($Owners as $owner) {
    $ownerid = $owner['id'];
    $count = "SELECT count(`car_owner_id`) as numbers FROM `cars`  WHERE `car_owner_id`='$ownerid' ";
    $select_count = mysqli_query($con, $count);
    $countRow = mysqli_fetch_assoc($select_count);
    $numbcars = $countRow['numbers'];
    $update = "UPDATE `car-owners` SET `nums_owned_car` = $numbcars WHERE `id` = '$ownerid' ";
    $uptodate = mysqli_query($con, $update);
};

if (isset($_GET['case'])) {
    if ($_GET['case'] == 'delete') {
        $ownerid1 = $_GET['id'];
        $delete = "DELETE FROM  `car-owners`  WHERE `id` = '$ownerid1' ";
        $deleteq = mysqli_query($con, $delete);
        $deletec = "DELETE FROM  `cars`  WHERE `car_owner_id` = '$ownerid1' ";
        $deleteqc = mysqli_query($con, $deletec);
        redirect('admin/CarOwners.php');
    } elseif ($_GET['case'] == 'block') {
        $Oid = $_GET['id'];
        $update1 = "UPDATE  `car-owners` SET `is_blocked` = 'blocked' WHERE `id` = '$Oid' ";
        mysqli_query($con, $update1);
        $updatecars = "UPDATE  `cars` SET `is_active` = 'Suspension' WHERE `car_owner_id` = '$Oid' ";
        mysqli_query($con, $updatecars);
        redirect('admin/CarOwners.php');
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
                        <h5 class="card-title">Owners</h5>

                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Owner Name</th>
                                    <th scope="col">Owner Email</th>
                                    <th scope="col">Owner Phone</th>
                                    <th scope="col">Numb Of Cars </th>
                                    <th scope="col">Net Profit</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php foreach ($Owners as $data) : ?>
                                    <tr>
                                        <td><?= $index++ ?></th>
                                        <td><?= $data['name'] ?></td>
                                        <td><?= $data['email'] ?></td>
                                        <td><?= $data['phone'] ?></td>
                                        <td><?= $data['nums_owned_car'] ?></td>
                                        <td><?= $data['profit'] ?></td>
                                        <td><a class="btn btn-warning" href="CarOwners.php?case=block&id=<?= $data['id'] ?>">Block</a> <a class="btn btn-danger" href="CarOwners.php?case=delete&id=<?= $data['id'] ?>">Delet</a></td>
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