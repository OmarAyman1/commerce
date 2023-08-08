@extends('layouts.admin')

@section('content')


<div class="row">
    <div class="col-md-12 grid-margin">

        @if (session('message'))
            <h5 class="alert alert-success mb-2">{{session('message')}}</h5>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Edit Product
                    <a href="{{ url('admin/products') }}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{url('admin/products/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                        Home
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag-tab-pane" aria-selected="false">
                        SEO tags
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">
                        Details
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">
                          Images
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane" aria-selected="false">
                          colors
                        </button>
                      </li>
                </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="mb-3">
                            <label>Category</label>
                            <select name="category_id" id="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{$category->id== $product->category_id ? 'selected': ''}}>
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>product name</label>
                                <input type="text" name="name" value="{{$product->name}}" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label>product slug</label>
                                <input type="text" name="slug" value="{{$product->name}}" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label>Brands</label>
                            <select name="brand" id="form-control">
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->name}}" {{$brand->name == $product->brand ? 'selected': ''}}>
                                        {{$brand->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>small description</label>
                            <textarea name="small_description"  class="form-control" rows="4">{{$product->small_description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>description</label>
                            <textarea name="description"  class="form-control" rows="4">{{$product->description}}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">
                        <div class="mb-3">
                            <label>meta title</label>
                                <input type="text" name="meta_title" value="{{$product->meta_title}}" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label>meta description</label>
                            <textarea name="meta_description"  class="form-control" rows="4">{{$product->meta_description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>meta keyword</label>
                            <textarea name="meta_keyword"  class="form-control" rows="4">{{$product->meta_keyword}}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>original price</label>
                                    <input type="text" name="original_price" value="{{$product->original_price}}" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <label>selling price</label>
                                    <input type="text" name="selling_price" value="{{$product->selling_price}}" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <label>quantity</label>
                                    <input type="number" name="quantity" value="{{$product->quantity}}" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <label>trending</label>
                                    <input type="checkbox" name="trending" {{$product->trending == '1' ? 'checked': ''}} style="width:50px; height:50px;"/>
                                </div>
                                <div class="mb-3">
                                    <label>status</label>
                                    <input type="checkbox" name="status" {{$product->status == '1' ? 'checked': ''}} style="width:50px; height:50px;"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                        <div class="mb-3">
                            <label>upload product images</label>
                            <input type="file" name="image[]" multiple class="form-control">
                        </div>
                        <div>
                            @if ($product->productImages)
                                <div class="row">
                                    @foreach ($product->productImages as $image)
                                        <div class="col-md-2">
                                            <img src="{{asset($image->image)}}" style="width: 80px; height: 80px;" class="me-4 border" alt="Img"/>
                                            <a href="{{url('admin/product-image/'.$image->id.'/delete')}}" class="d-block">Remove</a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <h5>no image uploaded</h5>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab" tabindex="0">
                        <div class="mb-3">
                            <h4>add product color</h4>
                            <label>select color</label>
                            <div class="row">
                                <div class="col-md-3">
                                    @forelse ($colors as $color)
                                    <div class="p-2 border mb-3">
                                        <input type="checkbox" name="colors[{{$color->id}}]" value="{{$color->id}}" />{{$color->name}}
                                        <br/>
                                        Quantity: <input type="number" name="colorquantity[{{$color->id}}]" style="width:70px; border:1px solid ">
                                    </div>
                                    @empty
                                        <div class="col-md-12">
                                            <h1>no colors found</h1>
                                        </div>
                                    @endforelse

                                </div>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>color name</th>
                                        <th>quantity</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->productColors as $prodColor)
                                        <tr class="prod-color-tr">
                                            <td>
                                                @if ($prodColor->color)
                                                    {{$prodColor->color->name}}
                                                @else
                                                    no color found
                                                @endif
                                            </td>
                                            <td>
                                                <div class="input-group mb-3" style="widt:150px">
                                                    <input type="text" value="{{$prodColor->quantity}}" class="productColorQuantity form-control form-control-sm"/>
                                                    <button type="button" value="{{$prodColor->id}}" class="updateProductColorBtn btn btn-primary btn-sm text-white">update</button>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" value="{{$prodColor->id}}" class="deleteProductColorBtn btn btn-danger btn-sm text-white">delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click','.updateProductColorBtn' function () {
                var product_id = "{{$product->id}}"
                var prod_color_id = $(this).val();
                var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();

                if(qty <= 0){
                    alert('Quantity is required');
                    return false;
                }
                var data = {
                    'product_id' : product_id,
                    'prod_color_id' : prod_color_id,
                    'qty': qty
                }

                $.ajax({
                    type: "POST",
                    url: "/admin/product-color/"+prod_color_id,
                    data: data,
                    success: function (response) {
                        alert(response.message);
                    }
                });
            });

            $(document).on('click','.deleteProductColorBtn' function () {

                var prod_color_id = $(this).val();
                var thisClick = $(this);

                $.ajax({
                    type: "GET",
                    url: "/admin/product-color/"+prod_color_id+"/delete",
                    data: data,
                    success: function (response) {
                        thisClick.closest('.prod-color-tr').remove();
                        alert(response.message);
                    }
                });
            });
        });
    </script>
@endsection
