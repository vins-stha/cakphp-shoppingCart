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
///////////////////////////////////////////////////////
  public function getCount(){
    $this->autoRender = false;
    $session = $this->request->session();
    $allProducts = $session->read('Cart');
    $qtyCount = 0;
    for($i=0;$i< count($allProducts); $i++){
      $qtyCount +=$allProducts[$i]['qty'];
    }
  //  $myArray[] =  array(json_decode($this->addinTable($this->request->data)));
    $myArray[]  = array('count' =>$qtyCount);
    // debug($myArray);
    // echo json_encode($myArray);
    return $myArray;
    // debug($allProducts);
  }
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function ajaxTest(){
  //  //header('Content-type: application/json;charset=utf-8');
  //$mycount = (new CartsController())->getCount();
  $newarray = array();
  $newarray[] = array( 'name' =>'test');
  $newarray[] = array('result'=>'test2');
  $newarray[] = $this->getCount();
  echo json_encode( $newarray);
  exit;
  }
  //////////////////////////////////////////////////////////////////////////
// public function addinTable($id){
public function addinTable(){
      $this->loadModel('Carts');
      $this->autoRender = false;
      $id = $this->request->data['id'];//////////edxtrea
	    /////////inserting into the cart table//////////7
      $item = $this->Products->get($id);
      $session = $this->request->session();
      $allProducts = $session->read('Cart');
    //  $count = count($allProducts);
  try { if(null!=$allProducts){
        // echo "<br>if(allProducts is not null)<br>";  // echo "<b><br> no of items in cart ".$count;
          if(array_search($id,array_column($allProducts,'itemid')) !== false){
              //if the id is already in list
              $key = array_search($id,array_column($allProducts, 'itemid'));
              $newqty = $allProducts[$key]['qty'];
              $allProducts[$key]['qty']++;
            }
          else{
          // echo"<br><b>new product  id is found but cart is not empty</b>";
            $allProducts[] = array('itemid'=>$id,'qty'=> 1);
        //  debug(($allProducts));
          //  $session->write('Cart',$allProducts);
            }
            }
            else{///////////if cart is empty at first

        //  $allProducts[] = array('itemid'=>$id, 'qty' => 1 );
        $allProducts[] = array('itemid'=>$id, 'qty' => 1 );
        print_r(json_encode($allProducts));
          }
        $session->write('Cart',$allProducts);
        $array = array();
        $array[] = array('message'=>'suceessfulll');
        $array[] =  $this->getCount();
        echo json_encode($array);
    }catch(Exception $ex) {
        $array = array('message'=>'unsuceessfulll');
       echo json_encode($array);
      }

}//end of function

  /*********************************************************/
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
      //  print_r($id); echo "<br>ids are :". $id;
    }
  }
  /*********************************************************/
  public function emptyCart(){
    $session = $this->request->session();
    $session->destroy();
    return $this->redirect(['controller'=>'products','action'=>'carts']);
  }
  /*********************************************************/
    public function removeitem($id){
  //  echo " pdocut id ".$id;
    $this->autoRender = false;
    $session = $this->request->session();
    $allProducts = $session->read('Cart');
  //  debug($allProducts);
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
