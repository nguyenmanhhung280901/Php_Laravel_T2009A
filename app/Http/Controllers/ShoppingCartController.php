<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    //
    public static $menu_parent = 'shopping-cart';

    public function show(){
        if (Session::has('shoppingCart')){
            $shoppingCart = Session::get('shoppingCart');
        }else{
            $shoppingCart = [];
        }
        return view('cart', [
            'shoppingCart' => $shoppingCart
        ]);
    }

    public function add(Request $request){
        $productId = $request->get('id');
        $productQuantity = $request->get('quantity');
        if ($productQuantity <= 0){
            return view('admin.errors.404',[
                'msg' => 'Số lượng sản phẩm cần lớn hơn 0.',
                'menu_parent' => self::$menu_parent,
                'menu_action' => 'create'
            ]);
        }

        $obj = Product::find($productId);

        if ($obj == null){
            return view('admin.errors.404',[
                'msg' => 'Không tìm thấy sản phẩm.',
                'menu_parent' => self::$menu_parent,
                'menu_action' => 'create'
            ]);
        }
    }
}
