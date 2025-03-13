<x-site-layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Select Specialization</h1>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($specializations as $specialization)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('images/' . strtolower($specialization) . '.jpg') }}" class="card-img-top" alt="{{ $specialization }} image">

                        <div class="card-body">
                            <h5 class="card-title">{{ $specialization }}</h5>
                            <p class="card-text">Select this specialization to book an appointment.</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ auth()->check() ? route('appointments.hospitals', ['specialization' => $specialization]) : route('login') }}"
                               class="btn btn-primary">
                                Select
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-site-layout>
