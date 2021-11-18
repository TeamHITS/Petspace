@extends('website.layouts.app')
<div class="dashboard-main-wrap">
	<!--<div class="side-bar">
		<div class="sidebar-top">
			<div class="logo-box">
				<a href="#!">
					<img src="public/assets/images/logo.png" alt="logo" class="img-fluid">
				</a>
			</div>
			<ul class="sidebar-list">
				<li><a href="dashboard.php"><img src="public/assets/images/dashboard-icon-1.png" class="img-fluid"><span>Dashboard</span></a></li>
				<li><a href="#!"><img src="public/assets/images/dashboard-icon-2.png" class="img-fluid"><span>Calendar</span></a></li>
				<li class="active"><a href="#!"><img src="public/assets/images/dashboard-icon-3.png" class="img-fluid"><span>Orders</span></a></li>
				<li><a href="#!"><img src="public/assets/images/dashboard-icon-4.png" class="img-fluid"><span>Service Menu</span></a></li>
				<li><a href="technicians.php"><img src="public/assets/images/dashboard-icon-5.png" class="img-fluid"><span>Technicians</span></a></li>
			</ul>
		</div>
		<div class="sidebar-bottom">
			<ul class="sidebar-bottom-list">
				<li><a href="store-setting.php"><img src="public/assets/images/dashboard-icon-6.png" class="img-fluid"><span>Store Settings</span></a></li>
				<li><a href="#!"><img src="public/assets/images/dashboard-icon-7.png" class="img-fluid"><span>Contact Petspace</span></a></li>
			</ul>
		</div>
	</div>-->
	@include('website.layouts.side-bar')
	<div class="main-stage">
		<!--<section class="auth-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-3">
						<p class="pg-title">Calendar</p>
					</div>
					<div class="col-lg-8 col-md-8 col-9">
						<ul class="auth-top-btn">
							<li>
								<div class="dropdown">
									<a class="dropdown-toggle" href="#" role="button" id="notification-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
										<img src="public/assets/images/bell-icon.png" alt="icon" class="img-fluid">
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
		</section>-->
		@include('website.layouts.main-header')
		<section class="stage-content-sec order-sec-2">
			<div class="container">
				<div class="calendar-wrap">
					<div id="menu" class="calender-menu-wrap">
						<div class="calender-menu-group-1">
							<div class="dropdown staff-drowndown-wrap">
								<button class="gen-btn dropdown-toggle" type="button" id="staff-drowndown" data-bs-toggle="dropdown" aria-expanded="false">
									All Staff
									<i class="fas fa-chevron-down"></i>
								</button>
								<ul class="dropdown-menu" aria-labelledby="staff-drowndown">
									<li><a class="dropdown-item" href="#">Technician 1</a></li>
									<li><a class="dropdown-item" href="#">Technician 2</a></li>
								</ul>
							</div>
						</div>
						<div class="calender-menu-group-2">
							<span id="menu-navi">
								<button type="button" id="calender-prev" class="btn btn-default btn-sm move-day">
									<i class="fas fa-arrow-left" data-action="move-prev"></i>
								</button>
								<p class="current-week">Thursday,9th Jan 2021</p>
								<button type="button" id="calender-next" class="btn btn-default btn-sm move-day">
									<i class="fas fa-arrow-right" data-action="move-next"></i>
								</button>
							</span>
							<span id="renderRange" class="render-range"></span>
						</div>
						<div class="calender-menu-group-3">
							<span class="dropdown view-list-dropdown">
								<button id="dropdownMenu-calendarType" class="btn btn-default btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
									<i id="calendarTypeIcon" class="calendar-icon ic_view_month" style="margin-right: 4px;"></i>
									<span id="calendarTypeName">Resource</span>&nbsp;
									<i class="fas fa-chevron-down"></i>
								</button>
								<ul class="view-list-dropdown-menu dropdown-menu" role="menu" aria-labelledby="dropdownMenu-calendarType">
									<!-- <li>
										<a class="dropdown-menu-title" role="menuitem" href="resource-calendar.php" id="daily-view">
											<i class="fas fa-bars"></i>Resource
										</a>
									</li> -->
									<li>
										<a class="dropdown-menu-title" role="menuitem" href="./" id="week-view">
											<i class="fas fa-th"></i>Weekly
										</a>
									</li>
								</ul>
							</span>
							<div class="dropdown add-event-dropdown">
								<button class="gen-btn dropdown-toggle" type="button" id="add-event-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="fas fa-plus"></i>Add new
								</button>
								<ul class="dropdown-menu" aria-labelledby="add-event-dropdown">
									<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addCalenderEvent">New Slot</a></li>
									<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addCalenderBlockedSlot">Blocked Time</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="custom-calendar-wrap">
						<div class="resource-box">
							<div class="resource-time-col">
								<div class="time-slot">
									<p>11:00</p>
								</div>
								<div class="time-slot">
									<p>12:00</p>
								</div>
								<div class="time-slot">
									<p>13:00</p>
								</div>
								<div class="time-slot">
									<p>14:00</p>
								</div>
								<div class="time-slot">
									<p>15:00</p>
								</div>
								<div class="time-slot">
									<p>16:00</p>
								</div>
							</div>
							<div class="resource-body">
								<div class="resource-col">
									<div class="resource-tag">
										<p class="tag grey">S</p>
										<p class="name">Stephen Hawking</p>
									</div>
									<div class="resource-slots-wrap">
										<div class="resource-slot-box">
											<div class="resource-slot-card grey"  data-bs-toggle="modal" data-bs-target="#view-slot-order-modal">
												<p class="title">Bath & Body Wash Package 222 x1</p>
												<p class="title">Bath & Body Wash Package 2 x1</p>
												<p class="desc">1431 Ciso Parkway, Dubai.</p>
											</div>
										</div>
										<div class="resource-slot-box">
											
										</div>
										<div class="resource-slot-box">
											<div class="resource-slot-card grey"  data-bs-toggle="modal" data-bs-target="#view-slot-order-modal">
												<p class="title">Bath & Body Wash Package 2 x1</p>
												<p class="title">Bath & Body Wash Package 2 x1</p>
												<p class="desc">1431 Ciso Parkway, Dubai.</p>
											</div>
										</div>
										<div class="resource-slot-box">
											
										</div>
										<div class="resource-slot-box">
											
										</div>
										<div class="resource-slot-box">
											
										</div>
									</div>
								</div>
								<div class="resource-col">
									<div class="resource-tag">
										<p class="tag green">J</p>
										<p class="name">Juan Bishop</p>
									</div>
									<div class="resource-slots-wrap">
										<div class="resource-slot-box">
											<div class="resource-slot-card green"  data-bs-toggle="modal" data-bs-target="#view-slot-order-modal">
												<p class="title">Bath & Body Wash Package 2 x1</p>
												<p class="title">Bath & Body Wash Package 2 x1</p>
												<p class="desc">1431 Ciso Parkway, Dubai.</p>
											</div>
										</div>
										<div class="resource-slot-box">
											<div class="resource-slot-card green" data-bs-toggle="modal" data-bs-target="#view-slot-order-modal">
												<p class="title">Bath & Body Wash Package 2676 x1</p>
												<p class="title">Bath & Body Wash Package 2 x1</p>
												<p class="desc">1431 Ciso Parkway, Dubai.</p>
											</div>
										</div>
										<div class="resource-slot-box">
											
										</div>
										<div class="resource-slot-box">
											
										</div>
										<div class="resource-slot-box">
											
										</div>
										<div class="resource-slot-box">
											
										</div>
									</div>
								</div>
								<div class="resource-col">
									<div class="resource-tag">
										<p class="tag blue">J</p>
										<p class="name">Juan Bishop</p>
									</div>
									<div class="resource-slots-wrap">
										<div class="resource-slot-box">
											<div class="resource-slot-card blue" data-bs-toggle="modal" data-bs-target="#view-slot-order-modal">
												<p class="title">Bath & Body Wash Package 2 x1</p>
												<p class="title">Bath & Body Wash Package 2 x1</p>
												<p class="desc">1431 Ciso Parkway, Dubai.</p>
											</div>
										</div>
										<div class="resource-slot-box">
											<div class="resource-slot-card blue" data-bs-toggle="modal" data-bs-target="#view-slot-order-modal">
												<p class="title">Bath & Body Wash Package 2 x1</p>
												<p class="title">Bath & Body Wash Package 2 x1</p>
												<p class="desc">1431 Ciso Parkway, Dubai.</p>
											</div>
										</div>
										<div class="resource-slot-box">
											
										</div>
										<div class="resource-slot-box">
											
										</div>
										<div class="resource-slot-box">
											
										</div>
										<div class="resource-slot-box">
											
										</div>
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

