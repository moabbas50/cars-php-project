<?php

include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';

include_once '../shared/head.php';
include_once './headerO.php';
$ownid = $_SESSION['owner']['id'];

if (isset($_POST['create'])) {
    $Car_Model = $_POST['Car-Model'];
    $Car_Number = $_POST['Car-Number'];
    $Cost_Day = $_POST['Cost-Day'];

    // image
    $image_name1 =  time() . rand(0, 255) . $_FILES['Car-licence']['name'];
    $image_tmp1 = $_FILES['Car-licence']['tmp_name'];
    $location1 = "../assets/img/cars/"  . $image_name1;

    $image_name2 =  time() . rand(0, 255) . $_FILES['Car-Report']['name'];
    $image_tmp2 = $_FILES['Car-Report']['tmp_name'];
    $location2 = "../assets/img/cars/"  . $image_name2;

    $image_name3 =  time() . rand(0, 255) . $_FILES['Car-Image']['name'];
    $image_tmp3 = $_FILES['Car-Image']['tmp_name'];
    $location3 = "../assets/img/cars/"  . $image_name3;
    move_uploaded_file($image_tmp1, $location1);
    move_uploaded_file($image_tmp2, $location2);
    move_uploaded_file($image_tmp3, $location3);
   
    $create = "INSERT INTO `cars` VALUES (null,'$Car_Model','$Car_Number',DEFAULT,DEFAULT,'$Cost_Day','$ownid','$image_name1','$image_name2','$image_name3')";

    $mysqli_run = mysqli_query($con, $create);
    redirect('user/owner/myCars.php');

    getMessage($mysqli_run, "Add Car succes");
}

?>

<div class="main">

    <h5 id="calc" class="mt-3">ADD New Car</h5>
    <div class="container-fluid mt-2">
        <form class="form text-center" method="POST" enctype="multipart/form-data">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-5">
                    <div class="mt-3 ">
                        <input class="form-control" name="Car-Model" type="text" placeholder="Car Model" />
                    </div>
                    <div class="mt-3 ">
                        <input class="form-control" name="Car-Number" type="text" placeholder="Car Number" />
                    </div>
                    <div class="mt-3 ">
                        <input class="form-control" name="Cost-Day" type="text" placeholder="Cost | Day" />
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-3 ">
                        <label for="Car-licence">Car licence</label>
                        <input class="form-control" name="Car-licence" type="file" placeholder="Car licence" />
                    </div>
                    <div class="mt-3 ">
                        <label for="Car-Report">Car Report</label>
                        <input class="form-control" name="Car-Report" type="file" placeholder="Car Report" />
                    </div>
                    <div class="mt-3 ">
                        <label for="Car-Image">Car Image</label>
                        <input class="form-control" name="Car-Image" type="file" placeholder="Car Image" />
                    </div>
                </div>

            </div>
            <button type="submit" name="create" class="btn btn-inf mt-3"> Create </button>
        </form>
    </div>
</div>











<?php
include_once '../shared/script.php';
?>