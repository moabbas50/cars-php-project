<?php

include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';

include_once '../shared/head.php';
include_once './headerC.php';


$id = $_SESSION['client']['id'];



$index = 0;
$select = "SELECT * FROM `rentsdata` Where 	`clientid` = '$id' AND  `status`='end' ";
$alldata = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($alldata);
if ($row) {
    $carownerid = $row['carOwnerid'];
    $selectwd = "SELECT `name` FROM `car-owners` Where 	`id` = '$carownerid' ";
    $ownername = mysqli_query($con, $selectwd);
    $owner = mysqli_fetch_assoc($ownername);
}

?>


<div class="container-fluid mt-4">
    <div class="table-responsive">
        <h3>Old Rented</h3>

        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Car Owner Name</th>
                    <th scope="col">Car Details</th>
                    <th scope="col">Rent time Details</th>
                    <th scope="col">Total Cost</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($alldata as $data) : ?>

                    <tr>
                        <td><?= $index++ ?></th>
                        <td><?= $owner['name'] ?></td>
                        <td>
                            <p>Car Model: <?= $data['carmodel'] ?> </p>
                            <p>Car Number: <?= $data['carnumber'] ?></p>
                            <a href="car.php?id=<?= $data['carid'] ?>">see more...</a>
                        </td>
                        <td>
                            <p>startdate: <?= $data['startdate'] ?></p>
                            <p>enddate: <?= $data['enddate'] ?></p>
                        </td>
                        <td>
                            <p>total-cost:<?= $data['total_cost'] ?></p>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>








<?php
include_once '../shared/script.php';
?>