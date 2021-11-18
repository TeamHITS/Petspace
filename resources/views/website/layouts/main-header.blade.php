<section class="auth-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-3">
                <p class="pg-title">{{$title}}</p>
            </div>
            <div class="col-lg-8 col-md-8 col-9">
                <ul class="auth-top-btn">
                    <ul class="auth-top-btn">
                        <li>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="notification-dropdown"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ url('public/assets/images/bell-icon.png') }}" class="img-fluid">
                                </a>
            
                                <ul class="dropdown-menu notification-dropdown" aria-labelledby="notification-dropdown" >
                                    <li class="d-flex justify-content-end p-3">
                                        <a href="javascript:markasread();" class="clear-btn">Clear</a>
                                    </li>
                                    <div id="menu_id">
                                        
                                    </div>
                                    
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown user-action-dropdown">
                                <a class="user-btn" type="button" id="userAction" data-bs-toggle="dropdown"
                                   aria-expanded="false">
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
@push('scripts')

<script type='text/javascript'>
    
    $(document).ready(function() {
        
        // Echo.channel(`bell-notifications`)
        //     .listen("BellNotification", event => {
        //         console.log("event listion");
        //         // setTimeout(function() {
        //         //     getNotifications();
        //         // }, 2000);
        //     });
        getNotifications();
    });
    function markasread(){
        $.get("notification-mark-as-read").then(response => {
            $('#menu_id').html("");
        });
    }
    function getNotifications() {
        $.get("/bell-notifications").then(response => {
            let notifications = response.data;
            if(notifications.length > 0){
                html = "";

                notifications.forEach(function(item) {
                    html +="<li>";
                    html +='<div class="dropdown-list-item">';
                    html +='<div class="icon red">';
                    html +='<i class="fas fa-truck"></i>';
                    html +='</div>';
                    html +='<div class="text">';
                    html +='<p class="tag">'+ item.title +'</p>';
                    html +='<p>'+ item.message +'</p>';
                    html +='<p class="time">'+ item.created_at +'</p>';
                    html +='</div>';
                    html +='</div>';
                    html +='</li>';
                });

                $('#menu_id').html(html);
            }
            
        });
    }
</script>

@endpush