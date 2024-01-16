<?php
    //session_start();
    require_once ('dbconnect.php');
    $connection = dbconnect();

    if(isset($_SESSION['user'])){
        $userid = $_SESSION["user"];
    }

    $outputcontracts = '';
    if(isset($_POST["query"])){
        $search = mysqli_real_escape_string($connection, $_POST["query"]);
        $query = "SELECT * FROM `contracts` WHERE (`contractID` LIKE '".$search."%') or (`customerID` LIKE '".$search."%') or (`serviceID` LIKE '".$search."%') or (`contractName` LIKE '%".$search."%') or (`contractDesc` LIKE '".$search."%') or (`contractSite` LIKE '".$search."%') or (`initiationDate` LIKE '".$search."%') or (`deadline` LIKE '".$search."%') or (`endDate` LIKE '".$search."%') or (`contractStatus` LIKE '".$search."%') or (`grandTotal` LIKE '".$search."%') or (`registryDate` LIKE '".$search."%')";
    }else{
      if(isset($_POST["request"])){
        $request = $_POST["request"];
        $query = "SELECT * FROM contracts ORDER BY $request";
      }else{
        $query = "SELECT * FROM contracts";
      }
    }
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) > 0){
     $outputcontracts .= ' <div class="table-responsive">
       <table class="table table-bordered table-light rounded" id="contracts_table">
        <thead class="thead-dark">
        <tr>
        <th>Contract ID</th>
        <th>Customer ID</th>
        <th>Service ID</th>
        <th>Contract Name</th>
        <th>Contract Site</th>
        <th>Initiation Date</th>
        <th>Deadline</th>
        <th>Contract Status</th>
        <th>Grand Total</th>
        <th>Registry Date</th>
        <th colspan="3" class="d-print-none">Commands</th>
        </tr>
        </thead>';
     while($row = mysqli_fetch_array($result))
     {
      $outputcontracts .= '
       <tr id="row'. $row["contractID"].'">
            <td>' .$row["contractID"].'</td>
            <td>' .$row["customerID"]. '</td>
            <td>' .$row["serviceID"]. '</td>
            <td>' .$row["contractName"]. '</td>
            <td>' .$row["contractSite"]. '</td>
            <td>' .$row["initiationDate"]. '</td>
            <td>' .$row["deadline"]. '</td>
            <td>' .$row["contractStatus"]. '</td>
            <td>' .$row["grandTotal"]. '</td>
            <td>' .$row["registryDate"]. '</td>
            <td class="d-print-none"> <a href="viewcontract.php?id=' .$row['contractID']. '"><input type="button" class="btn btn-outline-secondary" value="View"></a></td>
            <td class="d-print-none"> <form method="POST" action="edit.php?id=' .$row['contractID']. '"><input type="submit" class="btn btn-outline-success" id="' .$row["contractID"]. '" value="Edit" name="editcontract"></form></td>
            <td class="d-print-none"> <form method="POST" action="delete.php?id=' .$row['contractID']. '"><input type="submit" class="btn btn-outline-danger" id="' .$row["contractID"]. '" value="Delete" name="deletecontract"></form></td>
       </tr>';
     }
    
     echo $outputcontracts;
    }else
    {
     echo '<div class="alert alert-warning text-center h5" role="alert">Data Not Found </div>';
    }

?>
