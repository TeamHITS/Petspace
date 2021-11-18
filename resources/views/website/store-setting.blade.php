@extends('website.layouts.app')
@section('content')
<!--    --><?php // dd(request()->route());?>
    <div class="dashboard-main-wrap">
        @include('website.layouts.side-bar')

        <div class="main-stage">
            @include('website.layouts.main-header')
            <section class="store-setting-sec-2">
                <div class="container">
                    <div class="store-setting-2-wrap">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="store-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#store-profile" type="button" role="tab"
                                        aria-controls="store-profile" aria-selected="true">Store Profile
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                        type="button" role="tab" aria-controls="contact" aria-selected="false">Contact
                                    Person Information
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="password-tab" data-bs-toggle="tab"
                                        data-bs-target="#password" type="button" role="tab" aria-controls="password"
                                        aria-selected="false">Change Password
                                </button>
                            </li>
                        </ul>
                        <div class=" row m-0" style="padding-bottom: 10px">
                            <div id="response-alert"  class="error-notification" style="display: none">
                                <span class="icon"><img src="{{ url('public/assets/images/error-icon.png') }}" alt="icon" class="img-fluid"></span>
                                <p>ERROR</p>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="store-profile" role="tabpanel"
                                 aria-labelledby="store-profile-tab">
                                <div class="store-card">
                                    <form  id="submit-form"  action="{{URL::to('/update-petspace')}}" method="POST"
                                           enctype="multipart/form-data">
                                        <div class="card-top">
                                            <div class="card-text">
                                                <p class="card-title">Store Profile</p>
                                                <p class="card-sub-title">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing
                                                    elit.</p>
                                            </div>
                                            <div class="card-btn">
                                                <button type="submit">Save</button>
                                                <button>Cancel</button>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-12 y-center">
                                                    <label class="img-label">Store Image</label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-12">
                                                    <div class="upload-img-box-wrap">
                                                        <div class="upload-img-box">
                                                            <input type="file" id="petspace-image" name="image" onchange="readURL(this);">
                                                            <img id="uploaded_img"
                                                                 src="{{route('api.resize', ['img' => $petspace['image']])}}"
                                                                 alt="image"/>
                                                            <a id="edit-image-link" class="edit-btn"><img src="{{ url('public/assets/images/icon-pencil-grey.png') }}" class="img-fluid"></a>
                                                            <a id="delete-image-link" class="delete-btn"><i class="fas fa-times"></i></a>
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
                                                        <input type="text" name="name" value="{{$petspace['name']}}"
                                                               class="gen-input" required>
                                                        <input type="text" name="id" value="{{$petspace['id']}}"
                                                               hidden>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" disabled name="email" value="{{$petspace['email']}}"
                                                               class="gen-input" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <label>Contact Number</label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" name="phone" value="{{$petspace['phone']}}"
                                                               class="gen-input" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <label>Address Line 1</label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" class="gen-input" name="address"
                                                               value="{{$petspace['address']}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <label>Address Line 2 (optional)</label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" class="gen-input" name="address_two"
                                                               value="{{$petspace['address_two']}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <label>Area</label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" class="gen-input" name="area"
                                                               value="{{$petspace['area']}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <label>City</label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" class="gen-input" name="city"
                                                               value="{{$petspace['city']}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <label>Minimum Order</label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" class="gen-input" name="min_order"
                                                               value="{{$petspace['min_order']}}" required>
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
                                                            <option value="1" {{($petspace['is_pick_drop_available'] == 1) ? "selected" : ""}}>
                                                                Yes
                                                            </option>
                                                            <option value="0" {{($petspace['is_pick_drop_available'] == 0) ? "selected" : ""}}>
                                                                No
                                                            </option>
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
                                                            <option value="1" {{($petspace['is_delivery_fee'] == 1) ? "selected" : ""}} >
                                                                Yes
                                                            </option>
                                                            <option value="0" {{($petspace['is_delivery_fee'] == 0) ? "selected" : ""}}>
                                                                No
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="store-card">
                                    <form  id="submit-form"  action="{{URL::to('/update-vendor')}}" method="POST">
                                        <div class="card-top">
                                            <div class="card-text">
                                                <p class="card-title">Contact Person Information</p>
                                                <p class="card-sub-title">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing
                                                    elit.</p>
                                            </div>
                                            <div class="card-btn">
                                                <button type="submit">Save</button>
                                                <button>Cancel</button>
                                            </div>
                                        </div>
                                        <div class="card-body">

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
                                                    <label>Contact Number</label>
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
                                                        <input type="text" class="gen-input" name="email" value="{{$user['email']}}"
                                                               disabled required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                <div class="store-card">
                                    <form id="submit-form"  action="{{URL::to('/update-vendor-password')}}" method="POST">
                                        <div class="card-top">
                                            <div class="card-text">
                                                <p class="card-title">Change Password</p>
                                                <p class="card-sub-title">Change your password</p>
                                            </div>
                                            <div class="card-btn">
                                                <button type="submit">Save</button>
                                                <button >Cancel</button>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <label>Current Password</label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="password" name="current_password" class="gen-input"
                                                               placeholder="Current Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <label>New Password</label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="password" name="new_password" class="gen-input"
                                                              required placeholder="New Password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <label>Verify Password</label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="password" name="confirm_password"  class="gen-input"
                                                               placeholder="Verify Password" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
       $('#edit-image-link').on('click', function () {
           $('#petspace-image').trigger('click');
       });
       $('#delete-image-link').on('click', function () {
           $("#uploaded_img").attr("src","http://placehold.it/130");
       });
    </script>
@endpush