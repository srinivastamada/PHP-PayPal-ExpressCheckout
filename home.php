<?php
require 'config.php';
require 'session.php';
require 'class/paypalExpress.php';
$paypalExpress = new paypalExpress();
$getAllProducts = $paypalExpress->getAllProducts();
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
    <table>
      <?php foreach($getAllProducts as $product){ ?>
        <tr>
          <td width="70%">
          <img src="img/<?php echo $product->product_img; ?>" style="width:250px" />
          </td>
          <td width="10%">$<?php echo $product->price; ?></td>
          <td width="20%"><a href="<?php echo BASE_URL.'checkout.php?pid='.$product->pid; ?>" class="wallButton">Order</a></td>
        </tr>
        <?php }?>
    </table>

  </body>

  </html>