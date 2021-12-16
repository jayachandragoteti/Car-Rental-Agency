<?PHP 
include_once "./../connect.php";
session_start();
if (!isset($_SESSION['RentalAgency'])) {
	header("location: ./../logout.php");
}
$RentalAgency = $_SESSION['RentalAgency'];
$selectRentalAgency = mysqli_query($connect,"SELECT * FROM `users` WHERE `userId` = '$RentalAgency'");
$selectRentalAgencyRow = mysqli_fetch_array($selectRentalAgency);
?><!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Car Rental Agency</title>
	<link rel="shortcut icon" href="./../assets/images/HomeCar.png" type="image/png" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="./backScript.js"></script>
	<!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> -->
	<link href="./../assets/css/RentalAgencyStyles.css" rel="stylesheet" />
	<script src="./../assets/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<!-- Navbar Brand--><a class="navbar-brand ps-3" href="index.php">Car Rental Agency</a>
		<!-- Sidebar Toggle-->
		<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
		<!-- Navbar Search-->
		<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
			<div class="input-group">
				
			</div>
		</form>
		<!-- Navbar-->
		<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
			<li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
				<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
				<li><a class="dropdown-item changePassword" href="#!" onclick="ajaxProfilePageCall()"><i class="fas fa-id-badge"></i> Profile</a></li>
				<li><a class="dropdown-item changePassword" href="#!" onclick="ajaxChangePasswordPageCall()"><i class="fas fa-lock"></i> Change Password</a></li>
					<li>
						<hr class="dropdown-divider" /> </li>
					<li><a class="dropdown-item" href="./../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<div id="layoutSidenav">
		<div id="layoutSidenav_nav">
			<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
				<div class="sb-sidenav-menu mt-3">
					<div class="nav">
						<a class="nav-link dashboard sidebarToggle" href="#" onclick="ajaxDashboardPageCall()">
							<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> Dashboard 
                        </a>
                        <a class="nav-link addNewCar sidebarToggle" href="#" onclick="ajaxAddNewCarsPageCall()">
							<div class="sb-nav-link-icon"><i class="fas fa-plus-square"></i></div> Add New Car 
                        </a>
                        <!-- <a class="nav-link changePassword sidebarToggle" href="#" onclick="ajaxChangePasswordPageCall()" >
							<div class="sb-nav-link-icon"><i class="fas fa-lock"></i></div> Change Password 
                        </a> -->
                        <a class="nav-link myCars sidebarToggle" href="#" onclick="ajaxMyCarsPageCall()">
							<div class="sb-nav-link-icon"><i class="fas fa-car"></i></div> My Cars
                        </a>
                        <a class="nav-link bookedCars sidebarToggle" href="#" onclick="ajaxBookedCarsPageCall()" >
							<div class="sb-nav-link-icon"><i class="fas fa-taxi"></i></i></div>  Booked Cars
                        </a>
					</div>
				</div>
				<div class="sb-sidenav-footer">
					<div class="small">Logged in as:</div><?PHP echo $selectRentalAgencyRow ['name']; ?> </div>
			</nav>
		</div>
		<div id="layoutSidenav_content">
			<main id="ajax-main-content" class="p-lg-5">
				<section>
					<div class="container-fluid px-4">
						<div class="row justify-content-md-center">
							<div class="col-xl-12">
								<div class="card mb-4">
									<img src="./../assets/images/welcome.png" class="img-fluid" alt="...">
								</div>
							</div>
						</div>
					</div>
				</section>
			</main>
			<footer class="py-4 bg-light mt-auto">
				<div class="container-fluid px-4">
					<div class="d-flex align-items-center justify-content-between small">
						<div class="text-muted">
							<script>
							document.write(new Date().getFullYear())
							</script> Copyright: <a href="https://jayachandragoteti.github.io/" class="text-warning text-decoration-none">Jayachandra Goteti</a> </div>
					</div>
				</div>
		</div>
		</footer>
	</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="./../assets/js/RentalAgencyScripts.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->
	<script src="./../assets/js/datatables-simple-demo.js"></script>
</body>

</html>