<?php

$cakeDescription = 'Your own platform '; ?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- //$this->Html->css('base.css') ?> -->
    <?= $this->Html->css('bootstrap.min.css'); ?>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <?= $this->fetch('meta') ?>
     <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>


</head>
<body>
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Apple Shopping Cart</a>
        </div>
          <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>

          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php echo $this->Html->link('<span class="glyphicon glyphicon-log-in"></span>
                                        Login',
                                      array('controller'=>'','action'=>''),array('escape'=>false));?>
          <?php echo $this->Html->link('<span class="glyphicon glyphicon-shopping-cart"></span>
                                        Shopping Cart<span class="badge" id="cart-counter">0</span>',
                                      array('controller'=>'carts','action'=>'view'),array('escape'=>false));?>

        </ul>
      </div>
    </nav>

    <?php echo $this->fetch('content'); ?>

</div>
    <?= $this->element("footer");?>
    <?= $this->Html->script('bootstrap.min'); ?>
</body>
</html>
<!--  -->
