@extends('layouts.dashboard')

@section('title',' Trashed Categories')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
<li class="breadcrumb-item active">Trashed</li>

@endsection

@section('content')

<div class="mb-5">
    <a href="{{route('categories.index')}}" class="btn btn-sm btn-outline-primary"> Back </a>
</div>
<!-- Alert Component-->
<x-alert />


<form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
    <x-form.input name="name" placeholder="Name" label="" class="mx-2" :value="request('name')" />
    <select name="status" class="form-control" class="mx-2">
        <option>All</option>
        <option value="active" @selected(request('ststus')=='active' )>Active</option>
        <option value="archived" @selected(request('ststus')=='archived' )>Archived</option>
    </select>
    <button class="btn btn-dark" class="mx-2"> Filter </button>
</form>

<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Deleted At</th>
            <th colspan="2">Operations</th>

        </tr>
    </thead>
    <tbody>
        @if($categories->count())
        @foreach($categories as $category)
        <tr>
            <td><img src="{{ asset('storage/' .$category->image)}}" alt="" height="50"></td>
            <td>{{$category->name}}</td>
            <td>{{$category->description}}</td>
            <td>{{$category->status}}</td>
            <td>{{$category->deleted_at}}</td>
            <td>
                <form action="{{route('categories.restore',[$category->id])}}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-sm btn-outline-info">Restore</button>
                </form>
            </td>
            <td>
                <form action="{{route('categories.force-delete',[$category->id])}}" method="post">
                    @csrf
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