<!-- ADD CALENDER EVENT MODAL -->
<div class="modal fade gen-modal calender-modal" id="addCalenderEvent" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Create Slot</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-12">
							<div class="col-lg-6 col-md-6-col-sm-12">
								<div class="form-group">
								<label>Event Date</label>
								<div class="c-date-picker">
									<div class="tui-datepicker-input tui-datetime-input tui-has-focus gen-input">
										<input type="text" id="add-datepicker-input" aria-label="Date-Time">
										<span class="tui-ico-date"></span>
									</div>
									<div id="add-date-wrapper" style="margin-top: -1px;"></div>
								</div>
							</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6-col-sm-12">
							<div class="form-group">
								<label>Start Time</label>
								<input class="gen-input" type="time" id="event-start-time">
							</div>
						</div>
						<div class="col-lg-6 col-md-6-col-sm-12">
							<div class="form-group">
								<label>End Time</label>
								<input class="gen-input" type="time" id="event-end-time">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label>No. of booking for this slot</label>
								<select class="gen-input">
									<option value="">1</option>
									<option value="">2</option>
									<option value="">3</option>
									<option value="">4</option>
									<option value="">5</option>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label>Repeat</label>
								<select class="gen-input">
									<option>Daily</option>
									<option>Weekly</option>
									<option>Custom</option>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group custom-dates-wrap">
								<div class="day-checkbox">
									<input type="checkbox">
									<span>Sa</span>
								</div>
								<div class="day-checkbox">
									<input type="checkbox">
									<span>Su</span>
								</div>
								<div class="day-checkbox">
									<input type="checkbox">
									<span>Mo</span>
								</div>
								<div class="day-checkbox">
									<input type="checkbox">
									<span>Tu</span>
								</div>
								<div class="day-checkbox">
									<input type="checkbox">
									<span>We</span>
								</div>
								<div class="day-checkbox">
									<input type="checkbox">
									<span>Th</span>
								</div>
								<div class="day-checkbox">
									<input type="checkbox">
									<span>Fr</span>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group mb-0">
								<label>Assign Technicians</label>
								<span class="sub-label">You can assign multiple technicians to a slot</span>
								<div class="row">
									<div class="col-lg-12 col md-12 col-sm-12">
										<div class="form-group calender-select-technicain">
											<select class="gen-input">
												<option>Juan Bishop</option>
												<option>Stephen Hawking</option>
											</select>
											<a href="#!" class="del-technician">
												<i class="fas fa-trash"></i>
											</a>
										</div>
									</div>
									<div class="col-lg-12 col md-12 col-sm-12">
										<div class="form-group calender-select-technicain">
											<select class="gen-input">
												<option>Juan Bishop</option>
												<option>Stephen Hawking</option>
											</select>
											<a href="#!" class="del-technician">
												<i class="fas fa-trash"></i>
											</a>
										</div>
									</div>
									<div class="col-lg-12 col md-12 col-sm-12">
										<div class="form-group calender-select-technicain">
											<select class="gen-input">
												<option>Juan Bishop</option>
												<option>Stephen Hawking</option>
											</select>
											<a href="#!" class="del-technician">
												<i class="fas fa-trash"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="gen-btn" id="addToCalender">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- EDIT CALENDER EVENT MODAL -->
