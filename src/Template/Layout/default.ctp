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

?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */

$session = $this->request->session();
$allProducts =$session->read('Cart');

$qtyCount = 0;
for($i=0;$i< count($allProducts); $i++){
  $qtyCount +=$allProducts[$i]['qty'];
}
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
          <div>
            <?php echo $this->Form->create('search',array('controller'=>'products','action'=>'search')); ?>
            <?php  echo $this->Form->control('search', array('label' => false,
               "class" => "form-control input-medium", "placeholder" => __('Search example iphone 6')));?>
               <?php echo $this->Form->submit('search'); ?>
               <?php echo $this->Form->submit('Apply Filters',array('id'=>'filters')); ?>
               <?php echo "<div id ='hide'> <span class ='navbar-brand' ></style></span>";?>
                <?php  echo $this->Form->control('Max Price', array('label' => false,'id' =>'max',
                          "class" => "form-control input-medium", "placeholder" => __('Search by max price')));?>
                <?php  echo $this->Form->control('Minimum Price', array('label' => false,'id'=>'min',
                        "class" => "form-control input-medium", "placeholder" => __('Search by minimum  price')));?>
                <?php echo "</div>" ?> </div>
				 <?= $this->Form->end(); ?>
          </div>
          <?php echo $this->Html->link('Apple Shopping Cart','/products/index',['class' => 'navbar-brand']);?>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <!-- <?= $this->Form->create('search',array('controller'=>'proucts','action'=>'sarch')); ?> -->
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>

          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php echo $this->Html->link('<span class="glyphicon glyphicon-shopping-cart">'.$qtyCount.'</span>
                                        Shopping Cart<span class="badge" id="cart-counter">'.$qtyCount.'</span>',
                                      array('controller'=>'products','action'=>'carts'),array('escape'=>false));?>

        </ul>
      </div>
    </nav>
<?= $this->Flash->render() ?>
</div>
  <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
    <?php echo $this->Html->script('bootstrap.min'); ?>
</body>
</html>
<script>
$(document).ready(function(){
    $("#hide").hide();

$("#filters").click(function(e){
    $("#hide").toggle();
     e.preventDefault();
});

});
</script>
