<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Crad;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class user_getsion extends Controller
{
  public function products(){
    $products= Product::get();
    return $products;
  }
  public function show_product($id=null){
    $products= Product::where('id',$id)->first();
    return $products;
  }
  public function u_search($s_val=null){
     $s_products= Product::where('name','LIKE','%'.$s_val.'%')->get();
     if($s_products !== null){
         return $s_products;
     }
     else{
      return 'notnotnot';
     }
   
  }
  public function add_card(Request $request){
    $card_infos=$request->post();
     $card_id_added= Crad::create([
         'userID'=>$card_infos['userID'],
         'productID'=>$card_infos['productID'],
         'quantity'=>1,
      ]);
    if($card_id_added){
       return ['message'=>'cucces'];
    }
  }
  public function getUsercrad($id=null){
      $card= DB::table('products')
      ->join('crads','products.id','=','crads.productID')
      ->join('users','crads.userID','=','users.id')
      ->where('users.id',$id)
      ->select('products.image as image','products.price as price',
               'products.name as name','products.description as description',
                'crads.id as id','crads.quantity as quantity')
      ->get();
      if($card){
        return $card;
      }
  }
  public function deleteCard($id)
  {
     $is_deleted= Crad::where('id',$id)->delete();
     if($is_deleted){
       return ['message'=>'deleted'];
     }
  }
  //get all cards
  public function cards()
  {
   $cards=  Crad::all();
    return $cards;
  }
  //inxa2allah add order function tomorrow;
  public function updateInCard(Request $request){
        $card_infos=$request->post();
        $is_update=  Crad::where('id',$card_infos['id'])->update([
           'quantity'=>$card_infos['quantity'],
        ]);
  }
  public function orders(){
   $orders= Db::table('orders')
   ->join('products','orders.productID','=','products.id')
   ->select('orders.id','products.price as price')
   ->get();
   return $orders;
  }
  public function addOrders(Request $request){
     $userInfos=$request->post();
    $cards= Crad::where('userID',$userInfos[0])->get();
    Crad::where('userID',$userInfos[0])->delete();
    //insert data to orders table
     for($i=0; $i<count($cards); $i++){
        Order::create([
               'userID'=>$cards[$i]['userID'],
               'productID'=>$cards[$i]['productID'],
               'confirmed'=>'No',
               'delivred'=>'No',
         ]);
    }
    return  ['message'=>'passed']; 
   }
}

