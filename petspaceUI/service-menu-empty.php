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
						<p class="pg-title">Service Menu</p>
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
		<section class="stage-content-sec empty-stage">
			<div class="container">
				<div class="gen-text-box mw-490 m-0-auto text-center">
					<p class="heading">Lorem ipsum</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
					<button class="gen-btn gen-btn-outline">Add Technician</button>
				</div>
			</div>
		</section>
	</div>
</div>

<?php include 'includes/footer.php';?>
