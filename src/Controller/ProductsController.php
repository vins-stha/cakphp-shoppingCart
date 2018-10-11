<?php
namespace App\Controller;




use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use  App\Controller\Event;
use Cake\Http\Session\DatabaseSession;
 // mention at top
class ProductsController extends AppController
{

//  public $components = array('Auth');
  public $uses = array('Product','Cart');

  public function initialize(){
       parent::initialize();
       $this->loadComponent('RequestHandler');
        //$this->Auth->allow('*');
      //   debug(get_included_files());
      //   $this->Auth->allow(['ajaxTest', 'index']);
         // $this->Auth->allow();

  //    $table =  $this->loadModel('Carts');
       }

function ajaxTest(){
     $mycount = (new CartsController())->getCount();
        echo "<br>my count is from addti prodcut controller ".$mycount;
}
public function addit() {
  $this->render = false;
  $table =  $this->loadModel('Carts');
     if ($this->request->is('post')) {
         $id = $this->request->data['id'];//retrieve the id of the product
        // debug($this->Products->get($id));//retrieve the product details
        // $this->Carts->addProduct($this->Products->get($id));
       $result = (new CartsController())->addinTable($id);
       $mycount = (new CartsController())->getCount();
   echo "<br>total number of items is <b> ".$mycount."</b>";
             }else{
                echo "else";
                debug($this->request->get($id));
              }
           return json_encode($mycount);
 }

#######################33333
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
    //  $allProducts = $this->readProductinCart();
      // echo "all product is ".$allProducts;
      // if (null!=$allProducts) {
      //     if (array_key_exists($id, $allProducts)) {
      //         $allProducts[$id]++;
      //     } else {
      //         $allProducts[$id] = 1;
      //     }
      // } else {
      //     $allProducts[$id] = 1;
      // }
      // $this->saveProduct($allProducts);
  }
  public function destroy(){
    $session = $this->request->session();
    $session->read('Cart');
    if($session->destroy('Cart')){
      echo "SUCCESSFULLY DESTROYED SESSION";
    }
  }
  public function readSession(){
      $session = $this->request->session();
      debug($session->read('Cart'));
  }


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
  public function search (){
      echo "hello";

  }

  public function getCount() {
  $allProducts = $this->readProduct();

  if (count($allProducts)<1) {
      return 0;
  }

  $count = 0;
  foreach ($allProducts as $product) {
      $count=$count+$product;
  }

  return $count;
}
  //save product in cart in session
  public function saveProduct($data){
  //  $session = new Session();
    return $session->write('cart',$data);

  }
########################3
    public function index()//list the products from the table
    {
        $products = $this->paginate($this->Products);
        $this->set(compact('products'));
    }

    public function view($id = null)
      {
        $product = $this->Products->get($id, [
              'contain' => []
          ]);
         $this->set('product', $product);
        }
    public function addToCart2($id)

    {    $this->autoRender = false;
         $item = $this->Products->get($id);
          echo "hello your product  is ".$item->name;
    }
    public function additnow($id){
      echo $id;

    }

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

}
