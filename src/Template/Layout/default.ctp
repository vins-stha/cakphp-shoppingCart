<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
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


    <?= $this->Html->css('bootstrap.min.css'); ?>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <?=$this->Html->css('base.css') ?>
    <?= $this->fetch('meta') ?>
     <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

</head>
<body>
  <div class="container">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Apple Shopping Cart</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <!-- <?= $this->Form->create('search',array('controller'=>'products','action'=>'search')); ?> -->
        <?php  echo $this->Form->control('search', array('label' => false,
           "class" => "form-control input-medium", "placeholder" => __('Search example iphone 6')));?>
           <?= $this->Form->button('submit');?>

          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>

          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php echo $this->Html->link('<span class="glyphicon glyphicon-shopping-cart"></span>
                                        Shopping Cart<span class="badge" id="cart-counter">0</span>',
                                      array('controller'=>'carts','action'=>'view'),array('escape'=>false));?>

        </ul>
      </div>
    </nav>
<?= $this->Flash->render() ?>
</div>
    <!-- <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""> //$this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentation</a></li>
                <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>
            </ul>
        </div>
    </nav>-->

    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
    <?php echo $this->Html->script('bootstrap.min'); ?>
</body>
</html>
<!--  -->
