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
						<p class="pg-title"><i class="fas fa-arrow-left mr-2" style="margin-right: 10px;"></i>Order</p>
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
		<section class="stage-content-sec order-sec-2">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-12">
						<div class="shadow-card mb-3">
							<div class="order-number-info">
								<p class="number">Order #1234</p>
								<p class="status"><span class="tag completed"></span>Completed</p>
							</div>
						</div>
						<div class="shadow-card mb-3">
							<div class="order-instrustion">
								<p class="title">Special Instructions </p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
							</div>
						</div>
						<div class="shadow-card mb-3">
							<div class="ordered-services">
								<p class="heading">Ordered Services</p>
								<div class="ordered-service">
									<div class="img"></div>
									<div class="desc">
										<p class="name">Bath & Bodywash (Package 1)  x1</p>
										<p>For medium sized pet</p>
										<p>Service Duration: 50m</p>
									</div>
									<div class="price">
										<p>AED 200</p>
									</div>
									<div class="profile">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order-profile-1" aria-expanded="false" aria-controls="order-profile-1">
											Pet Profile <i class="fas fa-chevron-down"></i>
										</button>
										<div id="order-profile-1" class="accordion-collapse collapse">
											<div class="accordion-body">
												<div class="profile-info">
													<div class="name">
														<p class="title">NAME</p>
														<p class="info">Archie</p>
													</div>
													<div class="age">
														<p class="title">AGE</p>
														<p class="info">4months</p>
													</div>
													<div class="breed">
														<p class="title">BREED</p>
														<p class="info">German Shepard</p>
													</div>
													<div class="weight">
														<p class="title">WEIGHT</p>
														<p class="info">4 kgs</p>
													</div>
													<div class="allergies">
														<p class="title">ALLERGIES</p>
														<p class="info">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="ordered-service">
									<div class="img"></div>
									<div class="desc">
										<p class="name">Bath & Bodywash (Package 1)  x1</p>
										<p>For medium sized pet</p>
										<p>Service Duration: 50m</p>
									</div>
									<div class="price">
										<p>AED 200</p>
									</div>
									<div class="profile">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order-profile-2" aria-expanded="false" aria-controls="order-profile-2">
											Pet Profile <i class="fas fa-chevron-down"></i>
										</button>
										<div id="order-profile-2" class="accordion-collapse collapse">
											<div class="accordion-body">
												<div class="profile-info">
													<div class="name">
														<p class="title">NAME</p>
														<p class="info">Archie</p>
													</div>
													<div class="age">
														<p class="title">AGE</p>
														<p class="info">4months</p>
													</div>
													<div class="breed">
														<p class="title">BREED</p>
														<p class="info">German Shepard</p>
													</div>
													<div class="weight">
														<p class="title">WEIGHT</p>
														<p class="info">4 kgs</p>
													</div>
													<div class="allergies">
														<p class="title">ALLERGIES</p>
														<p class="info">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="time-box">
									<p><i class="far fa-clock"></i>Total Service Duration: 1h20mins</p>
								</div>
								<div class="amount-box">
									<ul class="amount-list">
										<li><span>Sub Total</span><span>AED 400</span></li>
										<li><span>Tax</span><span>AED 30</span></li>
										<li><span>Delivery</span><span>AED 30</span></li>
										<li><span>Total</span><span>AED 460</span></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="shadow-card mb-3">
							<div class="order-detail">
								<div class="order-info mb-3">
									<p class="title">Address</p>
									<p>1431 Ciso Parkway, Lorem ipsum, Dubai.</p>
								</div>
								<div class="order-info mb-3">
									<p class="title">Date</p>
									<p>22/11/2021</p>
								</div>
								<div class="order-info mb-1">
									<p class="title">TIME</p>
									<p>16:40</p>
								</div>
							</div>
						</div>
						<div class="shadow-card mb-3">
							<div class="assign-technician-card">
								<div class="d-flex justify-content-between align-items-center">
									<p class="title">Technician Assigned</p>
									<a href="#!" class="assign-tech" data-bs-toggle="modal" data-bs-target="#assignTechnicianModal"><i class="fas fa-pencil-alt"></i></a>
								</div>
								<div class="selected-technician">
									<div class="technician-item">
										<div class="img">
											<i class="fas fa-user"></i>
										</div>
										<p>Jamie Vardy</p>
									</div>
								</div>
							</div>
						</div>
						<div class="shadow-card mb-3">
							<div class="service-progress">
								<p class="title">SERVICE History</p>
								<div class="service-progress-info">
									<div class="img">
										<i class="fas fa-check"></i>
									</div>
									<div class="desc">
										<p class="title">Driver on the way</p>
										<p>16:10</p>
									</div>
								</div>
								<div class="service-progress-info">
									<div class="img">
										<i class="fas fa-check"></i>
									</div>
									<div class="desc">
										<p class="title">At the location</p>
										<p>16:10</p>
									</div>
								</div>
								<div class="service-progress-info">
									<div class="img">
										<i class="fas fa-check"></i>
									</div>
									<div class="desc">
										<p class="title">Service in progress</p>
										<p>16:10</p>
									</div>
								</div>
								<div class="service-progress-info">
									<div class="img">
										<i class="fas fa-check"></i>
									</div>
									<div class="desc">
										<p class="title">Service is completed</p>
										<p>16:10</p>
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

<!-- ASSIGN TECHNICIAN MODAL -->
<div class="modal fade gen-modal" id="assignTechnicianModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Select a Technician</h5>
				<h4 class="modal-sub-title">Are you sure you wanna delete this technician ?</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Technician Name</label>
					<select class="gen-input">
						<option value="" selected disabled>Select A Technician</option>
						<option value="">Jon</option>
						<option value="">Sam</option>
					</select>
				</div>
				<div class="form-group technician-schedule-wrap">
					<div class="btn-group dropend">
						<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
							View Technicians Schedule
						</button>
						<ul class="dropdown-menu">
							<li class="active">Schedule on 22/11/2021</li>
							<li> 12:30 - 14:30 Assigned</li>
							<li> 15:30 - 16:30 Assigned</li>
							<li> 17:00 - 18:30 Assigned</li>
							<li> 19:30 - 20:30 Assigned</li>
							<li class="active"> 22:30 - 23:30 Not Assigned</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="gen-btn">Save</button>
			</div>   
		</div>
	</div>
</div>


<?php include 'includes/footer.php';?>
