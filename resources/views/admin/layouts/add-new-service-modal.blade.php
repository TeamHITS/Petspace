<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">New Service</h5>
            <button type="button" class="btn-close btn-add-cancel" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="menu-form" action="{{URL::to('admin/petspaces/add-service')}}" method="POST">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="new-service-modal-top">
                                <div class="img upload-img">
                                    <div class="avatar-upload">
                                        <p class="tag"><i class="fas fa-cloud-upload-alt mr-1"></i>Upload Image</p>
                                        <div class="avatar-preview">
                                            <div id="imagePreview">
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" name="image_url" id="imageUpload"
                                                   accept=".png, .jpg, .jpeg">
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="img upload-img">--}}
                                {{--<input type="file">--}}
                                {{--</div>--}}
                                <div class="desc">

                                    <p>Allowed file types: png, jpg, jpeg</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Service Name</label>
                            <input name="name" type="text" class="gen-input" placeholder="Service Name" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="gen-input"
                                      placeholder="Small description about the service" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Total Standard Price</label>
                            <input name="price" type="text" class="gen-input" placeholder="Service Price" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Total Discount Price (Optional)</label>
                            <input name="discount" type="text" class="gen-input" placeholder="Service Discount Price"
                                   required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Service Duration</label>
                            <input name="service_duration" type="text" class="gen-input"
                                   placeholder="Service Duration in minutes" required>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="modal-cancel-btn btn-add-cancel" data-bs-dismiss="modal"
                        style="margin-right: 5px;">Cancel
                </button>
                <div>
                    <input type="text" hidden name="category_id" value="{{$categoryId}}">
                    @csrf
                    <button type="submit" class="gen-btn">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    // Avtar JS
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageUpload").change(function () {
        if(this.files[0].size > 2097152){
            alert("File is too big!");
            this.value = "";
        }else{
            readURL(this);
        }

    });
</script>