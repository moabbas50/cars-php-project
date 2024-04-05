<?php

include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';

include_once '../shared/head.php';

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password =  $_POST['password'];
    $hash_password = sha1($password);
    $select = "SELECT * FROM `car-owners` WHERE `email`='$email' and `password` ='$hash_password'";
    $selectRun = mysqli_query($con, $select);
    $numRows = mysqli_num_rows($selectRun);
    $row = mysqli_fetch_assoc($selectRun);


    if ($numRows == 1) {
        $_SESSION['owner'] = [
            "email" => $email,
            "id" => $row['id'],
            "name" => $row['name'],
            "image" => $row['image'],   
            "phone" => $row['phone']
        ];
        header("location:homeOwner.php");
    } else {
        redirect('user/owner/login.php');
        getMessage(true, "Fals Email or Passowrd ");
    }
}
clearSessionDone();
?>

<div class="layoutsign">
    <div class="signup">
        <h3>Owners</h3>
        <div class="signup-connect">

            <h1>LogIn</h1>

            <a href="#" class="btnn btnn-social btn-facebook"><i class="fa-brands fa-facebook-f"></i> login with Facebook</a>
            <a href="#" class="btnn btnn-social btn-google"><i class="fa-brands fa-google"></i> login with Google</a>
            <a href="#" class="btnn btnn-social btn-linkedin"><i class="fa-brands fa-linkedin-in"></i> login with Linkedin</a>
        </div>
        <div class="signup-classic">
            <h2>Classical way</h2>
            <?php if (isset($_SESSION['done'])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['done']; ?>
                    <form action="" method="POST">
                        <button type="submit" name="clearSession" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </form>
                </div>
            <?php endif; ?>
            <form class="form" method="POST">
                <fieldset class="email">
                    <input class="form-control" name="email" type="email" placeholder="email" />
                </fieldset>
                <fieldset class="password">
                    <input class="form-control" name="password" type="password" placeholder="password" />
                </fieldset>
                <button type="submit" name="login" class="form-control btn btn-inf">LogIn</button>
                <h6 class="mt-1"> To Sign up as Car Owner<a class="btn btn-inf" href="<?= url("user/owner/signup.php") ?>"> click</a></h6>
            </form>
        </div>
    </div>

</div>


<?php
include_once '../shared/script.php';
?>