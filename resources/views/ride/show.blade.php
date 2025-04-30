@extends('')

@section('title', 'index | ride')

@section('content')

    <div class="container my-3">

        <div class="row justify-content-center">
            <div class="col-8">{{-- card width --}}

                <div class="card shadow-lg">

                    {{--card header--}}
                    <div class="card-header fs-4 fw-bold">ride Details</div>

                    {{--card body--}}
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-4 text-secondary">Actual image</div>
                                <div class="col-6">
                                    <img src="{{ asset('storage/'.$ride->image) }}" class="w-50" alt="">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 text-secondary">AAA</div>
                                <div class="col-6">BBB</div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 text-secondary">AAA</div>
                                <div class="col-6">BBB</div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 text-secondary">AAA</div>
                                <div class="col-6">BBB</div>
                            </div>
                        </li>

                    </ul>

                    {{-- footer --}}
                    <div class="card-footer">
                        <a class="btn btn-dark" href="{{ route('ride.index') }}">Retour</a>
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
