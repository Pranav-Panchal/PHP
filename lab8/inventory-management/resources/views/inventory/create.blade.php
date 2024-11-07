{{-- resources/views/inventory/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Add New Inventory Item</h1>
    <form action="{{ route('inventories.store') }}" method="POST">
        @csrf
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required>

        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required>

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required>

        <button type="submit">Save</button>
    </form>
@endsection
