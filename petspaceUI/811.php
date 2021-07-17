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
				<div class="row align-items-center">
					<div class="col-lg-4 col-md-4 col-3">
						<a class="pg-title"><i class="fas fa-arrow-left mr-1"></i>Back</a>
					</div>
					<div class="col-lg-8 col-md-8 col-9 d-flex justify-content-end">
						<button class="gen-btn delete-btn">Delete Submenu</button>
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

					<div class="service-menu-card service-menu-card-3 service-menu-card-4">
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
							<p class="title">Please select your pet size<a class="mr-1" href="#!"><i class="fas fa-pencil-alt"></i></a></p>
							<p>This is a subheading or can be instructions for users</p>
						</div>
						<div class="bottom">
							<p><span class="mr-1">• Optional Items</span>  <span class="mr-1">• Minimum 01 Item</span>  <span class="mr-1">• Maximum 05 Items</span></p>
						</div>
					</div>

					<div class="service-menu-card add-new-service">
						<a href="#!" class="add-btn" data-bs-toggle="modal" data-bs-target="#addSubMenuNewService"><i class="fas fa-plus mr-1"></i>New Service</a>
					</div>

					<div class="service-menu-card add-service-category">
						<a href="#!" class="add-btn" data-bs-toggle="modal" data-bs-target="#addNewList"><i class="fas fa-plus mr-1"></i>NEW SUBMENU LIST</a>
					</div>

				</div>
			</div>
		</section>
	</div>
</div>

<div class="modal fade gen-modal technician-modal" id="addNewList" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">New Submenu List</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="">Submenu Name</label>
								<input type="text" class="gen-input" placeholder="Submenu list name">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Submenu Description</label>
								<input type="text" class="gen-input" placeholder="Submenu Description">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<div class="form-check form-switch d-flex align-items-center">
									<input class="form-check-input" type="checkbox" checked="">
									<label class="form-check-label mb-0">Optional Items <br><span class="gen-light-text">This list has optional items can be skipped</span></label>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="form-group">
								<label for="">Condition Options</label>
								<select class="gen-input">
									<option selected disabled>Select a condition</option>
									<option value="">Minimum</option>
									<option value="">Equal</option>
									<option value="">Maximum</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="form-group">
								<label for="">No. of Items can be selected</label>
								<input type="number" class="gen-input" placeholder="00-99">
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

<div class="modal fade gen-modal technician-modal" id="addSubMenuNewService" tabindex="-1" aria-hidden="true">
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
								<label for="">Service Name</label>
								<input type="text" class="gen-input" placeholder="Service Name">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Description</label>
								<input type="text" class="gen-input" placeholder="Service Description">
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
