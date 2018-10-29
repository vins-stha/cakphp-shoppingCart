
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */

?>

<div class="products view large-9 medium-8 columns content">
  <?php echo "number of carts products =".count($cartProducts);
        print_r($cartProducts[3]->name);
  ?>

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
         <?php echo $this->Html->link('Remove from Cart',['controller'=>'carts','action' =>'removeitem', $product->id]);?>
         <?php echo $this->Form->end();?>

       </p>
        </div>
      <?php endforeach ?>
       <?php if($cartProducts) {
       echo $this->Html->link('Empty the basket',"/carts/emptyCart/");
     }else{
      echo 'Shopping cart is empty !! Please add some ';
     }
       ?>

</div>
</div>
