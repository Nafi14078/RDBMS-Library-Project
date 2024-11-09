<?php

# server name
$sName="localhost";

#user name
$uName= "root";

#paaword
$pass="";

#database name
$db_name= "online_book_store_db";

#creating database connection using PHP objects(pdo)

try{
    $conn=new PDO("mysql:host=$sName;dbname=$db_name",$uName,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e){
    echo "Connection failed:".$e->getMessage();
}
