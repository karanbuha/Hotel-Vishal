<?php
    
    if( isset($_SESSION['role']) ){
        $id = 0;
        $sql = "SELECT * FROM users WHERE id=".$_SESSION['user_id'];
        $res = mysqli_query($conn,$sql);
        $admin_row = mysqli_fetch_assoc($res);

        $id = $admin_row['id'];
        $name = $admin_row['name'];
        $username = $admin_row['username'];
        $password = $admin_row['password'];
        $role = $admin_row['role'];
        $status = $admin_row['status'];
        $date = $admin_row['date'];
    }
    if(!isset($_SESSION['role'])){
        header('location:../');
    }

    // echo "<pre>";
    // print_r($admin_row);
    // echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Order Management</title>


    <script src="<?php echo "{$web}assets/js/jquery-3.7.1.min.js"; ?>"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo "{$bootstrap_css}bootstrap.min.css"; ?>">
    <script src="<?php echo "{$bootstrap_js}bootstrap.min.js"; ?>"></script>

    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo "{$web}assets/css/style.css"; ?>">

    <style>
        body{
            --caret_down: url(<?php echo $images.'caret_down.svg' ?>);
        }
    </style>
</head>
<body>
<div class="header_main navbar-light bg-light border-bottom">
    <div class="container">
        <nav class="navbar navbar-expand-lg pr-0 pl-0">
            <a class="navbar-brand pt-0 pb-0" href="<?php echo "{$admin}"; ?>">
                <img src="<?php echo $logo; ?>" width="150" height="" class="d-inline-block align-top" alt="Bootstrap">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo "{$admin}"; ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo "{$admin}today_orders/"; ?>">Today Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo "{$admin}menu_items"; ?>">Menu Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo "{$admin}staffs"; ?>">Staffs</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>