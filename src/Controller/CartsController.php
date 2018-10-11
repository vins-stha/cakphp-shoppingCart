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
    echo $id. "<br>from carts corntroller ";
    $this->loadModel('Carts');

    /////////inserting into the cart table//////////7
      $item = $this->Products->get($id);
      $session = $this->request->session();
    //    $session->write('Cart.itemsid',$id2);
      $allProducts = $session->read('Cart');
      echo " count is from addinTable carts table ".count($allProducts);
      $count = count($allProducts);
  if(null!=$allProducts){
        echo "<br>if(allProducts is not null)<br>";
        echo "<b><br> no of items in cart ".$count;
        debug(array_search($id,array_column($allProducts, 'itemid')));
      if(array_search($id,array_column($allProducts, 'itemid')) !== false){
      //  if(array_search($id,array_column($allProducts, 'itemid'))){
            //if the id is already in list
            echo "<br><b>ITEM Is IN the list already</b>";
            $key = array_search($id,array_column($allProducts, 'itemid'));
            echo "<br> key is ", $key;
           $newqty = debug($allProducts[$key]['qty']);

            debug($allProducts[$key]['qty']++);
            $session->write('Cart',$allProducts);
            debug( $session->read('Cart'));
        }
        else{
          echo"<br><b>The id is not found but cart is not empty</b>";
            $allProducts[] = array('itemid'=>$id,
                                    'qty' => 1
                                  );
            debug( $session->read('Cart'));
        }

        ///////trial goes here///////7
        // for($i=1;$i<=count($allProducts);$i++){
        //     debug($allProducts[$i]['product']);
        //     echo"product id ".$allProducts[$i];
        //     if($allProducts[$id]== $id){
        //       $allProducts[$id]['qty'] = $allProducts[$id]['qty'] +1;
        //     }else{
        //       $allProducts[$id]= $id;
        //       $allProducts[$id]['qty'] = 1;
        //
        //     }
        // }
        //   $session->write('Cart',$allProducts);
        /////echo "we counted to ".count($session->read('Cart.qty'));////////
        /*****************************/
        // if(array_key_exists($id,$allProducts))
        //   {
        //     echo "<br> id is repeatedl<br>";///does the item id exists already?
        //             //if yes
        //     debug(array_keys($session->read('Cart')));
        // //  debug($session->read('Cart'));//nooooo
        //     debug($session->read('Cart.'.$id.'.qty'));
        //           //  debug($allProducts[$id]++);//nooooo
        //        debug($allProducts[$id]['qty']+=1);//not required
        //             echo " <br>your qty is ".$qty;
        //             debug($allProducts);
        //
        //   }else{///if new id is  found
        //           echo "<br> <b>NEW </b>id dtected with id <b>:<br>".$id."</b>";
        //           $allProducts['itemid'] = $id;
        //           debug(  $allProducts['itemid'] );
        //           $allProducts[$id]['qty'] = 1;
        //           debug(  $allProducts[$id]['qty'] );
        //           debug( $allProducts->$id['qty']);
        //           $session->write('Cart',$allProducts);
        //           debug($session->read('Cart'));
        //           ///4lines down is req///
        //           // debug($allProducts[$id]['itemid'] = $id);
        //           // $amount = 1;
        //           // $session->write('Cart.'.$id.'.qty',$amount);
        //           // $allProducts[$id]['qty'] = 1;
        //         // $session->write('Cart.itemsid', array_push($id));//not req.
        //       }
              /**************/
    }
     else{///////////if cart is empty at first
       $count = 0;
         echo"<br><b>The  cart is  empty</b>";
       $allProducts[] = array('itemid'=>$id,
                               'qty' => 1
                             );
                             $qty = 1;
          debug($allProducts[0]);
          debug($allProducts);
          debug($allProducts[0]['itemid']);

        //  if(array_search($id,array_column($allProducts, 'itemid'))==true){echo "hello";}
          $session->write('Cart',$allProducts);

            debug( $session->read('Cart'));
          return $count++;
        //  $session->write('Cart.qty',1);

            echo ( "<br>Initiating because cart is empty ".
            debug( $session->read('Cart')));

          }
          ////////lets count qty////////77
                  /////////////
          $session->write('Cart',$allProducts);//save the item
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
  }
  public function getCount(){
    $session = $this->request->session();
    $allProducts = $session->read('Cart');
    return count($allProducts);
    // debug($allProducts);
  }

}//end class



?>
