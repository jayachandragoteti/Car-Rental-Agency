<?php
include_once "./connect.php";
date_default_timezone_set('Asia/Kolkata');
session_start();
// mobile number validations Functions
function validate_mobile($mobile)
{
    return preg_match('/^[6-9]\d{9}$/', $mobile);
}
// end mobile number validations Functions
// =======================================================
// Booking Status Auto Change 
// $selectCars= mysqli_query($connect,"SELECT * FROM `vehicleList` WHERE `VehicleStatus` = '1'");
// if (mysqli_num_rows($selectCars) > 0 ) {
//     while ($selectCarsRows = mysqli_fetch_array($selectCars)) {
//         $vehicleNo = $selectCarsRows['vehicleNo'];
//         $selectBookedCars= mysqli_query($connect,"SELECT * FROM `carBookings` WHERE `status` = '1' AND `vehicleNo` = '$vehicleNo' ");
//         if (mysqli_num_rows($selectBookedCars) > 0 ) {
//             while($selectBookedCarsRows = mysqli_fetch_array($selectBookedCars)) {
//                 $noDays = $selectBookedCarsRows['noDays'];
//                 $startingDate =  $selectBookedCarsRows['startingDate'];
//                 $today = date('Y-m-d');
//                 $lastDate = date('Y-m-d', strtotime($Date. ' + '.$noDays));
//                 if ($lastDate > $today) {
//                     if (mysqli_query($connect,"UPDATE `vehicleList` SET `VehicleStatus`='0' WHERE `vehicleNo` = '$vehicleNo'")) {
//                         echo "";
//                     }
//                 }
//             }
//         }
//     }
// }

// End Booking Status Auto Change 
// =======================================================
// RentalAgency Registration
if (isset($_POST['RentalAgencyName']) && isset($_POST['RentalAgencyEmail']) && isset($_POST['RentalAgencyContactNo']) && isset($_POST['RentalAgencyCity']) && isset($_POST['RentalAgencyAddress']) && isset($_POST['RentalAgencyRegistrationNo']) && isset($_POST['RentalAgencyPassword']) && isset($_POST['RentalAgencyConfirmPassword']) && $_FILES['RentalAgencyDocument']) {
    if ($_POST['RentalAgencyName'] != "" &&  $_POST['RentalAgencyEmail'] != "" && $_POST['RentalAgencyContactNo'] != "" && $_POST['RentalAgencyCity'] != "" && $_POST['RentalAgencyAddress'] != "" && $_POST['RentalAgencyRegistrationNo'] != "" && $_POST['RentalAgencyPassword'] != "" && $_POST['RentalAgencyConfirmPassword'] != "" && $_FILES['RentalAgencyDocument']) {
        $RentalAgencyName = $connect->real_escape_string($_POST['RentalAgencyName']);
        $RentalAgencyEmail = $connect->real_escape_string($_POST['RentalAgencyEmail']);
        $RentalAgencyContactNo = $connect->real_escape_string($_POST['RentalAgencyContactNo']);
        $RentalAgencyCity = strtoupper($connect->real_escape_string($_POST['RentalAgencyCity']));
        $RentalAgencyAddress = $connect->real_escape_string($_POST['RentalAgencyAddress']);
        $RentalAgencyRegistrationNo = $connect->real_escape_string($_POST['RentalAgencyRegistrationNo']);
        $RentalAgencyPassword = $connect->real_escape_string($_POST['RentalAgencyPassword']);
        $RentalAgencyConfirmPassword = $connect->real_escape_string($_POST['RentalAgencyConfirmPassword']);
        $RentalAgencyDocumentName = $_FILES['RentalAgencyDocument']['name'];
        $RentalAgencyDocumentFile = $_FILES['RentalAgencyDocument']['tmp_name'];
        //echo $RentalAgencyName.$RentalAgencyEmail.$RentalAgencyContactNo.$RentalAgencyAddress.$RentalAgencyRegistrationNo.$RentalAgencyPassword.$RentalAgencyConfirmPassword.$RentalAgencyDocumentName;
        $userCheck = mysqli_query($connect, "SELECT * FROM `users` WHERE `users`.`email` = '$RentalAgencyEmail'");
        if (mysqli_num_rows($userCheck) == 0) {
            $valid_extensions = array('pdf', 'doc', 'docx');
            $path = './assets/images/Documents/';
            $ext = strtolower(pathinfo($RentalAgencyDocumentName, PATHINFO_EXTENSION));
            $finalImage = strtolower($RentalAgencyName . $RentalAgencyEmail . "." . $ext);
            $path1 = $path . ($finalImage);
            if ($RentalAgencyPassword != $RentalAgencyConfirmPassword) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Password and confirm password should be same!</p>';
            } elseif (!filter_var($RentalAgencyEmail, FILTER_VALIDATE_EMAIL)) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid email format!</p>';
            } elseif (!validate_mobile($RentalAgencyContactNo)) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid Contact Number format!</p>';
            } elseif (!in_array($ext, $valid_extensions)) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> File extension can be .pdf , .doc, .docx</p>';
            } elseif (strlen($RentalAgencyConfirmPassword) < 8) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Password should contain at least eight characters!</p>';
            } elseif ($_FILES['RentalAgencyDocument']['size'] > 5097152) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> File size must be exactly 5MB or below!</p>';
            } elseif (strlen($RentalAgencyRegistrationNo) < 5) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid Registration No Number!</p>';
            } elseif (move_uploaded_file($RentalAgencyDocumentFile, $path1)) { //
                $hashed_password = password_hash($RentalAgencyPassword, PASSWORD_DEFAULT);
                $RentalAgencyRegister = mysqli_query($connect, "INSERT INTO `users`(`name`, `email`, `contactNo`, `city`, `address`, `AadharNoOrAgencyRegistrationNo`, `document`, `password`,`loginType`) VALUES ('$RentalAgencyName','$RentalAgencyEmail','$RentalAgencyContactNo','$RentalAgencyCity','$RentalAgencyAddress','$RentalAgencyRegistrationNo','$finalImage','$hashed_password','0')") or die($connect->error);
                if ($RentalAgencyRegister) {
                    echo '<p class="text-success"><i class="fas fa-check-circle"></i> Rental Agency successfully registered.p>';
                } else {
                    unlink("./assets/images/Documents/$finalImage");
                    echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed, Try Again! </p>';
                }
            } else {
                //echo $finalImage;
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Document is not uploaded.Try Again!</p>';
            }
        } else {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> User already exists, Please login.</p>';
        }
    } else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled!</p>';
    }
}

