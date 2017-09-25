<?php
require 'config.php';
require 'session.php';
require 'class/paypalExpress.php';
$paypalExpress = new paypalExpress();
$orders = $paypalExpress->orders();
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
    <h2>Orders</h2>
    <?php if($orders) { ?>
    <table>
       <?php foreach($orders as $order){  ?>
        <tr>
          <td>ORDER - <?php echo $order->oid; ?></td>
          <td><?php echo $order->product; ?></td>
          <td><?php echo $order->price.' '.$order->currency; ?></td>
          <td><?php echo $paypalExpress->timeFormat($order->created); ?></td>
        </tr>
        <?php } ?>
    </table>
    <?php }  else { ?>
      <div> No Orders</div>
      <?php } ?>

  </body>
  </html>