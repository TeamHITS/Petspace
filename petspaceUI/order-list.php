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
						<p class="pg-title">Order</p>
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
				<div class="order-table-wrap">
					<div class="order-table-top">
						<div class="search">
							<i class="fas fa-search"></i>
							<input placeholder="Search by order no." class="order-search">
						</div>
						<div class="calender">
							<div class="date-range-box" id="reportrange">
								<i class="fa fa-calendar"></i>
								<span>Today</span>
							</div>
						</div>
						<div class="filter">
							<button type="button" id="filter-side-toggle"><i class="fas fa-filter"></i>Filters</button>
						</div>
						<div class="filter-list">
							<ul>
								<li><p>Selected Filters</p></li>
								<li class="filter-pill">
									<p>Schedule</p>
									<button class="btn-close"></button>
								</li>
								<li class="filter-pill">
									<p>Schedule</p>
									<button class="btn-close"></button>
								</li>
							</ul>
						</div>
					</div>
					<table class="table gen-table gen-datatable shadow-card" id="order-table">
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
		</section>
	</div>
</div>

<!-- FILTER SIDEBAR -->
<div id="filter-sidebar">
	<div class="filter-sidebar-inner">
		<a id="close-filter-sidebar"><i class="fas fa-times"></i></a>
		<p class="sidebar-title">Filter</p>
		<form action="" class="filter-form">
			<div class="form-group">
				<label>Status</label>
				<select class="gen-input">
					<option value="">Schedule</option>
					<option value="">Active</option>
				</select>
			</div>
			<div class="form-group">
				<label>Technician</label>
				<select class="gen-input">
					<option value="">Juan</option>
					<option value="">Austin</option>
				</select>
			</div>
			<div class="button-wrap">
				<button class="gen-btn cancel-btn">Cancel</button>
				<button class="gen-btn">Apply</button>
			</div>
		</form>
	</div>
</div>
<div class="filter-sidebar-overlay"></div>
<?php include 'includes/footer.php';?>
