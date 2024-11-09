<?php
session_start();
# If the admin is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    // Admin is logged in, display the admin page

    # Database connection file
    include "db_conn.php";

    # Book helper function
    include "php/func-book.php";
    $books = get_all_books($conn);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ADMIN</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="admin.php">Admin</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Store</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Add Book</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Add Category</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Add Author</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <?php if ($books == 0) { ?>
                <div class="alert alert-warning mt-4" role="alert">
                    No books found in the database.
                </div>
            <?php } else { ?>
                <h4 class="mt-4">All Books</h4>
                <table class="table table-bordered shadow">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $index => $book) { ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($book['title']) ?></td>
                                <td><?= htmlspecialchars($book['author_id']) ?></td>
                                <td><?= htmlspecialchars($book['description']) ?></td>
                                <td><?= htmlspecialchars($book['category_id']) ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $book['id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="delete.php?id=<?= $book['id'] ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </body>

    </html>

    <?php
} else {
    # Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}
?>
