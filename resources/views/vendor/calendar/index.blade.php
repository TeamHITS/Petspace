
@extends('website.layouts.app')
@section('content')
    @include('flash::message')
    <div class="dashboard-main-wrap">
    @include('website.layouts.side-bar')
        <div class="main-stage">
            @include('website.layouts.main-header')
            <section class="stage-content-sec order-sec-2">
                <div class="container">
                    <div class="calendar-wrap">
                        <div id="menu" class="calender-menu-wrap">
                            <div class="calender-menu-group-1">
                                <div class="dropdown staff-drowndown-wrap">
                                    <button class="gen-btn dropdown-toggle" type="button" id="staff-drowndown" data-bs-toggle="dropdown" aria-expanded="false">
                                        All Staff
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="staff-drowndown">
                                        <li><a class="dropdown-item" href="#">Technician 1</a></li>
                                        <li><a class="dropdown-item" href="#">Technician 2</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="calender-menu-group-2">
                                <span id="menu-navi">
    								<button type="button" id="calender-prev" class="btn btn-default btn-sm move-day">
    									<i class="fas fa-arrow-left" data-action="move-prev"></i>
    								</button>
    								<p class="current-week weekly-view"></p>
    								<button type="button" id="calender-next" class="btn btn-default btn-sm move-day">
    									<i class="fas fa-arrow-right" data-action="move-next"></i>
    								</button>
    								 @if(isset($selectedWeekNumber))
                                        <button id="calender-selected" value='{{$selectedWeekNumber}}' type = 'hidden'></button>
                                    @endif
                                    @if(isset($_REQUEST['start_date']))
                                        <button id="calender-selected" value="{{isset($_REQUEST['start_date']) ? date("W", strtotime($_REQUEST['start_date'])):date("W",date("Y-m-d"))}}" style="display:none" type = 'hidden'></button>
                                    @endif
    							</span>
                                <span id="renderRange" class="render-range"></span>
                            </div>
                            <div class="calender-menu-group-3">
                            <span class="dropdown view-list-dropdown">
                                <button id="dropdownMenu-calendarType" class="btn btn-default btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                    <i id="calendarTypeIcon" class="calendar-icon ic_view_month" style="margin-right: 4px;"></i>
                                    <span id="calendarTypeName">Weekly</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <ul class="view-list-dropdown-menu dropdown-menu" role="menu" aria-labelledby="dropdownMenu-calendarType">
                                    <!-- <li>
                                        <a class="dropdown-menu-title" role="menuitem" id="week-view" href="calendar.php">
                                            <i class="fas fa-th"></i>Weekly
                                        </a>
                                    </li> -->
                                    <li>
                                        <a class="dropdown-menu-title" role="menuitem" id="daily-view" href="calendar/resource">
                                            <i class="fas fa-bars"></i>Resource
                                        </a>
                                    </li>
                                </ul>
                            </span>
                                <div class="dropdown add-event-dropdown">
                                    <button class="gen-btn dropdown-toggle" type="button" id="add-event-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-plus"></i>Add new
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="add-event-dropdown">
                                        <li><a class="dropdown-item" id="addCalenderSlot">New Slot</a></li>
                                        <li><a class="dropdown-item" id="addCalenderBlockedSlot">Blocked Time</a></li>
                                        <!--<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addCalenderBlockedSlot">Blocked Time</a></li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="custom-calendar-wrap">
                            <div class="calendar-box">
                                <div class="calendar-time-col">
                                    <?php 
                                    $x = 1;
                                    $length = count($times_for_display);
                                    ?>
                                    @foreach($times_for_display as $key =>  $time_for_display)
                                        @if ($x === $length) 
                                            <p style = "font-size: 14px;color: #676767; font-weight: 700;">
                                                {{$time_for_display}}
                                            </p>
                                        @else 
                                            <div class="time-slot">
                                                <p>
                                                    {{$time_for_display}}
                                                </p> 
                                            </div>
                                        @endif
                                        <?php $x++;?>
                                    @endforeach
                                </div>
                                <div class="calendar-body">
                                    
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>
    
    
    <!-- EDIT CALENDER EVENT MODAL -->
    <div class="modal fade gen-modal calender-modal" id="editCalenderEvent" tabindex="-1" aria-hidden="true">
    </div>
    <!-- ADD CALENDER EVENT MODAL -->
    <div class="modal fade gen-modal calender-modal" id="addCalenderEvent" tabindex="-1" aria-hidden="true">

    </div>

    <!-- EDIT CALENDER EVENT MODAL -->
    <div class="modal fade gen-modal calender-modal" id="editCalenderEvent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="c-date-picker">
                                            <div class="tui-datepicker-input tui-datetime-input tui-has-focus gen-input">
                                                <input type="text" id="edit-datepicker-input" aria-label="Date-Time">
                                                <span class="tui-ico-date"></span>
                                            </div>
                                            <div id="edit-date-wrapper" style="margin-top: -1px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6-col-sm-12">
                                <div class="form-group">
                                    <label>Start Time</label>
                                    <input class="gen-input" type="time">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6-col-sm-12">
                                <div class="form-group">
                                    <label>End Time</label>
                                    <input class="gen-input" type="time">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>No. of booking for this slot</label>
                                    <select class="gen-input">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                        <option value="">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Repeat</label>
                                    <select class="gen-input">
                                        <option>Daily</option>
                                        <option>Weekly</option>
                                        <option>Custom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group custom-dates-wrap">
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>Sa</span>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>Su</span>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>Mo</span>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>Tu</span>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>We</span>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>Th</span>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>Fr</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-0">
                                    <label>Assign Technicians</label>
                                    <span class="sub-label">You can assign multiple technicians to a slot</span>
                                    <div class="row">
                                        <div class="col-lg-12 col md-12 col-sm-12">
                                            <div class="form-group calender-select-technicain">
                                                <select class="gen-input">
                                                    <option>Juan Bishop</option>
                                                    <option>Stephen Hawking</option>
                                                </select>
                                                <a href="#!" class="del-technician">
                                                    <img src="{{ url('/assets/images/icon-trash-red.png') }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col md-12 col-sm-12">
                                            <div class="form-group calender-select-technicain">
                                                <select class="gen-input">
                                                    <option>Juan Bishop</option>
                                                    <option>Stephen Hawking</option>
                                                </select>
                                                <a href="#!" class="del-technician">
                                                    <img src="{{ url('/assets/images/icon-trash-red.png') }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col md-12 col-sm-12">
                                            <div class="form-group calender-select-technicain">
                                                <select class="gen-input">
                                                    <option>Juan Bishop</option>
                                                    <option>Stephen Hawking</option>
                                                </select>
                                                <a href="#!" class="del-technician">
                                                    <img src="{{ url('/assets/images/icon-trash-red.png') }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    <div>
                        <button type="button" class="del-option">Delete</button>
                        <button type="button" class="gen-btn">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- VIEW SLOT EVENT MODAL -->
    <div class="modal fade gen-modal calender-modal" id="viewSlotModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="c-date-picker">
                                            <div class="tui-datepicker-input tui-datetime-input tui-has-focus gen-input">
                                                <input type="text" id="view-slot-input" aria-label="Date-Time">
                                                <span class="tui-ico-date"></span>
                                            </div>
                                            <div id="view-slot-input-wrapper" style="margin-top: -1px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6-col-sm-12">
                                <div class="form-group">
                                    <label>Start Time</label>
                                    <input class="gen-input" type="time">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6-col-sm-12">
                                <div class="form-group">
                                    <label>End Time</label>
                                    <input class="gen-input" type="time">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>No. of booking for this slot</label>
                                    <select class="gen-input">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                        <option value="">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Repeat</label>
                                    <select class="gen-input">
                                        <option>Daily</option>
                                        <option>Weekly</option>
                                        <option>Custom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group custom-dates-wrap">
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>Sa</span>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>Su</span>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>Mo</span>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>Tu</span>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>We</span>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>Th</span>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox">
                                        <span>Fr</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-0">
                                    <label>Assign Technicians</label>
                                    <span class="sub-label">You can assign multiple technicians to a slot</span>
                                    <div class="row">
                                        <div class="col-lg-12 col md-12 col-sm-12">
                                            <div class="form-group calender-select-technicain">
                                                <select class="gen-input">
                                                    <option>Juan Bishop</option>
                                                    <option>Stephen Hawking</option>
                                                </select>
                                                <a href="#!" class="del-technician">
                                                    <img src="{{ url('/assets/images/icon-trash-red.png') }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col md-12 col-sm-12">
                                            <div class="form-group calender-select-technicain">
                                                <select class="gen-input">
                                                    <option>Juan Bishop</option>
                                                    <option>Stephen Hawking</option>
                                                </select>
                                                <a href="#!" class="del-technician">
                                                    <img src="{{ url('/assets/images/icon-trash-red.png') }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col md-12 col-sm-12">
                                            <div class="form-group calender-select-technicain">
                                                <select class="gen-input">
                                                    <option>Juan Bishop</option>
                                                    <option>Stephen Hawking</option>
                                                </select>
                                                <a href="#!" class="del-technician">
                                                    <img src="{{ url('/assets/images/icon-trash-red.png') }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mt-3">
                                    <label class="mb-3 d-block">Bookings</label>
                                    <a class="slot-order-box" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#view-slot-order-modal">
                                        <p class="heading">Bath & Body Wash Package 2 x1 +Addon lorem ipsum</p>
                                        <p>1431 Ciso Parkway, Dubai.</p>
                                    </a>
                                    <a class="slot-order-box" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#view-slot-order-modal">
                                        <p class="heading">Bath & Body Wash Package 2 x1</p>
                                        <p class="heading">Bath & Body Wash Package 2 x1</p>
                                        <p>1431 Ciso Parkway, Dubai.</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    <div>
                        <button type="button" class="del-option">Delete</button>
                        <button type="button" class="gen-btn">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD CALENDER EVENT MODAL -->
    <div class="modal fade gen-modal calender-modal" id="addCalenderBlockedEvent" tabindex="-1" aria-hidden="true">

    </div>
    <!-- ADD CALENDER BLOCK SLOT MODAL -->
    <!--<div class="modal fade gen-modal calender-modal" id="addCalenderBlockedSlot" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Blocked Time</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="">
                    <input class="gen-input" type="hidden" id="slot_type" name="slot_type" value="Blocked">
                    <div class="modal-body"> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="c-date-picker">
                                            <div class="tui-datepicker-input tui-datetime-input tui-has-focus gen-input">
                                                <input type="text" id="event-date" aria-label="Date-Time" name="event-date" >
                                                <span class="tui-ico-date"></span>
                                            </div>
                                            <div id="date-wrapper-3" style="margin-top: -1px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="gen-input" id="description" name="description">
                                </div>
                            </div>
                            <div class="row" name="times-row" id="times-row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <input type="text" id="startTimeInterval" name="start-time"  class="gen-input">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <input type="text" id="endTimeInterval" name="end-time"  class="gen-input">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="block_entire_day" name="block_entire_day">
                                        <label class="form-check-label" for="block_entire_day">
                                            Block slot for entire day
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Technicians</label>
                                    <p class="gen-light-text-12">You can choose multiple technicians to a slot</p>
                                    <div class="form-check mt-3 d-flex align-items-center">
                                        <input class="form-check-input mt-0" type="checkbox" value="" id="blocked-check-2">
                                        <label class="form-check-label gen-light-text-12 mb-0 ms-2" for="blocked-check-2">
                                            Select time to view available technicians
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group m-0">
                                    <label>Comments</label>
                                    <textarea class="gen-textarea" placeholder="eg. holiday or booking" id="comments" name="comments"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @csrf
                        <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="gen-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>-->

    <!-- EDIT CALENDER BLOCK SLOT MODAL -->
    <!-- <div class="modal fade gen-modal calender-modal" id="editCalenderBlockedSlot" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Blocked Time</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="c-date-picker">
                                            <div class="tui-datepicker-input tui-datetime-input tui-has-focus gen-input">
                                                <input type="text" id="datepicker-input-4" aria-label="Date-Time">
                                                <span class="tui-ico-date"></span>
                                            </div>
                                            <div id="date-wrapper-4" style="margin-top: -1px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="gen-input">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6-col-sm-12">
                                <div class="form-group">
                                    <label>Start Time</label>
                                    <input class="gen-input" type="time">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6-col-sm-12">
                                <div class="form-group">
                                    <label>End Time</label>
                                    <input class="gen-input" type="time">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Block slot for entire day
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Technicians</label>
                                    <p class="gen-light-text-12">You can choose multiple technicians to a slot</p>
                                    <div class="form-check mt-3 d-flex align-items-center">
                                        <input class="form-check-input mt-0" type="checkbox" value="" id="blocked-check-2" checked>
                                        <label class="form-check-label mb-0 ms-2" for="blocked-check-2">
                                            Juan Bishop
                                        </label>
                                    </div>
                                    <div class="form-check mt-3 d-flex align-items-center">
                                        <input class="form-check-input mt-0" type="checkbox" value="" id="blocked-check-2" checked>
                                        <label class="form-check-label mb-0 ms-2" for="blocked-check-2">
                                            Stephen Hawking
                                        </label>
                                    </div>
                                    <div class="form-check mt-3 d-flex align-items-center">
                                        <input class="form-check-input mt-0" type="checkbox" value="" id="blocked-check-2">
                                        <label class="form-check-label mb-0 ms-2" for="blocked-check-2">
                                            Lucas Brady
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group m-0">
                                    <label>Comments</label>
                                    <textarea class="gen-textarea" placeholder="eg. holiday or booking"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    <div>
                        <button type="button" class="del-option">Delete Blocked Slot</button>
                        <button type="button" class="gen-btn">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="modal fade gen-modal calender-modal" id="editCalenderBlockedSlot" tabindex="-1" aria-hidden="true" data-id="my_id_value">

    </div>

    <!-- VIEW SLOT ORDER MODAL -->
    <div class="modal fade gen-modal dashboard-modals" id="view-slot-order-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <div class="shadow-card mb-3">
                                        <div class="order-number-info">
                                            <p class="number">Order #1234</p>
                                            <p class="status"><span class="tag active"></span>Active</p>
                                        </div>
                                    </div>
                                    <div class="shadow-card mb-3">
                                        <div class="order-instrustion">
                                            <p class="title">Special Instructions </p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                                        </div>
                                    </div>
                                    <div class="shadow-card mb-3">
                                        <div class="ordered-services">
                                            <p class="heading">Ordered Services</p>
                                            <div class="ordered-service">
                                                <div class="img"></div>
                                                <div class="desc">
                                                    <p class="name">Bath & Bodywash (Package 1)  x1</p>
                                                    <p>For medium sized pet</p>
                                                    <p>Service Duration: 50m</p>
                                                </div>
                                                <div class="price">
                                                    <p>AED 200</p>
                                                </div>
                                                <div class="profile">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order-profile-1" aria-expanded="false" aria-controls="order-profile-1">
                                                        Pet Profile <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                    <div id="order-profile-1" class="accordion-collapse collapse">
                                                        <div class="accordion-body">
                                                            <div class="profile-info">
                                                                <div class="name">
                                                                    <p class="title">NAME</p>
                                                                    <p class="info">Archie</p>
                                                                </div>
                                                                <div class="age">
                                                                    <p class="title">AGE</p>
                                                                    <p class="info">4months</p>
                                                                </div>
                                                                <div class="breed">
                                                                    <p class="title">BREED</p>
                                                                    <p class="info">German Shepard</p>
                                                                </div>
                                                                <div class="weight">
                                                                    <p class="title">WEIGHT</p>
                                                                    <p class="info">4 kgs</p>
                                                                </div>
                                                                <div class="allergies">
                                                                    <p class="title">ALLERGIES</p>
                                                                    <p class="info">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ordered-service">
                                                <div class="img"></div>
                                                <div class="desc">
                                                    <p class="name">Bath & Bodywash (Package 1)  x1</p>
                                                    <p>For medium sized pet</p>
                                                    <p>Service Duration: 50m</p>
                                                </div>
                                                <div class="price">
                                                    <p>AED 200</p>
                                                </div>
                                                <div class="profile">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order-profile-2" aria-expanded="false" aria-controls="order-profile-2">
                                                        Pet Profile <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                    <div id="order-profile-2" class="accordion-collapse collapse">
                                                        <div class="accordion-body">
                                                            <div class="profile-info">
                                                                <div class="name">
                                                                    <p class="title">NAME</p>
                                                                    <p class="info">Archie</p>
                                                                </div>
                                                                <div class="age">
                                                                    <p class="title">AGE</p>
                                                                    <p class="info">4months</p>
                                                                </div>
                                                                <div class="breed">
                                                                    <p class="title">BREED</p>
                                                                    <p class="info">German Shepard</p>
                                                                </div>
                                                                <div class="weight">
                                                                    <p class="title">WEIGHT</p>
                                                                    <p class="info">4 kgs</p>
                                                                </div>
                                                                <div class="allergies">
                                                                    <p class="title">ALLERGIES</p>
                                                                    <p class="info">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="time-box">
                                                <p><img src="assets/images/icon-clock.png" class="img-fluid" alt="">Total Service Duration: 1h20mins</p>
                                            </div>
                                            <div class="amount-box">
                                                <ul class="amount-list">
                                                    <li><span>Sub Total</span><span>AED 400</span></li>
                                                    <li><span>Tax</span><span>AED 30</span></li>
                                                    <li><span>Delivery</span><span>AED 30</span></li>
                                                    <li><span>Total</span><span>AED 460</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="shadow-card mb-3">
                                        <div class="order-detail">
                                            <div class="order-info mb-3">
                                                <p class="title">Address</p>
                                                <p>1431 Ciso Parkway, Lorem ipsum, Dubai.</p>
                                            </div>
                                            <div class="order-info mb-3">
                                                <p class="title">Date</p>
                                                <p>22/11/2021</p>
                                            </div>
                                            <div class="order-info mb-1">
                                                <p class="title">TIME</p>
                                                <p>16:40</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="shadow-card mb-3">
                                        <div class="assign-technician-card">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="title">Technician Assigned</p>
                                                <a href="#!" class="assign-tech" data-bs-toggle="modal" data-bs-target="#assignTechnicianModal"><img src="assets/images/icon-pencil-green.png" alt="icon" class="img-fluid"></a>
                                            </div>
                                            <div class="selected-technician">
                                                <div class="technician-item">
                                                    <div class="img">
                                                        <img src="{{ url('/assets/images/icon-user.png') }}" class="img-fluid">
                                                    </div>
                                                    <p>Jamie Vardy</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="shadow-card mb-3">
                                        <div class="service-progress">
                                            <p class="title">SERVICE History</p>
                                            <div class="service-progress-info">
                                                <div class="img">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="desc">
                                                    <p class="title">Driver on the way</p>
                                                    <p>16:10</p>
                                                </div>
                                            </div>
                                            <div class="service-progress-info">
                                                <div class="img">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="desc">
                                                    <p class="title">At the location</p>
                                                    <p>16:10</p>
                                                </div>
                                            </div>
                                            <div class="service-progress-info">
                                                <div class="img">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="desc">
                                                    <p class="title">Service in progress</p>
                                                    <p>16:10</p>
                                                </div>
                                            </div>
                                            <div class="service-progress-info">
                                                <div class="img">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="desc">
                                                    <p class="title">Service is completed</p>
                                                    <p>16:10</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="gen-btn">Apply</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // CALNEDER SCRIPTS
        // let slot_cards = document.querySelectorAll(".calender-slots-wrap .slot-box .slot-card");
        // for (i=0; i<=slot_cards.length; i++){
        //  slot_cards[i].classList.add("test");
        // }

        // var datepicker = new tui.DatePicker('#add-date-wrapper', {
        //     date: new Date(),
        //     input: {
        //         element: '#add-datepicker-input',
        //         format: 'dd-MM-yyyy'
        //     }
        // });
        // var datepicker2 = new tui.DatePicker('#edit-date-wrapper', {
        //     date: new Date(),
        //     input: {
        //         element: '#edit-datepicker-input',
        //         format: 'dd-MM-yyyy'
        //     }
        // });
        var today = new Date();
        var datepicker3 = new tui.DatePicker('#date-wrapper-3', {
            date: new Date(),
            selectableRanges: [[today, new Date(today.getFullYear() + 1, today.getMonth(), today.getDate())]],
            input: {
                element: '#event-date',
                format: 'dd-MM-yyyy'
            }
        });

       /* var datepicker4 = new tui.DatePicker('#date-wrapper-4', {
            date: new Date(),
            input: {
                element: '#datepicker-input-4',
                format: 'dd-MM-yyyy'
            }
        });*/

        var datepicker5 = new tui.DatePicker('#view-slot-input-wrapper', {
            date: new Date(),
            input: {
                element: '#view-slot-input',
                format: 'dd-MM-yyyy'
            }
        });

        $(".view-list-dropdown-menu li a").click(function(){
            $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <i class="fas fa-chevron-down"></i>');
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        });
    </script>

    <!-- OPEN MODAL SCRIPTS -->
    <script>
        $(document).ready( function () {
                        
            $(".calender-slots-wrap .slot-card .slot-item").click(function(){
                $('#viewSlotModal').modal('show');
            });

            /*$(".calender-slots-wrap .slot-box .slot-card.blocked-slot").click(function(evt){
                var techId = this.id;
                var url = "{{URL::to("/calendar")}}/"+techId+"/edit";
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(result) {
                        $('#editCalenderEvent').html(result).modal('show');
                    }
                });
            });*/

            $(".calender-slots-wrap .slot-box .slot-card").click(function(evt){
                var techId = this.id;
                var url = "{{URL::to("/calendar")}}/"+techId+"/edit";
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(result) {
                        $('#editCalenderEvent').html(result).modal('show');
                    }
                });
            });

            $("#addCalenderSlot").click(function(evt){
                var url = "{{URL::to("/calendar")}}/create";
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {type: "New"},
                    success: function(result) {
                        $('#addCalenderEvent').html(result).modal('show');
                    }
                });
            });
            
             $("#addCalenderBlockedSlot").click(function(evt){
                var url = "{{URL::to("/calendar")}}/create";
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {type: "Blocked"},
                    success: function(result) {
                        $('#addCalenderBlockedEvent').html(result).modal('show');
                    }
                });
            });

            $('#startTimeInterval').timepicker({
                'minTime': '7:00am',
                'maxTime': '11:00pm',
                'timeFormat': 'H:i',
                'step': function(i) {
                    return (i%2) ? 15 : 15;
                },
                'forceRoundTime': true 
            });

            $('#endTimeInterval').timepicker({
                'minTime': '7:00am',
                'maxTime': '11:00pm',
                'timeFormat': 'H:i',
                'step': function(i) {
                    return (i%2) ? 15 : 15;
                },
                'forceRoundTime': true 
            });
            
        });
    </script>
@endpush