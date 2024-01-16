Steps to Using the Three K Contract Management Systsem with the Database

1) Install the XAMPP server exe file included in the system folder. This is the web server that the application depends on to operate. 

2) Once XAMPP is installed set it up. Then move the project folder (i.e. ThreeK_Contract_Management) into the htdocs folder in the xampp directory created on the computer system after installation.  

3) Create a new database in phpMyAdmin. Leave this database empty. 

4) Fill in the form that appears when you first go onto the webapp using the localhost/ThreeK_Contract_Management address (i.e. database-setup.php)
    - Database Name should be the name of the database that has been created, preferably threek_contract_management.
    - Database Username should be your phpMyAdmin username which can be found in the "User Accounts" tab of the Home in the phpMyAdmin interface (i.e. most commonly "root")
    - Database Host should be the your phpMyAdmin host name which can be found in the "User Accounts" tab of the Home in the phpMyAdmin interface (i.e. most commonly "localhost")
    - Database Password should be your phpMyAdmin password which can be found in the "User Accounts" tab of the Home in the phpMyAdmin interface (i.e. most commonly there is none).

5) Follow the directions on the installer.php page

*) What happens is that based on what you enter into the form fields on the installer page, the host, user, pass, and dbname values in config/config.ini will be filled.
    These values are then used to establish a connection to the created database. And then to dump the database tables from threek_contract_management.sql into the created database. 

*) This process is to be repeated each time the website is used on a new computer system. But once it is done, it does not have to be repeated.  

6) However, if you choose to put things back to how they were initially after using the webapp, once done using the webapp, close all instances of it in your browser. Then proceed to place the value of check.txt to "No" where the value is equal to "Yes".
    This file is used to determine whether the database has been setup and a connection established and whether the user can then proceed to using the site as normal. 
    Then clear away the values placed in config/config.ini for the "host =", "user =", "pass=", and "dbname=". But if you do this note that a new database may need to be created in phpmyadmin again when trying to use the webapp again. 


LOGIN CREDENTIALS

Administrator User
user = admin
pass = admin 

Administrative Staff 
user = staff
pass = staff

Project Manager
user = demo
pass = demo