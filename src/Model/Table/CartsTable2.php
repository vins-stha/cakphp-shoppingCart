<?php
namespace App\Model\Table;
namespace App\Http\Session;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Network\Session;
use Cake\Core\Configure;

class CartsTable extends Table
{
  public function addToCart(){
    //$cart_table = TableRegistry::get('Cart');
    echo "hello from model";
  }


}
