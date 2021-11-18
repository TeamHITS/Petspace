<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Blocked Time</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="calendar/save">
            <input type="text" hidden name="id" value="{{$slot->id}}">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="c-date-picker">
                                    <div class="tui-datepicker-input tui-datetime-input tui-has-focus gen-input">
                                        <input type="text" id="event-date-edit-blocked" aria-label="Date-Time"
                                               name="event-date" value='{{date("d-m-Y",strtotime($slot->start_date))}}'>
                                        <span class="tui-ico-date"></span>
                                    </div>
                                    <div id="edit-blocked-date-wrapper" style="margin-top: -1px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="gen-input" id="description" name="description"
                                   value="{{$slot->description}}">
                        </div>
                    </div>
                    <div class="row" id="times-row-edit"
                         style="display:{{$slot->block_entire_day == 'checked'?'none':''}}">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Start Time</label>
                                <input class="gen-input" type="text" id="event-start-time" name="start-time"
                                       value="{{$slot->start_time}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>End Time</label>
                                <input class="gen-input" type="text" id="event-end-time" name="end-time"
                                       value="{{$slot->end_time}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="block_entire_day_edit"
                                       name="block_entire_day_edit" {{$slot->block_entire_day}}>
                                <label class="form-check-label" for="block_entire_day_edit">
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
                            <textarea class="gen-textarea" placeholder="eg. holiday or booking" id="comments"
                                      name="comments">{{$slot->comments}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @csrf
                <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <div>

                    <button type="button" class="gen-btn" data-bs-toggle="modal"
                            data-bs-target="#deleteCalenderBlockedSlot" name="hiddenValue" id="hiddenValue"
                            value="{{$slot->id}}">Delete Blocked Slot
                    </button>
                    <button type="submit" class="gen-btn">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- COMFIRM DELETE CALENDER BLOCK SLOT MODAL -->
<div class="modal fade gen-modal calender-modal" id="deleteCalenderBlockedSlot" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header justify-content-start">
                <div class="form-group mb-0">
                    <label>Delete Blocked slot</label>
                    <span class="sub-label mb-0">Are you sure you wanna delete this blocked slot ?</span>
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
        var datepicker = new tui.DatePicker('#edit-blocked-date-wrapper', {
            date: new Date('{{date("dd-MM-yyyy",strtotime($slot->start_date))}}'),
            selectableRanges: [[today, new Date(today.getFullYear() + 1, today.getMonth(), today.getDate())]],
            input: {
                element: '#event-date-edit-blocked',
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


        $("#repeat").change(function (evt) {
            if (this.value == 'Custom') {
                $('#end-date-container').show();
            } else {
                $('#end-date-container').hide();
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

        $('#block_entire_day_edit').click(function () {
            if ($(this).is(':checked')) {
                $('#times-row-edit').hide();
            } else {
                $('#times-row-edit').show();
            }
        });
    });
</script>

