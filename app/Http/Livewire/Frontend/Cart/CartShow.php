<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartShow extends Component
{

    public $cart;

    public function incrementQuantity(int $cartId){
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if($cartData){
            if($cartData->productColor()->where('id', $cartData->product_color_id)->exists()){
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if($productColor->quantity > $cartData->quantity){
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'only'.$productColor->quantity .'exists',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            }else{
                if($cartData->product->quantity > $cartData->quantity){
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
                else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'only'.$cartData->product->quantity.'exists',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            }

        }else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'something went wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id', auth()->user()->id)->first();
        if($cartData)
        {
            if($cartData->quantity > 1){

                $cartData->decrement('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity Updated',
                    'type' => 'success',
                    'status' => 200
                ]);
            }else{
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity cannot be less than 1',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        }else{

            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong!',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    public function removeCartItem(int $cartId){
        $cartRemoveData = Cart::where('id',$cartId)->where('user_id', auth()->user()->id)->first();
        if($cartRemoveData){
            $cartRemoveData->delete();

            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => 'item removed',
                'type' => 'success',
                'status' => 200
            ]);
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong!',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }
    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }
}
