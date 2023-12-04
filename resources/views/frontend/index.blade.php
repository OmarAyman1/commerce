@extends('layouts.app')

@section('title', 'Home page')

@section('content')

<div id="carouselExampleCaptions" class="carousel slide">
    {{-- <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div> --}}

    <div class="carousel-inner">

        @foreach ($sliders as $key=>$slider)
        <div class="carousel-item {{$key==0  ? 'active':''}}  ">
            @if($slider->image)
            <img src="{{ asset("$slider->image")}}" class="d-block w-100" alt="...">
            @endif
            {{-- <div class="carousel-caption d-none d-md-block">
              <h5>{{$slider->title}}</h5>
              <p>{{$slider->description}}</p>
            </div> --}}
            <div class="carousel-caption d-none d-md-block">
                <div class="custom-carousel-content">
                    <h1>
                        {!!$slider->title!!}
                    </h1>
                    <p>
                        {!!$slider->description!!}
                    </p>
                    <div>
                        <a href="#" class="btn btn-slider">
                            Get Now
                        </a>
                    </div>
                </div>
            </div>
          </div>

        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
 </div>

 <div class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h4>welcome to x</h4>
                <div class="underline mx-auto"></div>
                <p>
                    dummy paragraph
                </p>
            </div>
        </div>
    </div>
 </div>

 <div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>trending</h4>
                <div class="underline mb-4"></div>
            </div>

            @if($trendingProducts)
            <div class="col-md-12">
                <div class="owl-carousel owl-theme trending-product">
                    @foreach ($trendingProducts as $product)
                            <div class="item">
                                <div class="product-card">
                                    <div class="product-card-img">

                                            <label class="stock bg-danger">new</label>



                                        @if ($product->productImages->count() > 0)
                                            <a href="{{url('/collections/'.$product->category->slug.'/'.$product->slug)}}">
                                                <img src="{{ asset($product->productImages[0])}}" alt="{{$product->name}}">
                                            </a>
                                        @endif

                                    </div>
                                    <div class="product-card-body">
                                        <p class="product-brand">{{$product->brand}}</p>
                                        <h5 class="product-name">
                                        <a href="{{url('/collections/'.$product->category->slug.'/'.$product->slug)}}">
                                                {{$product->name}}
                                        </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">{{$product->selling_price}}</span>

                                            <span class="original-price">{{$product->original_price}}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4>no trendingProducts available</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
 </div>
@endsection

@section('script')
<script>
    $('.trending-product').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>
@endsection
