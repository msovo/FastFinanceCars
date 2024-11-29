@extends('layouts.seller')

@section('seller-content')
    <h1>Manage Sales</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->vehicle->make }}</td>
                    <td>{{ $sale->vehicle->model }}</td>
                    <td>{{ $sale->vehicle->year }}</td>
                    <td>{{ $sale->vehicle->price }}</td>
                    <td>
                        <a href="#" class="btn btn-warning">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
