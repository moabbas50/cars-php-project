<?php

include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';

include_once '../shared/head.php';
include_once './headerO.php';

$index=1;

$validationeror = [];
$ownerid = $_SESSION['owner']['id'];

$select = "SELECT * FROM `cars` Where 	`car_owner_id` = $ownerid  ";
$alldata = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($alldata);

?>







<div class="container-fluid">
    <div class="table-responsive">
        <h3>My Cars</h3>
        <a href="<?= url("user/owner/creat.php") ?>"><span>Create New Car</span></a>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Car Model</th>
                    <th scope="col">Car Number</th>
                    <th scope="col">Car image</th>
                    <th scope="col">Car Status</th>
                    <th scope="col">Cost | day</th>

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
                        <td > <img  class="imgtable"   src="<?= url("user/assets/img/cars/") . $data['images'] ?>" alt=""></td>
                        <td style="color: red;">Status : <?php if ($data['is_avilable'] == 1) {
                                                    echo "Not Rented";
                                                } else {
                                                    echo "Rented";
                                                } ?><br>
                                                <br>
                                                Activate : <?=$data['is_active']?></td>
                        <td><?= $data['cost_per_day'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>










<?php
include_once '../shared/script.php';
?>