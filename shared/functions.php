<?php
session_start();
define("BASE_URL", "http://localhost/car_rent/");

function url($var = null)
{
    return BASE_URL . $var;
}



function getMessage($condition, $message)
{
    if ($condition) {
        $_SESSION['done'] = "$message";
    }
}



function redirect($var)
{

    echo "<script>
window.location.replace('http://localhost/car_rent/$var')
</script>";
}


function clearSessionDone()
{
    if (isset($_POST['clearSession'])) {

        unset($_SESSION['done']);
    }
}


function auth()
{
    if (isset($_SESSION['admin'])) {
        //  redirect('')
    } else {

        echo "<script>
    window.location.replace('http://localhost/car_rent/admin/pages-login.php')
    </script>";
    }
}

function profit($totalC)
{
    $business = (20.00 * $totalC) / 100.00;
    $carowner = (80.00 * $totalC) / 100.00;
    return $profits = [$carowner, $business];
}

// to get legnth of var 
//  strlen($var);
function filtervalidation($var)
{
    // delet spaces from value 
    $var = trim($var);
    // strip tag remove html special characters 
    $var = strip_tags($var);
    // html special characters readed it as string not element
    $var = htmlspecialchars($var);
    // remove slash from string value
    $var = stripslashes($var);
    return $var;
}
function stringvalidation($input)
{
    $minsize = 2;
    $maxsize = 30;
    // empty value
    $empty = empty($input);
    $minlength = strlen($input) < $minsize;
    $maxlength = strlen($input) > $maxsize;
    if ($empty == true || $minlength == true || $maxlength == true) {
        return true;
    } else {
        return false;
    }
}

// countdwon
function countdownDays($startDate, $endDate) {
    // Convert both dates to UTC to avoid issues with daylight saving time
    $startUTC = strtotime(gmdate('Y-m-d', strtotime($startDate)));
    $endUTC = strtotime(gmdate('Y-m-d', strtotime($endDate)));
    
    // Calculate the difference in seconds
    $timeDiff = $endUTC - $startUTC;
    
    // Calculate the number of days
    $daysDiff = floor($timeDiff / (60 * 60 * 24));
    
    return $daysDiff;
}