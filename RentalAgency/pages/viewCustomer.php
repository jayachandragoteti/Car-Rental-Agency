<?PHP 
include_once "./../../connect.php";
session_start();
if (isset($_SESSION['RentalAgency']) && isset($_POST['userId'])) {
	$Customer = $_POST['userId'];
	$selectCustomer = mysqli_query($connect,"SELECT * FROM `users` WHERE `userId` = '$Customer'");
	$selectCustomerRow = mysqli_fetch_array($selectCustomer);
?>
<section>
	<div class="container mt-lg-5" style="margin-top:5rem;">
		<div class="row justify-content-md-center">
			<!-- justify-content-md-center -->
			<div class="col-lg-12">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6>Customer Details</h6> 
					</div>
					<div class="card">
						<div class="container">
							<div class="row justify-content-md-center">
								<div class="col-sm-6">
									<div class="d-flex align-items-start py-3 border-bottom p-lg-4"> <img src="./../assets/images/profilePics/<?PHP echo ($selectCustomerRow['profileImage'] == "") ? 'locationIcon.png': $selectCustomerRow['profileImage'];?>" class="img-thumbnail img-fluid ml-lg-5" alt=""> </div>
								</div>
							</div>
							<div class="row justify-content-md-center pb-lg-5">
								<p class="update-profile-data-Alerts"></p>
								<form id="updateProfileDataForm">
									<div class="row py-2">
										<div class="col-md-6">
											<label for="" class="form-label">Name</label>
											<input type="text" class="form-control border-warning  shadow-none" value="<?PHP echo $selectCustomerRow['name']; ?>" name="" id="" disabled/> </div>
										<div class="col-md-6 pt-md-0 pt-3">
											<label for="" class="form-label">Email</label>
											<input type="email" name="" class="form-control border-warning  shadow-none" value="<?PHP echo $selectCustomerRow['email']; ?>" id="" disabled/> </div>
									</div>
									<div class="row py-2">
										<div class="col-md-6">
											<label for="" class="form-label">Contact No</label>
											<input type="phone" name="" class="form-control border-warning  shadow-none" value="<?PHP echo $selectCustomerRow['contactNo']; ?>"id="" disabled/> </div>
										<div class="col-md-6 pt-md-0 pt-3">
											<label for="CustomersCity" class="form-label">City</label>
											<input type="text" name="CustomersCity" class="form-control border-warning  shadow-none" value="<?PHP echo $selectCustomerRow['city']; ?>" id="CustomersCity" disabled/> </div>
									</div>
									<div class="row py-2">
										<div class="col-md-6">
											<label for="" class="form-label">Address</label>
											<input type="text" name="" class="form-control border-warning  shadow-none" value="<?PHP echo $selectCustomerRow['address']; ?>" id="" disabled/> </div>
										
									</div>
								</form>
							</div>
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