<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Slot</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="calendar/save">
            <input type="text" hidden name="id" value="{{$slot->id}}">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Event Start Date</label>
                                <div class="c-date-picker">
                                    <div class="tui-datepicker-input tui-datetime-input tui-has-focus gen-input">
                                        <input type="text" id="event-date" aria-label="Date-Time" name="event-date"
                                               value='{{date("d-m-Y",strtotime($slot->start_date))}}'>
                                        <span class="tui-ico-date"></span>
                                    </div>
                                    <div id="edit-date-wrapper" style="margin-top: -1px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6" id="end-date-container-edit"
                             style="display:{{$slot->reserved_type == 'Custom'?'':'none'}}">
                            <div class="form-group">
                                <label>Event End Date</label>
                                <div class="c-date-picker">
                                    <div class="tui-datepicker-input tui-datetime-input tui-has-focus gen-input">
                                        <input type="text" id="event-end-date" aria-label="Date-Time"
                                               name="event-end-date"
                                               value='{{date("d-m-Y",strtotime($slot->end_date))}}'>
                                        <span class="tui-ico-date"></span>
                                    </div>
                                    <div id="edit-end-date-wrapper" style="margin-top: -1px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6-col-sm-12">
                        <div class="form-group">
                            <label>Start Time</label>
                            <input class="gen-input" type="text" id="event-start-time" name="start-time"
                                   value="{{$slot->start_time}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6-col-sm-12">
                        <div class="form-group">
                            <label>End Time</label>
                            <input class="gen-input" type="text" id="event-end-time" name="end-time"
                                   value="{{$slot->end_time}}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>No. of booking for this slot</label>
                            <select class="gen-input" name="number-of-bookings">
                                @for($i = 1; $i <= $technicians_count; $i++)
                                    <option {{$slot->total_booking_count == $i?"selected":""}} value={{$i}} >{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Repeat</label>
                            <select class="gen-input" name="repeat-edit" id="repeat-edit">
                                <option {{$slot->reserved_type == 'No Repeat'?'selected':''}} value="No Repeat">No
                                    Repeat
                                </option>
                                <option {{$slot->reserved_type == 'Daily'?'selected':''}} value="Daily">Daily</option>
                                <option {{$slot->reserved_type == 'Weekly'?'selected':''}} value="Weekly">Weekly
                                </option>
                                <option {{$slot->reserved_type == 'Custom'?'selected':''}} value="Custom">Custom
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group custom-dates-wrap">
                            <div class="day-checkbox">
                                <input type="checkbox"
                                       name="saturday" {{$slot->reserved_days->saturday == "on"?"checked":""}}>
                                <span>Sa</span>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox"
                                       name="sunday" {{$slot->reserved_days->sunday == "on"?"checked":""}}>
                                <span>Su</span>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox"
                                       name="monday" {{$slot->reserved_days->monday == "on"?"checked":""}}>
                                <span>Mo</span>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox"
                                       name="tuesday" {{$slot->reserved_days->tuesday == "on"?"checked":""}}>
                                <span>Tu</span>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox"
                                       name="wednesday" {{$slot->reserved_days->wednesday == "on"?"checked":""}}>
                                <span>We</span>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox"
                                       name="thursday" {{$slot->reserved_days->thursday == "on"?"checked":""}}>
                                <span>Th</span>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox"
                                       name="friday" {{$slot->reserved_days->friday == "on"?"checked":""}}>
                                <span>Fr</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-0">
                            <label>Assign Technicians</label>
                            <span class="sub-label">You can assign multiple technicians to a slot</span>
                            <div class="row">
                                @for($i = 1; $i <= $booking_count; $i++)
                                    <div class="col-lg-12 col md-12 col-sm-12">
                                        <div class="form-group calender-select-technicain">
                                            <select class="gen-input">
                                                @foreach($alltechnicians as $technician)
                                                    <option value="{{$technician->id}}">{{$technician->name}}</option>
                                                @endforeach
                                            </select>
                                            <a href="#!" class="del-technician">
                                                <img src="{{ url('/public/assets/images/icon-trash-red.png') }}"
                                                     class="img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <div>
                    <button type="button" class="gen-btn" data-bs-toggle="modal" data-bs-target="#deleteCalenderSlot"
                            name="hiddenValue" id="hiddenValue" value="{{$slot->id}}">Delete Slot
                    </button>
                    <button type="submit" class="gen-btn">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- COMFIRM DELETE CALENDER BLOCK SLOT MODAL -->
<div class="modal fade gen-modal calender-modal" id="deleteCalenderSlot" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header justify-content-start">
                <div class="form-group mb-0">
                    <label>Delete slot</label>
                    <span class="sub-label mb-0">Are you sure you wanna delete this slot ?</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                @csrf
                <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="gen-btn del-slot delete-calendar-slot" name="hiddenValue" id="hiddenValue"
                        value="{{$slot->id}}">Delete
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var today = new Date();
        var datepicker = new tui.DatePicker('#edit-date-wrapper', {
            date: new Date('{{date("dd-MM-yyyy",strtotime($slot->start_date))}}'),
            selectableRanges: [[today, new Date(today.getFullYear() + 1, today.getMonth(), today.getDate())]],
            input: {
                element: '#event-date',
                format: 'dd-MM-yyyy'
            }
        });

        var datepicker = new tui.DatePicker('#edit-end-date-wrapper', {
            date: new Date('{{date("dd-MM-yyyy",strtotime($slot->start_date))}}'),
            selectableRanges: [[today, new Date(today.getFullYear() + 1, today.getMonth(), today.getDate())]],
            input: {
                element: '#event-end-date',
                format: 'dd-MM-yyyy'
            }
        });

        $('.delete-calendar-slot').on('click', function (evt) {
            var techId = this.value || "No ID!";
            var url = "{{URL::to("/calendar")}}/" + techId;
            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    $('.modal-cancel-btn').click();
                    if (result.data == "error") {
                        alert(result.message);
                    }
                    window.location = '/calendar';
                }
            });
        });


        $("#repeat-edit").change(function (evt) {
            if (this.value == 'Custom') {
                $('#end-date-container-edit').show();
            } else {
                $('#end-date-container-edit').hide();
            }
        });


        $('#event-start-time').timepicker({
            'minTime': '7:00am',
            'maxTime': '11:00pm',
            'timeFormat': 'H:i',
            'step': function (i) {
                return (i % 2) ? 15 : 15;
            },
            'forceRoundTime': true
        });

        $('#event-end-time').timepicker({
            'minTime': '7:00am',
            'maxTime': '11:00pm',
            'timeFormat': 'H:i',
            'step': function (i) {
                return (i % 2) ? 15 : 15;
            },
            'forceRoundTime': true
        });
    });
</script>