<?php include 'session.php';
if(isset($_SESSION['id']))
{
    if ($_SESSION['id'] > 1) {
        header('location: login.php');
    }
    else {
        header('location: login.php');
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <head>
        <style>
        p
        {
            padding:20px;
            color:white;
            width:300px;
            margin: 10px auto;
        }
        p.success{
            background-color:green;
        }
        p.error {
            background-color:red;
        }
        a.link
        {
            background-color: blue;
            display: block;
            padding:20px;
            width:80%;
            text-align: center;
            color:white;
        }

        </style>
        </head>
    </head>
    <body>
        <?php
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'ronair';

        // Create connection
        $conn = new mysqli($servername, $username, $password);
        // Check connection
        if ($conn->connect_error) {
            die('Connection failed!:'. $conn->connect_error . '</p>');
        }


        // Create database
        $conn = new mysqli($servername, $username, $password);
        $sql = 'CREATE DATABASE ' . $dbname;
        if ($conn->query($sql) === TRUE) {
            echo '<p class="success">Database created successfully</p>';
        } else {
            echo '<p class="error">Error creating database: ' . $conn->error . '</p>';

        	}


        // sql to create table login
        $conn = new mysqli($servername, $username, $password,$dbname);
        $sql = 'CREATE TABLE IF NOT EXISTS login (
          id tinyint(5) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
          fullname varchar(100) NOT NULL,
          email varchar(100) NOT NULL,
          dob date NOT NULL,
          address varchar(100) NOT NULL,
          username varchar(50) NOT NULL,
          password varchar(50) NOT NULL,
          Accesslevel varchar(30) NOT NULL DEFAULT "user",
          reg_date timestamp NULL DEFAULT NULL
        )';

        if ($conn->query($sql) === TRUE) {
            echo '<p class="success">Table customer created successfully</p>';
        } else {
            echo '<p class="error">Error creating table: ' . $conn->error . '</p>';
        }



        $conn->close();

        ?>
         <p>
        <a href = './' class="link">Go to Login </a>

    </body>
</html>
