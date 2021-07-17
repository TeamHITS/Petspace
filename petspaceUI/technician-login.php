<?php include 'includes/header.php';?>
<div class="technician-dashboard-wrap tech-dash-login">

	<section class="auth-main-sec">
		<div class="container">
			<div class="auth-card technician-login-form">
				<div class="logo-wrap text-center">
					<img src="assets/images/logo.png" alt="logo" class="img-fluid">
				</div>
				<form>
					<div class="form-top">
					    <p class="title mb-3">Sign In</p>
					    <p class="sub-title">Please enter your credentials top proceed.</p>
					</div>
					<div class="form-group">
						<label>STORE UNIQUE ID</label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<label class="d-flex justify-content-between">
							<span>PASSWORD PIN</span>
						</label>
						<input type="password" class="form-control">
					</div>
					<div class="form-group">
						<div class="sm-check-box">Keep me logged in
						  <input type="checkbox" checked>
						  <span class="checkmark"></span>
						</div>
					</div>
					<div class="form-group mb-0">
						<button type="submit" class="submit-btn">Sign In</button>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
<?php include 'includes/footer.php';?>

