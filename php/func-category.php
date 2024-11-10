<?php
#Get all Categories  function

function get_all_categories($con){
    $sql = "SELECT*FROM categories ";
    $stmt =$con->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()> 0){
        $categories =$stmt->fetchAll();
    }else{
        $categories = 0;
    }
    return $categories;
}

