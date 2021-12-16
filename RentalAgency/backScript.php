<?php
include "./../connect.php";
session_start();
// mobile number validations Functions
function validate_mobile($mobile)
{
    return preg_match('/^[6-9]\d{9}$/', $mobile);
}
// end mobile number validations Functions
//$connect =  mysqli_connect("localhost","root", "","carRentalAgency");
if (isset($_POST['vehicleNo']) && isset($_POST['vehicleModel']) && isset($_POST['seatingCapacity']) && isset($_POST['rentPerDay']) && $_FILES['vehicleImage'] && isset($_SESSION['RentalAgency'])) {
    if ($_POST['vehicleNo'] != "" && $_POST['vehicleModel'] !="" && $_POST['seatingCapacity'] !="" && $_POST['rentPerDay'] !="" )  {
        $RentalAgency = $_SESSION['RentalAgency'];
        $vehicleNo = strtoupper($connect->real_escape_string($_POST['vehicleNo']));
        $vehicleModel = strtoupper($connect->real_escape_string($_POST['vehicleModel']));
        $seatingCapacity = $connect->real_escape_string($_POST['seatingCapacity']);
        $rentPerDay = $connect->real_escape_string($_POST['rentPerDay']);
        // ------------
        $vehicleImage = $_FILES['vehicleImage']['name'];
        $vehicleImageFile = $_FILES['vehicleImage']['tmp_name'];
        $vehicleImageExt = strtolower(pathinfo($vehicleImage, PATHINFO_EXTENSION));
        $trainingOutcomeName = strtolower($vehicleNo. $vehicleImageExt);
        $trainingOutcomePath = "./" . ($trainingOutcomeName);
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'JPEG', 'PNG', 'JPG', 'jfif');
        $path = './../assets/images/vehicleImages/';//$target_dir = "uploads/";
        $finalImage = strtolower($vehicleNo.".".$vehicleImageExt);
        $selectCarsList = mysqli_query($connect,"SELECT * FROM  `vehicleList` WHERE `vehicleNo` = '$vehicleNo'");
        $target_file = $path .($finalImage);
        if (mysqli_num_rows($selectCarsList) == 0) {
            if (file_exists($target_file)) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, file already exists.</p>';
            }elseif ($_FILES["vehicleImage"]["size"] > 300000) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, Image size must be exactly 3MB or below.</p>';
            }elseif (!in_array($vehicleImageExt, $valid_extensions)) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, mages extension can be "jpeg", "jpg", "png", "gif", "JPEG" , "PNG" , "JPG" , "jfif"</p>';
            }elseif (strlen($vehicleNo) < 10) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, Invalid Vehicle No</p>';
            }elseif (move_uploaded_file($_FILES["vehicleImage"]["tmp_name"],$target_file)) {
                $insertCar = mysqli_query($connect,"INSERT INTO `vehicleList`(`vehicleNo`, `vehicleModel`, `seatingCapacity`, `rentPerDay`, `vehicleImage`, `VehicleStatus`,`userId`) VALUES ('$vehicleNo','$vehicleModel','$seatingCapacity','$rentPerDay ','$finalImage','0','$RentalAgency')");
                if ($insertCar) {
                    echo '<p class="text-success"><i class="fas fa-check-circle"></i> Vehicle added successfully.</p>';
                } else {
                    unlink("./../assets/images/vehicleImages/$finalImage");
                    echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, failed, Try Again!.</p>';
                }
            }else {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, file is not uploaded.Try Again!.</p>';
            }
        } else {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i>Already exists.</p>';
        }
    } else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled</p>';
    }
    
}
// Update Password
if (isset($_POST['UpdatePassword']) && isset($_SESSION['RentalAgency'])) {
	if (isset($_POST['oldPassword']) && $_POST['oldPassword'] != "" && isset($_POST['newPassword']) && $_POST['newPassword'] != "" && isset($_POST['confirmPassword']) && $_POST['confirmPassword'] != "") {
		$RentalAgency = $_SESSION['RentalAgency'];
		$newPassword = $connect -> real_escape_string($_POST['newPassword']);
		$confirmPassword = $connect -> real_escape_string($_POST['confirmPassword']);
		if ($newPassword != $confirmPassword) {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Password and confirm password should be same!</p>';
		}elseif (strlen($newPassword) < 8) {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Password should contain at least eight characters!</p>';
		} else {
			$selectRentalAgency = mysqli_query($connect,"SELECT * FROM `users` WHERE `userId` = '$RentalAgency'");
			if ($selectRentalAgency && mysqli_num_rows($selectRentalAgency) == 1 ) {
				$selectRentalAgencyRow = mysqli_fetch_array($selectRentalAgency);
				$oldPassword = $connect -> real_escape_string($_POST['oldPassword']);
				if (password_verify($oldPassword, $selectRentalAgencyRow['password'])) {
					$hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
					$updatePassword = mysqli_query($connect,"UPDATE `users` SET `password`='$hashed_password' WHERE `userId` = '$RentalAgency'");
					if ($updatePassword) {
                        echo '<p class="text-success"><i class="fas fa-check-circle"></i> Password Updated successfully.</p>';
					} else {
                        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
					}
				}else{
                    echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Incorrect old password. please retry</p>';
				}
			} else {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid login!</p>';
			}
		}
	} else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled!</p>';
	}
}
// My cars list
if (isset($_POST['myCarsList']) && isset($_SESSION['RentalAgency'])) {
    $RentalAgency = $_SESSION['RentalAgency'];
    $LIMIT = 10;
    if (isset($_POST['ShowRows'])) {
        if ($_POST['ShowRows'] == "") {
            $LIMIT = 10;
        }elseif ($_POST['ShowRows'] == "More") {
            $LIMIT = 1000000000000;
        } else{
            $LIMIT = $connect -> real_escape_string($_POST['ShowRows']);
        }
    }
    $selectMyCars = mysqli_query($connect,"SELECT * FROM `vehicleList` WHERE `userId` = '$RentalAgency' LIMIT $LIMIT");
    if (mysqli_num_rows($selectMyCars) >=1) {
        $i=1;
        while ($CarsRow=mysqli_fetch_array($selectMyCars)) {?>
            <tr>
                <th scope="row"><?PHP echo $i;?></th>
                <td><img src="./../assets/images/vehicleImages/<?PHP echo $CarsRow['vehicleImage'];?>" class="img-fluid img-thumbnail" width="150" height="50" alt=""></td>
                <td><?PHP echo $CarsRow['vehicleNo'];?></td>
                <td><?PHP echo $CarsRow['vehicleModel'];?></td>
                <td><?PHP echo $CarsRow['seatingCapacity'];?></td>
                <td><?PHP echo $CarsRow['rentPerDay'];?></td>
                <td><?PHP echo ($CarsRow['VehicleStatus'] == 1) ? '<span class="badge bg-danger">Booked</span>' : '<span class="badge bg-success">Open to Book</span>' ;?>
            </td>
                <td><a href="#" onclick="viewMyCar('<?PHP echo $CarsRow['vehicleNo'];?>')" class="btn btn-warning"><i class="fas fa-eye text-white"></i></a></td>
                <td><a href="#" onclick="myCarDelete('<?PHP echo $CarsRow['vehicleNo'];?>')" class="btn btn-danger"><i class="fas fa-trash-alt text-white"></i></a></td>
			</tr>
        <?PHP $i++;}
    } else {?>
        <tr>
            <th scope="row" colspan="9" class="bg-danger text-md-center text-white"><i class="far fa-frown"></i> No Data Found!</th>
        </tr>
    <?PHP }
    
}
// My Cars Deleted
if (isset($_POST['myCarDelete']) && isset($_SESSION['RentalAgency']) && isset($_POST['carNumber'])) {
    $RentalAgency = $_SESSION['RentalAgency'];
    $carNumber = $_POST['carNumber'];
    $selectCar = mysqli_query($connect,"SELECT * FROM `vehicleList` WHERE `userId` = '$RentalAgency' AND `vehicleNo` = '$carNumber' ");
    if (mysqli_num_rows($selectCar) == "1") {
        $CarsRow=mysqli_fetch_array($selectCar);
        $deleteMyCar = mysqli_query($connect,"DELETE FROM `vehicleList` WHERE `userId` = '$RentalAgency' AND `vehicleNo` = '$carNumber'");
        if ($deleteMyCar) {
            $finalImage = $CarsRow['vehicleImage'];
            unlink("./../assets/images/vehicleImages/$finalImage");
            echo '<p class="text-danger"><i class="fas fa-check-circle"></i> Car Deleted.</p>';
        } else {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
        }
    }else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
    }
}
// My Booked Cars List
if (isset($_POST['myBookedCarsList']) && isset($_SESSION['RentalAgency'])) {
    $RentalAgency = $_SESSION['RentalAgency'];
    $LIMIT = 10;
    if (isset($_POST['ShowRows'])) {
        if ($_POST['ShowRows'] == "") {
            $LIMIT = 10;
        }elseif ($_POST['ShowRows'] == "More") {
            $LIMIT = 1000000000000;
        } else{ 
            $LIMIT = $connect -> real_escape_string($_POST['ShowRows']);
        }
    }
    $selectMyCars = mysqli_query($connect,"SELECT * FROM `vehicleList` WHERE `userId` = '$RentalAgency' AND `VehicleStatus` = '1' LIMIT $LIMIT");
    if (mysqli_num_rows($selectMyCars) >=1) {
        $i=1;
        while ($CarsRow=mysqli_fetch_array($selectMyCars)) {?>
            <tr>
                <th scope="row"><?PHP echo $i;?></th>
                <td><img src="./../assets/images/vehicleImages/<?PHP echo $CarsRow['vehicleImage'];?>" class="img-fluid img-thumbnail" width="150" height="50" alt=""></td>
                <td><?PHP echo $CarsRow['vehicleNo'];?></td>
                <td><?PHP echo $CarsRow['vehicleModel'];?></td>
                <td><?PHP echo $CarsRow['seatingCapacity'];?></td>
                <td><?PHP echo $CarsRow['rentPerDay'];?></td>
                <td><span class="badge bg-danger">Booked</span></td>
                <td><a href="#" onclick="viewMyCar('<?PHP echo $CarsRow['vehicleNo'];?>')" class="btn btn-warning"><i class="fas fa-eye text-white"></i></a></td>
			</tr>
        <?PHP $i++;}
    } else {?>
        <tr>
            <th scope="row" colspan="9" class="bg-danger text-md-center text-white"> <i class="far fa-frown"></i> No Data Found!</th>
        </tr>
    <?PHP }
    
}

