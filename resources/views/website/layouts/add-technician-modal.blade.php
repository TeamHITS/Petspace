<!-- ADD TECHNICIAN MODAL -->
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Technician</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="technician-form" action="{{URL::to('/add-tech')}}" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" class="gen-input" placeholder="eg. Jane" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" class="gen-input" placeholder="eg. Doe" name="last_name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Mobile Number</label>
                                <input type="text" class="gen-input" placeholder="123 382 712" name="phone" required>
                                <input type="text" hidden name="roles" value="5" required>
                                @csrf
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="gen-input"
                                       placeholder="Enter a email of your technicians" name="email" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Password Pin</label>
                                <input type="password" class="gen-input"
                                       placeholder="Four digit or six digit pin for technicians to login" name="password" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Appointment Color</label>
                                <div class="technician-color-wrap">
                                    <div class="technician-color">
                                        <input type="radio" name="technician_color" value="#ccf8fe" required>
                                        <span style="background: #ccf8fe;"></span>
                                    </div>
                                    <div class="technician-color">
                                        <input type="radio" name="technician_color" value="#e2fbd7" required>
                                        <span style="background: #e2fbd7;"></span>
                                    </div>
                                    <div class="technician-color">
                                        <input type="radio" name="technician_color" value="#fff5cc" required>
                                        <span style="background: #fff5cc;"></span>
                                    </div>
                                    <div class="technician-color">
                                        <input type="radio" name="technician_color" value="#dad7fe" required>
                                        <span style="background: #dad7fe;"></span>
                                    </div>
                                    <div class="technician-color">
                                        <input type="radio" name="technician_color" value="#cea0ae" required>
                                        <span style="background: #cea0ae;"></span>
                                    </div>
                                    <div class="technician-color">
                                        <input type="radio" name="technician_color" value="#d68fd6" required>
                                        <span style="background: #d68fd6;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="service_assignment" id="flexSwitchCheckDefault" required>
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
                    <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="gen-btn">Apply</button>
                </div>
            </form>
        </div>
    </div>