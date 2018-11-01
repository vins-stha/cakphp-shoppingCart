<?php
namespace App\Controller;




use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use  App\Controller\Event;
use Cake\Http\Session\DatabaseSession;
use Cake\Datasource\ConnectionManager;
header('Content-Type: application/json');
 // mention at top
class ProductsController extends AppController
{
  public $uses = array('Product','Cart');
  public function initialize(){
       parent::initialize();
       $this->loadComponent('RequestHandler');
       }
  ////////////////////////////////////////////////////  ////////////////////////////////////////////////////
function ajaxTest(){
//  //header('Content-type: application/json;charset=utf-8');
$mycount = (new CartsController())->getCount();
echo $mycount;
// $array = array( 'name' =>'test');
// echo json_encode($array);
exit;

}
  ///////////////////////////////////////////////////////////////////////////////////////////////////////  ////////////////////////////////////////////////////
public function addit() {
  $this->autoRender = false;
  $table =  $this->loadModel('Carts');
  if ($this->request->is('post')) {
      $id = $this->request->data['id'];//retrieve the id of the product
        //debug($id = $this->request->data);
      //  debug($this->Products->get($id));//retrieve the product details
      // $this->Carts->addProduct($this->Products->get($id));
       // $result = (new CartsController())->addinTable($id);
       $result = (new CartsController())->addinTable($id);
       debug($result);
       //$mycount = (new CartsController())->getCount();
    }
    else{
            $this->flash->error('Something went wrong !');
            }
  echo  $result;
  exit;

 }

#######################33333  ////////////////////////////////////////////////////
public function addTCart($id) {
  echo $id;
  $products_in_cart_table = $this->read();
  $product = $this->Products->get($id);
  $this->request->session()->write('Config.language', 'eng');
  if(!empty($_SESSION['Cart'])) {
    echo "note empty";
    $_SESSION["Cart"]["id"] = $check["Cart"]["id"];
    $_SESSION['Cart']['number_of_products']++;
    $count ++;

        //$data["Cart"]["quantity"] = $check["Cart"]["quantity"] + 1;
  }else{
    echo "empty";
    $count =0;
    $session = $this->request->session();
    debug($session);
    $_SESSION['Cart']['product_id'] = $product->id;
    $_SESSION['Cart']['price'] = $product->price;
    $_SESSION['Cart']['number_of_products']++;;
    $count++;
    $session = $this->request->session();
    debug($session);
    debug($_SESSION['Cart']);
    echo $count;
    }
  }//End of addtoCart
  ////////////////////////////////////////////////////
  public function destroy(){
    $session = $this->request->session();
    $session->read('Cart');
    if($session->destroy('Cart')){
      echo "SUCCESSFULLY DESTROYED SESSION";
    }
  }
    ////////////////////////////////////////////////////
  public function readSession(){
      $session = $this->request->session();
      $session->read('Cart');
      $mycount = (new CartsController())->getCount();
      return json_encode($mycount);

  }
    ////////////////////////////////////////////////////
  /*
   * read cart data from session
   */
  public function readProductinCart() {
    $data =array();
    // echo "this->Session->read('Cart')".$this->request->Session()->check('Cart');
      if(!empty($_SESSION['Cart'])) {
        echo "note empty";
        $data["Cart"]["id"] = $check["Cart"]["id"];
            $data["Cart"]["quantity"] = $check["Cart"]["quantity"] + 1;
      }else{
        echo "empty";
        //$_SESSION['Cart']['product_id'] =
      }
    //  return $session->read('cart');
  }
  //count number of products in cart
  ////////////////////////////////////////////////////
  public function getCount() {
  $table =  $this->loadModel('Carts');
  $mycount = (new CartsController())->getCount();
  $allProducts = $this->readProduct();

  if (count($allProducts)<1) {
      return 0;
  }
  $count = 0;
  foreach ($allProducts as $product) {
      $count=$count+$product;
  }
  echo " my count is ".$mycount;
  return $count;
}
  //save product in cart in session
  public function saveProduct($data){
  //  $session = new Session();
    return $session->write('cart',$data);

  }
########################3  ////////////////////////////////////////////////////
    public function index()//list the products from the table
    {
        $this->paginate($this->Products);
        $products = $this->paginate($this->Products);
        $this->set(compact('products'));
    }
########################3  ////////////////////////////////////////////////////
    public function view($id = null)
      {
        $product = $this->Products->get($id, [
              'contain' => []
          ]);
         $this->set('product', $product);
        }

public function carts()
{
		$session = $this->request->session();
		$allProducts = $session->read('Cart');
        //debug(count($allProducts));//count of items types
		$totalItems =(new CartsController())->getCount();
    $totalItems = $totalItems[0]['count'];//total count of all of different items
      //  debug($totalItems);
		$itemIds = array();
		$products = array();

    if(count($allProducts)<0){
      $this->Flash->error(__('Shopping cart is empty !! Please add some '));
    }else{
      for($i=0;$i<count($allProducts);$i++){
 			 $qty=$allProducts[$i]['qty'];
 			  if($qty==1){
 				 $itemIds[]= $allProducts[$i]['itemid'];
 				 //$itemIds[]= $allProducts[$i]['itemid'];
 				//echo "  ".$allProducts[$i]['itemid']."<br>";

 			  }else{
 				for($j=0;$j<$qty;$j++){
 					 $itemIds[]= $allProducts[$i]['itemid'];
 				 // echo "  ".$allProducts[$i]['itemid']."<br>";
 			    }//for j
 			   }//else
 		   }
     } //for i
   for($i=0; $i<count($itemIds); $i++){ //to check if all itemsid are innnnnnside
		// print_r($itemIds[$i]);
		  // echo "<br>";
		  $products[$i] = $this->Products->get($itemIds[$i], ['contain' => []]);

	//	$products[] = $this->Products->get($itemIds[$i], ['contain' => []]);
		  }
      if($this->set('cartProducts',$products)){
        $this->set('cartProducts',$products);
      //  echo "successful <br>";
        }else{
        //      echo "unscucessful not";
              }
    //   $this->set(compact('product'));

    }

