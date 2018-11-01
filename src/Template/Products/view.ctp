
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
 session_start();
if(!$this->Session->check('Cart')){
  $items_id=array();
  $this->request->session()->write('itemsid',$items_id);
}
header('Content-Type: application/json');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products view large-9 medium-8 columns content">
  <div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><?php echo $this->Html->link('Home','/');?></li>
            <li><?php echo $product->name?></li>
           
        </ol>
    </div>
</div
<div class="row">
  <div class="col-lg-4 col-md-4"><!----main image --->
         <img src="cinqueterre.jpg" class="img-circle" alt="" style="width:200px; height:200px; border:1px solid;">
    </div>
    <div class="col-lg-4 col-md-4">
      <h2><?= $product->name ?></h2>
      <h4>Price : <?= $product->price ?>€</h4>
      <!-- <div id ="result"> here is ajax result test div</div> -->
        <p>
         <!-- <?php echo $this->Form->create('Cart-form',['url'=>['controller'=>'products','action'=>'addit'],'id'=>'Cart-form']);?> -->
         <?= $this->Form->create('Cart-form',array('controller'=>'products','action'=>'addit'));?>
         <?php echo $this->Form->input('id', ['type' => 'hidden', 'value' => $product->id]); ?>
          <button class="bn-large" id="bn_cart">Add to Cart now</button>
          <?php echo $this->Form->end();?>
       </p>
    </div>
</div>
</div>

<script>
 $(document).ready(function(){
        $('#bn_cart').click(function(event){
          //alert('clicked');
          var form_data = $(this).serialize();
          var hidden_value = $('[name="id"]').val();
          var id = $('#id').val();
          var csrfToken = <?php echo(json_encode($this->request->getParam('_csrfToken'))) ?>;
               //alert("your form data "+csrfToken);
              event.preventDefault();
              $.ajax({
                headers: {
                      'X-CSRF-Token': csrfToken
                    },
                //  url:'./../../Carts/getCount',
                  url:'./../../Carts/addinTable',
                //    url:'../addit',
                  type:'POST',
                  cache:true,
                  encode:true,
                //  data : hidden_value,
                  data: { id : id },
                  dataType:'json',
            success:function(data, status, jqxhr){
            var respons = data;
            console.log('success ',respons[1][0].count);
           $('#cart-counter').html(respons[1][0].count);
           $('#result').html(respons[1][0].count);
          },
              error:function(xhr, e,etype,response){
                alert("response = "+ response +"xhr = "+ xhr + "   e = " + e + "  etype = "+ etype);
                console.log(" response =" + response + "error ="+ e +"xhr = "+ xhr + "  etype = "+ etype );
                    }
          });

        });
    });
</script>
