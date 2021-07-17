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
						<p class="pg-title">Store settings</p>
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
		<section class="store-setting-sec-2">
			<div class="container">
				<div class="store-setting-2-wrap">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="store-profile-tab" data-bs-toggle="tab" data-bs-target="#store-profile" type="button" role="tab" aria-controls="store-profile" aria-selected="true">Store Profile</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact Person Information</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">Change Password</button>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade show active" id="store-profile" role="tabpanel" aria-labelledby="store-profile-tab">
							<div class="store-card">
								<div class="card-top">
									<div class="card-text">
										<p class="card-title">Store Profile</p>
										<p class="card-sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</div>
									<div class="card-btn">
										<button disabled="true">Save</button>
										<button disabled="true">Cancel</button>
									</div>
								</div>
								<div class="card-body">
									<form>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12 y-center">
												<label class="img-label">Store Image</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="upload-img-box-wrap">
													<div class="upload-img-box">
														<input type="file" onchange="readURL(this);">
														<img id="uploaded_img" src="http://placehold.it/130" alt="image" />
														<a href="#!" class="edit-btn"><i class="fas fa-pencil-alt"></i></a>
														<a href="#!" class="delete-btn"><i class="fas fa-times"></i></a>
													</div>
												</div>
											</div>
										</div>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>Store Name</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input">
												</div>
											</div>
										</div>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>Email</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input">
												</div>
											</div>
										</div>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>Contact Number</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input">
												</div>
											</div>
										</div>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>Address Line 1</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input">
												</div>
											</div>
										</div>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>Address Line 2 (optional)</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input">
												</div>
											</div>
										</div>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>Area</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input">
												</div>
											</div>
										</div>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>City</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input">
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
							<div class="store-card">
								<div class="card-top">
									<div class="card-text">
										<p class="card-title">Contact Person Information</p>
										<p class="card-sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</div>
									<div class="card-btn">
										<button disabled="true">Save</button>
										<button disabled="true">Cancel</button>
									</div>
								</div>
								<div class="card-body">
									<form>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>First Name</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input">
												</div>
											</div>
										</div>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>Last Name</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input">
												</div>
											</div>
										</div>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>Contact Number</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input">
												</div>
											</div>
										</div>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>Email</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input">
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
							<div class="store-card">
								<div class="card-top">
									<div class="card-text">
										<p class="card-title">Change Password</p>
										<p class="card-sub-title">Change your password</p>
									</div>
									<div class="card-btn">
										<button disabled="false">Save</button>
										<button disabled="fasle">Cancel</button>
									</div>
								</div>
								<div class="card-body">
									<form>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>Current Password</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input" placeholder="Current Password">
												</div>
											</div>
										</div>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>New Password</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input" placeholder="New Password">
												</div>
											</div>
										</div>
										<div class="row m-0">
											<div class="col-lg-3 col-md-4 col-sm-12">
												<label>Verify Password</label>
											</div>
											<div class="col-lg-9 col-md-8 col-sm-12">
												<div class="form-group">
													<input type="text" class="gen-input" placeholder="Verify Password">
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<?php include 'includes/footer.php';?>
