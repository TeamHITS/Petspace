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
						<p class="pg-title"><a href="service-menu.php"><i class="fas fa-arrow-left"></i> Back</a></p>
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
		<section class="stage-content-sec service-men-sec-2">
			<div class="container">
				<div class="service-menu-card-wrap">
					<div class="service-menu-card service-menu-card-1">
						<div class="text">
							<p class="title">Publish Changes</p>
							<p>These can be instructions to publish changes</p>
						</div>
						<div class="button-box">
							<a href="#!" class="gen-btn"><i class="fas fa-upload"></i>Publish changes</a>
						</div>
					</div>

					<div class="service-menu-card service-menu-card-3 sub-menu-card-1">
						<div class="top">
							<div class="text">
								<p class="name">Bath & Brush (Package I)</p>
								<p>Shampoo wash + Blow dry, Brush, Trim Nails,Clean Ears,Spray Colonge, Anal Gland .Lorem ipsum dolor sit amet.</p>
								<p class="price">AED 160.00 • Duration: 30mins</p>
							</div>
							<div class="img">
								
							</div>
						</div>
					</div>

					<div class="service-menu-card sub-menu-card-3">
						<div class="text">
							<p class="title">Please select your pet size</p>
							<p>This is a subheading or can be instructions for users</p>
						</div>
						<div class="bottom">
							<p>•Optional Items •Minimum 01 Item •Maximum 05 Items</p>
						</div>
					</div>

					<div class="service-menu-card service-menu-card-3 sub-menu-card-2">
						<div class="top">
							<div class="text">
								<p class="name">Small Pet</p>
								<p>Shampoo wash + Blow dry, Brush, Trim Nails,Clean Ears,Spray Colonge, Anal Gland .Lorem ipsum dolor sit amet.</p>
								<p class="price">AED 160.00 • Duration: 30mins</p>
							</div>
						</div>
						<div class="bottom">
							<div class="form-check form-switch">
							  <input class="form-check-input" type="checkbox" checked>
							  <label class="form-check-label">In Stock</label>
							</div>
						</div>
					</div>

					<div class="service-menu-card service-menu-card-3 sub-menu-card-2">
						<div class="top">
							<div class="text">
								<p class="name">Small Pet</p>
								<p>Shampoo wash + Blow dry, Brush, Trim Nails,Clean Ears,Spray Colonge, Anal Gland .Lorem ipsum dolor sit amet.</p>
								<p class="price">AED 160.00 • Duration: 30mins</p>
							</div>
						</div>
						<div class="bottom">
							<div class="form-check form-switch">
							  <input class="form-check-input" type="checkbox" checked>
							  <label class="form-check-label">In Stock</label>
							</div>
						</div>
					</div>

					<div class="service-menu-card service-menu-card-3 sub-menu-card-2">
						<div class="top">
							<div class="text">
								<p class="name">Small Pet</p>
								<p>Shampoo wash + Blow dry, Brush, Trim Nails,Clean Ears,Spray Colonge, Anal Gland .Lorem ipsum dolor sit amet.</p>
								<p class="price">AED 160.00 • Duration: 30mins</p>
							</div>
						</div>
						<div class="bottom">
							<div class="form-check form-switch">
							  <input class="form-check-input" type="checkbox" checked>
							  <label class="form-check-label">In Stock</label>
							</div>
						</div>
					</div>

					<div class="service-menu-card sub-menu-card-3">
						<div class="text">
							<p class="title">Addons</p>
							<p>This is a subheading or can be instructions for users</p>
						</div>
						<div class="bottom">
							<p>•Optional Items •Minimum 01 Item •Maximum 05 Items</p>
						</div>
					</div>

					<div class="service-menu-card service-menu-card-3 sub-menu-card-2">
						<div class="top">
							<div class="text">
								<p class="name">Small Pet</p>
								<p>Shampoo wash + Blow dry, Brush, Trim Nails,Clean Ears,Spray Colonge, Anal Gland .Lorem ipsum dolor sit amet.</p>
								<p class="price">AED 160.00 • Duration: 30mins</p>
							</div>
						</div>
						<div class="bottom">
							<div class="form-check form-switch">
							  <input class="form-check-input" type="checkbox" checked>
							  <label class="form-check-label">In Stock</label>
							</div>
						</div>
					</div>

					<div class="service-menu-card service-menu-card-3 sub-menu-card-2">
						<div class="top">
							<div class="text">
								<p class="name">Small Pet</p>
								<p>Shampoo wash + Blow dry, Brush, Trim Nails,Clean Ears,Spray Colonge, Anal Gland .Lorem ipsum dolor sit amet.</p>
								<p class="price">AED 160.00 • Duration: 30mins</p>
							</div>
						</div>
						<div class="bottom">
							<div class="form-check form-switch">
							  <input class="form-check-input" type="checkbox" checked>
							  <label class="form-check-label">In Stock</label>
							</div>
						</div>
					</div>

					<div class="service-menu-card service-menu-card-3 sub-menu-card-2">
						<div class="top">
							<div class="text">
								<p class="name">Small Pet</p>
								<p>Shampoo wash + Blow dry, Brush, Trim Nails,Clean Ears,Spray Colonge, Anal Gland .Lorem ipsum dolor sit amet.</p>
								<p class="price">AED 160.00 • Duration: 30mins</p>
							</div>
						</div>
						<div class="bottom">
							<div class="form-check form-switch">
							  <input class="form-check-input" type="checkbox" checked>
							  <label class="form-check-label">In Stock</label>
							</div>
						</div>
					</div>

					<div class="service-menu-card service-menu-card-3 sub-menu-card-2">
						<div class="top">
							<div class="text">
								<p class="name">Small Pet</p>
								<p>Shampoo wash + Blow dry, Brush, Trim Nails,Clean Ears,Spray Colonge, Anal Gland .Lorem ipsum dolor sit amet.</p>
								<p class="price">AED 160.00 • Duration: 30mins</p>
							</div>
						</div>
						<div class="bottom">
							<div class="form-check form-switch">
							  <input class="form-check-input" type="checkbox" checked>
							  <label class="form-check-label">In Stock</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<?php include 'includes/footer.php';?>
