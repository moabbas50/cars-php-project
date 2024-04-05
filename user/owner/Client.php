<?php
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';

include_once '../shared/head.php';
include_once './headerO.php';

if (isset($_GET['id'])) {
    $clientid = $_GET['id'];
    $selectclient = "SELECT * FROM `clients` WHERE id = $clientid";
    $alldata1 = mysqli_query($con, $selectclient);
    $client = mysqli_fetch_assoc($alldata1);
}
?>

<section class="section dashboard">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card info-card ">
                    <div class="card-body" >
                        <h5 class="card-title"><?= $client['name'] ?></h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <img src="<?= $client['img_national_id'] ?>" alt="">
                                        <h4 class="card-title"><span> <?= $client['email'] ?></span></h4>
                                        <h4 class="card-title"><span><?= $client['phone'] ?></span></h4>
                                        <h4 class="card-title"><span><?= $client['national_id'] ?></span></h4>
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