
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
		<?php if($cartProducts) {
		   
       echo $this->Html->link('Empty the basket',"/carts/emptyCart/",['class'=>'btn btn-danger']);
     }else{
      echo $this->Html->link('Shopping cart is empty !! Please add some',"/products/",['class'=>'btn btn-success']);
	  
     }
       ?>
       
    </ul>
</nav>
<div class="products view large-9 medium-8 columns content">
  <!-- <?php echo "number of carts products =".count($cartProducts); ?> -->

    <?php foreach ($cartProducts as $product): ?>
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="cinqueterre.jpg" class="img-circle" alt="" style="width:100px; height:100px;">
          <?php //echo  $this->Html->link($this->Html->image($product->image))?>
        </div>
        <div class="caption"><h4>
          <?= $this->Html->link(h($product->name), ['controller'=>'Products','action' => 'view', $product->id]); ?>
            <h5>Price : <?= $product->price ?>€</h5>
            <h5>Quantity : 1</h5>
        </div>
        <p>
         <?php echo $this->Form->create(null);?>
         <?php echo $this->Html->link('Remove',['controller'=>'carts','action' =>'removeitem', $product->id],['class'=>'btn btn-danger']);?>
         <?php echo $this->Form->end();?>

       </p>
        </div>
      <?php endforeach ?>
       

</div>
</div>
