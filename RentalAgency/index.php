<?PHP 
include_once "./connect.php";
session_start();
if (!isset($_SESSION['RentalAgency'])) {
	header("location: ./../logout.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
	<meta name="description" content="We are committed to provoke mindsets towards self learning and  provide unlimited opportunities with redefined look " />
	<meta name="keywords" content="sac,aitam,aitamsac,aditya tekkali,aitam tekkali,Student Activity Center,Student Activity Center aitam,Aditya Institute of Technology and Management (AITAM College, Tekkali),Student Activity Center | AITAM" />
	<meta name="author" content="Car Rental Agency " />
	<title> Car Rental Agency </title>
	<link rel="shortcut icon" href="./../assets/images/logo.png" type="image/png" />
	<!-- Bootstrap CSS CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<!-- Our Custom CSS -->
	<link rel="stylesheet" href="./../assets/css/adminStyle.css">
	<!-- Scrollbar Custom CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
	<!-- Font Awesome JS -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
	</script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
	</script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="./backScript.js"></script>
</head>

<body>
	<div class="wrapper">
		<!-- Sidebar  -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<h3>
                    Car Rental Agency 
                </h3> </div>
			<ul class="list-unstyled components">
				<!-- <p>Dummy Heading</p> -->
				<li> <a href="#" onclick="ajaxAddNewCarsPageCall()" class="sidebarDismiss addNewCar"><i class="fas fa-plus-square"></i> Add New Car</a> </li>
				<li> <a href="#" onclick="ajaxChangePasswordPageCall()" class="sidebarDismiss changePassword"><i class="fas fa-lock"></i> Change Password</a> </li>
				<li> <a href="#" onclick="ajaxMyCarsPageCall()" class="sidebarDismiss myCars"><i class="fas fa-car"></i> My Cars</a> </li>
				<li> <a href="#" onclick="ajaxAddNewCarsPageCall()" class="sidebarDismiss bookedCars"> <i class="fas fa-taxi"></i> Booked Cars</a> </li>
				<!-- <li class="">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Web
                        Content</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#" onclick="ajaxAddTrainingPageCall()">Add Training</a>
                        </li>
                        <li>
                            <a href="#" onclick="ajaxAddEventPageCall()">Add Event</a>
                        </li>
                        <li>
                            <a href="#" onclick="ajaxAddGalleryPageCall()">Add Gallery </a>
                        </li>
                        <li>
                            <a href="#" onclick="ajaxAddTestimonialPageCall()">Add Testimonials</a>
                        </li>
                    </ul>
                </li> -->
			</ul>
			<ul class="list-unstyled CTAs">
				<li> <a href="" class="article">Logout</a> </li>
			</ul>
		</nav>
		<!-- Page Content  -->
		<div id="content">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
                    <a href="#" id="sidebarCollapse"><i class="fas fa-align-left ze-text-primary"></i> </a>
					<!-- <a class="nav-link ml-auto d-flex float-lg-end" href="./../logout.php" >
                        <i class="fas fa-sign-out-alt mt-1"></i>&nbsp Logout
                    </a> 
                    <div class="navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav">
                            <li class="nav-item no-arrow">
                                <a href="./../logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                    <div class="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item no-arrow">
                                
                            </li>
                        </ul>
                    </div> --></div>
			</nav>
			<main id="ajax-main-content"> </main>
		</div>
		<!-- Popper.JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
		</script>
		<!-- Bootstrap JS -->
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
		</script>
		<!-- jQuery Custom Scroller CDN -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
		</script>
		<script type="text/javascript">
		$(document).ready(function() {
			$("#sidebar").mCustomScrollbar({
				theme: "minimal"
			});
			$('#sidebarCollapse,.sidebarDismiss').on('click', function() {
				$('#sidebar, #content').toggleClass('active');
				$('.collapse.in').toggleClass('in');
				$('a[aria-expanded=true]').attr('aria-expanded', 'false');
			});
		});
		</script>
</body>

</html>