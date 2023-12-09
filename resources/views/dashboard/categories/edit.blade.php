@extends('layouts.dashboard')

@section('title','Edit Category')
 
@section('breadcrumb')
@parent
 <li class="breadcrumb-item active">Categories</li>
 <li class="breadcrumb-item active"> Edit Category</li>
@endsection 

@section('content')
<form action="{{route('categories.update',$categories->id)}}" method="post" enctype="multipart/form-data">
    @csrf    
    @method('put')
   
    @include('dashboard.categories._form',[
         'button_label' => 'Updated'
        ])


</form>
@endsection