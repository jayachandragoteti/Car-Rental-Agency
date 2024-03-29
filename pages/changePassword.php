<section>
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-6">
				<div class="container">
					<div class="card mt-5">
						<div class="card-body">
							<div class="container ">
								<div class="col-lg-12">
									<h3 class="text-center mb-5 text-warning ">Change Password</h3> </div>
								<div class="row">
									<form method="post">
										<div class="col-sm-12">
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
										<p class="User-Password-Alerts m-lg-3 text-danger"></p>
										<div class=" mb-3 text-center">
											<input type="button" onclick="UpdatePassword()" name="UpdatePasswordSubmit" class="btn btn btn-warning text-white rounded-pill" style="font-size:20px;" value="Update" /> </div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>