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
                                                <input type="text" id="event-date-create-blocked" aria-label="Date-Time" name="event-date" >
                                                <span class="tui-ico-date"></span>
                                            </div>
                                            <div id="date-wrapper-create-blocked" style="margin-top: -1px;"></div>
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

<script>
    $(document).ready( function () {
        var today = new Date();
        var datepicker3 = new tui.DatePicker('#date-wrapper-create-blocked', {
            date: new Date(),
            selectableRanges: [[today, new Date(today.getFullYear() + 1, today.getMonth(), today.getDate())]],
            input: {
                element: '#event-date-create-blocked',
                format: 'dd-MM-yyyy'
            }
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
        
        $('#block_entire_day').click(function(){
            if($(this).is(':checked')){
                $('#times-row').hide();
            } else {
                $('#times-row').show();
            }
        });
        
    });
</script>