<div class="modal fade gen-modal calender-modal" id="editCalenderEvent" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Slot</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-6">
								<div class="form-group">
									<div class="c-date-picker">
										<div class="tui-datepicker-input tui-datetime-input tui-has-focus gen-input">
											<input type="text" id="edit-datepicker-input" aria-label="Date-Time">
											<span class="tui-ico-date"></span>
										</div>
										<div id="edit-date-wrapper" style="margin-top: -1px;"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6-col-sm-12">
							<div class="form-group">
								<label>Start Time</label>
								<input class="gen-input" type="time">
							</div>
						</div>
						<div class="col-lg-6 col-md-6-col-sm-12">
							<div class="form-group">
								<label>End Time</label>
								<input class="gen-input" type="time">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label>No. of booking for this slot</label>
								<select class="gen-input">
									<option value="">1</option>
									<option value="">2</option>
									<option value="">3</option>
									<option value="">4</option>
									<option value="">5</option>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label>Repeat</label>
								<select class="gen-input">
									<option>Daily</option>
									<option>Weekly</option>
									<option>Custom</option>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group custom-dates-wrap">
								<div class="day-checkbox">
									<input type="checkbox">
									<span>Sa</span>
								</div>
								<div class="day-checkbox">
									<input type="checkbox">
									<span>Su</span>
								</div>
								<div class="day-checkbox">
									<input type="checkbox">
									<span>Mo</span>
								</div>
								<div class="day-checkbox">
									<input type="checkbox">
									<span>Tu</span>
								</div>
								<div class="day-checkbox">
									<input type="checkbox">
									<span>We</span>
								</div>
								<div class="day-checkbox">
									<input type="checkbox">
									<span>Th</span>
								</div>
								<div class="day-checkbox">
									<input type="checkbox">
									<span>Fr</span>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group mb-0">
								<label>Assign Technicians</label>
								<span class="sub-label">You can assign multiple technicians to a slot</span>
								<div class="row">
									<div class="col-lg-12 col md-12 col-sm-12">
										<div class="form-group calender-select-technicain">
											<select class="gen-input">
												<option>Juan Bishop</option>
												<option>Stephen Hawking</option>
											</select>
											<a href="#!" class="del-technician">
												<i class="fas fa-trash"></i>
											</a>
										</div>
									</div>
									<div class="col-lg-12 col md-12 col-sm-12">
										<div class="form-group calender-select-technicain">
											<select class="gen-input">
												<option>Juan Bishop</option>
												<option>Stephen Hawking</option>
											</select>
											<a href="#!" class="del-technician">
												<i class="fas fa-trash"></i>
											</a>
										</div>
									</div>
									<div class="col-lg-12 col md-12 col-sm-12">
										<div class="form-group calender-select-technicain">
											<select class="gen-input">
												<option>Juan Bishop</option>
												<option>Stephen Hawking</option>
											</select>
											<a href="#!" class="del-technician">
												<i class="fas fa-trash"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
				<div>
					<button type="button" class="del-option">Delete</button>
					<button type="button" class="gen-btn">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ADD CALENDER BLOCK SLOT MODAL -->
