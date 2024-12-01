<div id="dealershipList">
    @foreach($dealerships as $dealership)
        <div class="card dealership-card mb-3" onclick="location.href='{{ route('dealerships.show', $dealership->user_id) }}'">
            <div class="me-3">
                @if($dealership->verified)
                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> Verified</span>
                @else
                    <span class="badge badge-warning"><i class="fas fa-exclamation-circle"></i> Not Verified</span>
                @endif
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <small>Logo</small>
                    @if($dealership->logo)
                        <img src="{{ asset('storage/' . $dealership->logo) }}" alt="{{ $dealership->dealership_name }}" class="dealership-logo rounded">
                    @else
                        <p>No Logo</p>
                    @endif
                </div>
                <h5 class="card-title text-center">{{ $dealership->dealership_name }}</h5>
                <div class="row">
                    <div class="col-6">
                        <p><i class="fas fa-map-marker-alt icon"></i> {{ $dealership->address }}</p>
                        <p><i class="fas fa-car icon"></i> Total Cars: {{ $dealership->total_cars }}</p>
                        <p><i class="fas fa-phone icon"></i> Contact: {{ $dealership->contact }}</p>
                    </div>
                    <div class="col-6">
                        <p><i class="fas fa-car-side icon"></i> Car Makes: {{ $dealership->car_makes_count }}</p>
                        <p><i class="fas fa-car-alt icon"></i> Car Models: {{ $dealership->car_models_count }}</p>
                        <p><i class="fas fa-clock icon"></i> Registered: {{ $dealership->created_at->diffInDays() }} days ago</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{ $dealerships->links() }}
</div>
