<!-- DELETE TECHNICIAN MODAL -->
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Technician</h5>
                <h4 class="modal-sub-title">Are you sure you wanna delete this technician ?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <div>
                    <form id="technician-form" action="{{URL::to('/delete-tech')}}" method="POST">
                        <input type="text" hidden name="id" value="{{$user_id}}" required>
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>