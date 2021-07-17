<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">New Submenu List</h5>
            <button type="button" class="btn-close btn-add-cancel" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="menu-form" action="{{URL::to('admin/petspaces/add-submenu')}}" method="POST">
            <div class="modal-body">

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Submenu Name</label>
                            <input type="text" class="gen-input" placeholder="Submenu list name" name="name" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Submenu Description</label>
                            <input type="text" class="gen-input" placeholder="Submenu Description" name="description"
                                   required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <div class="form-check form-switch d-flex align-items-center">
                                <label class="switch">
                                    <input class="form-check-input" id="submenu-condition-chk" type="checkbox" checked="">
                                    <span class="slider round"></span>
                                </label>
                                <label class="form-check-label mb-0">Optional Items <br><span class="gen-light-text">This list has optional items can be skipped</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 submenu-condition-div">
                        <div class="form-group">
                            <label for="">Condition Options</label>
                            <select class="gen-input" name="condition_option">
                                <option selected disabled>Select a condition</option>
                                <option value="{{\App\Models\SubmenuList::MINIMUM}}">Minimum</option>
                                <option value="{{\App\Models\SubmenuList::EQUAL}}">Equal</option>
                                <option value="{{\App\Models\SubmenuList::MAXIMUM}}">Maximum</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 submenu-condition-div">
                        <div class="form-group">
                            <label for="">No. of Items can be selected</label>
                            <input type="number" class="gen-input" placeholder="00-99" name="select_count">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="text" hidden name="cat_service_id" value="{{$catServiceId}}">
                <button type="button" class="modal-cancel-btn btn-add-cancel" data-bs-dismiss="modal" style="margin-right: 5px;">Cancel</button>
                <button type="submit" class="gen-btn">Save</button>
            </div>
        </form>
    </div>
</div>