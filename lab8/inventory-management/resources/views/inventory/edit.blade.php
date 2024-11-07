{{-- resources/views/inventory/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Edit Inventory Item</h1>
    <form action="{{ route('inventories.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" value="{{ $item->product_name }}" required>

        <label for="category">Category:</label>
        <input type="text" name="category" id="category" value="{{ $item->category }}" required>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="{{ $item->quantity }}" required>

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" value="{{ $item->price }}" required>

        <button type="submit">Update</button>
    </form>
@endsection
