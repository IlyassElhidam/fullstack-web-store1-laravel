<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class productController extends Controller
{
    public function add(Request $request){
        $product_infos= $request->post();
        $is_added=  Product::create([
           'name'=>strip_tags($product_infos['name']),
           'image'=>$request->file('image')->store('products'),
           'price'=>strip_tags($product_infos['price']),
           'description'=>strip_tags($product_infos['description']),''
         ]);
    }
    public function get_products(){
        $products= Product::inRandomOrder()->get();
        return $products;
    }
    public function show($product_id= null){
         $product_infos= Product::where('id', $product_id)->first();
       if($product_infos){
          return $product_infos;
       }
       else{
        return false;
       }
    }
    public function edit(Request $request){
      $product_infos= $request->post();
      $image_existing= $request->file('product_image');
      if(empty($image_existing)){
              $to_update= Product::where('id', $product_infos['id'])->update([
                 'id'=>strip_tags($product_infos['id']),
                 'name'=>strip_tags($product_infos['product_name']),
                 'price'=>strip_tags($product_infos['product_price']),
                 'description'=>strip_tags($product_infos['product_description']),
              ]);
              return response()->json([
                'message'=>'no image'
             ],200);
      }
      else if(!empty($image_existing)){
               $to_update= Product::where('id', $product_infos['id'])->update([
                  'id'=>strip_tags($product_infos['id']),
                 'name'=>strip_tags($product_infos['product_name']),
                'image'=>$request->file('product_image')->store('products'),
                 'price'=>strip_tags($product_infos['product_price']),
                 'description'=>strip_tags($product_infos['product_description']),
              ]);
              return response()->json([
                'message'=>'yes image'
             ],200);
      }
    }
    public function search($serach_val= null){
      $to_serach= Product::where('name','like','%'.$serach_val.'%')->get();
     return $to_serach;
    }
    public function delete($product_id=null){
       $to_delete= Product::where('id',$product_id)->delete();
       return $to_delete;
    }
    public function uupdat( Request $request, $id){
      $to_uupdate= $request->post();
      return $to_uupdate;
   }
}
