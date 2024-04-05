<?php
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';

include_once '../shared/head.php';
include_once './headerC.php';

if (isset($_GET['id'])) {
    $carid = $_GET['id'];
    $selectclient = "SELECT * FROM `cars` WHERE id = $carid ";
    $alldata1 = mysqli_query($con, $selectclient);
    $rowc = mysqli_fetch_assoc($alldata1);
    $carOWnerId = $rowc['car_owner_id'];
    $Ownerselected = "SELECT * FROM `car-owners` WHERE id = $carOWnerId ";
    $Owner = mysqli_query($con, $Ownerselected);
    $row2 = mysqli_fetch_assoc($Owner);
}
?>

<section class="section dashboard">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card info-card ">
                    <div class="card-body">
                        <h5 class="card-title"><?= $rowc['car_model'] ?></h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <img src="<?= $rowc['images'] ?>" alt="">
                                        <h4 class="card-title">Car Number |<span> <?= $rowc['car_number'] ?></span></h4>
                                        <h4 class="card-title">Car Cost | Day | <span><?= $rowc['cost_per_day'] ?> LE.</span></h4>
                                        <h4 class="card-title">Car Owner |<?= $row2['name'] ?> <br><?= $row2['phone'] ?> </h4>

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
include_once '../shared/script.php';
?>