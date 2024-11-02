<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Reseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function redirect()
    {
        
        if (Auth::check()) {
            if (Auth::user()->usertype == 'user') {
                $products = Product::paginate(8);
                $categories = Category::all();

                // Fetch cart count for the logged-in user
                $cart = Cart::where('user_id', Auth::id())->count();

                return view('user.index', compact('products', 'categories', 'cart'));
            } elseif (Auth::user()->usertype == 'admin') {

                return view('admin.index');

            } elseif (Auth::user()->usertype == 'reseller') {

                $products = Product::paginate(8);
                $categories = Category::all();

                // Fetch cart count for the logged-in user
                $cart = Reseller::where('reseller_id', Auth::id())->count();

                return view('reseller.dashboard', compact('products', 'categories', 'cart'));;
                
            }
        }
        return redirect('/');
    }


    public function home()
    {
        $products = Product::paginate(8);
        $categories = Category::all();

        // Show cart count only for logged-in user; set to 0 if not logged in
        $cart = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('user.index', compact('products', 'categories', 'cart'));
    }


    public function add_product_page()
    {
        $data = Category::all();
        return view('admin.add_product_page', compact('data'));
    }


    public function add_product(Request $request)
    {
        $data = new Product();

        $data->title = $request->title;
        $data->subtitle = $request->subtitle;
        $data->description = $request->description;

        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->delivery_charge = $request->delivery_charge;

        $categoryid = $request->category_id;

        $category = Category::find($categoryid);

        $data->category = $category->name;

        $data->category_id = $categoryid;


        $image = $request->image;

        if ($image) {
            $imgname = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('productImage', $imgname);
            $data->image = $imgname;
        }

        $data->save();

        return redirect()->back()->with('message', 'Product added Successfully!');
    }

    public function view_product_page()
    {
        $data = Product::all();
        return view('admin.view_product_page', compact('data'));
    }

    public function category_page()
    {
        $data = Category::all();
        return view('admin.category_page', compact('data'));
    }


    public function add_category(Request $request)
    {

        $data = new Category();

        $data->name = $request->name;

        $data->save();

        return redirect()->back()->with('message', 'Category added Successfully!');
    }

    public function update_category_page($id)
    {
        $data = Category::find($id);
        return view('admin.update_category_page', compact('data'));
    }



    public function update_category(Request $request, $id)
    {

        $data = Category::find($id);

        $data->name = $request->name;

        $data->save();

        return redirect('category_page')->with('message', 'Category updated Successfully!');
    }

    public function delete_category($id)
    {

        $data = Category::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Category deleted Successfully!');
    }

    public function edit_product_page($id)
    {
        $data = Product::find($id);
        $data2 = Category::all();
        return view('admin.edit_product_page', compact('data', 'data2'));
    }


    public function update_product(Request $request, $id)
    {
        $data = Product::find($id);

        $data->title = $request->title;
        $data->subtitle = $request->subtitle;
        $data->description = $request->description;

        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->delivery_charge = $request->delivery_charge;

        $categoryid = $request->category_id;

        $category = Category::find($categoryid);

        $data->category = $category->name;

        $data->category_id = $categoryid;


        $image = $request->image;

        if ($image) {
            $imgname = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('productImage', $imgname);
            $data->image = $imgname;
        }

        $data->save();

        return redirect('view_product_page')->with('message', 'Product updated Successfully!');
    }



    public function delete_product($id)
    {

        $data = Product::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Product deleted Successfully!');
    }

    public function order_page()
    {
        // Retrieve all orders and carts
        $data = Order::all();
        $carts = Cart::all();

        // Loop through each order and decode the JSON-encoded columns
        foreach ($data as $order) {
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

        // Pass both orders and carts to the view
        return view('admin.order_page', compact('data', 'carts'));
    }


    public function status_OnTheWay($id)
    {

        $data = Order::find($id);

        $data->delivery_status = 'OnTheWay';

        $data->save();

        return redirect()->back();
    }


    public function status_rejected($id)
    {

        $data = Order::find($id);

        $data->delivery_status = 'Rejected';

        $data->save();

        return redirect()->back();
    }

    public function delete_order($id)
    {

        $data = Order::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Product deleted Successfully!');
    }


 








    //Reseller 

    public function reseller_products_page(){

        $data = Reseller::all();

        return view('admin.reseller_products_page', compact('data'));

    }



    public function approval_accepted($id)
    {

        $data = Reseller::find($id);

        $data->approval_status = 'Approved';

        $data->save();

        return redirect()->back();
    }


    public function approval_rejected($id)
    {

        $data = Reseller::find($id);

        $data->approval_status = 'Rejected';

        $data->save();

        return redirect()->back();
    }

    public function delete_reseller_product($id)
    {

        $data = Reseller::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Product deleted Successfully!');
    }


    
}