    /**************************************************************/
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    public function search(){
        $this->loadModel('Products');
        $searchData = $this->request->getData();
        //  debug($searchData);
        $item = $searchData['search'];
        $maxPrice =(float) $searchData['Max_Price'];
        $minPrice =(float) $searchData['Minimum_Price'];
      //  debug($searchData);
        if($minPrice >$maxPrice){
          $tempPrice = $minPrice;
          $minPriceTemp = $maxPrice;
          $maxPrice = $tempPrice;
          }
        if(!$searchData){ echo "blank";}
        if(!$minPrice){ $minPrice = 0;}
         if(!$maxPrice){
           $products = $this->Products->find()
                                        ->select(['name','price'])
                                        ->where(['name LIKE' =>"%". $item. "%"])
                                        ->toList();
         }else{ //echo "else";
           if($minPrice >$maxPrice){
             $tempPrice = $minPrice;
             $minPriceTemp = $maxPrice;
             $maxPrice = $tempPrice;
             }
             $products = $this->Products->find()
                                          ->select(['name','price'])
                                          ->where(['name LIKE' =>"%". $item. "%",
                                                    'Products.price <='=> $maxPrice,
                                                    'Products.price >='=>$minPrice])
                                          ->toList();
           }

    $this->set(compact('products'));
  }
    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

/////////////////////////Extra !!!///////////////////////////////////////////////////////////////
        public function search2 (){

          $this->loadModel('Products');
    //     $this->autoRender = false;
         $connection = ConnectionManager::get('default');

         $searchData = $this->request->getData();
         $item = $searchData['search'];
         $maxPrice =(float) $searchData['Max_Price'];
         $minPrice =(float) $searchData['Minimum_Price'];
         debug($searchData);
         if($minPrice >$maxPrice){
           $tempPrice = $minPrice;
           $minPriceTemp = $maxPrice;
           $maxPrice = $tempPrice;
           }
         if(!$searchData){ echo "blank";}
         if(!$minPrice){ $minPrice = 0;}
         if(!$maxPrice){
           // $results = $connection
           //          ->newQuery()->select('products.name as Name, products.price as Price, products.image as Image')
           //                      ->from ('products')
           //                      ->where(['products.name LIKE'=>"%".$item."%"])
           //                      ->execute()
           //                      ->fetchAll('assoc');
           $results = $this->Products->find(['all',
                            'conditions' =>['Products.name LIKE ' =>"%".$item."%"
                          ]

           ]);
                                debug($results);
         }else{ echo "else";
           if($minPrice >$maxPrice){
             $tempPrice = $minPrice;
             $minPriceTemp = $maxPrice;
             $maxPrice = $tempPrice;
             }
           debug($searchData);

           // $results = $connection
           //          ->newQuery()->select('products.name as Name, products.price as Price, products.image as Image')
           //                      ->from ('products')
           //                      ->where(['products.name LIKE'=>"%".$item."%",
           //                                'Products.price <='=> $maxPrice,
           //                                'Products.price >='=>$minPrice
           //                              ])
           //                      ->execute()
           //                      ->fetchAll('assoc');
                                debug($results);

         }//END OF ifelse
      //   $this->set('searchResults',($results));

         $this->set('results', $results);
         //$this->set('_serialize','results');
      }//END OF SEARCH


}
