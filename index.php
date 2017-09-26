<?php
require 'config.php';
require 'class/paypalExpress.php';

if(!empty($_SESSION['session_uid'])){
  header('Location:home.php');
}

$errorMsgLogin ='';
if (!empty($_POST['loginSubmit']))
{
    $usernameEmail=$_POST['username'];
    $password=$_POST['password'];
    if(strlen(trim($usernameEmail))>1 && strlen(trim($password))>1 )
    {
        $paypalExpress = new paypalExpress();
        $uid=$paypalExpress->userLogin($usernameEmail,$password);
        if($uid)
        {
            $url='home.php';
            header("Location: $url"); // Page redirecting to home.php
        }
        else
        {
            $errorMsgLogin="Please check login details.";
        }
    }
}
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/main.css" rel="stylesheet">
    <title>PayPal Express Checkout using PHP</title>
  </head>

  <body>
    <h1>PHP PayPal Express Checkout Demo</h1>
    <form action="" method="post">
      <label>Username</label>
      <input type="text" required value="" name="username" placeholder="username" class="input" />
      <label>Password</label>
      <input type="password" required value="" name="password" placeholder="password" class="input" />
      <div>
        <input type="submit" class="wallButton" value=" Log In" name="loginSubmit" />
      </div>
      <div>
        <?php echo $errorMsgLogin ?>
      </div>
    </form>

    <h3>Demo Credentials</h3>
    <div><b>Username:</b> srinivas</div>
    <div><b>Password:</b> 123456</div>

  </body>

  </html>