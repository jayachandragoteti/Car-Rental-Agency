<section>
	<div class="container">
		<div class="row justify-content-md-center">
			<!-- justify-content-md-center -->
			<div class="col-lg-8">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-dark">Add New Cars</h6> </div>
					<div class="card-body">
						<form id="addNewCarsForm">
							<div class="container">
								<p class="text-danger add-New-Cars-alerts">*All fields are mandatory</p>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="vehicleNo">Vehicle No</label>
											<input type="text" class="form-control" name="vehicleNo" id="trainingName" required /> </div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="vehicleModel">Vehicle Model</label>
											<input type="text" class="form-control" name="vehicleModel" id="trainingName" required /> </div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="seatingCapacity">Seating Capacity</label>
											<input type="number" class="form-control" min="1" name="seatingCapacity" id="trainingName" required /> </div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="rentPerDay">Rent Per Day</label>
											<input type="number" class="form-control" name="rentPerDay" id="trainingName" required /> </div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="vehicleImage">Vehicle Image</label>
											<input type="file" class="form-control" name="vehicleImage" id="trainingName" required /> </div>
									</div>
								</div>
                                <div class="row">
									<div class="col-sm-12 mt-4">
										<div class="form-group">
											<button type="button" class="btn btn-lg btn-warning text-white float-lg-end" onclick="addNewCar()">Add Car</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>