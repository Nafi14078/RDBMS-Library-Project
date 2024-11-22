<?php
session_start();

# If the admin is logged in
if (
   isset($_SESSION['user_id']) &&
   isset($_SESSION['user_email'])
) {

   # Database Connection File
   include "../db_conn.php";

    # Validation helper function
    include "func-validation.php";

    # File upload helper function
    include "func-file-upload.php";
   /**
    * if all input field are filled
    */
   if (isset($_POST['book_id'])          &&
       isset($_POST['book_title'])       &&
       isset($_POST['book_description']) &&
       isset($_POST['book_author'])      &&
       isset($_POST['book_category'])    &&
       isset($_FILES['book_cover'])      &&
       isset($_FILES['file'])            &&
       isset($_POST['current_cover'])    &&
       isset($_POST['current_file'])            
    ) {

        # Get data from POST request and store them in var   
        $id          = $_POST['book_id'];
        $title       = $_POST['book_title'];
        $description = $_POST['book_description'];
        $author      = $_POST['book_author'];
        $category    = $_POST['book_category'];

      /**
       * Get data from POST request and store them in var
       */

      $current_cover = $_POST['current_cover'];
      $current_file = $_POST['current_file'];

      #simple form Validation

      $text = "Book title";
      $location = "../edit-book.php";
      $ms = "id=$id&error";
      is_empty($title, $text, $location, $ms, "");

      $text = "Book description";
      $location = "../edit-book.php";
      $ms = "id=$id&error";
      is_empty($description, $text, $location, $ms, "");

      $text = "Book author";
      $location = "../edit-book.php";
      $ms = "id=$id&error";
      is_empty($author, $text, $location, $ms, "");

      $text = "Book category";
      $location = "../edit-book.php";
      $ms = "id=$id&error";
      is_empty($category, $text, $location, $ms, "");
      
      # if the admin try to update the book cover

      if(!empty($_FILE['book_cover']['name'])){
        # if the admin try to update both
        if(!empty($_FILE['book_cover']) && !empty($_FILE['file']['name'])){
            # update both here
        }
        else{
            # update just the book cover
        }
      }
      # if the admin try to update just the file
      else if(!empty($_FILE['file']['name'])){
        # update just the file
        
      }
      else{
        # update just the data
        $sql = "UPDATE books
                SET title=?,
                    author_id=?,
                    description=?,
                    category_id=?
                WHERE id=?";

        $stmt = $conn->prepare($sql);
        $res = $stmt->execute([$title, $author,$description,$category,$id]);

          /**
          * if there is no error while updating data
          */
          if ($res) {
            #success message
            $sm = "Successfully updated!";
            header("Location: ../edit-book.php?success=$sm&id=$id");
            exit;

         } else {
            #error message
            $em = "Unknown Error Occurred!";
            header("Location: ../edit-book.php?error=$em&id=$id");
            exit;
         }
      
      }
   } else {
      header("Location: ../admin.php");
      exit;
   }

} else {
   header("Location: ../login.php");
   exit;
}