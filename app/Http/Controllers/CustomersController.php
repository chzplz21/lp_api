<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CustomersController extends Controller
{

  public function __construct() {
    $this->customers = new Customers;
  }

  //Gets all customers
  public function GetAll(Request $request) {

    $dbName = $request->query('dbName');
    $this->customers->setConnection($dbName);

    $allCustomers = DB::connection('lpclient')->select('select * from customers');
    $allCustomers = json_decode(json_encode($allCustomers), True);

    foreach($allCustomers as &$customer) {
       if( !empty($customer['parentid']) ) {
        $parent = $this->customers->where('id', $customer['parentid'])->first();
        $customer['parent_name'] = $parent['name'];
        $customer['parent_id'] = $parent['id'];
        $customer['parentCount'] =  $this->CountParents($customer, $parent);

      } else {
        $customer['parentCount'] = 0;
      }

    }

    return response()->json([
      'response' => $allCustomers
    ]);

  }



 //Counts amount of ancestors of customer
  public function CountParents($customer, $parent) {
        $count = 0;

        while(!empty($parent)) {
          $customer = $parent;
          $parent = $this->customers->where('id', $customer['parentid'])->first();
          $count++;
        }

        return $count;

  }

  //Gets header columns for all customers view
   public function GetCustomersHeader(Request $request) {

     $column_names = ["name", "physical address", "primary #", "email"];

     $header_info = array(
       "column_names" => $column_names,
       "header_title" => "Customers",
       "data_target" => "#add_edit_customer"
     );

      return response()->json([
        'response' => $header_info
      ]);

   }





}