/// Rental Agency Profile
if (isset($_POST['RentalAgencyName']) && isset($_POST['RentalAgencyEmail']) && isset($_POST['RentalAgencyContactNo']) && isset($_POST['RentalAgencyCity']) && isset($_POST['RentalAgencyAddress']) && !isset($_POST['AadharNumber']) && !isset($_POST['RentalAgencyPassword']) && !isset($_POST['RentalAgencyConfirmPassword']) && isset($_SESSION['RentalAgency'])) {
    if ($_POST['RentalAgencyName'] != "" &&  $_POST['RentalAgencyEmail'] != "" && $_POST['RentalAgencyContactNo'] != "" && $_POST['RentalAgencyCity'] != "" && $_POST['RentalAgencyAddress'] != "" ) {
        $RentalAgency = $_SESSION['RentalAgency'];
        $RentalAgencyName = $connect -> real_escape_string($_POST['RentalAgencyName']);
        $RentalAgencyEmail = $connect -> real_escape_string($_POST['RentalAgencyEmail']);
        $RentalAgencyContactNo = $connect -> real_escape_string($_POST['RentalAgencyContactNo']);
        $RentalAgencyCity = strtoupper($connect -> real_escape_string($_POST['RentalAgencyCity']));
        $RentalAgencyAddress = $connect -> real_escape_string($_POST['RentalAgencyAddress']);
        if (!filter_var($RentalAgencyEmail, FILTER_VALIDATE_EMAIL)) {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid email format!</p>';
        } elseif(!validate_mobile($RentalAgencyContactNo)){
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid Contact Number format!</p>';
        } else {
            $userCheck = mysqli_query($connect,"UPDATE `users` SET `name`='$RentalAgencyName',`email`='$RentalAgencyEmail',`contactNo`='$RentalAgencyContactNo',`city`='$RentalAgencyCity',`address`='$RentalAgencyAddress' WHERE `userId` = '$RentalAgency'");
            if ($userCheck) {
                echo '<p class="text-success"><i class="fas fa-check-circle"></i> Profile Updated successfully.</p>';
            } else {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
            }
        }
        
    } else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled!</p>';
    }
}

