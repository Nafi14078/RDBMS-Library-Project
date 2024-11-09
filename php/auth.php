<?php
if(isset($_POST["email"]) && 
isset($_POST["password"]))  {

    # validation helper function

    include "func-validation.php";

    /**Get data from POST request and store them in var **/

    $email = $_POST["email"];
    $password = $_POST["password"];

    # simple form validation
    $text="Email";
    $location="../login.php";
    $ms="error";

    is_empty($email,$text,$location,$ms,"");

    $text="Password";
    $location="../login.php";
    $ms="error";

    is_empty($password,$text,$location,$ms,"");


}