<?php
require 'config.php';
require 'session.php';
require 'class/paypalExpress.php';
if(!empty($_GET['pid']) && $_GET['pid']>0){
    $paypalExpress = new paypalExpress();
    $product = $paypalExpress->getProduct($_GET['pid']);
   
}else {
  header("Location:home.php");
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
    <div> <a href="logout.php" class="logout">Logout</a> </div>
    <h2>Checkout</h2>
    <table>
        <tr>
          <td width="70%"><img src="img/<?php echo $product->product_img; ?>" style="width:250px" /></td>
          <td width="10%">$
            <?php echo $product->price; ?>
          </td>
          <td width="20%">
          <?php require 'paypalButton.php'; ?>
          </td>
        </tr>
    </table>

  </body>
  </html>