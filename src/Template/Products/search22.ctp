

<div class="products view large-9 medium-8 columns content">

<div class="row">

<?php foreach ($products as $product): {
 ?>
<div class="col-sm-6 col-md-4">
  <div class="thumbnail">
    <img src="cinqueterre.jpg" class="img-circle" alt="" style="width:100px; height:100px;">
    <?php //echo  $this->Html->link($this->Html->image($product->image))?>
  </div>
  <div class="caption"><h4>
    <?= $this->Html->link(h($product->name), ['controller'=>'Products','action' => 'view', $product->id]); ?>
      <h5>Price : <?= $product->price ?>€</h5>
  </div>
  <p>
   <?php echo $this->Form->create(null, ['controller'=>'products','action'=>'addit']);?>
   <input type='hidden' value='<?php echo($product->id);?>'name='productId'/>
   <?php echo $this->Form->button('Add to cart now',array('id'=>'Add_to_cart'));?>
   <?php echo $this->Html->link('Add',"/products/addit/".$product->id);?>
   <?php echo $this->Form->end();?>
   <!-- <?php echo $this->Form->hidden('product_id',array('value'=>$product->id));?> -->
 </p>
</div>
<?php }endforeach ?>
</div>
<!-- <div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div> -->
