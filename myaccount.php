<?php
    //session_start();
    require_once ('dbconnect.php');
    $connection = dbconnect();
    $userID = $_SESSION["user"];

    $query = "SELECT * FROM users WHERE userID='".$userID."' ";
    $ret = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($ret); 
?>

<!-- Update Processing -->

<?php

$update = "";

if(isset($_POST["form"])){
    $update = $_POST["form"];
}

if($update == "firstName"){
    if(isset($_POST["newFirstname"])){
        $firstname = mysqli_real_escape_string($connection, $_POST["newFirstname"]);
        $query = "UPDATE users SET firstName = '$firstname' WHERE userID = \"$userID\"";
        $ret = mysqli_query($connection, $query);
        if ($ret) {
            echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">First name succesfully updated.</span> &nbsp; Please reload page to see the effectuated change.</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error' . mysqli_error($connection) . '</div>';
        }
    }
}else if($update == "lastName"){
    if(isset($_POST["newLastname"])){
        $lastname = mysqli_real_escape_string($connection, $_POST["newLastname"]);
        $query = "UPDATE users SET lastName = '$lastname' WHERE userID = \"$userID\"";
        $ret = mysqli_query($connection, $query);
        if ($ret) {
            echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Last name succesfully updated.</span> &nbsp; Please reload page to see the effectuated change.</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error' . mysqli_error($connection) . '</div>';
        }
    }
}else if($update == "email"){
    if(isset($_POST["newEmail"])){
        $email = mysqli_real_escape_string($connection, $_POST["newEmail"]);
        $query = "UPDATE users SET email = '$email' WHERE userID = \"$userID\"";
        $ret = mysqli_query($connection, $query);
        if ($ret) {
            echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Email succesfully updated.</span> &nbsp; Please reload page to see the effectuated change.</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error' . mysqli_error($connection) . '</div>';
        }
    }
}else if($update == "phone"){
    if(isset($_POST["newPhone"])){
        $phone = mysqli_real_escape_string($connection, $_POST["newPhone"]);
        $query = "UPDATE users SET phoneNumber = '$phone' WHERE userID = \"$userID\"";
        $ret = mysqli_query($connection, $query);
        if ($ret) {
            echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Phone number succesfully updated.</span> &nbsp; Please reload page to see the effectuated change.</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error' . mysqli_error($connection) . '</div>';
        }
    }
}else if($update == "user"){
    if(isset($_POST["newUser"])){
        $username = mysqli_real_escape_string($connection, $_POST["newUser"]);
        $query = "UPDATE users SET username = '$username' WHERE userID = \"$userID\"";
        $ret = mysqli_query($connection, $query);
        if ($ret) {
            echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Username succesfully updated.</span> &nbsp; Please reload page to see the effectuated change.</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error' . mysqli_error($connection) . '</div>';
        }        
    }
}else{
    if(isset($_POST["newPass"])){
        $currpass = mysqli_real_escape_string($connection, $_POST["currentPass"]);
        $validpass = password_verify($currpass, $row['passw']);
        if($validpass){
            $password = mysqli_real_escape_string($connection, $_POST["newPass"]);
            $hashpass = password_hash($password, PASSWORD_BCRYPT);
            $query = "UPDATE users SET passw = '$hashpass' WHERE userID = \"$userID\"";
            $ret = mysqli_query($connection, $query);
            if ($ret) {
                echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Password succesfully updated.</span> &nbsp; Please reload page to see the effectuated change.</div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error' . mysqli_error($connection) . '</div>';
            }    
        }
    }
}

?>

<!-- End of Processing-->

