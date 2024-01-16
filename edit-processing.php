<?php
    session_start();
    require_once ('dbconnect.php');
    $connection = dbconnect();
    $userid = $_SESSION["user"];

    $_SESSION['alert']= "";

    $modalForm = "";

    if(isset($_POST["modalForm"])){
        $modalForm = $_POST["modalForm"];
    }

    if($modalForm == "editCustomer"){
        $customerID = mysqli_real_escape_string($connection, $_POST["newCustomerID"]);
        $customerType = mysqli_real_escape_string($connection, $_POST["newCustomerType"]) ;
        $fullName = mysqli_real_escape_string($connection, $_POST["newCustomerName"]) ;
        $email = mysqli_real_escape_string($connection, $_POST["newCustomerEmail"]) ;
        $phoneNumber = mysqli_real_escape_string($connection, $_POST["newCustomerPhone"]) ;
        $address = mysqli_real_escape_string($connection, $_POST["newCustomerAddress"]) ;
        $DOB = mysqli_real_escape_string($connection, $_POST["newCustomerDOB"]) ;

        $query = "UPDATE customers SET customerType='$customerType', fullName='$fullName', 
                email='$email', phoneNumber='$phoneNumber', addr='$address', DOB='$DOB'  WHERE customerID=\"$customerID\"";
        $ret = mysqli_query($connection, $query);

        if($ret){
            header("location:index1.php?page=customers");
            $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Customer succesfully updated.</span></div>';
        }else{
            header("location:index1.php?page=customers");
            $_SESSION['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "editContract"){
        $contractID = mysqli_real_escape_string($connection, $_POST["newContractID"]);
        $serviceID = mysqli_real_escape_string($connection, $_POST["newServiceID"]);
        $contractName = mysqli_real_escape_string($connection, $_POST["newContractName"]);
        $contractDesc = mysqli_real_escape_string($connection, $_POST["newContractDesc"]);
        $site = mysqli_real_escape_string($connection, $_POST["newContractSite"]);
        $initiationDate = mysqli_real_escape_string($connection, $_POST["newInitiationDate"]);
        $deadline = mysqli_real_escape_string($connection, $_POST["newDeadline"]);
        $endDate = mysqli_real_escape_string($connection, $_POST["newEndDate"]);
        $contractStatus = mysqli_real_escape_string($connection, $_POST["newContractStatus"]);
        $grandTotal = mysqli_real_escape_string($connection, $_POST["newGrandTotal"]);

        $query2 = "UPDATE contracts SET serviceID='$serviceID', contractName='$contractName',
                    contractDesc='$contractDesc', contractSite='$site', initiationDate='$initiationDate',
                    deadline='$deadline', endDate='$endDate', contractStatus='$contractStatus', grandTotal='$grandTotal' WHERE contractID=\"$contractID\"";
        $ret2 = mysqli_query($connection, $query2);

        if($ret2){
            header("location:index1.php?page=contracts");
            $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Contract succesfully updated.</span></div>';
        }else{
            header("location:index1.php?page=contracts");
            $_SESSION['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "editPayment"){
        $paymentID = mysqli_real_escape_string($connection, $_POST["newPaymentID"]);
        $paymentMethodID = mysqli_real_escape_string($connection, $_POST["newPaymentMethodID"]);
        $paymentDate = mysqli_real_escape_string($connection, $_POST["newPaymentDate"]);
        $amountPaid = mysqli_real_escape_string($connection, $_POST["newAmountPaid"]);
        $amountToPay = mysqli_real_escape_string($connection, $_POST["newAmountToPay"]);

        $query3 = "UPDATE payments SET paymentMethodID='$paymentMethodID',paymentDate='$paymentDate', 
                    amountPaid='$amountPaid', amountToPay='$amountToPay' WHERE paymentID=\"$paymentID\"";
        $ret3 = mysqli_query($connection, $query3);

        if($ret3){
            header("location:index1.php?page=payments");
            $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Payment succesfully updated.</span></div>';
        }else{
            header("location:index1.php?page=payments");
            $_SESSION['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "editService"){
        $serviceID = mysqli_real_escape_string($connection, $_POST["newServiceID"]);
        $serviceName = mysqli_real_escape_string($connection, $_POST["newServiceName"]);
        $serviceDesc = mysqli_real_escape_string($connection, $_POST["newServiceDesc"]);

        $query4 = "UPDATE service_offerings SET serviceName='$serviceName', serviceDesc='$serviceDesc' WHERE serviceID=\"$serviceID\"";
        $ret4 = mysqli_query($connection, $query4);

        if($ret4){
            header("location:index1.php?page=service_offerings");
            $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Service Offering succesfully updated.</span></div>';
        }else{
            header("location:index1.php?page=service_offerings");
            $_SESSION['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "editUser"){
        $userID = mysqli_real_escape_string($connection, $_POST["newUserID"]);
        $firstName = mysqli_real_escape_string($connection, $_POST["newFirstname"]);
        $lastName = mysqli_real_escape_string($connection, $_POST["newLastname"]);
        $email = mysqli_real_escape_string($connection, $_POST["newEmail"]);
        $phoneNumber = mysqli_real_escape_string($connection, $_POST["newPhoneNumber"]);
        $userRole = mysqli_real_escape_string($connection, $_POST["newUserRole"]);
        $username = mysqli_real_escape_string($connection, $_POST["newUsername"]);

        $query5 = "UPDATE users SET firstName='$firstName', lastName='$lastName', email='$email',
                    phoneNumber='$phoneNumber', userRole='$userRole', username='$username' WHERE userID =\"$userID\"";
        $ret5 = mysqli_query($connection, $query5);
            
        if($ret5){
            header("location:index1.php?page=users");
            $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">User succesfully updated.</span></div>';
        }else{
            header("location:index1.php?page=users");
            $_SESSION['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "editCustomer2"){
        $customerID = mysqli_real_escape_string($connection, $_POST["newCustomerID"]);
        $customerType = mysqli_real_escape_string($connection, $_POST["newCustomerType"]) ;
        $fullName = mysqli_real_escape_string($connection, $_POST["newCustomerName"]) ;
        $email = mysqli_real_escape_string($connection, $_POST["newCustomerEmail"]) ;
        $phoneNumber = mysqli_real_escape_string($connection, $_POST["newCustomerPhone"]) ;
        $address = mysqli_real_escape_string($connection, $_POST["newCustomerAddress"]) ;
        $DOB = mysqli_real_escape_string($connection, $_POST["newCustomerDOB"]) ;

        $query6 = "UPDATE customers SET customerType='$customerType', fullName='$fullName', 
                email='$email', phoneNumber='$phoneNumber', addr='$address', DOB='$DOB'  WHERE customerID=\"$customerID\"";
        $ret6 = mysqli_query($connection, $query6);

        if($ret6){
            header("location:viewcustomer.php?id=$customerID");
            $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Customer succesfully updated.</span></div>';
        }else{
            header("location:viewcustomer.php?id=$customerID");
            $_SESSION['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    }else if ($modalForm == "editContract2"){
        $contractID = mysqli_real_escape_string($connection, $_POST["newContractID"]);
        $customerID = mysqli_real_escape_string($connection, $_POST["newCustomerID"]);
        $serviceID = mysqli_real_escape_string($connection, $_POST["newServiceID"]);
        $contractName = mysqli_real_escape_string($connection, $_POST["newContractName"]);
        $contractDesc = mysqli_real_escape_string($connection, $_POST["newContractDesc"]);
        $site = mysqli_real_escape_string($connection, $_POST["newContractSite"]);
        $initiationDate = mysqli_real_escape_string($connection, $_POST["newInitiationDate"]);
        $deadline = mysqli_real_escape_string($connection, $_POST["newDeadline"]);
        $endDate = mysqli_real_escape_string($connection, $_POST["newEndDate"]);
        $contractStatus = mysqli_real_escape_string($connection, $_POST["newContractStatus"]);
        $grandTotal = mysqli_real_escape_string($connection, $_POST["newGrandTotal"]);

        $query7 = "UPDATE contracts SET serviceID='$serviceID', contractName='$contractName',
                    contractDesc='$contractDesc', contractSite='$site', initiationDate='$initiationDate',
                    deadline='$deadline', endDate='$endDate', contractStatus='$contractStatus', grandTotal='$grandTotal' WHERE contractID=\"$contractID\"";
        $ret7 = mysqli_query($connection, $query7);

        if($ret7){
            header("location:viewcustomer.php?id=$customerID");
            $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Customer Contract succesfully updated.</span></div>';
        }else{
            header("location:viewcustomer.php?id=$customerID");
            $_SESSION['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error:' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "editContract3"){
        $contractID = mysqli_real_escape_string($connection, $_POST["newContractID"]);
        $customerID = mysqli_real_escape_string($connection, $_POST["newCustomerID"]);
        $serviceID = mysqli_real_escape_string($connection, $_POST["newServiceID"]);
        $contractName = mysqli_real_escape_string($connection, $_POST["newContractName"]);
        $contractDesc = mysqli_real_escape_string($connection, $_POST["newContractDesc"]);
        $site = mysqli_real_escape_string($connection, $_POST["newContractSite"]);
        $initiationDate = mysqli_real_escape_string($connection, $_POST["newInitiationDate"]);
        $deadline = mysqli_real_escape_string($connection, $_POST["newDeadline"]);
        $endDate = mysqli_real_escape_string($connection, $_POST["newEndDate"]);
        $contractStatus = mysqli_real_escape_string($connection, $_POST["newContractStatus"]);
        $grandTotal = mysqli_real_escape_string($connection, $_POST["newGrandTotal"]);

        $query8 = "UPDATE contracts SET customerID='$customerID', serviceID='$serviceID', contractName='$contractName',
                    contractDesc='$contractDesc', contractSite='$site', initiationDate='$initiationDate',
                    deadline='$deadline', endDate='$endDate', contractStatus='$contractStatus', grandTotal='$grandTotal' WHERE contractID=\"$contractID\"";
        $ret8 = mysqli_query($connection, $query8);

        if($ret8){
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Contract succesfully updated.</span></div>';
        }else{
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error:' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "editActivity"){
        $contractID = mysqli_real_escape_string($connection, $_POST["newContractID"]);
        $activityID = mysqli_real_escape_string($connection, $_POST["newActivityID"]);
        $activityName = mysqli_real_escape_string($connection, $_POST["newActivityName"]);
        $activityDesc = mysqli_real_escape_string($connection, $_POST["newActivityDesc"]);
        $startDate = mysqli_real_escape_string($connection, $_POST["newStartDate"]);
        $finishDate = mysqli_real_escape_string($connection, $_POST["newFinishDate"]);
        $completionStatus = mysqli_real_escape_string($connection, $_POST["newCompletionStatus"]);

        $oldActivityID = mysqli_real_escape_string($connection, $_POST["oldActivityID"]);

        $query9 = "UPDATE contract_activities SET contractID='$contractID', activityID='$activityID',
                    activityName='$activityName', activityDesc='$activityDesc', startDate='$startDate',
                    finishDate='$finishDate', completionStatus='$completionStatus' WHERE contractID=\"$contractID\" AND activityID=\"$oldActivityID\"";
        $ret9 = mysqli_query($connection, $query9);

        if($ret9){
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Contract Activity succesfully updated.</span></div>';
        }else{
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error:' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "editPayment2"){
        $paymentID = mysqli_real_escape_string($connection, $_POST["newPaymentID"]);
        $contractID = mysqli_real_escape_string($connection, $_POST["newContractID"]);
        $paymentMethodID = mysqli_real_escape_string($connection, $_POST["newPaymentMethodID"]);
        $paymentDate = mysqli_real_escape_string($connection, $_POST["newPaymentDate"]);
        $amountPaid = mysqli_real_escape_string($connection, $_POST["newAmountPaid"]);
        $amountToPay = mysqli_real_escape_string($connection, $_POST["newAmountToPay"]);

        $query10 = "UPDATE payments SET paymentMethodID='$paymentMethodID', paymentDate='$paymentDate',
                    amountPaid='$amountPaid', amountToPay='$amountToPay' WHERE paymentID=\"$paymentID\"";
        $ret10 = mysqli_query($connection, $query10);

        if($ret10){
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Contract Payment succesfully updated.</span></div>';
        }else{
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error:' . mysqli_error($connection) . '</div>';
        }
    }
?>