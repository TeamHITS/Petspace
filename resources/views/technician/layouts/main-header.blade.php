<section class="technician-dash-top auth-top">
    <a href="#!" class="pg-title">{{$title}}</a>
    <div>
        <ul class="auth-top-btn">
            <li>
                <div class="dropdown user-action-dropdown">
                    <a class="user-btn" type="button" id="userAction" data-bs-toggle="dropdown" aria-expanded="false">
                        K
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userAction">
                        <li><a class="dropdown-item" href="{{URL::to('/technician/account')}}">Go To Settings</a></li>
                        <li><a class="dropdown-item" href="{{URL::to('/technician/logout')}}">Logout</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="notification-dropdown"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ url('/public/assets/images/bell-icon.png') }}" class="img-fluid">
                    </a>

                    <ul class="dropdown-menu notification-dropdown" aria-labelledby="notification-dropdown">
                        <li class="d-flex justify-content-end p-3">
                            <a href="#!" class="clear-btn">Clear</a>
                        </li>
                        <li>
                            <div class="dropdown-list-item">
                                <div class="icon red">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="text">
                                    <p class="tag">New Order</p>
                                    <p>A new order was assigned to you!</p>
                                    <p class="time">20 min ago</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-list-item">
                                <div class="icon red">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="text">
                                    <p class="tag">New Order</p>
                                    <p>A new order was assigned to you!</p>
                                    <p class="time">20 min ago</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-list-item">
                                <div class="icon red">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="text">
                                    <p class="tag">New Order</p>
                                    <p>A new order was assigned to you!</p>
                                    <p class="time">20 min ago</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</section>