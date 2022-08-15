<?php
include "vendor/autoload.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .wrap {
            width: 100%;
            max-width: 400px;
            margin: 40px auto;
        }
    </style>
</head>
<body class="text-center">
    <div class="wrap">
        <h1 class="h3 mb-3">Register</h1>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-warning">
                Cannot create account. Please try again.
            </div>
        <?php endif ?>
        <?php if (isset($_GET['valiError'])) : ?>
            <div class="alert alert-warning">
                Please fill all infomation.
            </div>
        <?php endif ?>

        <form action="_actions/create.php" method="post">
            <input type="hidden" name="csrf" value="<?= $token ?>">
            <input type="text" name="name" placeholder="Name"  class="form-control mb-2" requred>

            <input type="email" name="email" class="form-control mb-2" placeholder="Email" requred>

            <input type="text" name="phone" class="form-control mb-2" placeholder="Phone" requred>

            <textarea name="address" class="form-control mb-2" placeholder="Address" requred></textarea>

            <input type="password" name="password" class="form-control mb-2" placeholder="Password" requred>

            <button type="submit" class="w-100 btn btn-lg btn-primary">Register</button>
        </form>
        <br>

        <a href="index.php">Login</a>
    </div>
</body>
</html>