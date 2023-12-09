@extends('layouts.dashboard')

@section('title','Categories')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

<div class="mb-5">
    <a href="{{route('categories.create')}}" class="btn btn-sm btn-outline-primary"> Add Category </a>
</div>

@if(session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

@if(session()->has('info'))
<div class="alert alert-info">
    {{ session('info') }}
</div>

@endif

<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Parent</th>
            <th>Created At</th>
            <th colspan="2">Operations</th>
        </tr>
    </thead>
    <tbody>
        @if($categories->count())
        @foreach($categories as $category)
        <tr>
            <td><img src="{{ asset('storage/' .$category->image)}}" alt="" height="50"></td>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->description}}</td>
            <td>{{$category->parent_id}}</td>
            <td>{{$category->created_at}}</td>
            <td>
                <a href="{{route('categories.edit',[$category->id])}}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{route('categories.destroy',[$category->id])}}" method="post">
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


@endsection