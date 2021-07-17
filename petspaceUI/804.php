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

					<div class="service-menu-card service-menu-card-2">
						<div class="img">
							
						</div>
						<div class="text">
							<p class="title">Squeaky Clean <a href="#!"><i class="fas fa-pencil-alt"></i></a></p>
							<p>Grooming for Dogs & Cats</p>
							<ul class="info-list">
								<li>4.8 <i class="fas fa-star"></i> (200) <img src="assets/images/google-icon.png" alt="icon" class="img-fluid"></li>
								<li>AED 20 min.</li>
								<li>No delivery fee</li>
							</ul>
							<p class="sub-text">Pickup & Drop off available</p>
						</div>
					</div>

					<div class="service-menu-card service-menu-card-1 full-text">
						<div class="text">
							<p class="title">Basic Packages <a href="#!"><i class="fas fa-pencil-alt"></i></a></p>
							<p>This is a subheading or can be instructions for users</p>
						</div>
					</div>

					<div class="service-menu-card add-new-service">
						<a href="#!" class="add-btn" data-bs-toggle="modal" data-bs-target="#addNewService"><i class="fas fa-plus mr-1"></i>New Service</a>
					</div>

					<div class="service-menu-card add-service-category">
						<a href="#!" class="add-btn" data-bs-toggle="modal" data-bs-target="#addNewCategory"><i class="fas fa-plus mr-1"></i>ADD A NEW CATEGORY</a>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>


<div class="modal fade gen-modal technician-modal" id="addNewCategory" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">New Category</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="">List Name</label>
								<input type="text" class="gen-input" placeholder="Basic Packages">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Description</label>
								<input type="text" class="gen-input" placeholder="Lorem ipsum">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="gen-btn">Save</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade gen-modal technician-modal" id="addNewService" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">New Service</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<div class="new-service-modal-top">
									<div class="img"></div>
									<div class="desc">
										<select>
											<option>Actions</option>
										</select>
										<p>Allowed file types: png, jpg, jpeg</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Service Name</label>
								<input type="text" class="gen-input" placeholder="Service Name">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Description</label>
								<textarea class="gen-input" placeholder="Small description about the service"></textarea>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="">Total Standard Price</label>
								<input type="text" class="gen-input" placeholder="Service Price">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="">Total Discount Price (Optional)</label>
								<input type="text" class="gen-input" placeholder="Service Discount Price">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="">Service Duration</label>
								<input type="text" class="gen-input" placeholder="Service Duration in minutes">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
				<div>
					<button type="button" class="del-technician">Delete Service</button>
					<button type="button" class="gen-btn">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'includes/footer.php';?>
