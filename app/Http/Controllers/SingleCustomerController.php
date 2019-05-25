<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Customers;
use Illuminate\Support\Facades\DB;

class SingleCustomerController extends Controller
{

    public function __construct() {
        $this->customers = new Customers;
    }

    //Adds Customer
    public function AddCustomer(Request $request) {
      $dbName = $request['dbName'];
      $this->customers->setConnection($dbName);
      $this->customers->create($request->all());

    }

    //Shows Single Customer
    public function showSingleCustomer(Request $request) {

        $dbName = $request->query('dbName');
        $customerid = $request->query('id');
        $this->customers->setConnection($dbName);

        $singlecustomer = $this->customers->where('id', $customerid)->first();

        

        return response()->json([
          'response' => $singlecustomer
        ]);

        //file_put_contents("log.txt", "yo");

    }


    public function getTabs() {

      $links = array (
        ['button_color' => 'btn-primary', 'data_target' => '#add_edit_customer', 'fa' => 'fa-envelope-square'],

      );

      $tabs = array(
        ['tab_name' => 'info', 'tab_href' => '#tab-info', 'class' => 'active'],
        ['tab_name' => 'history', 'tab_href' => '#tab-history', 'class' => '']

      );

      $tabs_links = array(
        "links" => $links,
        "tabs" => $tabs
      );

      return response()->json([
        'response' => $tabs_links
      ]);


    }



}
