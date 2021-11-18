<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Create Slot</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action="calendar"><?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="row">
                        <input class="gen-input" type="hidden" id="slot_type" name="slot_type" value="Ordered">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Event Date</label>
                                <div class="c-date-picker">
                                    <div class="tui-datepicker-input tui-datetime-input tui-has-focus gen-input">
                                        <input type="text" id="add-datepicker-input" aria-label="Date-Time"
                                               name="event-date">
                                        <span class="tui-ico-date"></span>
                                    </div>
                                    <div id="add-date-wrapper" style="margin-top: -1px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6" id="end-date-container" style="display:none">
                            <div class="form-group">
                                <label>Event End Date</label>
                                <div class="c-date-picker">
                                    <div class="tui-datepicker-input tui-datetime-input tui-has-focus gen-input">
                                        <input type="text" aria-label="Date-Time" name="event-end-date"
                                               id="end-event-date">
                                        <span class="tui-ico-date"></span>
                                    </div>
                                    <div id="add-end-date-wrapper" style="margin-top: -1px;"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-6-col-sm-12">
                        <div class="form-group">
                            <label>Start Time</label>
                            <input class="gen-input" type="text" id="event-start-time" name="start-time">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6-col-sm-12">
                        <div class="form-group">
                            <label>End Time</label>
                            <input class="gen-input" type="text" id="event-end-time" name="end-time">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>No. of booking for this slot</label>
                            <select class="gen-input" name="number-of-bookings" id="number-of-bookings">
                                <option value="">Select no of bookings</option>
                                <option hidden value="">1</option>
                                @for($i = 1; $i <= $technicians_count; $i++)
                                    <option value={{$i}}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Repeat</label>
                            <select class="gen-input" name="repeat" id="repeat">
                                <option value="No Repeat" selected>No Repeat</option>
                                <option value="Daily">Daily</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Custom">Custom</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12" id="day-div">
                        <div class="form-group custom-dates-wrap">
                            <div class="day-checkbox">
                                <input type="checkbox" name="saturday">
                                <span>Sa</span>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox" name="sunday">
                                <span>Su</span>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox" name="monday">
                                <span>Mo</span>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox" name="tuesday">
                                <span>Tu</span>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox" name="wednesday">
                                <span>We</span>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox" name="thursday">
                                <span>Th</span>
                            </div>
                            <div class="day-checkbox">
                                <input type="checkbox" name="friday">
                                <span>Fr</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-0">
                            <label>Assign Technicians</label>
                            <span class="sub-label">You can assign multiple technicians to a slot</span>
                            <div class="row" id="technician-container">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="gen-btn" id="addToCalender">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        var today = new Date();
        var datepicker = new tui.DatePicker('#add-date-wrapper', {
            date: new Date(),
            selectableRanges: [[today, new Date(today.getFullYear() + 1, today.getMonth(), today.getDate())]],
            input: {
                element: '#add-datepicker-input',
                format: 'dd-MM-yyyy'
            }
        });

        var datepicker = new tui.DatePicker('#add-end-date-wrapper', {
            date: new Date(),
            selectableRanges: [[today, new Date(today.getFullYear() + 1, today.getMonth(), today.getDate())]],
            input: {
                element: '#end-event-date',
                format: 'dd-MM-yyyy'
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

        $("#repeat").change(function (evt) {
            if (this.value == 'Custom') {
                $('#end-date-container').show();
            } else {
                $('#end-date-container').hide();
            }
            if (this.value == "Daily") {
                $('#day-div').hide();
            } else {
                $('#day-div').show();
            }

        });
        
        $("#number-of-bookings").change(function (evt) {

            var value = this.value;
            var html = '';
            for (let index = 1; index <= value; index++) {

                html += "<div class='col-lg-12 col md-12 col-sm-12' id = 'technicain-div-" + index + "' >";
                html += "<div class='form-group calender-select-technicain'>";
                html += "<select class='gen-input' id='select-technicain-" + index + "'>";
                html += "<option value='' selected disabled hidden>Choose Technician</option>";
                @foreach($alltechnicians as $technician)
                    html += '<option value="{{$technician->id}}">{{$technician->name}}</option>';
                @endforeach
                    html += "</select>";
                html += "<a href='#!' class='del-technician'>";
                html += "<img src='{{ asset('public/assets/images/icon-trash-red.png') }}' class='img-fluid'>";
                html += "</a>";
                html += "</div>";
                html += "</div>";
            }
            $('#technician-container').html(html);
        });
    });
</script>