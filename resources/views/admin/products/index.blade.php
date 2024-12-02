@extends('layouts.admin')

@section('content')
<h1>Manage Products</h1>
<a href="{{ route('admin.products.create') }}">Add New Product</a>
<table>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->price }}</td>
        <td>
            <a href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
            <a href="{{ route('admin.products.delete', $product->id) }}">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection