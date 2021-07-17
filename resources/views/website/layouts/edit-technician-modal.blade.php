 <!-- EDIT TECHNICIAN MODAL -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Technician</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                 <form id="technician-form" action="{{URL::to('/edit-tech')}}" method="POST">
                <div class="modal-body">
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" class="gen-input" placeholder="eg. Jane" name="first_name"                                                                               value="{{$technician['user']['details']['first_name']}}" required>
                                    <input type="text" hidden name="id" value="{{$technician['user_id']}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" class="gen-input" placeholder="eg. Doe" name="last_name"                                                                                 value="{{$technician['user']['details']['last_name']}}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Mobile Number</label>
                                    <input type="text" class="gen-input" placeholder="123 382 712" name="phone"
                                     value="{{$technician['user']['details']['phone']}}" required>
                                    @csrf
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="gen-input"
                                           placeholder="Enter a email of your technicians" disabled name="email"
                                            value="{{$technician['user']['email']}}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Password Pin</label>
                                    <input type="password" class="gen-input"
                                           placeholder="Four digit or six digit pin for technicians to login" name="password"
                                           >
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Appointment Color</label>
                                    <div class="technician-color-wrap">
                                        <div class="technician-color">
                                            <input type="radio" name="technician_color" value="#ccf8fe"
                                             {{($technician['user']['details']['technician_color'] == "#ccf8fe") ? "checked" :""}} required>
                                            <span style="background: #ccf8fe;"></span>
                                        </div>
                                        <div class="technician-color">
                                            <input type="radio" name="technician_color" value="#e2fbd7"
                                            {{($technician['user']['details']['technician_color'] == "#e2fbd7") ? "checked" :""}} required>
                                            <span style="background: #e2fbd7;"></span>
                                        </div>
                                        <div class="technician-color">
                                            <input type="radio" name="technician_color" value="#fff5cc"
                                            {{($technician['user']['details']['technician_color'] == "#fff5cc") ? "checked" :""}} required>
                                            <span style="background: #fff5cc;"></span>
                                        </div>
                                        <div class="technician-color">
                                            <input type="radio" name="technician_color" value="#dad7fe"
                                            {{($technician['user']['details']['technician_color'] == "#dad7fe") ? "checked" :""}} required>
                                            <span style="background: #dad7fe;"></span>
                                        </div>
                                        <div class="technician-color">
                                            <input type="radio" name="technician_color" value="#cea0ae"
                                            {{($technician['user']['details']['technician_color'] == "#cea0ae") ? "checked" :""}} required>
                                            <span style="background: #cea0ae;"></span>
                                        </div>
                                        <div class="technician-color">
                                            <input type="radio" name="technician_color" value="#d68fd6"
                                            {{($technician['user']['details']['technician_color'] == "#d68fd6") ? "checked" :""}} required>
                                            <span style="background: #d68fd6;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" name="user_status" id="flexSwitchCheckDefault"
                                         {{($technician['user']['status'] == 1) ? "checked" :""}}>
                                        <label class="form-check-label mb-0" for="flexSwitchCheckDefault">
                                            <span>Enable Service Assignments</span>
                                            <span>Lorem ipsum</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-cancel-btn " data-bs-dismiss="modal">Cancel</button>
                    <div>
                        <button type="button" class="del-technician delete-technician-modal" data-id="{{$technician['user_id']}}" >Delete Technician
                        </button>
                        <button type="submit" class="gen-btn">Save</button>
                    </div>
                </div>
                  </form>
            </div>
        </div>
