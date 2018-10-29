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
              debug($session->read('Cart'));
        }
        else{
          // echo"<br><b>The id is not found but cart is not empty</b>";
            $allProducts[] = array('itemid'=>$id,'qty'=> 1);
            $session->write('Cart',$allProducts);
            debug($session->read('Cart'));
        }
    }
     else{///////////if cart is empty at first
       $count = 0;
           $allProducts[] = array('itemid'=>$id, 'qty' => 1 );
          $session->write('Cart',$allProducts);
          debug($session->read('Cart'));
          }

//  echo count($allProducts);
  //getCount(); //??? why to check ??
}//end of function

  public function getCount(){

    $this->autoRender = false;
    $session = $this->request->session();
    $allProducts = $session->read('Cart');
    $qtyCount = 0;
    for($i=0;$i< count($allProducts); $i++){
      $qtyCount +=$allProducts[$i]['qty'];
    }
    $result = array('count' =>$qtyCount);
    echo json_encode($result);
    // debug($allProducts);
  }
  public function viewCart(){

    $session = $this->request->session();
    $allProducts = $session->read('Cart');
    debug($allProducts);
    $total = $this->getCount();
    echo "count = ".$this->getCount();
    echo " <br> id   qty <br>";
    {
      for($i=0;$i<count($allProducts);$i++){
        $qty=$allProducts[$i]['qty'];
        if($qty==1){
          $id = array();
          //  $id[]= $allProducts[$i]['itemid'];
         $id= $allProducts[$i]['itemid'];
          echo "  ".$allProducts[$i]['itemid']."<br>";
          debug((new ProductsController())->viewCartProducts($id));
        }else{
          for($j=0;$j<$qty;$j++){
              $id= $allProducts[$i]['itemid'];
            echo "  ".$allProducts[$i]['itemid']."<br>";

          //  $result = (new ProductsController())->viewCartProducts($id);
            (new ProductsController())->viewCartProducts($id);
          }
        }
      }
        print_r($id); echo "<br>ids are :". $id;

    }

  }
  public function emptyCart(){
    $session = $this->request->session();
    $session->destroy();
    return $this->redirect(['controller'=>'products','action'=>'carts']);
  }

  public function removeitem($id){
  //  echo " pdocut id ".$id;
    $this->autoRender = false;
    $session = $this->request->session();
    $allProducts = $session->read('Cart');
    debug($allProducts);

  // if(array_search($key,array_column($allProducts, 'itemid'))){
  $key = array_search($id,array_column($allProducts, 'itemid'));
  if ($key ==0){
    debug($allProducts[0]['qty']);
    $allProducts[0]['qty'] = $allProducts[0]['qty']-1;
    debug($allProducts[0]);
    echo "<br>key  deleted ";
    $session->write('Cart',$allProducts);
  }else{
    debug($allProducts[$key]['qty']);
    $allProducts[$key]['qty'] = $allProducts[$key]['qty']-1;
    debug($allProducts[$key]);
    echo "<br>key  deleted ";
    $session->write('Cart',$allProducts);
  }
//  $this->flash->success("Successfully removed from cart");
return $this->redirect(['controller'=>'products','action'=>'carts']);
} //function remvoitem
}//end class



?>
