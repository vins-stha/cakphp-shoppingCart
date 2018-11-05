<?php ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products index large-9 medium-8 columns content">
    <h3><?= __('Products') ?></h3>
      <table cellpadding="0" cellspacing="0">
        <tbody>
          <?php   foreach ($products as $product): ?>
              <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <img src="cinqueterre.jpg" class="img-circle" alt="" style="width:100px; height:100px;">
					<?php $path = $product->path.$product->image; echo  $this->Html->image($product->image,
												array(
												'class'=>'img-responsive',
												'alt'=>$product->image,
												 // 'width'=>'100px',
												 // 'height'=>'60px'
												
												),
												['fullBase'=>false],
												array('escape'=>false)
										
								
								);?>
              </div>
              <div class="caption"><h4>
                <?= $this->Html->link(h($product->name), ['controller'=>'Products','action' => 'view', $product->id]); ?>
                  <h5>Price : <?= $product->price ?>€</h5>
              </div>
			  <?= $this->Form->postLink(__('Remove'), ['action' => 'delete', $product->id], 
			  ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> </li>
             <p>
               <?php echo $this->Form->create(null, ['controller'=>'products','action'=>'addit']);?>
					<input type='hidden' value='<?php echo($product->id);?>'name='productId'/>
                <?php echo $this->Form->end();?>
             </p>
            </div>
		 <?php endforeach; ?>

<!----------------------------------------------<button class="bn-large" id="bn_cart">Add to Cart</button>----------------------------->
<!-- <tr>
    <td><?= $this->Number->format($product->id) ?></td>
    <td><?= h($product->name) ?></td>
    <td><?= $this->Number->format($product->price) ?></td>
    <td><?= h($product->image) ?></td>
    <td class="actions">
        <?= $this->Form->postLink(__('View'), ['controller' =>'products','action' => 'view', $product['Product']['id']]);?>
        <?php  "product['Product']['id'] is". $product['Product']['id'];?>
        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?>
<!-- //array('class'=>'btn btn-primary btn-lg btn-block login-button','type'=>'Submit') -->
        <!-- <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?>
    </td>
</tr> -->
<!------------------------------------------------------------------------------------------------------------------------------------>


           
        </tbody>
    </table>
  
</div>
  <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

