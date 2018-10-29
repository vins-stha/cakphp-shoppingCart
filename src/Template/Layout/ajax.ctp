
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products index large-9 medium-8 columns content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>

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
            <!-- <script>
            $(document).ready(function(){
              $('button').click(function(e){
                e.preventDefault();
                  $.post($(this).attr('action'),$(this).serialize(),function(data){
                alert('Add clicked 2');
              });

                  alert('Add clicked');
              });//click
            });//ready -->

<!--

            	//	});
            </script>
<!----------------------------------------------------------------------------------------------------------------------------------> -->
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


            <?php endforeach; ?>
        </tbody>
    </table>
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
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
