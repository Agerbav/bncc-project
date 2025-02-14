<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddItemRequest;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Cart;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $items = Item::where("name","like","%".$keyword."%")->
        with('categories')->
        paginate(16);
        return view("home", ['itemList' => $items]);
    }

    public function show($id)
    {
        $currentItem = Item::with(['categories'])->findOrFail($id);
        return view('item', ['item' => $currentItem]);
    }

    public function adminView(Request $request)
    {
        $keyword = $request->keyword;
        $items = Item::where('name','like','%'.$keyword.'%')->
        with(['categories'])->
        paginate(25);
        return view('admin/adminPage', ['itemList' => $items]);
    }

    public function addItem()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin/addItem', ['categories'=> $categories]);
    }
    
    public function store(AddItemRequest $request)
    {
        // dd($request->all());
        $newName = '';
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->name.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('images', $newName);
        }
        
        $request['image_path'] = $newName;
        $item = Item::create($request->all());
        if($item){
            Session::flash('status','success');
            Session::flash('message','Item created Succesfully');
        }
        return redirect('admin-page');
    }
    
    public function updateItem(Request $request, $id)
    {
        $item = Item::with(['categories'])->findOrFail($id);
        $categories = Category::where('id', '!=', $item->category_id)->get(['id', 'name']);
        // dd($item);
        return view('admin/updateItem', ['item'=> $item, 'categories' => $categories]);
        // return redirect('admin-page');
    }
    
    public function update(AddItemRequest $request, $id)
    {
        $item = Item::findOrFail($id);
        $newName = '';
        // dd($request->all());
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->name.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('images', $newName);
            $request['image_path'] = $newName;
        }
        if($item){
            Session::flash('status','success');
            Session::flash('message','Item updated Succesfully');
        }
        $item->update($request->all());
        return redirect('admin-page');
    }

    public function decreaseItem($id, $count)
    {
        $item = Item::findOrFail($id);
        // dd($count);
        $item->count = $item->count - $count;
        // dd($item);
        $item->update();
    }
    
    public function delete($id)
    {
        $item = Item::findOrFail($id);
        return view('admin/deleteItem', ['item'=> $item]);
    }
    
    public function destroy($id)
    {
        $deletedItem = Item::findOrFail($id);
        $deletedItem->delete();
        if($deletedItem){
            Session::flash('status','success');
            Session::flash('message','Item deleted Succesfully');
        }
        return redirect('admin-page');
    }

    public function addToCart(Request $request, $id)
    {
        $item = Item::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($item, $id);
        $request->session()->put('cart', $cart);
        // dd($cart);
        return redirect('/');
    }
    
    public function increaseCart(Request $request, $id)
    {
        $item = Item::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        // dd($cart);
        $cart->add($item, $id);
        $request->session()->put('cart', $cart);
        // dd($cart);
        return redirect('/cart');
    }

    public function decreaseCart(Request $request, $id)
    {
        $item = Item::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($item, $id);
        $request->session()->put('cart', $cart);
        // dd($cart);
        return redirect('/cart');
    }
    
    public function getCart()
    {
        if(!Session::has('cart')){
            return view('cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        // dd($cart);
        return view('cart', ['cart' => $cart, 'totalPrice' => $cart->totalPrice]);
    }

}

