<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Reseller;
use Illuminate\Http\Request;
use App\Models\ResellerModification;
use Illuminate\Support\Facades\Auth;

class ResellerController extends Controller
{
    public function reseller_dashboard()
    {

        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please log in to proceed to checkout.');
        }

        $products = Product::paginate(9);
        $categories = Category::all();

        // Fetch cart count for the logged-in user
        $cart = Reseller::count();

        return view('reseller.dashboard', compact('products', 'categories', 'cart'));;


    }



    public function reseller_product_details($id){

        $product = Product::find($id);

        $category = Category::all();

        $cart_count = Reseller::count();

        return view('reseller.product_details', compact('product', 'category', 'cart_count'));

    }

    public function reseller_cart_page()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please log in to access your cart.');
        }
    
        $category = Category::all();
        $cart_count = Reseller::where('reseller_id', Auth::id())->count();
    
        // Fetch cart items specific to the logged-in user
        $carts = Cart::where('user_id', Auth::id())->get();
    
        return view('reseller.cart_page', compact('carts', 'category', 'cart_count'));
    }

    public function reseller_checkout_page()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please log in to proceed to checkout.');
        }
    
        $category = Category::all();
    
        // Fetch cart items specific to the logged-in user
        $cart_count = Reseller::where('user_id', Auth::id())->count();
        $carts = Reseller::where('reseller_id', Auth::id())->get();
    
        return view('reseller.checkout_page', compact('category', 'cart_count', 'carts'));
    }
    



    public function reseller_order_history()
    {
        $category = Category::all();
        $cart_count = Reseller::where('reseller_id', Auth::id())->count();
    
        // Fetch orders for the logged-in user only
        $orders = Reseller::where('reseller_id', Auth::id())->get();
    
        return view('reseller.order_history', compact('category', 'cart_count', 'orders'));
    }



    public function filterByCategory(Request $request)
    {
        // Start query for filtering products
        $products = Product::query();
    
        // Filter by category or subcategory
        if ($request->has('category')) {
            $products->where('category_id', $request->category);
        } elseif ($request->has('subcategory')) {
            $products->where('subcategory', $request->subcategory);
        }
    
        // Filter by price range if provided
        if ($request->has('price_range') && is_array($request->price_range)) {
            $priceRanges = $request->price_range;
    
            // Apply price filtering if 'all' is not selected
            if (!in_array('all', $priceRanges)) {
                $products->where(function ($query) use ($priceRanges) {
                    foreach ($priceRanges as $range) {
                        [$min, $max] = explode('-', $range);
                        $query->orWhereBetween('price', [(int)$min, (int)$max]);
                    }
                });
            }
        }
    
        // Execute the query to get products
        $products = $products->get();
    
        // Fetch additional data for the view
        $cart_count = '0';
        $categories = Category::all();
    
        // Return view with filtered products and additional data
        return view('user.shop', compact('products', 'cart_count', 'categories'));
    }


    public function modify_product_page($id){

        $product = Product::find($id);
        
        $category = Category::all();
    
        // Fetch cart items specific to the logged-in user
        $cart_count = Reseller::count();
        
    
        return view('reseller.modify_product', compact('category', 'cart_count','product'));

    }


    public function reseller_checkout(Request $request)
    {
        $data = new Reseller();
    
        // Associate the order with the logged-in user
        $data->reseller_id = Auth::id();
        $data->reseller_name = Auth::user()->name;
        $data->email = Auth::user()->email;

        $data->product_name = $request->product_name;
     
        $data->modified_price = $request->price;
        $data->modified_dcharge = $request->delivery_charge;
        $data->quantity = $request->quantity;
        $data->payment = $request->payment_method;
        $data->bkash = $request->bkash;
        $data->product_id = $request->product_id;
        $data->approval_status = 'pending';

        $image = $request->image;

        if($image){
            $imgname = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('productImage', $imgname);
            $data->modified_image = $imgname;
        }


        $product = Product::find($request->product_id);

        $data->product_image = $product->image;


        $data->save();
    
    
        return redirect()->back()->with('message', 'Order placed Successfully!');
    }



}
