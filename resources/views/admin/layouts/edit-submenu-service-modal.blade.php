<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Service</h5>
            <button type="button" class="btn-close btn-add-cancel" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="menu-form" action="{{URL::to('admin/petspaces/update-submenu-service')}}" method="POST">
            <div class="modal-body">

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Service Name</label>
                            <input type="text" class="gen-input" placeholder="Service Name" name="name"
                                   value="{{$service['name']}}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="gen-input" placeholder="Service Description" name="description"
                                   value="{{$service['description']}}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Total Standard Price</label>
                            <input type="text" class="gen-input" placeholder="Enter Service Price" name="price"
                                   value="{{$service['price']}}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Total Discount Price (Optional)</label>
                            <input type="text" class="gen-input" name="discount" value="{{$service['discount']}}"
                                   placeholder="Enter Discount in Percentage" pattern="^[0-9][0-9]?$|^100$"
                                   title="Enter discount between 0 to 100">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Service Duration</label>
                            <input type="text" class="gen-input" placeholder="Enter Duration in minutes"
                                   name="service_duration" value="{{$service['service_duration']}}" required>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="modal-cancel-btn btn-add-cancel" data-bs-dismiss="modal"
                        style="margin-right: 5px;">Cancel
                </button>
                <div>
                    <input type="text" hidden name="id" value="{{$service['id']}}">
                    <a href="{{url('admin/petspaces/delete-submenu-service').'/'.$service['id']}}"
                       class="del-technician">Delete Service</a>
                    <button type="submit" class="gen-btn">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>