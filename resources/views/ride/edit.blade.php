@extends('layout.layout')

@section('title', 'edit | ride' )

@section('ride_edit')

    <div class="container my-3">
        <div class="row justify-content-center">

            <div class="col-md-10">

                {{-- form begin --}}
                <form action="{{ route('ride.update', $ride->id) }}" method="post" enctype="multipart/form-data" class="">
                    @csrf
                    @method('PUT')

                    <div class="card shadow-lg border-0 rounded-4">

                        {{--card title--}}
                        <div class="card-header bg-primary text-white fs-4 fw-semibold rounded-top-4">Edit ride</div>

                        {{--card body--}}
                        <div class="card-body">

                            {{-- text --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="origin">origin </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="origin"
                                               id="origin"
                                               placeholder="start point"
                                               autofocus
                                               value="{{ old('origin', $ride->origin)  }}"
                                               class="form-control">
                                        @error('origin')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- text --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="destination">destination</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="destination"
                                               id="destination"
                                               placeholder="end point"
                                               autofocus
                                               value="{{ old('destination' , $ride->destination)  }}"
                                               class="form-control">
                                        @error('destination ')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- date time --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="departure_time">departure_time </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="datetime-local"
                                               id="departure_time"
                                               name="departure_time"
                                               value="{{ old('departure_time', $ride->departure_time) }}"
                                               class="form-control">
                                        @error('departure_time')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- number input --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="available_seats">available seats</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="number"
                                               id="available_seats"
                                               name="available_seats"
                                               min="1"
                                               max="10"
                                               placeholder="1"
                                               value="{{ old('available_seats',$ride->available_seats) }}"
                                               class="form-control">
                                        @error('available_seats')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- price input --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="price_per_seat">price per seat ($)</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number"
                                                   id="price_per_seat"
                                                   name="price_per_seat"
                                                   min="0.01"
                                                   max="1000"
                                                   step="0.01"
                                                   placeholder="0.00"
                                                   value="{{ old('price_per_seat', $ride->price_per_seat) }}"
                                                   class="form-control">
                                        </div>
                                        @error('price_per_seat')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            {{-- Notes field --}}
                            <div class="mb-3">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label for="notes">Notes</label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea id="notes"
                                                  name="notes"
                                                  class="form-control "
                                                  rows="3"
                                                  placeholder="Add any additional information about the ride">{{ old('notes',$ride->notes) }}</textarea>
                                        <small class="text-muted">Optional. Maximum 500 characters.</small>
                                        @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Image Upload --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="image" class="form-label fw-semibold">Upload Vehicle Image</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="file"
                                               name="image"
                                               id="image"
                                               class="form-control @error('image') is-invalid @enderror"
                                               accept="image/*"
                                               onchange="previewImage(event)">
                                        <small class="text-muted">Max size 2MB. JPG, PNG recommended.</small>
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Preview --}}
                                    <div id="imagePreview" class="mt-3 d-none">
                                        <p class="fw-semibold">Image Preview:</p>
                                        <img id="preview" src="#" class="img-fluid rounded border" style="max-height: 300px;" alt="Preview">
                                    </div>
                                </div>
                            </div>

                        </div>{{--end card body--}}

                        {{--card footer--}}
                        <div class="card-footer">

                            <button type="submit" class="btn btn-primary">Save</button>

                            <a class="btn btn-dark" href="{{ route('ride.index') }}">Return</a>

                        </div>

                    </div>
                </form>
                {{-- form end --}}

            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('preview');
                const previewContainer = document.getElementById('imagePreview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        previewContainer.classList.remove('d-none');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush

@endsection
