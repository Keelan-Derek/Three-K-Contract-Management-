<?php
    session_start();

    $host = $_POST["localhost"];
    $dbuser = $_POST["dbuser"];
    $dbpass = $_POST["dbpass"];
    $database = $_POST["database"];

    $_SESSION["localhost"] = $host;
    $_SESSION["dbuser"] = $dbuser;
    $_SESSION["dbpass"] = $dbpass;
    $_SESSION["database"] = $database;

    $connection = mysqli_connect($host, $dbuser, $dbpass, $database);

    if(!$connection) {
        echo "<div class='alert alert-danger' role='alert'>Failed to connect: " . mysqli_connect_error() . "</div>";
        return mysqli_connect_error();
    } else{
        echo "<div class='alert alert-success' role='alert'> Connection successfully made! </div>";
    }

    $file ="config/config.ini";
    $current = array("host" => $host, "user" => $dbuser, "pass" => $dbpass, "dbname" => $database);
    
        file_put_contents($file, "host = " . $current["host"]. "\r\n");
        file_put_contents($file, "user = " . $current["user"]. "\r\n", FILE_APPEND);
        file_put_contents($file,"pass = " . $current["pass"]. "\r\n", FILE_APPEND);
        file_put_contents($file, "dbname = " . $current["dbname"]. "\r\n", FILE_APPEND);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    
    $sql = '';
    $count = 0;
    $db_data = file("threek_contract_management.sql");
    
    foreach ($db_data as $row){
        $start_character = substr(trim($row), 0, 2);
        if($start_character != '--' || $start_character != '/*' || $start_character != '//' || $row != ''){
            $sql = $sql . $row;
            $end_character = substr(trim($row), -1, 1);
            if($end_character == ';'){
                if(!mysqli_query($connection, $sql)){
                    $count++;
                }
                $sql = '';
            }
        }
    }
    if($count > 0)
    {
        echo "<div class='alert alert-danger' role='alert' text-danger> There is an error in the database configuration.</div>";
    } else {
        echo "<div class='alert alert-success' role='alert' text-success> Database Tables Successfully Imported</div>";
    }
    
    $file1 = "check.txt";
    $current1 = "Yes";
    
    if(file_put_contents($file1, $current1)){
        header('location:login.php');
    }
           
?>
