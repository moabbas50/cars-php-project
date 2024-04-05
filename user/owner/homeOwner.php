<?php

include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';

include_once '../shared/head.php';
include_once './headerO.php';

$id = $_SESSION['owner']['id'];



$index = 0;
$select = "SELECT * FROM `rentsdata` Where 	`carOwnerid` = '$id' AND (`status`='notStart'  OR `status`='still') ";
$alldata = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($alldata);




?>


<div class="container-fluid mt-5">
    <div class="table-responsive">
        <h3>My Current Rented Cars</h3>
      
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Client </th>
                    <th scope="col">Car Details</th>
                    <th scope="col">Rent time Details</th>
                    <th scope="col">Profit</th>
                                       
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($alldata as $data) : ?>

                    <tr <?php if ($data['status'] == 'still') : ?> style="<?= 'background-color: lightskyblue;' ?>" <?php endif; ?>>

                        <td><?= $index++ ?></th>
                        <td><a href="<?= url("user/owner/client.php?id=")?><?=$data['clientid']?>"><?= $data['clientname'] ?></a></td>
                        <td>
                            <p>Car Model: <?= $data['carmodel'] ?> </p>
                            <p>Car Number: <?= $data['carnumber'] ?></p>
                            <a href="car.php?id=<?= $data['carid'] ?>">see more...</a>
                        </td>
                        <td>
                            <p>startdate: <?= $data['startdate'] ?></p>
                            <p>enddate: <?= $data['enddate'] ?></p>
                        </td>
                        <td><p>My-profit:<?= $data['profit_car_owner'] ?></p>
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