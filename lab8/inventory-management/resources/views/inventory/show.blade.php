{{-- resources/views/inventory/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Inventory Item Details</h1>
    <p><strong>Product Name:</strong> {{ $item->product_name }}</p>
    <p><strong>Category:</strong> {{ $item->category }}</p>
    <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
    <p><strong>Price:</strong> ${{ number_format($item->price, 2) }}</p>
    <a href="{{ route('inventories.index') }}">Back to Inventory List</a>
@endsection
