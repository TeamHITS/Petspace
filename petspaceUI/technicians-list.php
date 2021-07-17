<?php include 'includes/header.php';?>

<div class="dashboard-main-wrap">
	<div class="side-bar">
		<div class="sidebar-top">
			<div class="logo-box">
				<a href="#!">
					<img src="assets/images/logo.png" alt="logo" class="img-fluid">
				</a>
			</div>
			<ul class="sidebar-list">
				<li><a href="dashboard.php"><img src="assets/images/dashboard-icon-1.png" class="img-fluid"><span>Dashboard</span></a></li>
				<li><a href="#!"><img src="assets/images/dashboard-icon-2.png" class="img-fluid"><span>Calendar</span></a></li>
				<li class="active"><a href="#!"><img src="assets/images/dashboard-icon-3.png" class="img-fluid"><span>Orders</span></a></li>
				<li><a href="#!"><img src="assets/images/dashboard-icon-4.png" class="img-fluid"><span>Service Menu</span></a></li>
				<li><a href="technicians.php"><img src="assets/images/dashboard-icon-5.png" class="img-fluid"><span>Technicians</span></a></li>
			</ul>
		</div>
		<div class="sidebar-bottom">
			<ul class="sidebar-bottom-list">
				<li><a href="store-setting.php"><img src="assets/images/dashboard-icon-6.png" class="img-fluid"><span>Store Settings</span></a></li>
				<li><a href="#!"><img src="assets/images/dashboard-icon-7.png" class="img-fluid"><span>Contact Petspace</span></a></li>
			</ul>
		</div>
	</div>
	<div class="main-stage">
		<section class="auth-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-3">
						<p class="pg-title">Technicians</p>
					</div>
					<div class="col-lg-8 col-md-8 col-9">
						<ul class="auth-top-btn">
							<li>
								<div class="dropdown">
								  <a class="dropdown-toggle" href="#" role="button" id="notification-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
								    <img src="assets/images/bell-icon.png" alt="icon" class="img-fluid">
								  </a>

								  <ul class="dropdown-menu notification-dropdown" aria-labelledby="notification-dropdown">
								    <li class="d-flex justify-content-end">
								    	<a href="#!" class="clear-btn">Clear</a>
								    </li>
								    <li>
								    	<div class="dropdown-list-item">
								    		<div class="icon blue">
								    			<i class="far fa-sticky-note"></i>
								    		</div>
								    		<div class="text">
								    			<p class="tag">Menu</p>
								    			<p>Your Menu Details have been updated</p>
								    			<p class="time">20 min ago</p>
								    		</div>
								    	</div>
								    </li>
								    <li>
								    	<div class="dropdown-list-item">
								    		<div class="icon red">
								    			<i class="fas fa-truck"></i>
								    		</div>
								    		<div class="text">
								    			<p class="tag">Order</p>
								    			<p>You have a new Order #12234</p>
								    			<p class="time">20 min ago</p>
								    		</div>
								    	</div>
								    </li>
								    <li>
								    	<div class="dropdown-list-item">
								    		<div class="icon blue">
								    			<i class="far fa-sticky-note"></i>
								    		</div>
								    		<div class="text">
								    			<p class="tag">Order</p>
								    			<p>An Order within the next 48 hours has not been assigned</p>
								    			<p class="time">20 min ago</p>
								    		</div>
								    	</div>
								    </li>
								  </ul>
								</div>
							</li>
							<li>
								<div class="dropdown user-action-dropdown">
								  <a class="user-btn" type="button" id="userAction" data-bs-toggle="dropdown" aria-expanded="false">
								    K
								  </a>
								  <ul class="dropdown-menu" aria-labelledby="userAction">
								    <li><a class="dropdown-item" href="#!">Go To Settings</a></li>
								    <li><a class="dropdown-item" href="#!">Logout</a></li>
								  </ul>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<section class="stage-content-sec technician-sec-2">
			<div class="container">
				<div class="technician-list-wrap">
					<div class="technnician-list-title">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="all-status-tab" data-bs-toggle="tab" data-bs-target="#all-status" type="button" role="tab" aria-controls="all-status" aria-selected="true">All Status</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="on-delivery-tab" data-bs-toggle="tab" data-bs-target="#on-delivery" type="button" role="tab" aria-controls="on-delivery" aria-selected="false">On Delivey</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="in-active-tab" data-bs-toggle="tab" data-bs-target="#in-active" type="button" role="tab" aria-controls="in-active" aria-selected="false">Inactive</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="available-tab" data-bs-toggle="tab" data-bs-target="#available" type="button" role="tab" aria-controls="available" aria-selected="false">Available</button>
							</li>
						</ul>
						<button class="gen-btn" data-bs-toggle="modal" data-bs-target="#addTechnicianModal">New Technician</button>
					</div>
					<div class="technician-tables-wrap">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="all-status" role="tabpanel" aria-labelledby="all-status-tab">
								<div class="table-box">
									<div class="table-responsive">
										<table class="table gen-table">
											<thead>
												<tr>
													<th scope="col">NAME</th>
													<th scope="col">MOBILE NUMBER</th>
													<th scope="col">EMAIL</th>
													<th scope="col">STATUS</th>
												</tr>
											</thead>
											<tbody>
												<tr data-bs-toggle="modal" data-bs-target="#editTechnicianModal">
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill yellow">On Delivery</span></td>
												</tr>
												<tr data-bs-toggle="modal" data-bs-target="#editTechnicianModal">
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill blue">Available</span></td>
												</tr>
												<tr data-bs-toggle="modal" data-bs-target="#editTechnicianModal">
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill pink">In Active</span></td>
												</tr>
												<tr data-bs-toggle="modal" data-bs-target="#editTechnicianModal">
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill yellow">On Delivery</span></td>
												</tr>
												<tr data-bs-toggle="modal" data-bs-target="#editTechnicianModal">
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill yellow">On Delivery</span></td>
												</tr>
												<tr data-bs-toggle="modal" data-bs-target="#editTechnicianModal">
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill yellow">On Delivery</span></td>
												</tr>
												<tr data-bs-toggle="modal" data-bs-target="#editTechnicianModal">
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill yellow">On Delivery</span></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="on-delivery" role="tabpanel" aria-labelledby="on-delivery-tab">
								<div class="table-box">
									<div class="table-responsive">
										<table class="table gen-table">
											<thead>
												<tr>
													<th scope="col">NAME</th>
													<th scope="col">MOBILE NUMBER</th>
													<th scope="col">EMAIL</th>
													<th scope="col">STATUS</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill yellow">On Delivery</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill yellow">On Delivery</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill yellow">On Delivery</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill yellow">On Delivery</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill yellow">On Delivery</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill yellow">On Delivery</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill yellow">On Delivery</span></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="in-active" role="tabpanel" aria-labelledby="in-active-tab">
								<div class="table-box">
									<div class="table-responsive">
										<table class="table gen-table">
											<thead>
												<tr>
													<th scope="col">NAME</th>
													<th scope="col">MOBILE NUMBER</th>
													<th scope="col">EMAIL</th>
													<th scope="col">STATUS</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill pink">In Active</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill pink">In Active</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill pink">In Active</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill pink">In Active</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill pink">In Active</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill pink">In Active</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill pink">In Active</span></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="available" role="tabpanel" aria-labelledby="available-tab">
								<div class="table-box gen-table">
									<div class="table-responsive">
										<table class="table gen-table">
											<thead>
												<tr>
													<th scope="col">NAME</th>
													<th scope="col">MOBILE NUMBER</th>
													<th scope="col">EMAIL</th>
													<th scope="col">STATUS</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill blue">Available</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill blue">Available</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill blue">Available</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill blue">Available</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill blue">Available</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill blue">Available</span></td>
												</tr>
												<tr>
													<td>Juan Bishop</td>
													<td>92861-19278</td>
													<td>juanbishop@gmail.com</td>
													<td><span class="pill blue">Available</span></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<!-- ADD TECHNICIAN MODAL -->
