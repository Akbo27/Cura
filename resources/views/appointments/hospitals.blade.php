<x-site-layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Hospitals for {{ $specialization }}</h1>

        <div class="row">
            @foreach($hospitals as $hospital)
                <div class="col-md-4 mb-4"> <!-- Added mb-4 for spacing -->
                    <div class="card h-100">
                        <div class="row g-0 h-100">
                            <div class="col-md-4">
                                <img src="{{ asset('images/' .'hospital.jpg') }}" class="img-fluid h-100 w-100 rounded-start" style="object-fit: cover;" alt="{{ $hospital->name }}">
                            </div>
                            <div class="col-md-8 d-flex align-items-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $hospital->name }}</h5>
                                    <p class="card-text text-muted">{{ $hospital->location }}</p>
                                    <a href="{{ route('appointments.book', ['hospital_id' => $hospital->id, 'specialization' => $specialization]) }}" class="btn btn-primary">
                                        View More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-site-layout>
