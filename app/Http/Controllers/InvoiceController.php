<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddInvoiceRequest;
use App\Models\Cart;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function generate(Request $request)
    {
        $user= Auth::user();
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $invoiceNumber = time() . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT) . str_pad($user->id, 2, '0', STR_PAD_LEFT);
        return view('/checkout', ['cart' => $cart, 'totalPrice' => $cart->totalPrice, 'invoiceNumber' => $invoiceNumber]);
    }

    public function checkout(AddInvoiceRequest $request, $invoiceNumber)
    {
        $userId = Auth::user()->id;
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $invoice = new Invoice();

        $invoice->cart = serialize($cart);
        $invoice->invoice_number = $invoiceNumber;
        $invoice->user_id = $userId;
        $invoice->address = $request->address;
        $invoice->postcode = $request->postcode;
        // dd($invoice);
        if($invoice){
            Session::flash('status','success');
            Session::flash('message','Checkout Successful');
        }
        $invoice->save();

        foreach($cart->items as $item){
            $count = $item['qty'];
            // dd($count);
            $id = $item['item']->id;

            $item = new ItemController();
            $item->decreaseItem($id, $count);
        }
        
        $request->session()->forget('cart');
        return redirect('/');
    }
}