<div class="modal fade gen-modal technician-modal" id="addTechnicianModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">New Technician</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="form-group">
								<label for="">First Name</label>
								<input type="text" class="gen-input" placeholder="eg. Jane">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="form-group">
								<label for="">Last Name</label>
								<input type="text" class="gen-input" placeholder="eg. Doe">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Mobile Number</label>
								<input type="text" class="gen-input" placeholder="123 382 712">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Store Unique ID</label>
								<input type="text" class="gen-input" placeholder="Select a username for your technicians">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Password Pin</label>
								<input type="password" class="gen-input" placeholder="Four digit or six digit pin for technicians to login">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Appointment Color</label>
								<div class="technician-color-wrap">
									<div class="technician-color">
										<input type="radio" name="technician-color-radio">
										<span style="background: #ccf8fe;"></span>
									</div>
									<div class="technician-color">
										<input type="radio" name="technician-color-radio">
										<span style="background: #e2fbd7;"></span>
									</div>
									<div class="technician-color">
										<input type="radio" name="technician-color-radio">
										<span style="background: #fff5cc;;"></span>
									</div>
									<div class="technician-color">
										<input type="radio" name="technician-color-radio">
										<span style="background: #dad7fe;"></span>
									</div>
									<div class="technician-color">
										<input type="radio" name="technician-color-radio">
										<span style="background: #cea0ae;"></span>
									</div>
									<div class="technician-color">
										<input type="radio" name="technician-color-radio">
										<span style="background: #d68fd6;"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group mb-0">
								<div class="form-check form-switch mb-0">
									<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
									<label class="form-check-label mb-0" for="flexSwitchCheckDefault">
										<span>Enable Service Assignments</span>
										<span>Lorem ipsum</span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="gen-btn">Apply</button>
			</div>
		</div>
	</div>
