@extends('layouts.seller')

@section('seller-content')
    <h1>Manage Listings</h1>
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
            @foreach($listings as $listing)
                <tr>
                    <td>{{ $listing->vehicle->make }}</td>
                    <td>{{ $listing->vehicle->model }}</td>
                    <td>{{ $listing->vehicle->year }}</td>
                    <td>{{ $listing->vehicle->price }}</td>
                    <td>
                        <a href="#" class="btn btn-warning">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
