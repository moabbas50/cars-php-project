<?php

include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';

include_once '../shared/head.php';
include_once './headerO.php';

$id = $_SESSION['owner']['id'];
$img = $_SESSION['owner']['image'];
$name = $_SESSION['owner']['name'];
$phone = $_SESSION['owner']['phone'];
$email = $_SESSION['owner']['email'];

// profit 

$profit = "SELECT SUM(profit_car_owner) AS total FROM `rentsdata` WHERE `carOwnerid` ='$id' and `status` = 'end'  ";
$prof = mysqli_query($con, $profit);
$t = mysqli_fetch_assoc($prof);
$totalprofit = $t['total'];

$select = "SELECT `password` FROM `car-owners` WHERE id ='$id' ";
$data = mysqli_query($con, $select);
$rowd = mysqli_fetch_assoc($data);


$password = $rowd['password'];
$masseage = "";
$massagee = "";
$oldpasswordd = "";
$newpassword = "";
$renewpassword = "";
// change password
if (isset($_POST['change'])) {
  if (sha1($_POST['oldpassword']) == $password) {
    if ($_POST['newpassword'] == $_POST['renewpassword']) {
      $newpassword = sha1($_POST['newpassword']);
      $update = "UPDATE `car-owners` SET `password` = '$newpassword'  where id=$id";
      $updatequery = mysqli_query($con, $update);
      redirect("user/owner/homeOwner.php");
    } else {
      $massagee = "incorect renewpassword";
      $oldpasswordd = $_POST['oldpassword'];
      $newpassword = $_POST['newpassword'];
    }
  } else {
    $masseage = "incorect old password";
    $renewpassword = $_POST['renewpassword'];
    $newpassword = $_POST['newpassword'];
  }
};

if (isset($_POST['updateimage'])) {
  $image_name =  time() . rand(0, 255) . $_FILES['image']['name'];
  $image_tmp = $_FILES['image']['tmp_name'];
  $location = ("../assets/img/carOwner/")  . $image_name;
  move_uploaded_file($image_tmp, $location);
  // update
  $update = "UPDATE `car-owners` SET `image` = '$image_name'  where id=$id";
  $updatequery = mysqli_query($con, $update);
  $_SESSION['owner']['image'] = $image_name;
  redirect("user/owner/homeOwner.php");
};
if (isset($_POST['updatedata'])) {
  $namee = $_POST['name'];
  $emaile = $_POST['email'];
  $phonee = $_POST['phone'];
  $update = "UPDATE `car-owners` SET `name` = '$namee' , `email` ='$emaile' , `phone` = '$phonee'  where `id`=$id";
  $updatequery = mysqli_query($con, $update);
  $_SESSION['owner']['name'] = $namee;
  $_SESSION['owner']['email'] = $emaile;
  $_SESSION['owner']['phone'] = $phonee;
  redirect("user/owner/homeOwner.php");
};


?>

<div class="container-fluid">
  <div class="row">
    <div class="card col-lg-6">
      <div class="card-body ">
        <img src="<?= url("user/assets/img/carOwner/") . $img ?>" alt="">
        <h3><?= $name ?></h3>
        <h5><?= $email ?></h5>
        <h5><?= $phone ?></h5>
      </div>

    </div>
    <div class="card col-lg-6 ">
      <h3 class="mt-3"> My Total Profit : <span style="font-size: smaller;"><?php if (!empty($totalprofit)) {
                                                                              echo $totalprofit;
                                                                            } else {
                                                                              echo "no Profit yet";
                                                                            } ?></span></h3>

    </div>
  </div>
</div>


<div class="container pb-5">
  <div class="row m-3 ">
    <h2>Edit Profile</h2>
    <div class="col-6">
      <form class="form" method="POST" enctype="multipart/form-data">
        <label for="">username</label>
        <fieldset class="username">
          <input value="<?= $name ?>" name="name" class="form-control" type="text" placeholder="" />
        </fieldset>
        <label for="">Email</label>
        <fieldset class="email">
          <input value="<?= $email ?>" name="email" class="form-control" type="email" placeholder="" />
        </fieldset>
        <label for="">Phone</label>
        <fieldset class="phone">
          <input value="<?= $phone ?>" name="phone" class="form-control" type="text" placeholder="" />
        </fieldset>
        <button type="submit" name="updatedata" class="form-control btn btn-inf ">Change</button>
      </form>
    </div>
    <div class="col-6">

      <form class="form" method="POST" enctype="multipart/form-data">
        <h2>Edit image</h2>
        <fieldset class="image">
          <input name="image" class="form-control" type="file" placeholder="image" />
        </fieldset>
        <button type="submit" name="updateimage" class="form-control btn btn-inf "> update</button>
      </form>
    </div>
    <div class="col-6">
      <form class="form" method="POST">
        <fieldset class="password">
          <input name="oldpassword" class="form-control" type="password" placeholder="Enter Old password" />
        </fieldset>
        <?php if (isset($_POST['oldpassword'])) : ?>
          <?php if (sha1($_POST['oldpassword']) != $password) : ?>
            <div class="alert alert-danger">
              <?= $masseage ?>
            </div>
          <?php endif; ?>
        <?php endif; ?>
        <fieldset class="password">
          <input name="newpassword" class="form-control" type="password" placeholder="Enter new password" />
        </fieldset>
        <fieldset class="password">
          <input name="renewpassword" class="form-control" type="password" placeholder="Renter password" />
        </fieldset>

        <?php if (isset($_POST['oldpassword'])) : ?>
          <?php if ($_POST['newpassword'] != $_POST['renewpassword']) : ?>
            <div class="alert alert-danger">
              <?= $massagee ?>
            </div>
          <?php endif; ?>
        <?php endif; ?>
        <button type="submit" name="change" class="form-control btn btn-inf ">Change</button>
      </form>
    </div>
  </div>

</div>




<?php
include_once '../shared/script.php';
?>