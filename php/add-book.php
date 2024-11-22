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
    if (
        isset($_POST['book_title']) &&
        isset($_POST['book_description']) &&
        isset($_POST['book_author']) &&
        isset($_POST['book_category']) &&
        isset($_FILES['book_cover']) &&
        isset($_FILES['file'])
    ) {

        # Get data from POST request and store them in var   
        $title = $_POST['book_title'];
        $description = $_POST['book_description'];
        $author = $_POST['book_author'];
        $category = $_POST['book_category'];

        # making URL data format
        $user_input = '&title='.$title.'&category_id='.$category.'&desc='.$description.'&author_id='.$author;

        #simple form Validation

        $text = "Book title";
        $location = "../add-book.php";
        $ms = "error";
        is_empty($title, $text, $location, $ms, $user_input);

        $text = "Book description";
        $location = "../add-book.php";
        $ms = "error";
        is_empty($description, $text, $location, $ms, $user_input);

        $text = "Book author";
        $location = "../add-book.php";
        $ms = "error";
        is_empty($author, $text, $location, $ms, $user_input);

        $text = "Book category";
        $location = "../add-book.php";
        $ms = "error";
        is_empty($category, $text, $location, $ms, $user_input);

        # book cover uploading
        $allowed_image_exs = array("jpg", "jpeg", "png");
        $path = "cover";
        $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);


        if($book_cover['status'] == "error"){
            $em = $book_cover['data'];

            header("Location: ../add-book.php?error=$em&$user_input");

            exit;
        }
        else{
            # file uploading
            $allowed_file_exs = array("pdf", "docx", "pptx");
            $path = "files";
            $file = upload_file($_FILES['file'], $allowed_file_exs, $path);

            if($file['status'] == "error"){
                $em = $file['data'];
    
                header("Location: ../add-book.php?error=$em&$user_input");
    
                exit;
            }
            else{
                $file_URL = $file['data'];
                $book_cover_URL = $book_cover['data'];

                # Insert the data into database
                $sql = "INSERT INTO books (title,
                author_id, description, category_id, cover, file)
                VALUES (?,?,?,?,?,?)";

                $stmt = $conn->prepare($sql);
                $res = $stmt->execute([$title, $author,$description,$category,$book_cover_URL,$file_URL]);

                /**
                * if there is no error while inserting data
                */
                if ($res) {
                    #success message
                    $sm = "The book has been successfully created!";
                    header("Location: ../add-book.php?success=$sm");
                        exit;

                    } else {
                        #error message
                        $em = "Unknown Error Occurred!";
                        header("Location: ../add-book.php?error=$em");
                        exit;
                    }
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