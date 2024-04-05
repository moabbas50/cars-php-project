<?php

include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';

include_once '../shared/head.php';
include_once './headerC.php';



$validationeror = [];
$clintid = $_SESSION['client']['id'];

$select = "SELECT * FROM `cars` Where 	`is_active` = 'yes'  ";
$alldata = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($alldata);

if (isset($_GET['calc'])) {
    if (empty($validationeror)) {
        $carId = $_GET['id'];
        $selectedcar = "SELECT * FROM `cars` Where 	`id`= $carId  ";
        $cardata = mysqli_query($con, $selectedcar);
        $rentcar = mysqli_fetch_assoc($cardata);
        $costday = $rentcar['cost_per_day'];
        $carmodel = $rentcar['car_model'];
        $carid = $rentcar['id'];
        $startT = $_GET['startDate'];
        $endT = $_GET['endDate'];
        $durationtime = countdownDays($startT, $endT);
        $totalcost = $costday * $durationtime;
        $ownerpro =  profit($totalcost)[0];
        $businesspro =  profit($totalcost)[1];
        $selects = "SELECT `rent_end_date` FROM `rents` Where `car_id`='$carid' AND (`status`='notStart'  OR `status`='still') ";
        $s = mysqli_query($con, $selects);
        $R = mysqli_fetch_assoc($s);
        if (empty($startT) || empty($endT)) {
            $validationeror[] = "You Must Choose your Start Date or";
            $validationeror[] = "You Must Choose your End Date";
        }elseif ($R) {
            $T = $R['rent_end_date'];
            if (strtotime($startT) <= strtotime($T)) {
                $validationeror[] = "you can not rent car at this period of time
                you can rent after $T ";
            }else {
                if (isset($_POST['Rent'])) {
                    $create = "INSERT INTO `rents` VALUES (null,$clintid,$carId,'$startT','$endT',DEFAULT,$totalcost,$ownerpro,$businesspro)";
                    $i = mysqli_query($con, $create);
                    echo ($startT);
                    $update = "UPDATE `cars` SET  `is_avilable`=0 WHERE `id`='$carid' ";
                    mysqli_query($con, $update);
                    redirect("user/client/homeClient.php");
                }
            }
        } 
    }
}





?>

<div class="main mt-4">

    <h5 id="calc">Create New Rent</h5>
    <div class="container-fluid mt-5">
        <div class="row">
            <?php if (empty($row)) : ?>
                <div class="alert alert-danger">
                    <h4>No Avilable Cars</h4>
                </div>
            <?php endif; ?>
            <?php if (!empty($validationeror)) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($validationeror as $eror) : ?>
                            <li><?= $eror ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php foreach ($alldata as $car) : ?>

                <form action="" class="col-lg-4">
                    <div class="card  mt-3" id="<?php if ($car['is_avilable'] == 0) echo "ssalary"; ?>">
                        <img src="<?= url("user/assets/img/cars/") . $car['images'] ?>" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= $car['car_model'] ?></h5>
                            <p class="card-text">Cost:<?= $car['cost_per_day'] ?><span> | Day</span></p>
                            <div class="">
                                <label for="">Rent</label>
                                <label for=""> start</label>
                                <input name="startDate" class="form-control" type="date" value="">
                                <label for=""> end</label>
                                <input name="endDate" class="form-control" type="date" value="">
                                <input type="hidden" name="id" value="<?= $car['id'] ?>">
                                <?php if ($car['is_avilable'] == 0) : ?>
                                    <p>this Car is not Avilable right now
                                        check if the time you want to Rent,if it will be Avilable
                                    </p>
                                <?php endif; ?>
                                <div class="text-center"><button class="btn btn-inf mt-3" name="calc">Calculate</button></div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="container">

</div>



<div class="container m-5 " id="total">
    <div class="row">
        <form action="" method="POST">
            <?php if (isset($_GET['calc'])) : ?>

                <h3>car model: <?= $carmodel ?> </h3>
                <h3>Cost | Day : <?= $costday ?> </h3>
                <h3>Star Time : <?= $startT ?> </h3>
                <h3>End Time : <?= $endT ?> </h3>
                <h3>Duration : <?= $durationtime ?></h3>
                <h3>Total Cost :<?= $totalcost ?> </h3>
                <button name="Rent" class="btn btn-inf mt-3"> Rent</button>
            <?php endif; ?>
        </form>
    </div>
</div>



</div>
</div>








<?php
include_once '../shared/script.php';
?>