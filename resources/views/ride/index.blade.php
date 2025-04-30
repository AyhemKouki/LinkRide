@extends('layout.layout')

@section('title', 'index | ride')

@section('ride_content')

    {{-- begin container --}}
    <div class="container my-3">

        <div class="card">

            {{-- card header --}}
            <div class="card-header fs-4 fw-bold">All {{ Str::plural('ride') }}</div>

            {{-- card body --}}
            <div class="card-body">

                {{-- button trashes + button create --}}
                <div class="row mb-3 justify-content-center">
                    <div class="col-12 d-flex justify-content-end">
                        <a class="btn btn-sm btn-primary" href="{{ route('ride.create')  }}">Create</a>
                    </div>
                </div>

                    {{-- listing all resources --}}
                    @foreach( $rides as $ride)
                        @if(auth()->id() === $ride->driver_id)
                            <div class="card shadow">
                                <div class="row g-0">
                                    @if($ride->image)
                                        <div class="col-md-4">
                                            <img src="{{ asset('storage/'.$ride->image )}}"
                                                 class="img-fluid rounded-start h-100 w-100 object-fit-cover"
                                                 alt="Ride Image">
                                        </div>
                                    @endif

                                    <div class="col-md-{{ $ride->image ? '8' : '12' }}">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-4">
                                                <h3 class="card-title">
                                                    {{ $ride->origin }} → {{ $ride->destination }}
                                                </h3>

                                                    <div class="btn-group">
                                                        <a href="{{ route('ride.edit', $ride) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                                        <form action="{{ route('ride.destroy', $ride) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm ms-2"
                                                                    onclick="return confirm('Delete this ride?')">Delete</button>
                                                        </form>
                                                    </div>

                                            </div>

                                            <div class="row g-3">
                                                <div class="col-6 col-md-3">
                                                    <div class="small text-muted">Departure</div>
                                                    <div>{{ $ride->departure_time->format('M j, Y g:i A') }}</div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="small text-muted">Available Seats</div>
                                                    <div>{{ $ride->available_seats }}</div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="small text-muted">Price per Seat</div>
                                                    <div>${{ number_format($ride->price_per_seat, 2) }}</div>
                                                </div>
                                            </div>

                                            @if($ride->notes)
                                                <div class="mt-4">
                                                    <div class="small text-muted">Notes</div>
                                                    <p class="mb-0">{{ $ride->notes }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="card-footer bg-transparent">
                                            <a href="{{ route('ride.index') }}" class="btn btn-link ps-0">← Back to Rides</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach


            </div>

            {{-- card footer --}}
            <div class="card-footer"></div>


        </div>

    </div>
    {{-- end container --}}

@endsection
