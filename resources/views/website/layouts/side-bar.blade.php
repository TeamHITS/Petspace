<div class="side-bar">
    <div class="sidebar-top">
        <div class="logo-box">
            <a href="#!">
                <img src="{{ url('/public/assets/images/logo.png') }}" alt="logo" class="img-fluid">
            </a>
        </div>
        <ul class="sidebar-list">
            <li class="{{  request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{URL::to('/dashboard')}}"><img src="{{ url('/public/assets/images/dashboard-icon-1.png') }}"
                                                         class="img-fluid"><span>Dashboard</span></a>
            </li>
            <li class="{{  request()->is('calendar') ? 'active' : '' }}"><a href="{{URL::to('/calendar')}}"><img
                            src="{{ url('/public/assets/images/dashboard-icon-2.png') }}" class="img-fluid"><span>Calendar</span></a>
            </li>
            <li class="{{  request()->is('orders') ? 'active' : '' }}">
                <a href="{{URL::to('/orders')}}"><img src="{{ url('/public/assets/images/dashboard-icon-3.png') }}"
                                                      class="img-fluid"><span>Orders</span></a>
            </li>
            <li class="{{  request()->is('service-menu') ? 'active' : '' }}">
                <a href="{{URL::to('/service-menu')}}"><img
                            src="{{ url('/public/assets/images/dashboard-icon-4.png') }}" class="img-fluid"><span>Service Menu</span></a>
            </li>

            <li class="{{  request()->is('tech-list') ? 'active' : '' }}">
                <a href="{{URL::to('/tech-list')}}"><img src="{{ url('/public/assets/images/dashboard-icon-5.png') }}"
                                                         class="img-fluid"><span>Technicians</span></a>
            </li>
        </ul>
    </div>
    <div class="sidebar-bottom">
        <ul class="sidebar-bottom-list">
            <li class="{{  request()->is('store-setting') ? 'active' : '' }}">
                <a href="{{URL::to('/store-setting')}}"><img
                            src="{{ url('/public/assets/images/dashboard-icon-6.png') }}" class="img-fluid"><span>Store Settings</span></a>
            </li>
            <li><a href="#!" data-bs-toggle="modal" data-bs-target="#contactPetspace"><img
                            src="{{ url('/public/assets/images/dashboard-icon-7.png') }}" class="img-fluid"><span>Contact Petspace</span></a>
            </li>
        </ul>
    </div>
</div>
<div class="modal fade gen-modal contact-petspace-modal" id="contactPetspace" tabindex="-1" aria-hidden="true">
    <!-- EDIT TECHNICIAN MODAL -->
    <div class="modal-dialog modal-dialog-centered" style="width: max-content;">
        <div class="modal-content" style="width: auto !important">
            <div class="modal-header">
                <h5 class="modal-title">Contact Petspace</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="gen-input"
                                   disabled
                                   value="woof@petspace.app">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Number</label>
                            <input type="text" class="gen-input"
                                   value="+971 55 598 5588" disabled>
                            @csrf
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
