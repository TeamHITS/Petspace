<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header" style="padding: 18px 30px;justify-content: center;">
            <h5 class="modal-title">New Category</h5>
            <button type="button" class="btn-close btn-add-cancel" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="menu-form" action="{{URL::to('admin/petspaces/add-category')}}" method="POST">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">List Name</label>
                            <input type="text" class="gen-input" name="name" placeholder="Basic Packages" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="gen-input" name="description" placeholder="Lorem ipsum" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="text" hidden name="petspace_id" value="{{$petspaceId}}">
                @csrf
                <button type="button" class="modal-cancel-btn btn-add-cancel" data-bs-dismiss="modal" style="margin-right: 5px;">Cancel</button>
                <button type="submit" class="gen-btn">Save</button>
            </div>
        </form>
    </div>
</div>