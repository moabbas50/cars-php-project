<?php
include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';
include_once '../shared/head.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nationalID = $_POST['nationalID'];
    $hash_password = sha1($password);
    $create = "INSERT INTO `clients` VALUES (null,'$name' ,'$email', '$hash_password' , DEFAULT,DEFAULT,$nationalID, DEFAULT) ";
    $INSER = mysqli_query($con, $create);
    header("location:login.php");
}
?>

<div class="layoutsign">

    <div class="signup">
        <div class="signup-connect">
            <h1>Create your account </h1>
            <a href="#" class="btnn btnn-social btn-facebook"><i class="fa-brands fa-facebook-f"></i> Sign in with Facebook</a>
            <a href="#" class="btnn btnn-social btn-google"><i class="fa-brands fa-google"></i> Sign in with Google</a>
            <a href="#" class="btnn btnn-social btn-linkedin"><i class="fa-brands fa-linkedin-in"></i> Sign in with Linkedin</a>
        </div>
        <div class="signup-classic">
            <h2>Classical way</h2>
            <form class="form" method="POST">
                <fieldset class="username">
                    <input name="name" class="form-control" type="text" placeholder="username" />
                </fieldset>
                <fieldset class="email">
                    <input name="email" class="form-control" type="email" placeholder="email" />
                </fieldset>
                <fieldset class="password">
                    <input name="password" class="form-control" type="password" placeholder="password" />
                </fieldset>
                <fieldset class="nationalID">
                    <input name="nationalID" class="form-control" type="text" placeholder="nationalID" />
                </fieldset>
                <button type="submit" name="submit" class="form-control btn btn-inf ">sign up</button>
            </form>
        </div>
    </div>

</div>











<?php
include_once '../shared/script.php';
?>