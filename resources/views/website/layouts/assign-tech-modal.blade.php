<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Select a Technician</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="technician-form" action="{{URL::to('/assign-tech')}}" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" onchange="showAllTech(this)" id="show_all_tech">
                  <label class="form-check-label" for="show_all_tech">View All Technicians</label>
                </div>
                <label>Technician Name</label>
                <select class="gen-input" name="technician_id" onchange="show_tech_fee(this)" id="restricted">
                    <option value="" {{(!isset($order['technician_id']))?"selected":""}} disabled>Select A Technician</option>
                    @foreach($technicians as $technician)
                        @if($order['technician_id'] && $order['technician_id'] == $technician['id'])
                            <option value="{{$technician['id']}}" selected >{{$technician['name']}}</option>
                            @else
                            <option value="{{$technician['id']}}">{{$technician['name']}}</option>
                            @endif

                    @endforeach
                </select>

                <select class="gen-input d-none" name="technician_id" onchange="show_tech_fee(this)" id="nonrestricted">
                    <option value="" {{(!isset($order['technician_id']))?"selected":""}} disabled>Select A Technician</option>
                    @foreach($alltechnicians as $technician)
                        @if($order['technician_id'] && $order['technician_id'] == $technician->id)
                            <option value="{{$technician->id}}" selected >{{$technician->name}}</option>
                            @else
                            <option value="{{$technician->id}}">{{$technician->name}}</option>
                            @endif

                    @endforeach
                </select>
                <input type="text" name="order_id" hidden value="{{$order['id']}}">
                <input type="text" id="assign_url" name="assign_url" hidden value="{{url('get-technician-min-order-fee').'/'}}">
            </div>
            <div class="form-group technician-schedule-wrap">
                <div class="btn-group dropend">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        View Technicians Schedule
                    </button>
                    <ul class="dropdown-menu">
                        <li class="active">Schedule on {{date('d/m/Y',strtotime($order['date_time']))}}</li>
                        <li> 12:30 - 14:30 Assigned</li>
                        <li> 15:30 - 16:30 Assigned</li>
                        <li> 17:00 - 18:30 Assigned</li>
                        <li> 19:30 - 20:30 Assigned</li>
                        <li class="active"> 22:30 - 23:30 Not Assigned</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @csrf
            <div class="row d-none" id="fees">
                <div class="col-md-6">
                    <label style="font-size: 12px;">Minimum Order Fee : 
                        <span id="minOrderFee"></span>
                    </label>
                </div>
                <div class="col-md-6">
                    <label style="font-size: 12px;">Minimum Delivery Fee : 
                        <span id="minDeliveryFee"></span>
                    </label>
                </div>
            </div>
            <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="gen-btn">Save</button>
        </div>
        </form>
    </div>
</div>