// Customer Registration
if (isset($_POST['CustomersName']) && isset($_POST['CustomersEmail']) && isset($_POST['CustomersContactNo']) && isset($_POST['CustomersCity']) && isset($_POST['CustomersAddress']) && isset($_POST['AadharNumber']) && isset($_POST['CustomersPassword']) && isset($_POST['CustomersConfirmPassword']) && $_FILES['CustomersDocument']) {
    if ($_POST['CustomersName'] != "" &&  $_POST['CustomersEmail'] != "" && $_POST['CustomersContactNo'] != "" && $_POST['CustomersCity'] != "" && $_POST['CustomersAddress'] != "" && $_POST['AadharNumber'] != "" && $_POST['CustomersPassword'] != "" && $_POST['CustomersConfirmPassword'] != "" && $_FILES['CustomersDocument']) {
        $CustomersName = $connect->real_escape_string($_POST['CustomersName']);
        $CustomersEmail = $connect->real_escape_string($_POST['CustomersEmail']);
        $CustomersContactNo = $connect->real_escape_string($_POST['CustomersContactNo']);
        $CustomersCity = strtoupper($connect->real_escape_string($_POST['CustomersCity']));
        $CustomersAddress = $connect->real_escape_string($_POST['CustomersAddress']);
        $AadharNumber = $connect->real_escape_string($_POST['AadharNumber']);
        $CustomersPassword = $connect->real_escape_string($_POST['CustomersPassword']);
        $CustomersConfirmPassword = $connect->real_escape_string($_POST['CustomersConfirmPassword']);
        $CustomersDocumentName = $_FILES['CustomersDocument']['name'];
        $CustomersDocumentFile = $_FILES['CustomersDocument']['tmp_name'];
        //echo $CustomersName.$CustomersEmail.$CustomersContactNo.$CustomersAddress.$AadharNumber.$CustomersPassword.$CustomersConfirmPassword.$CustomersDocumentName;
        $userCheck = mysqli_query($connect, "SELECT * FROM `users` WHERE `users`.`email` = '$CustomersEmail'");
        if (mysqli_num_rows($userCheck) == 0) {
            $valid_extensions = array('pdf', 'doc', 'docx');
            $path = './assets/images/Documents/';
            $ext = strtolower(pathinfo($CustomersDocumentName, PATHINFO_EXTENSION));
            $finalImage = strtolower($CustomersName . $CustomersEmail . "." . $ext);
            $path1 = $path . ($finalImage);
            if ($CustomersPassword != $CustomersConfirmPassword) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Password and confirm password should be same!</p>';
            } elseif (!in_array($ext, $valid_extensions)) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> File extension can be .pdf , .doc, .docx</p>';
            } elseif (!filter_var($CustomersEmail, FILTER_VALIDATE_EMAIL)) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid email format!</p>';
            } elseif ($_FILES['CustomersDocument']['size'] > 5097152) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> File size must be exactly 5MB or below!</p>';
            } elseif (!validate_mobile($CustomersContactNo)) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid Contact Number format!</p>';
            } elseif (strlen($CustomersConfirmPassword) < 8) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Password should contain at least eight characters!</p>';
            } elseif (strlen($AadharNumber) < 12) {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid Aadhar Number!</p>';
            } elseif (move_uploaded_file($CustomersDocumentFile, $path1)) {
                $hashed_password = password_hash($CustomersPassword, PASSWORD_DEFAULT);
                $CustomersRegister = mysqli_query($connect, "INSERT INTO `users`( `name`, `email`, `contactNo`, `city`, `address`, `AadharNoOrAgencyRegistrationNo`, `document`, `password`, `loginType`) VALUES ('$CustomersName','$CustomersEmail','$CustomersContactNo','$CustomersCity','$CustomersAddress','$AadharNumber','$finalImage','$hashed_password','1')");
                if ($CustomersRegister) {
                    echo '<p class="text-success"><i class="fas fa-check-circle"></i> Rental Agency successfully registered.</p>';
                } else {
                    unlink("./assets/images/Documents/$finalImage");
                    echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed, Try Again!</p>';
                }
            } else {
                //echo $finalImage;
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Document is not uploaded.Try Again!</p>';
            }
        } else {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> User already exists!</p>';
        }
    } else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled!</p>';
    }
}

