<?php

# form validation function

function is_empty($var,$text,$location,$ms,$data){
    if(empty($var))
    {
        $em="The ".$text." is required";
        header("Location:$location?$ms=$em&$data");
        exit;
    }
    return 0;


}