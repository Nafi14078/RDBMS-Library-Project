<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</head>

<body class="bg-success p-2 text-dark bg-opacity-10">
    <div class="d-flex justify-content-center align-items-center" style="min-height:100vh;">
        <form class="p-5 rounded shadow" style="max-width:30rem; width:100%" method="POST" action="php/auth.php">

            <h1 class="text-center display-4 pb-5">LOGIN</h1>
            <?php 
            if (isset($_GET["error"])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($_GET["error"]); ?>
                </div>
            <?php 
            } 
            ?>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
            <a href="index.php">Store</a>
        </form>
    </div>
</body>

</html>
