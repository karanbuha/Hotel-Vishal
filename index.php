<?php
include 'db.php';
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
    $userId = $_COOKIE['remember_me'];

    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['password'] = $user['password'];
        header("Location: " . $web . $user['role'] . "/");
    }
}

    if( isset($_SESSION['role']) ){
        header("Location:" .$web .$_SESSION['role'] );

    }

    if( isset($_POST['login']) ){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM users WHERE username = '$username' and password = '$password' and status='active'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        $count=mysqli_num_rows($result);

        if ($count == 1) {
            
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];

            setcookie("remember_me", $row['id'], time() + (15 * 24 * 60 * 60), "/");
            header("Location:" .$web .$_SESSION['role'] );

        }else{
            $error = "Invalid username or password.";
        }
    }
    // echo $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Vishal Order Management System</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo "{$bootstrap_css}bootstrap.min.css"; ?>">
</head>
<body>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">Sign In</h4>
                    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input class="form-control" name="username" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button class="btn btn-primary w-100" name="login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