if (isset($_SESSION['RentalAgency']) && isset($_FILES['RentalAgencyProfilePic']['name'])) {//&& isset($_POST['updateProfilePic'])
    if ( $_FILES['RentalAgencyProfilePic']['name']!="" ) {
        $RentalAgency = $_SESSION['RentalAgency'];
        $RentalAgencyProfilePicName = $_FILES['RentalAgencyProfilePic']['name'];
        $RentalAgencyProfilePicFile = $_FILES['RentalAgencyProfilePic']['tmp_name'];
        $userCheck = mysqli_query($connect,"SELECT * FROM `users` WHERE  `userId` = '$RentalAgency'");
        if (mysqli_num_rows($userCheck) == 1) {
            $selectRentalAgencyRow = mysqli_fetch_array($userCheck);
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'JPEG' , 'PNG' , 'JPG' , 'jfif');
            $path = './../assets/images/profilePics/';
            $ext = strtolower(pathinfo($RentalAgencyProfilePicName, PATHINFO_EXTENSION));
            $finalImage = strtolower($selectRentalAgencyRow['email'].".".$ext);
            $path1 = $path.($finalImage);
            if(!in_array($ext, $valid_extensions)){
                echo "Images extension can be 'jpeg', 'jpg', 'png', 'gif', 'JPEG' , 'PNG' , 'JPG' , 'jfif'";
            } elseif($_FILES['RentalAgencyProfilePic']['size'] > 5097152){
                echo "Image size must be exactly 5MB or below.";
            } else{
                if ($selectRentalAgencyRow['profileImage'] !="") {
                    $oldImg = $selectRentalAgencyRow['profileImage'];
                    unlink("./../assets/images/profilePics/$oldImg");
                }
                if (move_uploaded_file($RentalAgencyProfilePicFile,$path1)) {
                    $userCheck = mysqli_query($connect,"UPDATE `users` SET `profileImage`='$finalImage' WHERE `userId` = '$RentalAgency'");
                    if ($userCheck) {
                        echo '<p class="text-success"><i class="fas fa-check-circle"></i> Profile Updated successfully.</p>';
                    } else {
                        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
                    }
                }else{
                    $userCheck = mysqli_query($connect,"UPDATE `users` SET `profileImage`='' WHERE `userId` = '$RentalAgency'");
                }
            }
        }else {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
        }
    } else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Please Select the Profile Pic!</p>';
    }
}
// Rental Agency Car Pic Update
if (isset($_SESSION['RentalAgency']) && isset($_FILES['RentalAgencyCarPic']['name']) && isset($_POST['RentalAgencyCarNo'])) {
    if ($_POST['RentalAgencyCarNo'] !="" && $_FILES['RentalAgencyCarPic']['name']!="") {
        $RentalAgency = $_SESSION['RentalAgency'];
        $RentalAgencyCarNo = $_POST['RentalAgencyCarNo'];
        $RentalAgencyCarPicName = $_FILES['RentalAgencyCarPic']['name'];
        $RentalAgencyCarPicFile = $_FILES['RentalAgencyCarPic']['tmp_name'];
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'JPEG' , 'PNG' , 'JPG' , 'jfif');
        $path = './../assets/images/vehicleImages/';
        $ext = strtolower(pathinfo($RentalAgencyCarPicName, PATHINFO_EXTENSION));
        $finalImage = strtolower($RentalAgencyCarNo.".".$ext);
        $path1 = $path.($finalImage);
        if(!in_array($ext, $valid_extensions)){
            echo "Images extension can be 'jpeg', 'jpg', 'png', 'gif', 'JPEG' , 'PNG' , 'JPG' , 'jfif'";
        } elseif($_FILES['RentalAgencyCarPic']['size'] > 5097152){
            echo "Image size must be exactly 5MB or below.";
        } else{
            $selectCarRow = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM `vehicleList` WHERE `vehicleNo` = '$RentalAgencyCarNo' AND `userId` = '$RentalAgency' "));
            if ($selectCarRow['vehicleImage'] !="") {
                $oldImg =$selectCarRow['vehicleImage'];
                unlink("./../assets/images/vehicleImages/$oldImg");
            }
            if (move_uploaded_file($RentalAgencyCarPicFile,$path1)) {
                $updateImage = mysqli_query($connect,"UPDATE `vehicleList` SET `vehicleImage`='$finalImage' WHERE `vehicleNo` = '$RentalAgencyCarNo' AND `userId` = '$RentalAgency'");
                if ($updateImage) {
                    echo '<p class="text-success"><i class="fas fa-check-circle"></i> Image Updated successfully.</p>';
                } else {
                    echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
                }
            }else {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
            }
        }

    } else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Please select the Image!</p>';
    }
    
}
// Rental Agency Car Data Update
if (isset($_POST['updateRentalAgencyCarNo']) && isset($_POST['updateRentalAgencyCarModel']) && isset($_POST['updateRentalAgencyCarSeatingCapacity']) && isset($_POST['updateRentalAgencyCarRentPerDay']) && isset($_SESSION['RentalAgency']) && isset($_POST['RentalAgencyCarNo'])) {
    if ($_POST['updateRentalAgencyCarNo'] != "" &&  $_POST['updateRentalAgencyCarModel'] != "" && $_POST['updateRentalAgencyCarSeatingCapacity'] != "" && $_POST['updateRentalAgencyCarRentPerDay'] != "" ) {
        $RentalAgency = $_SESSION['RentalAgency'];
        $RentalAgencyCarNo = $_POST['RentalAgencyCarNo'];
        $updateRentalAgencyCarNo = strtoupper($connect -> real_escape_string($_POST['updateRentalAgencyCarNo']));
        $updateRentalAgencyCarModel = strtoupper($connect -> real_escape_string($_POST['updateRentalAgencyCarModel']));
        $updateRentalAgencyCarSeatingCapacity = $connect -> real_escape_string($_POST['updateRentalAgencyCarSeatingCapacity']);
        $updateRentalAgencyCarRentPerDay = $connect -> real_escape_string($_POST['updateRentalAgencyCarRentPerDay']);
        if (strlen($updateRentalAgencyCarNo) < 10) {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, Invalid Vehicle No</p>';
        }else {
            $userCheck = mysqli_query($connect,"UPDATE `vehicleList` SET `vehicleNo`='$updateRentalAgencyCarNo',`vehicleModel`='$updateRentalAgencyCarModel',`seatingCapacity`='$updateRentalAgencyCarSeatingCapacity',`rentPerDay`='$updateRentalAgencyCarRentPerDay' WHERE `vehicleNo` = '$RentalAgencyCarNo'");
            if ($userCheck) {
                $updateBookings = mysqli_query($connect,"UPDATE `carBookings` SET `vehicleNo`='$updateRentalAgencyCarNo' WHERE `vehicleNo` = '$RentalAgencyCarNo'");
                echo '<p class="text-success"><i class="fas fa-check-circle"></i> .'.$updateRentalAgencyCarNo.'. Car Details Updated successfully.</p>';
            } else {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
            }
        }
        
    } else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled!</p>';
    }
}
//  Booking Requests
if (isset($_POST['bookingRequests'])) {
    $LIMIT = 10;
    $selectBookingList = "
        SELECT * FROM `carBookings` WHERE `status` = '0'
    ";
    if (isset($_POST['ShowRows'])) {
        if ($_POST['ShowRows'] == "") {
            $LIMIT = 10;
        }elseif ($_POST['ShowRows'] == "More") {
            $LIMIT = 1000000000000;
        } else{
            $LIMIT = $connect -> real_escape_string($_POST['ShowRows']);
        }
    }
    $selectBookingList .= "LIMIT $LIMIT";
    $selectBookingListSql = mysqli_query($connect,$selectBookingList);
    if (mysqli_num_rows($selectBookingListSql) >= 1) {
        $i=1;
        while ($selectBookingRow=mysqli_fetch_array($selectBookingListSql)) {?>
            <tr>
                <th scope="row"><?PHP echo $i;?></th>
                <td>CRA<?PHP echo $selectBookingRow['bookingId'];?></td>
                <td><?PHP echo $selectBookingRow['vehicleNo'];?></td>
                <td><?PHP echo $selectBookingRow['noDays'];?></td>
                <td><?PHP echo $selectBookingRow['startingDate'];?></td>
                <td><a href="#" onclick="viewCustomer('<?PHP echo $selectBookingRow['userId'];?>')" class="btn btn-warning"><i class="fas fa-eye text-white"></i></a></td>
                <td><a href="#" onclick="acceptBookingRequest('<?PHP echo $selectBookingRow['bookingId'];?>')" class="btn btn-success"><i class="fas fa-check-double text-white"></i></a></td>
                <td><a href="#" onclick="rejectBookingRequest('<?PHP echo $selectBookingRow['bookingId'];?>')" class="btn btn-danger"><i class="fas fa-trash-alt text-white"></i></a></td>
			</tr>
        <?PHP $i++;}
    } else {?>
        <tr>
            <th scope="row" colspan="8" class="bg-danger text-md-center text-white"><i class="far fa-frown"></i> No Data Found!</th>
        </tr>
    <?PHP }
}
//Accept Booking Request
if (isset($_POST['acceptBookingRequest']) && isset($_POST['bookingId']) && $_POST['bookingId'] !="") {
    $bookingId  = $_POST['bookingId'];
    $accept = mysqli_query($connect,"UPDATE `carBookings` SET `status`='1' WHERE `bookingId` = '$bookingId'");
    if ($accept) {
        echo '<p class="text-success"><i class="fas fa-check-circle"></i> Successfully accepted</p>';
    }else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
    }
}
//Rejected Booking Request
if (isset($_POST['rejectBookingRequest']) && isset($_POST['bookingId']) && $_POST['bookingId'] !="") {
    $bookingId  = $_POST['bookingId'];
    $selectBookedCar = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM `carBookings`WHERE `bookingId` = '$bookingId' "));
    $vehicleNo = $selectBookedCar['vehicleNo'];
    if (mysqli_query($connect,"UPDATE `vehicleList` SET `VehicleStatus`='0' WHERE `vehicleNo` = '$vehicleNo'")) {
        $Rejected = mysqli_query($connect,"UPDATE `carBookings` SET `status`='2' WHERE `bookingId` = '$bookingId'");
        if ($Rejected) {
            echo '<p class="text-success"><i class="fas fa-check-circle"></i> Successfully Rejected</p>';
        }else {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
        }
    }else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
    }
}