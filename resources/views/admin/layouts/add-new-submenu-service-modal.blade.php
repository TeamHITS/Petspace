<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">New Service</h5>
            <button type="button" class="btn-close btn-add-cancel" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="menu-form" action="{{URL::to('admin/petspaces/add-submenu-service')}}" method="POST">
        <div class="modal-body">

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Service Name</label>
                            <input type="text" class="gen-input" placeholder="Service Name" name="name" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="gen-input" placeholder="Service Description" name="description" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Total Standard Price</label>
                            <input type="text" class="gen-input" placeholder="Service Price" name="price" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Total Discount Price (Optional)</label>
                            <input type="text" class="gen-input" placeholder="Service Discount Price" name="discount" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Service Duration</label>
                            <input type="text" class="gen-input" placeholder="Service Duration in minutes" name="service_duration" required>
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="modal-cancel-btn btn-add-cancel" data-bs-dismiss="modal" style="margin-right: 5px;">Cancel</button>
            <div>
                <input type="text" hidden name="submenu_id" value="{{$submenuId}}">
                <button type="submit" class="gen-btn">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>