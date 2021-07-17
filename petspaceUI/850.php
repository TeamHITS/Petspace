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
						<p class="pg-title">Store Setting</p>
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
		<section class="stage-content-sec dashboard-content-stage">
			<div class="container">
				<div class="delivery-map-card">
					<div class="card-top">
						<div class="card-text">
							<p class="card-title">Delivery areas & fees</p>
							<p class="card-sub-title">Select  areas you want to serve.</p>
						</div>
						<div class="card-btn">
							<button class="gen-btn">Save</button>
							<button class="gen-btn cancel-btn">Cancel</button>
						</div>
					</div>
					<div class="map-wrap">
						<div class="map-input">
							<div class="map-input-inner">
							    <img src="assets/images/icon-search.png" alt="icon" class="img-fluid">
							    <input type="text" placeholder="Search for locations">
							</div>
						</div>
						<div class="map-form">
							<form action="">
								<div class="form-head">
									<p class="form-title">New Technician</p>
								</div>
								<div class="form-body">
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<label for="">Technician</label>
												<select name="" id="" class="gen-input">
													<option selected disabled="">Select A Technician</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="">Minimum order</label>
												<input type="text" class="gen-input" placeholder="AED 00">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="">Delivery fee</label>
												<input type="text" class="gen-input" placeholder="AED 00">
											</div>
										</div>
										<div class="col-12">
											<buton class="submit">Create area</buton>
										</div>
									</div>
								</div>
							</form>
						</div>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3613.218933311935!2d55.175033514482315!3d25.094449242020616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f6b7968da356d%3A0xb3819e83095b067d!2sAuris%20Inn%20Al%20Muhanna%20Hotel!5e0!3m2!1sen!2s!4v1622040980960!5m2!1sen!2s" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<?php include 'includes/footer.php';?>


