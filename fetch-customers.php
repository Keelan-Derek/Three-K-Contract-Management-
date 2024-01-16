<?php
    //session_start();
    require_once ('dbconnect.php');
    $connection = dbconnect();

    if(isset($_SESSION['user'])){
        $userid = $_SESSION["user"];
    }

    $outputcustomers = '';
    if(isset($_POST["query"])){
        $search = mysqli_real_escape_string($connection, $_POST["query"]);
        $query = "SELECT * FROM `customers` WHERE (`customerID` LIKE '".$search."%') or (`customerType` LIKE '".$search."%') or (`fullName` LIKE '".$search."%') or (`email` LIKE '%".$search."%') or (`phoneNumber` LIKE '".$search."%') or (`addr` LIKE '".$search."%') or (`DOB` LIKE '".$search."%') or (`dateLastUpdated` LIKE '".$search."%')";
    }else{
      if(isset($_POST["request"])){
        $request = $_POST["request"];
        $query = "SELECT * FROM customers ORDER BY $request";
      }else{
        $query = "SELECT * FROM customers";
      }
    }
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) > 0){
     $outputcustomers .= ' <div class="table-responsive">
       <table class="table table-bordered table-light rounded" id="customers_table">
        <thead class="thead-dark">
        <tr>
        <th>Customer ID</th>
        <th>Customer Type</th>
        <th>Full Name</th>
        <th>Email </th>
        <th>Phone Number</th>
        <th>Address</th>
        <th>Date of Birth</th>
        <th>Date Last Updated</th>
        <th colspan="2" class="d-print-none">Commands</th>
        </tr>
        </thead>';
     while($row = mysqli_fetch_array($result))
     {
      $outputcustomers .= '
       <tr id="row'. $row["customerID"].'">
            <td>' .$row["customerID"].'</td>
            <td>' .$row["customerType"]. '</td>
            <td>' .$row["fullName"]. '</td>
            <td><a href="mailto:'.$row["email"].'">' .$row["email"]. '</a></td>
            <td>' .$row["phoneNumber"]. '</a></td>
            <td>' .$row["addr"]. '</td>
            <td>' .$row["DOB"]. '</td>
            <td>' .$row["dateLastUpdated"]. '</td>
            <td class="d-print-none"> <a href="viewcustomer.php?id=' .$row['customerID']. '"><input type="button" class="btn btn-outline-secondary" value="View"></a></td>
            <td class="d-print-none"> <form method="POST" action="edit.php?id=' .$row['customerID']. '"><input type="submit" class="btn btn-outline-success" id="' .$row["customerID"]. '" value="Edit" name="editcustomer"></form></td>   
       </tr>';
     }
    
     echo $outputcustomers;
    }else
    {
     echo '<div class="alert alert-warning text-center h5" role="alert">Data Not Found </div>';
    }

?>