<div class="modal fade gen-modal calender-modal" id="addCalenderBlockedSlot" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">New Blocked Time</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-6">
								<div class="form-group">
									<div class="c-date-picker">
										<div class="tui-datepicker-input tui-datetime-input tui-has-focus gen-input">
											<input type="text" id="datepicker-input-3" aria-label="Date-Time">
											<span class="tui-ico-date"></span>
										</div>
										<div id="date-wrapper-3" style="margin-top: -1px;"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label>Description</label>
								<input type="text" class="gen-input">
							</div>
						</div>
						<div class="col-lg-6 col-md-6-col-sm-12">
							<div class="form-group">
								<label>Start Time</label>
								<input class="gen-input" type="time">
							</div>
						</div>
						<div class="col-lg-6 col-md-6-col-sm-12">
							<div class="form-group">
								<label>End Time</label>
								<input class="gen-input" type="time">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
									<label class="form-check-label" for="flexCheckDefault">
										Block slot for entire day
									</label>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group m-0">
								<label>Comments</label>
								<textarea class="gen-textarea" placeholder="eg. holiday or booking"></textarea>
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

<!-- EDIT CALENDER BLOCK SLOT MODAL -->
<div class="modal fade gen-modal calender-modal" id="editCalenderBlockedSlot" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Blocked Time</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-6">
								<div class="form-group">
									<div class="c-date-picker">
										<div class="tui-datepicker-input tui-datetime-input tui-has-focus gen-input">
											<input type="text" id="datepicker-input-4" aria-label="Date-Time">
											<span class="tui-ico-date"></span>
										</div>
										<div id="date-wrapper-4" style="margin-top: -1px;"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label>Description</label>
								<input type="text" class="gen-input">
							</div>
						</div>
						<div class="col-lg-6 col-md-6-col-sm-12">
							<div class="form-group">
								<label>Start Time</label>
								<input class="gen-input" type="time">
							</div>
						</div>
						<div class="col-lg-6 col-md-6-col-sm-12">
							<div class="form-group">
								<label>End Time</label>
								<input class="gen-input" type="time">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
									<label class="form-check-label" for="flexCheckDefault">
										Block slot for entire day
									</label>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group m-0">
								<label>Comments</label>
								<textarea class="gen-textarea" placeholder="eg. holiday or booking"></textarea>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
				<div>
					<button type="button" class="del-option">Delete Blocked Slot</button>
					<button type="button" class="gen-btn">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- COMFIRM DELETE CALENDER BLOCK SLOT MODAL -->
