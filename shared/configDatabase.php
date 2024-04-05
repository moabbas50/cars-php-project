
<?php
try{
    $con = mysqli_connect('localhost','root','','car_rental');
}catch(Exception $e){
    echo $e->getMessage();
}

?>
