<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $prodColorSelectedQuantity, $quantityCount=1;

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
    public function colorSelected($productColorId){
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
