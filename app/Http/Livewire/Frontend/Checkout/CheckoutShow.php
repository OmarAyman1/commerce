<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount=0;

    public $fullname, $email, $phone, $pincode, $address, $payment_mode = null, $payment_id=null;

    public function rules(){
        return [
            'fullname'=> 'required|string|max:121',
            'email'=> 'required|email|max:121',
            'phone'=> 'required|string|max:11|min:10',
            'pincode'=> 'required|string|max:6|min:6',
            'address'=> 'required|string|max:500',
        ] ;
    }

    public function placeOrder(){
        $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'trackin_no' => 'test-'.Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status_message' =>'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);
        foreach ($this->carts as $cartItem){
            $orderItems = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product->id,
                'product_color_id' =>  $cartItem->product_color->id,
                'quantity' =>  $cartItem->quantity,
                'price' =>  $cartItem->product->selling_price,
            ]);
            if ($cartItem->prod_color_id != null) {
                $cartItem->productColor()->where('id', $cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);
            } else {
                $cartItem->product()->where('id', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
            }

        }

        return $order;
    }
    public function codOrder(){
        $this->payment_mode = 'Cash on delivery';
        $codOrder = $this->placeOrder();
        if($codOrder){
            Cart::where('user_id', auth()->user()->id)->delete();

            $this->dispatchBrowserEvent('message', [
                'text' => 'order placed successfully',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('thank_you');
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'something went wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    public function totalProductAmount(){
        $this->totalProductAmount=0;
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->carts as $cartItem){
            $this->totalProductAmount += $cartItem->product->selling_price*$cartItem->quantity;
        }
        return $this->totalProductAmount;
    }
    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show',[
            'totalProductAmount'=>$this->totalProductAmount
        ]);
    }
}
