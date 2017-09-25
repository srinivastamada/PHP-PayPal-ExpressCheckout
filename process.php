<?php
require 'config.php';
require 'session.php';
require 'class/paypalExpress.php';
if(!empty($_GET['paymentID']) && !empty($_GET['payerID']) && !empty($_GET['token']) && !empty($_GET['pid']) ){
    $paypalExpress = new paypalExpress();
    $paymentID = $_GET['paymentID'];
    $payerID = $_GET['payerID'];
    $token = $_GET['token'];
    $pid = $_GET['pid'];
    
    $paypalCheck=$paypalExpress->paypalCheck($paymentID, $pid, $payerID, $token);
    if($paypalCheck){
        header('Location:orders.php');
    }
}
else{
    header('Location:home.php');
}
?>