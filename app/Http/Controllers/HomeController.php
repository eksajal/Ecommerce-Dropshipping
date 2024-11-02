<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    public function view_details_page($id){

        $product = Product::find($id);

        $category = Category::all();

        $cart_count = Cart::count();

        return view('user.view_details_page', compact('product', 'category', 'cart_count'));

    }
 

    public function cart_page()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please log in to access your cart.');
        }
    
        $category = Category::all();
        $cart_count = Cart::where('user_id', Auth::id())->count();
    
        // Fetch cart items specific to the logged-in user
        $carts = Cart::where('user_id', Auth::id())->get();
    
        return view('user.cart_page', compact('carts', 'category', 'cart_count'));
    }
    
    public function add_cart($id)
    {
        if (Auth::check()) {
            $product = Product::find($id);
            
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }
    
            // Create a new cart item
            $cart = new Cart();
            $cart->user_id = Auth::id(); // Set the user_id to the logged-in user's ID
            $cart->product_name = $product->title;
            $cart->price = $product->price;
            $cart->quantity = 1; // Default quantity to 1
            $cart->product_id = $product->id;
            $cart->product_img = $product->image;
    
            $cart->save();
    
            return redirect()->back()->with('message', 'Product added to Cart Successfully!');
        } else {
            return redirect('login')->with('error', 'You must be logged in to add products to the cart.');
        }
    }
    

    public function remove_cart($id){

        $data = Cart::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Product removed Successfully!');

    }

    public function checkout_page()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please log in to proceed to checkout.');
        }
    
        $category = Category::all();
    
        // Fetch cart items specific to the logged-in user
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $carts = Cart::where('user_id', Auth::id())->get();
    
        return view('user.checkout_page', compact('category', 'cart_count', 'carts'));
    }

    public function checkout(Request $request)
    {
        $order = new Order();
    
        // Associate the order with the logged-in user
        $order->user_id = Auth::id();
    
        // Save products, prices, images, and other data from the form (except product_id)
        $order->product_name = json_encode($request->products);
        $order->product_img = json_encode($request->images);
        $order->price = json_encode($request->prices);
        $order->quantity = json_encode($request->quantities);
        $order->total = $request->total;
    
        // Save customer details
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->mobile;
        $order->address1 = $request->address1;
        $order->address2 = $request->address2;
        $order->city = $request->city;
        $order->payment = $request->payment_method;
    
        $order->save();
    
        return redirect()->back()->with('message', 'Order placed Successfully!');
    }
    

    public function order_history()
    {
        $category = Category::all();
        $cart_count = Cart::where('user_id', Auth::id())->count();
    
        // Fetch orders for the logged-in user only
        $orders = Order::where('user_id', Auth::id())->get();
    
        // Decode JSON fields for each order
        foreach ($orders as $order) {
            if (!empty($order->product_name)) {
                $order->product_name = json_decode($order->product_name, true); // Decode product_name
            }
            if (!empty($order->price)) {
                $order->price = json_decode($order->price, true); // Decode price
            }
            if (!empty($order->product_img)) {
                $order->product_img = json_decode($order->product_img, true); // Decode product_img
            }
            if (!empty($order->quantity)) {
                $order->quantity = json_decode($order->quantity, true); // Decode quantity
            }
        }
    
        return view('user.order_history', compact('category', 'cart_count', 'orders'));
    }

    public function shop(){

        $cart_count = Cart::where('user_id', Auth::id())->count();

        $categories = Category::all();

        $products = Product::all();

        return view('user.shop',compact('cart_count','categories','products'));

    }

    public function contact(){

        return view('user.contact');

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
       
    
}
