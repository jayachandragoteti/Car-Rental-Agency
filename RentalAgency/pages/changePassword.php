<?PHP 
include_once "./../../connect.php";
session_start();
if (isset($_SESSION['RentalAgency'])) {

?>
<section>
	<div class="container-fluid px-4">
		<h1 class="mt-4">Change Password</h1>
		<div class="row ">
			<div class="col-xl-8">
				<div class="card mb-4">
					<div class="card-header User-Password-Alerts text-danger"> *All fields are mandatory</div>
					<div class="card-body">
						<div class="row justify-content-md-center">
							<form method="post">
								<div class="col-sm-12 ">
									<div class="mb-3">
										<label for="oldPassword" class="form-label">Old password</label>
										<input type="password" name="oldPassword" class="form-control shadow-none" id="oldPassword" required/> </div>
								</div>
								<div class="col-sm-12">
									<div class="mb-3">
										<label for="newPassword" class="form-label">New Password</label>
										<input type="password" class="form-control shadow-none" name="newPassword" id="newPassword" required/> </div>
								</div>
								<div class="col-sm-12">
									<div class="mb-3">
										<label for="confirmPassword" class="form-label">Confirm Password</label>
										<input type="password" class="form-control shadow-none" name="confirmPassword" id="confirmPassword" required/> </div>
								</div>
								<div class="col-md-12 pt-3">
									<input type="button" onclick="UpdatePassword()" class="form-control btn btn-warning mt-3 text-white" value="Update" /> </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?PHP 
}
?>