<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $prodColorSelectedQuantity, $quantityCount=1, $productColorId;

    public function addToWishlist($productId)
    {
        if(Auth::check()){
            if(Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()){
                //session()->flash('message', 'already added');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'already added',
                    'type' => 'warning',
                    'status' => 409
                ]);
                return false;
            }else{
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' =>$productId
                ]);
                //session()->flash('message', 'added successfully');
                $this->emit('wishlistUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'added successfully',
                    'type' => 'success',
                    'status' => 200
                ]);
            }

        }
        else{
            //session()->flash('message', 'please login');
            $this->dispatchBrowserEvent('message', [
                'text' => 'please login',
                'type' => 'info',
                'status' => 401
            ]);
            return false;
        }
    }

    public function decrementQuantity(){
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }
    }
    public function incrementQuantity(){
        $this->quantityCount++;
    }

    public function addToCart(int $productId){
        if(Auth::check())
        {
            if($this->product->where('id', $productId)->where('status', '0')->exists())
            {
                if($this->product->productColors->count() > 1)
                {
                    if($this->prodColorSelectedQuantity != null)
                    {
                        if(Cart::where('user_id', Auth::user()->id)->where('product_id', $productId)->where('product_color_id',$this->productColorId)->exists())
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'product already added',
                                'type' => 'warning',
                                'status' => 200
                            ]);
                        }else
                        {
                            $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                        if($productColor->quantity >0)
                        {
                            if($productColor->quantity > $this->quantityCount)
                            {
                                ///
                                Cart::create([
                                    'user_id' => Auth::user()->id,
                                    'product_id' => $productId,
                                    'product_color_id' => $this->productColorId,
                                    'quantity' => $this->quantityCount
                                ]);
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'product added',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            }else
                            {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'only'.$this->productColor->quantity.'available',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        }else
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'color out of stock',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                        }
                    }
                    else
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'select color',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
                }else
                {
                    if(Cart::where('user_id', Auth::user()->id)->where('product_id', $productId)->exists())
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'product already added',
                            'type' => 'warning',
                            'status' => 200
                        ]);
                    }else
                    {
                        if($this->product->quantity > 0)
                        {
                            if($this->product->quantity > $this->quantityCount)
                            {
                                Cart::create([
                                    'user_id' => Auth::user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount
                                ]);
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'product added',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            }else
                            {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'only'.$this->product->quantity.'available',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        }else
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'out of stock',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    }
                }
            }else
            {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'product does not exist',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        }
        else
        {
            $this->dispatchBrowserEvent('message', [
                'text' => 'please login',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }
    public function colorSelected($productColorId){
        $this->productColorId = $productColorId;
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        $this->prodColorSelectedQuantity = $productColor->quantity;

        if($this->prodColorSelectedQuantity == 0){
            $this->prodColorSelectedQuantity = 'outOfStock';
        }
    }
    public function mount($category, $product){
        $this->category = $category;
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.frontend.product.view',[
            'category'=> $this->category,
            'product'=> $this->product
        ]);
    }
}
