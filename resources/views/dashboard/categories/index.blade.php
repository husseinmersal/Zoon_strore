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
            <th>Image</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2">Operations</th>

        </tr>
    </thead>
    <tbody>
        @if($categories->count())
        @foreach($categories as $category)
        <tr>
            <td><img src="{{ asset('storage/' .$category->image)}}" alt="" height="50"></td>
            <td>{{$category->name}}</td>
            <td>{{$category->parent_name}}</td>
            <td>{{$category->description}}</td>
            <td>{{$category->status}}</td>
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

{{$categories->withQueryString()->links()}}
@endsection