<?php
#Get all Author  function

function get_all_author($con){
    $sql = "SELECT*FROM authors ";
    $stmt =$con->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()> 0){
        $authors =$stmt->fetchAll();
    }else{
        $authors = 0;
    }
    return $authors;
}

