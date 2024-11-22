<?php 

# File upload helper function
function upload_file($files, $allowed_exs, $path){
    # get data and store them in var
    $file_name = $files['name'];
    $tmp_name  = $files['tmp_name'];
    $error     = $files['error'];
    
    # if there's no error while uploading
    if($error === 0){

        # get file extension store it in var
        $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);

        
        $file_ex_lc = strtolower($file_ex);

        if(in_array($file_ex_lc,$allowed_exs)){
            $new_file_name = uniqid("", true).'.'.$file_ex_lc;

            # assigning the upload path
            $file_upload_path = '../uploads/'.$path.'/'.$new_file_name;

            move_uploaded_file($tmp_name,$file_upload_path);

            $sm['status'] = 'success';
            $sm['data']   = $new_file_name;

            # Return the sm array
            return $sm;
        }
        else{
            $em['status'] = 'error';
            $em['data']   = "You can't upload file of this type";

            # Return the em array
            return $em;
        }
    }
    else{
        $em['status'] = 'error';
        $em['data']   = 'Error occurred while uploading!';

        # Return the em array
        return $em;
    }
}