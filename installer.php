<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name=”viewport” content="width=device-width, initial-scale=1.0">
        <title>Setup Page | Three K Contract Management</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"> 
        <link href="fontawesome-free-5.12.0-web/css/all.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.4.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/stylesheet.css"/>
        
    </head>  
    <body>
        <div class="container-fluid">
            <h1><u>Welcome to the Setup Page</u></h1>
            <p> Please fill in the following fields.</p>
            <form id="setup" method="POST" action="database-setup.php">
                <div class="form-group">
                    <label for="localhost">Database localhost:</label>
                    <input class="form-control" type="text" name="localhost"/> <br>
                </div>
                 
                <div class="form-group">
                    <label for="user">Username:</label>
                    <input class="form-control" type="text" name="dbuser" /><br>
                </div>
                
                <div class="form-group">
                    <label for="pass">Password:</label>
                    <input class="form-control" type="password" name="dbpass" placeholder="If there is no password, leave blank."/><br>
                </div>
                
                <div class="form-group">
                    <label for="database">Database name:</label>
                    <input class="form-control" type="text" name="database" /><br>
                </div>

                <input class="btn btn-default" type="submit" value="Apply">
            </form>  
         </div> 
    </body>      
</html> 