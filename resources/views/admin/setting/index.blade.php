@extends('layouts.admin')

@section('title', 'admin settings')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">

        @if (session('message'))
            <div class="alert alert-success mb-3">{{session('message')}}</div>
        @endif

        <form action="{{url('/admin/settings')}}" method="POST">
            @csrf

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>website name</label>
                            <input type="text" name="website_name" class="form-control" value="{{$setting->website_name  ?? ''}}"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>website url</label>
                            <input type="text" name="website_url" class="form-control" value="{{$setting->website_url  ?? ''}}"/>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>page title</label>
                            <input type="text" name="page_title" class="form-control" value="{{$setting->page_title  ?? ''}}"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>meta keywords</label>
                            <textarea rows="3" name="meta_keyword" class="form-control">{{$setting->meta_keyword  ?? ''}}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>meta description</label>
                            <textarea rows="3" name="meta_description" class="form-control" >{{$setting->meta_description  ?? ''}}</textarea>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>address</label>
                            <textarea rows="3" name="address" class="form-control" >{{$setting->address  ?? ''}}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>phone 1</label>
                            <input type="text", name="phone1" class="form-control" value="{{$setting->phone1  ?? ''}}"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>phone 2</label>
                            <input type="text", name="phone2" class="form-control" value="{{$setting->phone2  ?? ''}}"/>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>email 1</label>
                            <input type="text", name="email1" class="form-control" value="{{$setting->email1  ?? ''}}"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>email 2</label>
                            <input type="text"  name="email2" class="form-control" value="{{$setting->email2  ?? ''}}"/>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website social media</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Facebook</label>
                            <input type="text" name="facebook" class="form-control" value="{{$setting->facebook  ?? ''}}"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>twitter</label>
                            <input type="text", name="twitter" class="form-control" value="{{$setting->twitter  ?? ''}}"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>instagram</label>
                            <input type="text", name="instagram" class="form-control" value="{{$setting->instagram  ?? ''}}"/>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>youtube</label>
                            <input type="text", name="youtube" class="form-control" value="{{$setting->youtube  ?? ''}}"/>
                        </div>
                    </div>
                </div>
            </div>


            <div class="text-end">
                <button type="submit" class="btn btn-primary text-white">save settings</button>
            </div>


        </form>
    </div>
</div>

@endsection
