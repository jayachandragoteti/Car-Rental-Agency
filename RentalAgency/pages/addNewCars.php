<?PHP 
session_start();
if (isset($_SESSION['RentalAgency'])) {
?>
<section>
	<div class="container-fluid px-4">
		<h1 class="mt-4 text-align-center">Add New Cars</h1>
		<div class="row">
			<div class="col-xl-8">
				<div class="card mb-4">
					<div class="card-header add-New-Cars-alerts text-danger"> *All fields are mandatory</div>
					<div class="card-body">
						<div class="row justify-content-md-center ">
							<div class="col-sm-8">
								<p class="update-profile-data-Alerts"></p>
								<form id="addNewCarsForm">
									<div class="container">
										<div class="row justify-content-md-center ">
											<div class="col-sm-12">
												<div class="form-group">
													<label for="vehicleNo">Vehicle No</label>
													<input type="text" class="form-control" name="vehicleNo" id="trainingName" required /> </div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label for="vehicleModel">Vehicle Model</label>
													<input type="text" class="form-control" name="vehicleModel" id="trainingName"  required />
									
												</div>
											</div>
										</div>
										<div class="row justify-content-md-center ">
											<div class="col-sm-12">
												<div class="form-group">
													<label for="seatingCapacity">Seating Capacity</label>
													<input type="number" class="form-control" min="1" name="seatingCapacity" id="trainingName" required /> </div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label for="rentPerDay">Rent Per Day</label>
													<input type="number" class="form-control" name="rentPerDay" id="trainingName" required /> </div>
											</div>
										</div>
										<div class="row justify-content-md-center ">
											<div class="col-sm-12">
												<div class="form-group">
													<label for="vehicleImage">Vehicle Image</label>
													<input type="file" class="form-control" name="vehicleImage" id="trainingName" required /> </div>
											</div>
											<div class="col-md-12 pt-2">
												<input type="button" onclick="addNewCar()" class="form-control btn btn-warning mt-3 text-white" Value="Add Car" /> </div>
										</div>
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