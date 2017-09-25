<?php
//ob_start();
error_reporting(0);
session_start();

/* DATABASE CONFIGURATION */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_DATABASE', 'demo_paypal');
define('DB_PASSWORD', '');
define("BASE_URL", "http://localhost/PHP-PayPal-ExpressCheckout/");

define('PRO_PayPal', 0);

if(PRO_PayPal){
	define("PayPal_CLIENT_ID", "#########################");
	define("PayPal_SECRET", "###################");
	define("PayPal_BASE_URL", "https://api.paypal.com/v1/");
}
else{
	define("PayPal_CLIENT_ID", "AQwoZAAHsmA5vBLj_mZffS3NWJjNJODewuV2WakPm-BQilgsawTtnbLvWHNC73idcfiaHBOjaeTDkAS8");
	define("PayPal_SECRET", "EB3Ozp20s6yHcQFijDOhBV_4k0tt1UL8z4o7sXsmQ2WFCLW3K0vf9pyVdTi70M2x_6kKVKCBYQ1o_o9u");
	define("PayPal_BASE_URL", "https://api.sandbox.paypal.com/v1/");
}



function getDB() 
{
	$dbhost=DB_SERVER;
	$dbuser=DB_USERNAME;
	$dbpass=DB_PASSWORD;
	$dbname=DB_DATABASE;
	$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbConnection->exec("set names utf8");
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}
?>