<?php
session_start();

# If the admin is logged in
if (
	isset($_SESSION['user_id']) &&
	isset($_SESSION['user_email'])
) {

	# Database Connection File
	include "db_conn.php";

	# Book helper function
	include "php/func-book.php";
	$books = get_all_books($conn);

	# author helper function
	include "php/func-author.php";
	$authors = get_all_author($conn);

	# Category helper function
	include "php/func-category.php";
	$categories = get_all_categories($conn);

?>


	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ADMIN</title>

		<!-- bootstrap 5 CDN-->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

		<!-- bootstrap 5 Js bundle CDN-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
			crossorigin="anonymous"></script>

	</head>

	<body class="bg-success p-2 text-dark bg-opacity-10">
		<div class="container">
			<nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, #667eea, #764ba2); box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
				<div class="container-fluid">
					<a class="navbar-brand text-white fw-bold" href="admin.php" style="font-size: 1.5rem; letter-spacing: 1px;">
						<i class="fas fa-shield-alt"></i> Admin Panel
					</a>
					<button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
						data-bs-target="#navbarSupportedContent"
						aria-controls="navbarSupportedContent"
						aria-expanded="false"
						aria-label="Toggle navigation" style="border-color: #fff;">
						<span class="navbar-toggler-icon" style="color: #fff;"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item">
								<a class="nav-link text-white" href="index.php" style="font-size: 1rem; font-weight: 500;">
									<i class="fas fa-store"></i> Store
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-white" href="add-book.php" style="font-size: 1rem; font-weight: 500;">
									<i class="fas fa-book"></i> Add Book
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-white" href="add-category.php" style="font-size: 1rem; font-weight: 500;">
									<i class="fas fa-list"></i> Add Category
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-white" href="add-author.php" style="font-size: 1rem; font-weight: 500;">
									<i class="fas fa-user-edit"></i> Add Author
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-white" href="logout.php" style="font-size: 1rem; font-weight: 500;">
									<i class="fas fa-sign-out-alt"></i> Logout
								</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>


			<form action="search.php" method="get" style="width: 100%; max-width: 30rem">

				<div class="input-group my-5">
					<input type="text" class="form-control" name="key" placeholder="Search Book..."
						aria-label="Search Book..." aria-describedby="basic-addon2">

					<button class="input-group-text
						 btn btn-primary" id="basic-addon2">
						<img src="img/search.png" width="20">

					</button>
				</div>
			</form>
			<div class="mt-5"></div>
			<?php if (isset($_GET['error'])) { ?>
				<div class="alert alert-danger" role="alert">
					<?= htmlspecialchars($_GET['error']); ?>
				</div>
			<?php } ?>
			<?php if (isset($_GET['success'])) { ?>
				<div class="alert alert-success" role="alert">
					<?= htmlspecialchars($_GET['success']); ?>
				</div>
			<?php } ?>


			<?php if ($books == 0) { ?>
				<div class="alert alert-warning 
						text-center p-5" role="alert">
					<img src="img/empty.png" width="100">
					<br>
					There is no book in the database
				</div>
			<?php } else { ?>


				<!-- List of all books -->
				<h4>All Books</h4>
				<table class="table table-bordered shadow table-success">
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
						<?php
						$i = 0;
						foreach ($books as $book) {
							$i++;
						?>
							<tr>
								<td><?= $i ?></td>
								<td>
									<img width="100" src="uploads/cover/<?= $book['cover'] ?>">
									<a class="link-dark d-block
							   text-center" href="uploads/files/<?= $book['file'] ?>">
										<?= $book['title'] ?>


									</a>

								</td>
								<td>
									<?php if ($authors == 0) {
										echo "Undefined";
									} else {

										foreach ($authors as $author) {
											if ($author['id'] == $book['author_id']) {
												echo $author['name'];
											}
										}
									}
									?>

								</td>
								<td><?= $book['description'] ?></td>
								<td>
									<?php if ($categories == 0) {
										echo "Undefined";
									} else {

										foreach ($categories as $category) {
											if ($category['id'] == $book['category_id']) {
												echo $category['name'];
											}
										}
									}
									?>
								</td>
								<td>
									<a href="edit-book.php?id=<?= $book['id'] ?>"
										class="btn btn-warning">
										Edit</a>

									<a href="php/delete-book.php?id=<?= $book['id'] ?>" class="btn btn-danger">
										Delete</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php } ?>

			<?php if ($categories == 0) { ?>
				<div class="alert alert-warning 
						text-center p-5" role="alert">
					<img src="img/empty.png" width="100">
					<br>
					There is no category in the database
				</div>
			<?php } else { ?>
				<!-- List of all categories -->
				<h4 class="mt-5">All Categories</h4>
				<table class="table table-bordered shadow table-success">
					<thead>
						<tr>
							<th>#</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$j = 0;
						foreach ($categories as $category) {
							$j++;
						?>
							<tr>
								<td><?= $j ?></td>
								<td><?= $category['name'] ?></td>
								<td>
									<a href="edit-category.php?id=<?= $category['id'] ?>"
										class="btn btn-warning">
										Edit</a>

									<a href="php/delete-category.php?id=<?= $category['id'] ?>" class="btn btn-danger">
										Delete</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php } ?>

			<?php if ($authors == 0) { ?>
				<div class="alert alert-warning 
						text-center p-5" role="alert">
					<img src="img/empty.png" width="100">
					<br>
					There is no author in the database
				</div>
			<?php } else { ?>
				<!-- List of all Authors -->
				<h4 class="mt-5">All Authors</h4>
				<table class="table table-bordered shadow table-success">
					<thead>
						<tr>
							<th>#</th>
							<th>Author Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$k = 0;
						foreach ($authors as $author) {
							$k++;
						?>
							<tr>
								<td><?= $k ?></td>
								<td><?= $author['name'] ?></td>
								<td>
									<a href="edit-author.php?id=<?= $author['id'] ?>"
										class="btn btn-warning">
										Edit</a>

									<a href="php/delete-author.php?id=<?= $author['id'] ?>" class="btn btn-danger">
										Delete</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php } ?>
		</div>
	</body>

	</html>

<?php } else {
	header("Location: login.php");
	exit;
} ?>