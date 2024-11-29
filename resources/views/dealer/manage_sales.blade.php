@extends('layouts.dealer')

@section('title', 'Manage Sales')

@section('content')

    <h1>Manage Sales</h1>
    <table class="table table-striped" id="sales-table"> 
        <thead>
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->vehicle->make }}</td>
                    <td>{{ $sale->vehicle->model }}</td>
                    <td>{{ $sale->vehicle->year }}</td>
                    <td>R{{ $sale->vehicle->price }}</td> 
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#sales-table').DataTable(); 
        });
    </script>
@endsection