<div class="page-content-wrapper">
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron pt-5 pb-4" style="background-color: rgb(255,212,170);">
                <h1 class="text-center">Welcome to Your Account Page, <span class="font-italic"> <?php if($_SESSION["login"] == true){ echo $_SESSION["firstname"]; } else {echo "NO USER";} ?>  !</span></h1>
                <p class="lead jumbo-content text-right font-weight-bold"><span class="font-italic">Date Last Updated:  </span><?php echo $row["dateLastUpdated"]; ?></p>
            </div>  
        </div>
    </div>

    <br>  
    <div class="container mb-3" id="personal-info">
        <hr>
        <h2 class="ml-3" id="personal-info-head">Personal Information</h2>
        <hr>
        <div class="table-responsive">
            <table class="account table table-borderless table-striped table-dark mt-3" id="tb-user-info">
                <tr>
                    <td class="font-weight-bold">First Name:</td>
                    <td><?php echo $row["firstName"] ?></td>
                    <td><button class="button btn btn-outline-info" data-toggle="modal" data-target="#firstnameEdit"><i class="fas fa-edit"></i> Update</button></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Last Name:</td>
                    <td><?php echo $row["lastName"] ?></td>
                    <td><button class="button btn btn-outline-info" data-toggle="modal" data-target="#lastnameEdit"><i class="fas fa-edit"></i> Update</button></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Email:</td>
                    <td><?php echo $row["email"] ?></td>
                    <td><button class="button btn btn-outline-info" data-toggle="modal" data-target="#emailEdit"><i class="fas fa-edit"></i> Update</button></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Phone Number:</td>
                    <td><?php echo $row["phoneNumber"] ?></td>
                    <td><button class="button btn btn-outline-info" data-toggle="modal" data-target="#phoneEdit"><i class="fas fa-edit"></i> Update</button></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="container mt-3 mb-3" id="account-settings">
        <hr>
        <h2 class="ml-3" id="account-settings-head">Account Settings</h2>
        <hr>
        <div class="table-responsive">
            <table class="account table table-borderless table-striped table-light mt-3" id="tb-account-set">
                <tr>
                    <td class="font-weight-bold">User ID:</td>
                    <td><?php echo $row["userID"] ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">User Role:</td>
                    <td><?php echo $row["userRole"] ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Username:</td>
                    <td><?php echo $row["username"] ?></td>
                    <td><button class="button btn btn-outline-success" data-toggle="modal" data-target="#userEdit"><i class="fas fa-edit"></i> Update</button></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Password:</td>
                    <td><?php echo $row["passw"] ?></td>
                    <td><button class="button btn btn-outline-success" data-toggle="modal" data-target="#passEdit"><i class="fas fa-edit"></i> Update</button></td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Update First Name Modal-->

    <div class="modal fade" id="firstnameEdit" data-toggle="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="changeFname" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold" id="changeFname">Change First Name</h3>
                    <button type="button" class="close" data-toggle="modal" data-dismiss="modal" aria-label="Close" title="Cancel">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body bg-light p-5">

                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="currentFirstname" class="col-form-label font-weight-bold">Current First Name: </label>
                            <div>
                                <input class="form-control" type="text" name="currentFirstname" id="currentFirstname" placeholder="<?php echo $row['firstName']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newFirstname" class="col-form-label font-weight-bold">Updated First Name: </label>
                            <div>
                                <input class="form-control" type="text" name="newFirstname" id="newFirstname" placeholder="Enter New Value" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <input type="hidden" name="form" value="firstName">
                        <button type="submit" class="btn btn-success" name="firstName" value="firstName">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal End-->

    <!-- Update Last Name Modal -->

    <div class="modal fade" id="lastnameEdit" data-toggle="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="changeLname" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold" id="changeLname">Change Last Name</h3>
                    <button type="button" class="close" data-toggle="modal" data-dismiss="modal" aria-label="Close" title="Cancel">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body bg-light p-5">

                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="currentLastname" class="col-form-label font-weight-bold">Current Last Name: </label>
                            <div>
                                <input class="form-control" type="text" name="currentLastname" id="currentLastname" placeholder="<?php echo $row['lastName']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newLastname" class="col-form-label font-weight-bold">Updated Last Name: </label>
                            <div>
                                <input class="form-control" type="text" name="newLastname" id="newLastname" placeholder="Enter New Value" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <input type="hidden" name="form" value="lastName">
                        <button type="submit" class="btn btn-success" name="lastName" value="lastName">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal End -->

    <!-- Update Email Modal -->

    <div class="modal fade" id="emailEdit" data-toggle="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="changeEmail" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold" id="changeEmail">Change Email Address</h3>
                    <button type="button" class="close" data-toggle="modal" data-dismiss="modal" aria-label="Close" title="Cancel">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body bg-light p-5">

                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="currentEmail" class="col-form-label font-weight-bold">Current Email Address: </label>
                            <div>
                                <input class="form-control" type="text" name="currentEmail" id="currentEmail" placeholder="<?php echo $row['email']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newEmail" class="col-form-label font-weight-bold">New Email Address: </label>
                            <div>
                                <input class="form-control" type="email" name="newEmail" id="newEmail" placeholder="Enter New Value" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <input type="hidden" name="form" value="email">
                        <button type="submit" class="btn btn-success" name="email" value="email">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal End -->

    <!-- Update Phone Number Modal-->

    <div class="modal fade" id="phoneEdit" data-toggle="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="changePhone" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold" id="changePhone">Change Phone Number</h3>
                    <button type="button" class="close" data-toggle="modal" data-dismiss="modal" aria-label="Close" title="Cancel">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body bg-light p-5">

                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="currentPhone" class="col-form-label font-weight-bold">Current Phone Number: </label>
                            <div>
                                <input class="form-control" type="text" name="currentPhone" id="currentPhone" placeholder="<?php echo $row['phoneNumber']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newPhone" class="col-form-label font-weight-bold">New Phone Number: </label>
                            <div>
                                <input class="form-control" type="text" name="newPhone" id="newPhone" placeholder="Enter New Value" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <input type="hidden" name="form" value="phone">
                        <button type="submit" class="btn btn-success" name="phone" value="phone">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal End -->

    <!-- Update Username Modal-->

    <div class="modal fade" id="userEdit" data-toggle="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="changeUsername" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold" id="changeUsername">Change Username</h3>
                    <button type="button" class="close" data-toggle="modal" data-dismiss="modal" aria-label="Close" title="Cancel">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body bg-light p-5">

                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="currentUser" class="col-form-label font-weight-bold">Current Username: </label>
                            <div>
                                <input class="form-control" type="text" name="currentUser" id="currentUser" placeholder="<?php echo $row['username']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newUser" class="col-form-label font-weight-bold">New Username: </label>
                            <div>
                                <input class="form-control" type="text" name="newUser" id="newUser" placeholder="Enter New Value" required>
                            </div>
                        </div>
            
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <input type="hidden" name="form" value="user">
                        <button type="submit" class="btn btn-info" name="user" value="user">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal End -->

    <!-- Update Password Modal-->

    <div class="modal fade" id="passEdit" data-toggle="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="changePassword" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold" id="changePassword">Change Password</h3>
                    <button type="button" class="close" data-toggle="modal" data-dismiss="modal" aria-label="Close" title="Cancel">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body bg-light p-5">

                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="currentPass" class="col-form-label font-weight-bold">Current Password: </label>
                            <div>
                                <input class="form-control" type="text" name="currentPass" id="currentPass" placeholder="Enter Current Pasword" aria-describedby="curpassNote" required>
                                <small id="currpassNote" class="form-text text-muted">Enter in the unhashed version of your current password.</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newPass" class="col-form-label font-weight-bold">New Password: </label>
                            <div>
                                <input class="form-control" type="password" name="newPass" id="newPass" placeholder="Enter New Password" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <input type="hidden" name="form" value="pass">
                        <button type="submit" class="btn btn-info" name="pass" value="pass">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal End -->


</div>
</div>
