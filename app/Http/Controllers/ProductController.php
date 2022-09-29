<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Product;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    

    public function create(Request $request)
    {
        Product::create($request->all());
    }

    public function update(Request $request, $id)
    {
        Product::where('id', $id)->update($request->all());
    }

    

    public function destroy($id)
    {
        Product::where('id', $id)->delete();
    }
}
