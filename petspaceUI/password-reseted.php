<?php include 'includes/header.php';?>

	<section class="auth-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-3">
					<div class="logo-wrap">
						<img src="assets/images/logo.png" alt="logo" class="img-fluid">
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-9">
					<ul class="auth-top-btn">
						<li><a href="#!">Need assistance?</a></li>
						<li><a href="#!" class="gen-btn">Contact Petspace</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section class="auth-main-sec">
		<div class="container">
			<div class="auth-card">
				<form>
					<div class="form-top">
					    <p class="title">Sign In</p>
					    <p class="sub-title">Password has been reseted. Please login</p>
					</div>
					<div class="auth-error auth-link">
						<span><img src="assets/images/check-icon.png" alt="icon" class="img-fluid"></span>
						<p>You entered an incorrect email/password.</p>
					</div>
					<div class="form-group">
						<label>Email Address</label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<label class="d-flex justify-content-between">
							<span>Password</span>
							<a href="forgot-password.php" class="forgot-pass">Forgot Password?</a>
						</label>
						<input type="password" class="form-control">
					</div>
					<div class="form-group mb-0">
						<button type="submit" class="submit-btn">Sign In</button>
					</div>
				</form>
			</div>
		</div>
	</section>

<?php include 'includes/footer.php';?>
