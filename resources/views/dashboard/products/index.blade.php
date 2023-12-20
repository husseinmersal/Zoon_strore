@extends('layouts.dashboard')

@section('title','Products')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Products</li>
@endsection

@section('content')

<div class="mb-5">
    <a href="{{route('products.create')}}" class="btn btn-sm btn-outline-primary mr-2"> Add Product </a>

</div>
<!-- Alert Component-->
<x-alert/>


<form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4"  >
    <x-form.input name="name" placeholder="Name" label="" class="mx-2" :value="request('name')"/>
    <select name="status" class="form-control" class="mx-2">
        <option>All</option>
        <option value="active" @selected(request('ststus') == 'active')>Active</option>
        <option value="archived" @selected(request('ststus') == 'archived')>Archived</option>
    </select>
    <button class="btn btn-dark" class="mx-2"> Filter </button>
</form>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2">Operations</th>

        </tr>
    </thead>
    <tbody>
        @if($products->count())
        @foreach($products as $product)
        <tr>
            <td>{{$product->name}}</td>
            <td>{{$product->category->name}}</td>
            <td>{{$product->store->name}}</td>
            <td>{{$product->status}}</td>
            <td>{{$product->created_at}}</td>
            <td>
                <a href="{{route('products.edit',[$product->id])}}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{route('products.destroy',[$product->id])}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="delete">
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        @else
        <tr colspan="7">
            <td>No Categories Defined</td>
        </tr>
        @endif
    </tbody>
</table>

{{$products->withQueryString()->links()}}
@endsection