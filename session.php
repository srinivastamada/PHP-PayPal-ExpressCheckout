<?php
$sesson_uid = '';
if(!empty($_SESSION['session_uid'])){
    $sesson_uid = $_SESSION['session_uid'];
}
else{
    header('Location:index.php');
}
?>