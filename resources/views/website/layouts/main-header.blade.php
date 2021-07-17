<section class="auth-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-3">
                <p class="pg-title">{{$title}}</p>
            </div>
            <div class="col-lg-8 col-md-8 col-9">
                <ul class="auth-top-btn">
                    <ul class="auth-top-btn">
                        <li><a href="#!"><i class="far fa-bell"></i></a></li>
                        <li>
                            <div class="dropdown user-action-dropdown">
                                <a class="user-btn" type="button" id="userAction" data-bs-toggle="dropdown" aria-expanded="false">
                                    K
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="userAction">
                                    <li><a class="dropdown-item" href="{{URL::to('/logout')}}">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>

                </ul>
            </div>
        </div>
    </div>
</section>