</div>

<!-- EDIT TECHNICIAN MODAL -->
<div class="modal fade gen-modal technician-modal" id="editTechnicianModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Technician</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="form-group">
								<label for="">First Name</label>
								<input type="text" class="gen-input" placeholder="eg. Jane">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="form-group">
								<label for="">Last Name</label>
								<input type="text" class="gen-input" placeholder="eg. Doe">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Mobile Number</label>
								<input type="text" class="gen-input" placeholder="123 382 712">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Store Unique ID</label>
								<input type="text" class="gen-input" placeholder="Select a username for your technicians">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Password Pin</label>
								<input type="password" class="gen-input" placeholder="Four digit or six digit pin for technicians to login">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Appointment Color</label>
								<div class="technician-color-wrap">
									<div class="technician-color">
										<input type="radio" name="technician-color-radio">
										<span style="background: #ccf8fe;"></span>
									</div>
									<div class="technician-color">
										<input type="radio" name="technician-color-radio">
										<span style="background: #e2fbd7;"></span>
									</div>
									<div class="technician-color">
										<input type="radio" name="technician-color-radio">
										<span style="background: #fff5cc;;"></span>
									</div>
									<div class="technician-color">
										<input type="radio" name="technician-color-radio">
										<span style="background: #dad7fe;"></span>
									</div>
									<div class="technician-color">
										<input type="radio" name="technician-color-radio">
										<span style="background: #cea0ae;"></span>
									</div>
									<div class="technician-color">
										<input type="radio" name="technician-color-radio">
										<span style="background: #d68fd6;"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group mb-0">
								<div class="form-check form-switch mb-0">
									<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
									<label class="form-check-label mb-0" for="flexSwitchCheckDefault">
										<span>Enable Service Assignments</span>
										<span>Lorem ipsum</span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
				<div>
					<button type="button" class="del-technician" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#deleteTechnicianModal">Delete Technician</button>
					<button type="button" class="gen-btn">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- DELETE TECHNICIAN MODAL -->
<div class="modal fade gen-modal technician-modal" id="deleteTechnicianModal" tabindex="-1" aria-hidden="true">
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
					<button type="button" class="delete-btn">Delete</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'includes/footer.php';?>