// User Login
if (isset($_POST['UserLogin'])) {
    if (!isset($_POST['loginEmail']) || $_POST['loginEmail'] == "" || !isset($_POST['loginPassword']) || $_POST['loginPassword'] == "") {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled!</p>';
    } else {
        $loginEmail = $connect->real_escape_string($_POST['loginEmail']);
        $loginPassword = $connect->real_escape_string($_POST['loginPassword']);
        // Login Type Check
        $searchUser = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$loginEmail'");
        if (mysqli_num_rows($searchUser) == 1) {
            $searchUserRow = mysqli_fetch_array($searchUser);
            // If the password inputs matched the hashed password in the database
            if (password_verify($loginPassword, $searchUserRow['password'])) {
                if ($searchUserRow['loginType'] == "0") {
                    //session_start();
                    $_SESSION['RentalAgency'] = $searchUserRow['userId'];
                    echo 'loggedSuccessfully.';
                } elseif ($searchUserRow['loginType'] == "1") {
                    //session_start();
                    $_SESSION['Customer'] = $searchUserRow['userId'];
                    echo 'loggedSuccessfully.';
                } else {
                    echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> login failed, try again!</p>';
                }
            } else {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid Password!</p>';
            }
        } else {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid login!</p>';
        }
    }
}
// Update Password
if (isset($_POST['UpdatePassword']) && isset($_SESSION['Customer'])) {
    if (isset($_POST['oldPassword']) && $_POST['oldPassword'] != "" && isset($_POST['newPassword']) && $_POST['newPassword'] != "" && isset($_POST['confirmPassword']) && $_POST['confirmPassword'] != "") {
        $Customer = $_SESSION['Customer'];
        $newPassword = $connect->real_escape_string($_POST['newPassword']);
        $confirmPassword = $connect->real_escape_string($_POST['confirmPassword']);
        if ($newPassword != $confirmPassword) {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Password and confirm password should be same!</p>';
        } elseif (strlen($newPassword) < 8) {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Password should contain at least eight characters!</p>';
        } else {
            $selectCustomer = mysqli_query($connect, "SELECT * FROM `users` WHERE `userId` = '$Customer'");
            if ($selectCustomer && mysqli_num_rows($selectCustomer) == 1) {
                $selectCustomerRow = mysqli_fetch_array($selectCustomer);
                $oldPassword = $connect->real_escape_string($_POST['oldPassword']);
                if (password_verify($oldPassword, $selectCustomerRow['password'])) {
                    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updatePassword = mysqli_query($connect, "UPDATE `users` SET `password`='$hashed_password' WHERE `userId` = '$Customer'");
                    if ($updatePassword) {
                        echo '<p class="text-success"><i class="fas fa-check-circle"></i> Password Updated successfully.</p>';
                    } else {
                        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
                    }
                } else {
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

// Customer Profile

if (isset($_POST['CustomersName']) && isset($_POST['CustomersEmail']) && isset($_POST['CustomersContactNo']) && isset($_POST['CustomersCity']) && isset($_POST['CustomersAddress']) && !isset($_POST['AadharNumber']) && !isset($_POST['CustomersPassword']) && !isset($_POST['CustomersConfirmPassword']) && isset($_SESSION['Customer'])) {
    if ($_POST['CustomersName'] != "" &&  $_POST['CustomersEmail'] != "" && $_POST['CustomersContactNo'] != "" && $_POST['CustomersCity'] != "" && $_POST['CustomersAddress'] != "") {
        $Customer = $_SESSION['Customer'];
        $CustomersName = $connect->real_escape_string($_POST['CustomersName']);
        $CustomersEmail = $connect->real_escape_string($_POST['CustomersEmail']);
        $CustomersContactNo = $connect->real_escape_string($_POST['CustomersContactNo']);
        $CustomersCity = $connect->real_escape_string($_POST['CustomersCity']);
        $CustomersAddress = $connect->real_escape_string($_POST['CustomersAddress']);
        if (!validate_mobile($CustomersContactNo)) {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid Contact Number format!</p>';
        } elseif (!filter_var($CustomersEmail, FILTER_VALIDATE_EMAIL)) {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid email format!</p>';
        } else {
            $userCheck = mysqli_query($connect, "UPDATE `users` SET `name`='$CustomersName',`email`='$CustomersEmail',`contactNo`='$CustomersContactNo',`city`='$CustomersCity',`address`='$CustomersAddress' WHERE `userId` = '$Customer'");
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

if (isset($_SESSION['Customer']) && isset($_FILES['CustomersProfilePic']['name'])) { //&& isset($_POST['updateProfilePic'])
    if ($_FILES['CustomersProfilePic']['name'] != "") {
        $Customer = $_SESSION['Customer'];
        $CustomersProfilePicName = $_FILES['CustomersProfilePic']['name'];
        $CustomersProfilePicFile = $_FILES['CustomersProfilePic']['tmp_name'];
        $userCheck = mysqli_query($connect, "SELECT * FROM `users` WHERE  `userId` = '$Customer'");
        if (mysqli_num_rows($userCheck) == 1) {
            $selectCustomerRow = mysqli_fetch_array($userCheck);
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'JPEG', 'PNG', 'JPG', 'jfif');
            $path = './assets/images/profilePics/';
            $ext = strtolower(pathinfo($CustomersProfilePicName, PATHINFO_EXTENSION));
            $finalImage = strtolower($selectCustomerRow['email'] . "." . $ext);
            $path1 = $path . ($finalImage);
            if (!in_array($ext, $valid_extensions)) {
                echo "Images extension can be 'jpeg', 'jpg', 'png', 'gif', 'JPEG' , 'PNG' , 'JPG' , 'jfif'";
            } elseif ($_FILES['CustomersProfilePic']['size'] > 5097152) {
                echo "Image size must be exactly 5MB or below.";
            } else {
                if ($selectCustomerRow['profileImage'] != "") {
                    $oldImg = $selectCustomerRow['profileImage'];
                    unlink("./assets/images/profilePics/$oldImg");
                }
                if (move_uploaded_file($CustomersProfilePicFile, $path1)) {
                    $userCheck = mysqli_query($connect, "UPDATE `users` SET `profileImage`='$finalImage' WHERE `userId` = '$Customer'");
                    if ($userCheck) {
                        echo '<p class="text-success"><i class="fas fa-check-circle"></i> Profile pic updated successfully.</p>';
                    } else {
                        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
                    }
                } else {
                    $userCheck = mysqli_query($connect, "UPDATE `users` SET `profileImage`='' WHERE `userId` = '$Customer'");
                }
            }
        } else {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
        }
    } else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Please select profile pic!</p>';
    }
}

// Available Cars
if (isset($_POST['AvailableCarsResponse'])) {
    $LIMIT = 10;
    $selectCarsQuery = "
        SELECT * FROM `vehicleList` WHERE `vehicleNo` != '0'
    ";
    if (isset($_POST['City']) && $_POST['City'] != "") {
        $City = $connect->real_escape_string(strtoupper($_POST['City']));
        $selectUsers = mysqli_query($connect, "SELECT * FROM `users` WHERE `city` = '$City' AND `loginType` = '0'");
        if (mysqli_num_rows($selectUsers) > 0) {
            $selectUsersRow = mysqli_fetch_array($selectUsers);
            $users = $selectUsersRow['userId'];
            $selectCarsQuery .= "AND `userId` IN ('$users')";
        }
    }
    if (isset($_POST['availableCarsGroupFilter']) && $_POST['availableCarsGroupFilter'] != "") {
        $vehicleModel = $connect->real_escape_string($_POST['availableCarsGroupFilter']);
        $selectCarsQuery .= "AND `vehicleModel` = '$vehicleModel'";
    }
    if (isset($_POST['seatingCapacity']) && $_POST['seatingCapacity'] != "") {
        $seatingCapacity = $connect->real_escape_string($_POST['seatingCapacity']);
        $selectCarsQuery .= "AND `seatingCapacity` = '$seatingCapacity'";
    }
    if (isset($_POST['availabilityFilter']) && $_POST['availabilityFilter'] != "") {
        $availabilityFilter = $connect->real_escape_string($_POST['availabilityFilter']);
        $selectCarsQuery .= "AND `VehicleStatus` = '$availabilityFilter'";
    }
    if (isset($_POST['ShowRows'])) {
        if ($_POST['ShowRows'] == "") {
            $LIMIT = 10;
        } elseif ($_POST['ShowRows'] == "More") {
            $LIMIT = 1000000000000;
        } else {
            echo $LIMIT = $connect->real_escape_string($_POST['ShowRows']);
        }
    }
    $selectCarsQuery .= "LIMIT $LIMIT";
    $selectCarsSql = mysqli_query($connect, $selectCarsQuery);
    if (mysqli_num_rows($selectCarsSql) != 0) {
        $i = 1;
        while ($selectCarsRow = mysqli_fetch_array($selectCarsSql)) {
            $SelectUserId = $selectCarsRow['userId'];
            $SelectUserIdSql = mysqli_query($connect, "SELECT * FROM `users` WHERE `userId` = '$SelectUserId'");
            $SelectUserIdRow = mysqli_fetch_array($SelectUserIdSql);
?>
            <tr class="p-2">
                <td><?PHP echo $i; ?></td>
                <td><?PHP echo $SelectUserIdRow['city']; ?></td>
                <td><?PHP echo $selectCarsRow['vehicleNo']; ?></td>
                <td><?PHP echo $selectCarsRow['vehicleModel']; ?></td>
                <td><?PHP echo $selectCarsRow['seatingCapacity']; ?></td>
                <td><?PHP echo ($selectCarsRow['VehicleStatus'] == 1) ? '<span class="badge bg-danger">Booked</span>' : '<span class="badge bg-success">Open to Book</span>'; ?></td>
                <td><a href="#" onclick="viewCarDetails('<?PHP echo $selectCarsRow['vehicleNo']; ?>')" class="btn btn-warning"><i class="fas fa-eye text-white"></i></a></td>
            </tr>
        <?PHP $i++;
        }
    } else { ?>
        <tr class="p-2 text-center">
            <th colspan='7'><span class="btn btn-danger btn-sm "><i class="far fa-frown"></i> No Data Found!</span></th>
        </tr>
        <?PHP }
}

//  Book Your Car
if (isset($_POST['bookYourCar']) && isset($_POST['vehicleNo']) && isset($_SESSION['Customer']) && isset($_POST['noDaysToRent']) && isset($_POST['startingDate'])) {
    if ($_POST['vehicleNo'] != "" && $_POST['noDaysToRent'] != "" && $_POST['startingDate'] != "") {
        $Customer = $_SESSION['Customer'];
        $vehicleNo = $_POST['vehicleNo'];
        $noDaysToRent = $connect->real_escape_string($_POST['noDaysToRent']);
        $startingDate = $connect->real_escape_string($_POST['startingDate']);
        $selectCar = mysqli_query($connect, "SELECT * FROM `vehicleList` WHERE `vehicleNo` = '$vehicleNo' AND `VehicleStatus` = '0'");
        if (mysqli_num_rows($selectCar) == 1) {
            $selectCarRows = mysqli_fetch_array($selectCar);
            $totalCost = $noDaysToRent * $selectCarRows['rentPerDay'];
            $carStatus = mysqli_query($connect, "UPDATE `vehicleList` SET `VehicleStatus` = '1' WHERE `vehicleNo` = '$vehicleNo' AND `VehicleStatus` = '0'");
            if ($carStatus) {
                $BookCar = mysqli_query($connect, "INSERT INTO `carBookings`(`userId`, `vehicleNo`, `noDays`, `startingDate`,`totalCost`, `status`) VALUES ('$Customer','$vehicleNo','$noDaysToRent','$startingDate','$totalCost','0')");
                if ($BookCar) {
                    echo '<p class="text-success"><i class="fas fa-check-circle"></i> Request submitted successfully.</p>';
                } else {
                    mysqli_query($connect, "UPDATE `vehicleList` SET `VehicleStatus`='0' WHERE `vehicleNo` = '$vehicleNo'");
                    echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
                }
            } else {
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
            }
        } else {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Already Booked!</p>';
        }
    } else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled!</p>';
    }
}

// My bookings List
if (isset($_POST['myBookingsList']) && isset($_SESSION['Customer'])) {
    $Customer = $_SESSION['Customer'];
    $selectBookings = mysqli_query($connect, "SELECT * FROM `carBookings` WHERE `userId` = '$Customer'");
    if (mysqli_num_rows($selectBookings) != 0) {
        $i = 1;
        while ($selectBookingsRow = mysqli_fetch_array($selectBookings)) {
            $vehicleNo = $selectBookingsRow['vehicleNo'];
            // $selectCar = mysqli_query($connect,"SELECT * FROM `vehicleList` WHERE `vehicleNo` = '$vehicleNo'");
            // $selectCarRow = mysqli_fetch_array($selectCar);
            $SelectUserIdSql = mysqli_query($connect, "SELECT * FROM `users` WHERE `userId` = ( SELECT `userId` FROM `vehicleList` WHERE `vehicleNo` ='$vehicleNo') ");
            $SelectUserIdRow = mysqli_fetch_array($SelectUserIdSql);
        ?>
            <tr class="p-2">
                <td><?PHP echo $selectBookingsRow['bookingId']; ?></td>
                <td><?PHP echo $vehicleNo; ?></td>
                <td><?PHP echo $SelectUserIdRow['name']; ?></td>
                <td><?PHP echo $selectBookingsRow['noDays']; ?></td>
                <td><?PHP echo $selectBookingsRow['startingDate']; ?></td>
                <td><?PHP echo $selectBookingsRow['totalCost']; ?></td>
                <td><?PHP if ($selectBookingsRow['status'] == 0) {
                        echo '<span class="badge bg-warning">Pending</span>';
                    } else {
                        echo ($selectBookingsRow['status'] == 1) ? '<span class="badge bg-success">Accepted</span>' : '<span class="badge bg-danger">Rejected</span>';
                    } ?></td>
            </tr>
        <?PHP $i++;
        }
    } else { ?>
        <tr class="p-2 text-center">
            <th colspan='7'><span class="btn btn-danger btn-sm "><i class="far fa-frown"></i> No Data Found!</span></th>
        </tr>
<?PHP }
}
