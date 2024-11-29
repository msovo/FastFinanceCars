@extends('layouts.seller')

@section('seller-content')
    <h1>Manage Leads</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Quote ID</th>
                <th>Vehicle</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
                <tr>
                    <td>{{ $lead->id }}</td>
                    <td>{{ $lead->listing->vehicle->make }} {{ $lead->listing->vehicle->model }}</td>
                    <td>{{ $lead->user->name }}</td>
                    <td>{{ $lead->status }}</td>
                    <td>
                        <a href="#" class="btn btn-success">Approve</a>
                        <a href="#" class="btn btn-danger">Decline</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
