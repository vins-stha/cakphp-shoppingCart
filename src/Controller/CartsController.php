<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\Network\Session\DatabaseSession;

class CartsController extends AppController {

  public function initialize(){
    $this->loadModel('Products');
    $this->loadModel('Carts');
      $this->loadComponent('RequestHandler');
  }

public function addinTable($id){
      $this->loadModel('Carts');
       $this->autoRender = false;
    /////////inserting into the cart table//////////7
      $item = $this->Products->get($id);
      $session = $this->request->session();
    //    $session->write('Cart.itemsid',$id2);
      $allProducts = $session->read('Cart');
      // echo " count is from addinTable carts table ".count($allProducts);
      $count = count($allProducts);
  if(null!=$allProducts){
        // echo "<br>if(allProducts is not null)<br>";
        // echo "<b><br> no of items in cart ".$count;
        if(array_search($id,array_column($allProducts, 'itemid')) !== false){
      //  if(array_search($id,array_column($allProducts, 'itemid'))){
            //if the id is already in list
              $key = array_search($id,array_column($allProducts, 'itemid'));
              $newqty = debug($allProducts[$key]['qty']);
              $allProducts[$key]['qty']++;
              $session->write('Cart',$allProducts);
              debug( $session->read('Cart'));
        }
        else{
          // echo"<br><b>The id is not found but cart is not empty</b>";
            $allProducts[] = array('itemid'=>$id,'qty'=> 1);
            $session->write('Cart',$allProducts);
            debug( $session->read('Cart'));
        }
    }
     else{///////////if cart is empty at first
       $count = 0;
           $allProducts[] = array('itemid'=>$id, 'qty' => 1 );
          $session->write('Cart',$allProducts);
          debug( $session->read('Cart'));
          }
        //  $this->Carts->getCount();
        //////////////////delete below this///7
      // $article = $this->Carts->newEntity();
      // $article->product_id = $item->id;
      // $article->product_amount = 1;
      // if ($this->Carts->save($article)) {
      //     // The $article entity contains the id now
      //   echo "<br>added to cart table db";
      // }
      ///////////////7
      //   debug($session->write('Cart.itemsid', $id2));
      //      $id2 = $session->read('Cart.itemsid');
      //      echo("<br>you have items ".count($id2));
      // }else{
      //   debug($session->write('Cart.itemsid', $id2));
      //   $session->write('Cart.qty',1);
      // }

  //    $this->request->session()->read('Cart');

  return count($allProducts);
  getCount();
}//end of function

  public function getCount(){
    echo "hello from getCount<br>";
    $this->autoRender = false;
    $session = $this->request->session();
    $allProducts = $session->read('Cart');
    $qtyCount = 0;
    for($i=0;$i< count($allProducts); $i++){
      $qtyCount +=$allProducts[$i]['qty'];
    }
    return $qtyCount;
    // debug($allProducts);
  }

}//end class



?>
