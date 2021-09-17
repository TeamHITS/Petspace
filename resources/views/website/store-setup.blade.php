@extends('website.layouts.app')
@section('content')
    <div class="store-setup-wrap">
        <div class="container">
            <form id="submit-form" action="{{URL::to('/store-petspace')}}" method="POST">
                <div class="row">
                    <div class="col-lg-8 col-md-9 col-sm-12">
                        <div class="store-card">
                            <div class="card-top">
                                <p class="card-title">Store Setup</p>
                                <p class="card-sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="card-body pt-0">

                                <div class=" row m-0" style="padding-top: 10px">
                                    <div id="response-alert" class="error-notification" style="display: none">
                                        <span class="icon"><img src="{{ url('/public/assets/images/error-icon.png') }}"
                                                                alt="icon" class="img-fluid"></span>
                                        <p>ERROR</p>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12"></div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <p class="form-heading">Store Information</p>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12 y-center">
                                        <label class="img-label">Store Image</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="upload-img-box-wrap">
                                            <div class="upload-img-box">
                                                <input type="file" id="petspace-image" name="image"
                                                       onchange="readURL(this);">
                                                <img id="uploaded_img" src="http://placehold.it/130" alt="image"/>
                                                <a id="edit-image-link" class="edit-btn"><img
                                                            src="{{ url('/public/assets/images/icon-pencil-grey.png') }}"
                                                            class="img-fluid"></a>
                                                <a id="delete-image-link" class="delete-btn"><i
                                                            class="fas fa-times"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>Store Name</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="name" class="gen-input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <input type="email" name="email" class="gen-input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>Contact Number</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="phone" class="gen-input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>Address Line 1</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            {{--<input type="text" class="gen-input" name="address" required>--}}
                                            <input type="text" id="search_input" class="gen-input" name="address"
                                                   required>
                                            <input type="hidden" id="loc_lat" name="latitude">
                                            <input type="hidden" id="loc_long" name="longitude">
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>Address Line 2 (optional)</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="gen-input" name="address_two">
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>Area</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="gen-input" name="area" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>City</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="gen-input" name="city" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>Minimum Order</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="gen-input" name="min_order" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>Grooming</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <select class="gen-input" name="grooming"
                                                    required>
                                                <option value="">Select Service</option>
                                                @foreach(\App\Models\Petspace::$GROOMING_WEB_TEXT as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>Pick and Drop Service</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <select class="gen-input" name="is_pick_drop_available"
                                                    required>
                                                <option value="">Select Availability</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>Delivery Available</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <select class="gen-input" name="is_delivery_fee" required>
                                                <option value="">Select Availability</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12"></div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <p class="form-heading mt-3">Contact Person Information</p>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>First Name</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="first_name" class="gen-input"
                                                   value="{{$user['details']['first_name']}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>Last Name</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="last_name" class="gen-input"
                                                   value="{{$user['details']['last_name']}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>Contact Information</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="phone" class="gen-input"
                                                   value="{{$user['details']['phone']}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="gen-input" value="{{$user['email']}}"
                                                   disabled required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-12">
                        <div class="store-setup-btn-box">
                            <button type="submit" class="submit setup-submit-btn">Continue</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#edit-image-link').on('click', function () {
            $('#petspace-image').trigger('click');
        });
        $('#delete-image-link').on('click', function () {
            $("#uploaded_img").attr("src", "http://placehold.it/130");
        });
    </script>
    <script>

        var searchInput = 'search_input';

        $(document).ready(function () {

            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            var autocomplete;
            autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
                types: ['establishment'],
                componentRestrictions: {
                    country: "AE"
                }
            });

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var near_place = autocomplete.getPlace();
                document.getElementById('loc_lat').value = near_place.geometry.location.lat();
                ;
                document.getElementById('loc_long').value = near_place.geometry.location.lng();
            });
        });
    </script>
@endpush