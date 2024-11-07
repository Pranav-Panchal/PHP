{{-- resources/views/inventory/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Inventory List</h1>
    <a href="{{ route('inventories.create') }}">Add New Item</a>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>
                        <a href="{{ route('inventories.edit', $item->id) }}">Edit</a>
                        <form action="{{ route('inventories.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No items found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
