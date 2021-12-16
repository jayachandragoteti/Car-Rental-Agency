<?PHP 
include_once "./../connect.php";
?>
<section>
	<div class="jumbotron jumbotron-fluid bg-dark" style="height: 450px;  ">
		<div class="container">
			<div class="row">
				<div class="col-sm mt-5">
					<h1 class="display-4 text-center text-white fw-bold  mt-5">
									Car Rental Agency
									<img src='./assets/images/HomeCar.png' height="75" />
									<!-- class="blink" -->
								</h1>
					<p class="lead text-center text-white font-weight-bold mt-5"><b>Safety</b> & <b>Security</b> are the very first priority.</p>
					<p class="lead text-white font-weight-bold text-center mt-5 "> <a class="btn btn-outline-light btn-warning text-dark rounded-pill p-2" href="#SearchCars" role="button">Search Car</a> </p>
				</div>a </div>
		</div>
	</div>
	<!-- img with Cars -->
	<div class="container mt-5 border-1">
		<div class="row">
			<div class="col-lg-6 mt-5">
				<div class="lead text-center mt-5">
					<p class="mt-5">
						<br/>You could drive a rental car until you don't want it.
						<br/> Just get out of it while it's moving and just walk away.
						<br/> No, I don't feel like being in that car any longer. Just call Hertz.
						<br/> Hi, your car is drifting into the intersection of 28th and Broadway,
						<br/> if you're interested. It's now your problem. 
					</p>
				</div>
				<div class="text-center text-dark">
					<h2 class="h1 text-warning">In Need Of Rental Car?</h2> </div>
			</div>
			<div class="col-lg-6"> <img src="./assets/images/home.png" class="img-fluid" width="100%"> </div>
		</div>
	</div>
	<!-- end of img Cars -->
	<div class="container " id="SearchCars">
		<div class="row justify-content-md-center">
			<div class="col col-lg-8 text-center text-warning mb-5">
				<h2 class="h1">Available Cars</h2> </div>
		</div>
		<div class="row justify-content-md-center">
			<div class="col col-lg-12">
				<div class="container">
					<form method="get">
						<div class="row justify-content-md-center">
							<div class="col-sm-2">
								<select name="city" id="availableCarsCityFilter" class="form-select bg-light mb-2" aria-label="Default select example" onchange="availableCarsResponse()">
									<option selected="" value="">City</option>
									<option value="">All</option>
									<?PHP 
										$SelectCity = mysqli_query($connect,"SELECT DISTINCT(`city`) FROM `users` WHERE `loginType` = '0'");
										while ($SelectCityRow= mysqli_fetch_array($SelectCity)) { ?>
											<option value="<?PHP echo $SelectCityRow['city']; ?>"><?PHP echo $SelectCityRow['city']; ?></option>
										<?PHP }
									?>
								</select>
							</div>
							<div class="col-sm-2">
								<select name="CarsGroup" id="availableCarsModelsFilter" class="form-select bg-light mb-2" aria-label="Default select example" onchange="availableCarsResponse()">
									<option selected="" value="">Car Models</option>
									<option value="">All</option>
									<?PHP 
										$SelectCarsGroup = mysqli_query($connect,"SELECT DISTINCT(`vehicleModel`) FROM `vehicleList`");
										while ($SelectCarsGroupRow= mysqli_fetch_array($SelectCarsGroup)) { ?>
											<option value="<?PHP echo $SelectCarsGroupRow['vehicleModel']; ?>"><?PHP echo $SelectCarsGroupRow['vehicleModel']; ?></option>
										<?PHP }
									?>
								</select>
							</div>
							<div class="col-sm-2">
								<select name="hospital" id="availableSeatingCapacityFilter" class="form-select bg-light mb-2" aria-label="Default select example" onchange="availableCarsResponse()">
									<option selected="" value="">Seating Capacity</option>
									<option value="">All</option>
									<?PHP 
										$SelectCarsGroup = mysqli_query($connect,"SELECT DISTINCT(`seatingCapacity`) FROM `vehicleList`");
										while ($SelectCarsGroupRow= mysqli_fetch_array($SelectCarsGroup)) { ?>
											<option value="<?PHP echo $SelectCarsGroupRow['seatingCapacity']; ?>"><?PHP echo $SelectCarsGroupRow['seatingCapacity']; ?></option>
										<?PHP }
									?>
								</select>
							</div>
							<div class="col-sm-2">
								<select name="hospital" id="availabilityFilter" class="form-select bg-light mb-2" aria-label="Default select example" onchange="availableCarsResponse()">
									<option selected="" value="">Availability</option>
									<option value="">All</option>
									<option value="0">Open to Book</option>
									<option value="1">Booked</option>
								</select>
							</div>
							<div class="col-sm-2">
								<select id="ShowRows" class="form-select bg-light mb-2" aria-label="Default select example" onchange="availableCarsResponse()">
									<option selected="" value="">Show Rows</option>
									<option value="10">10</option>
									<option value="20">20</option>
									<option value="30">30</option>
									<option value="40">40</option>
									<option value="50">50</option>
									<option value="60">60</option>
									<option value="70">70</option>
									<option value="80">80</option>
									<option value="90">90</option>
									<option value="100">100</option>
									<option value="More">More</option>
								</select>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="row justify-content-md-center mt-5 jumbotron jumbotron-fluid ">
			<div class="col col-sm-10">
				<!-- table -->
				<div class="table-responsive">
					<table id="dtBasicExample" cellspacing="0" width="100%" class="table table-striped table-hover table-bordered border-warning ">
						<thead>
							<tr class="p-2">
								<th scope="col">Sno</th>
								<th scope="col">City</th>
								<th scope="col">Vehicle No</th>
								<th scope="col">Vehicle Model</th>
								<th scope="col">Seating Capacity</th>
								<th scope="col">Availability</th>
								<th scope="col">View</th>
							</tr>
						</thead>
						<tbody class="AvailableCarsResponse">
							
						</tbody>
					</table>
					<!-- end table -->
				</div>
			</div>
		</div>
		
		<!-- <div class="row justify-content-md-center mt-5 jumbotron jumbotron-fluid ">
			<div class="col col-sm-10">
				<div class="py-4 px-4">
					<div class="container">
						<h2>All Cities</h2>
						<section class="customer-logos slider">
						<?PHP 
						$totalCity = mysqli_query($connect,"SELECT DISTINCT(`city`) FROM `users` WHERE `loginType` = '0'");
							while ($totalCityRow= mysqli_fetch_array($totalCity)) { ?>
							<div class="col-lg-3 mb-2 pr-lg-1 pb-lg-5 mt-lg-4 slide">
								<div class="row" id="box-search">
									<div class="thumbnail text-center">
										<img src="./assets/images/profilePics/locationIcon.png" alt="" class="img-responsive img-fluid rounded shadow-sm img-thumbnail" >
										<div class="captions" >
											<h2 class="text-dark"><?PHP echo $totalCityRow['city'];?></h2>
										</div>
									</div>
								</div>
							</div>
							<div class="slide"><img src="https://image.freepik.com/free-vector/luxury-letter-e-logo-design_1017-8903.jpg"></div>
							<div class="slide"><img src="https://image.freepik.com/free-vector/3d-box-logo_1103-876.jpg"></div>
							<div class="slide"><img src="https://image.freepik.com/free-vector/blue-tech-logo_1103-822.jpg"></div>
							<div class="slide"><img src="https://image.freepik.com/free-vector/colors-curl-logo-template_23-2147536125.jpg"></div>
							<div class="slide"><img src="https://image.freepik.com/free-vector/abstract-cross-logo_23-2147536124.jpg"></div>
							<div class="slide"><img src="https://image.freepik.com/free-vector/football-logo-background_1195-244.jpg"></div>
							<div class="slide"><img src="https://image.freepik.com/free-vector/background-of-spots-halftone_1035-3847.jpg"></div>
							<div class="slide"><img src="https://image.freepik.com/free-vector/retro-label-on-rustic-background_82147503374.jpg"></div>
						<?PHP } ?>
						</section>
					</div>
				</div>
			</div>
		</div> -->
		<div class="row justify-content-md-center mt-5 jumbotron jumbotron-fluid ">
			<div class="col col-sm-10">
				<div class="py-4 px-4">
					<div class="d-flex align-items-center justify-content-between mb-3">
						<h5 class="mb-0">All Agencies</h5><!-- <a href="#" class="btn btn-link text-muted">Show all</a> -->
					</div>
					<div class="row">
					<?PHP 
					$totalAgencies = mysqli_query($connect,"SELECT * FROM `users` WHERE `loginType` = '0'");
						while ($totalAgenciesRow= mysqli_fetch_array($totalAgencies)) { ?>
						<div class="col-lg-3 mb-2 pr-lg-1 pb-lg-5 mt-lg-4">
							<div class="row" id="box-search">
								<div class="thumbnail text-center">
									<img src="./assets/images/profilePics/<?PHP echo($totalAgenciesRow['profileImage'] == "") ? 'logo.png':$totalAgenciesRow['profileImage'];?>" alt="<?PHP echo $totalAgenciesRow['name'];?>" class="img-responsive img-fluid rounded shadow-sm img-thumbnail" style="height:10rem;width:10rem;" />
									<div class="captions" >
										<h5 class="text-dark"><?PHP echo $totalAgenciesRow['name'];?></h5>
									</div>
								</div>
							</div>
						</div>
					<?PHP } ?>
						
						<!-- <div class="col-lg-3 mb-2 pl-lg-1"><img src="./assets/images/cityImage.jpg" alt="" class="img-fluid rounded shadow-sm"></div>
						<div class="col-lg-3 pr-lg-1 mb-2"><img src="./assets/images/cityImage.jpg" alt="" class="img-fluid rounded shadow-sm"></div>
						<div class="col-lg-3 pl-lg-1"><img src="./assets/images/cityImage.jpg" alt="" class="img-fluid rounded shadow-sm"></div> -->
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-md-center mt-5 jumbotron jumbotron-fluid ">
			<div class="col col-sm-10">
				<div class="py-4 px-4">
					<div class="d-flex align-items-center justify-content-between mb-3">
						<h5 class="mb-0">All Cities</h5><!-- <a href="#" class="btn btn-link text-muted">Show all</a> -->
					</div>
					<div class="row">
					<?PHP 
					$totalCity = mysqli_query($connect,"SELECT DISTINCT(`city`) FROM `users` WHERE `loginType` = '0'");
						while ($totalCityRow= mysqli_fetch_array($totalCity)) { ?>
						<div class="col-lg-3 mb-2 pr-lg-1 pb-lg-5 mt-lg-4">
							<div class="row" id="box-search">
								<div class="thumbnail text-center">
									<img src="./assets/images/profilePics/cityImage.png" alt="" class="img-responsive img-fluid rounded-circle shadow-sm img-thumbnail" style="height:10rem;width:10rem;"/>
									<div class="captions" >
										<h5 class="text-dark"><?PHP echo $totalCityRow['city'];?></h5>
									</div>
								</div>
							</div>
						</div>
					<?PHP } ?>
						
						<!-- <div class="col-lg-3 mb-2 pl-lg-1"><img src="./assets/images/cityImage.jpg" alt="" class="img-fluid rounded shadow-sm"></div>
						<div class="col-lg-3 pr-lg-1 mb-2"><img src="./assets/images/cityImage.jpg" alt="" class="img-fluid rounded shadow-sm"></div>
						<div class="col-lg-3 pl-lg-1"><img src="./assets/images/cityImage.jpg" alt="" class="img-fluid rounded shadow-sm"></div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>