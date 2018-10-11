<?php
namespace App\Controller;

class UserController extends AppController {
  public function initialize(){
    parent::initialize();
    $this->viewBuilder()->layout('defaultShoppingCart');
  }

  public function register(){
    echo "user controller says hello";

      $products = array(
      "name" =>"iphoneX",
      "price" =>300,
      "year"  =>2017
    );
    $this->set(compact("products"));
  }

}


?>
