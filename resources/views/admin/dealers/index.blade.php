@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Dealers Management</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dealers-table">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Vehicles</th>
                        <th>Registration Date</th>
                        <th>Cars Sold</th>
                        <th>Featured</th>
                        <th>Sponsored</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dealers as $dealer)
                    <tr>
                        <td>
                            <img src="{{ $dealer->logo_url }}" alt="Logo" class="img-thumbnail" width="50">
                        </td>
                        <td>{{ $dealer->name }}</td>
                        <td>{{ $dealer->listings_count }}</td>
                        <td>{{ $dealer->created_at->diffForHumans() }}</td>
                        <td>{{ $dealer->sold_listings_count }}</td>
                        <td>{{ $dealer->is_featured ? 'Yes' : 'No' }}</td>
                        <td>{{ $dealer->is_sponsored ? 'Yes' : 'No' }}</td>
                        <td>{{ $dealer->contact }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.dealers.show', parameters: $dealer) }}" 
                                   class="btn btn-sm btn-info">View</a>
                                @if(!$dealer->verified)
                                    <form action="{{ route('admin.dealers.verify', $dealer) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-success">Verify</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.dealers.suspend', $dealer) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-warning">Suspend</button>
                                </form>
                                <form action="{{ route('admin.dealers.block', $dealer) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Block</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dealers-table').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });
    });
</script>
@endpush