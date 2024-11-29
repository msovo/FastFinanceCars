@extends('layouts.dealer')

@section('content')
    <h1>Manage Dealership</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($dealership)
        <div class="card">
            <div class="card-header">Dealership Information</div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Dealership Name:</th>
                            <td>{{ $dealership->dealership_name }}</td>
                        </tr>
                        <tr>
                            <th>License Number:</th>
                            <td>{{ $dealership->license_number }}</td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>{{ $dealership->address }}</td>
                        </tr>
                        <tr>
                            <th>City/Town:</th>
                            <td>{{ $dealership->city_town }}</td>
                        </tr>
                        <tr>
                            <th>Postal Code:</th>
                            <td>{{ $dealership->postal_code }}</td>
                        </tr>
                        <tr>
                            <th>Logo:</th>
                            <td>
                                @if ($dealership->logo)
                                    <img src="{{ asset('storage/' . $dealership->logo) }}" alt="Dealership Logo" style="max-width: 100px;"> 
                                @else
                                    No Logo
                                @endif
                            </td>
                        </tr>
                        </div>
                    </tbody>
                </table>
                <a href="{{ route('dealer.dealership.edit') }}" class="btn btn-primary">Edit Dealership</a>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            You haven't set up your dealership information yet.
        </div>
        <a href="{{ route('dealer.dealership.create') }}" class="btn btn-primary">Create Dealership</a>
    @endif
@endsection