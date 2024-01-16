<?php

    session_start();
    $form=$_POST["form"];
    require ('dbconnect.php');
    $connection = dbconnect();

    if($form == "Signup"){
        $firstname = mysqli_real_escape_string($connection, $_POST["firstname"]);
        $lastname = mysqli_real_escape_string($connection, $_POST["lastname"]);
        $email = mysqli_real_escape_string($connection, $_POST["email"]);
        $phone = mysqli_real_escape_string($connection, $_POST["phoneNumber"]);
        $user = mysqli_real_escape_string($connection, $_POST["username"]);
        $passw = mysqli_real_escape_string($connection, $_POST["password"]);
        $hashpass = password_hash($passw, PASSWORD_BCRYPT);

        $query = "SELECT username, passw FROM users";
        $ret = mysqli_query($connection, $query);
        $num_rows = mysqli_num_rows($ret);
        $match = 0;

        for($i=0;$i < $num_rows; $i++){
            $row = mysqli_fetch_array($ret);
            if($row["username"]== $user){
                echo "This username is currently in use.";
                $match = 1;
                break;
            }
        }
        if($match==0){
            if(isset($_POST["userRole"])){
                $userrole = mysqli_real_escape_string($connection, $_POST["userRole"]);
                $query="INSERT INTO users(firstName, lastName, email, phoneNumber, userRole, username, passw)
                        VALUES ('$firstname', '$lastname', '$email', '$phone', '$userrole', '$user', '$hashpass')";
                $ret1 = mysqli_query($connection, $query);
                if($ret1){
                    $last_id = mysqli_insert_id($connection);
                    $_SESSION["user"] = $last_id;
                    $query2 = "SELECT * FROM users WHERE userID='".$last_id."' ";
                    $result = mysqli_query($connection, $query2);
                    $row = mysqli_fetch_array($result);
                    $_SESSION["firstname"] = $row["firstName"]; 
                    $_SESSION["login"] = true;
                    header('location:index1.php?page=home');
                }else{
                    echo "<p>Something went wrong: " . mysqli_error($connection); + "</p>";
                }
            }
        }
    }else if($form == "Login"){  
        $user = mysqli_real_escape_string($connection, $_POST["username"]);
        $passw = mysqli_real_escape_string($connection, $_POST["password"]);
        $query = "SELECT * FROM users WHERE username=\"$user\"";
        $ret = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($ret);
        if($row && $user == $row["username"]){
            $validpass = password_verify($passw, $row["passw"]);
            if($validpass){
                $_SESSION["login"] = true;
                $_SESSION["user"] = $row["userID"];
                $_SESSION["firstname"] = $row["firstName"];
                
                $_SESSION["accessRole"] = $row["userRole"];
                header('location:index1.php?page=home');
            }else{
                $_SESSION["error"] = "Invalid Password.";
                $_SESSION["login"] = false;
                header('location:login.php');
                $_SESSION["attempts"] += 1;
                if($_SESSION["attempts"] >= 3){
                    setcookie("lock", $user, time() +180);
                    $_SESSION["attempts"] = 0;
                }
            }
        }else{
            $_SESSION["error"] =  "Invalid Username.";
            $_SESSION["login"] = false;
                header('location:login.php');
                $_SESSION["attempts"] += 1;
                if($_SESSION["attempts"] >= 3){
                    setcookie("lock", $user, time() +180);
                    $_SESSION["attempts"] = 0;
                }
        }
    }

?>