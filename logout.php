<?php
$_SESSION['session_uid'] = '';
$sesson_uid = '';
session_destroy();
if(empty($_SESSION['session_uid']) &&  empty($sesson_uid)){
    header('Location:index.php');
}
?>