<div class="modal fade gen-modal calender-modal" id="deleteCalenderBlockedSlot" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header justify-content-start">
				<div class="form-group mb-0">
					<label>Delete Blocked slot</label>
					<span class="sub-label mb-0">Are you sure you wanna delete this blocked slot ?</span>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-footer">
				<button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="gen-btn delete-btn">DELETE</button>
			</div>
		</div>
	</div>
</div>

<!-- VIEW SLOT ORDER MODAL -->
<div class="modal fade gen-modal dashboard-modals" id="view-slot-order-modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="">
					<div class="container">
						<div class="row">
							<div class="col-lg-8 col-md-8 col-sm-12">
								<div class="shadow-card mb-3">
									<div class="order-number-info">
										<p class="number">Order #1234</p>
										<p class="status"><span class="tag active"></span>Active</p>
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
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="gen-btn">Apply</button>
			</div>
		</div>
	</div>
</div>

<footer>

</footer>


<script src="public/assets/js/bootstrap.min.js"></script>
<script src="public/assets/js/jquery-3.5.1.min.js"></script>
<script src="public/assets/js/stellarnav.min.js"></script>
<script src="public/assets/js/custom.js"></script>

</body>
</html>


<script>
	const resource_box = document.querySelector(".resource-body");
	let resource_number = document.querySelector(".resource-box .resource-body").children.length;
	if (resource_number == 1){
		resource_box.classList.add('one-resource');
	}
	else if (resource_number == 2){
		resource_box.classList.add('two-resource');
	}
	else if (resource_number == 3){
		resource_box.classList.add('three-resource');
	}
	else if (resource_number > 3){
		resource_box.classList.add('more-than-three');
	}

	// CALNEDER SCRIPTS
	// let slot_cards = document.querySelectorAll(".calender-slots-wrap .slot-box .slot-card");
	// for (i=0; i<=slot_cards.length; i++){
	// 	slot_cards[i].classList.add("test");
	// }
	


var datepicker = new tui.DatePicker('#add-date-wrapper', {
    date: new Date(),
    input: {
      element: '#add-datepicker-input',
      format: 'dd-MM-yyyy'
    }
  });
  var datepicker2 = new tui.DatePicker('#edit-date-wrapper', {
    date: new Date(),
    input: {
      element: '#edit-datepicker-input',
      format: 'dd-MM-yyyy'
    }
  });

  var datepicker3 = new tui.DatePicker('#date-wrapper-3', {
    date: new Date(),
    input: {
      element: '#datepicker-input-3',
      format: 'dd-MM-yyyy'
    }
  });

  var datepicker4 = new tui.DatePicker('#date-wrapper-4', {
    date: new Date(),
    input: {
      element: '#datepicker-input-4',
      format: 'dd-MM-yyyy'
    }
  });
	

// $(".view-list-dropdown-menu li a").click(function(){
//   $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <i class="fas fa-chevron-down"></i>');
//   $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
// });



</script>

<!-- OPEN MODAL SCRIPTS -->
<script>
	// $(document).ready( function () {
	// 	$(".resource-slot-box .resource-slot-card").click(function(){
 //  			$('#editCalenderEvent').modal('show');
	// 	});
	// });
</script>