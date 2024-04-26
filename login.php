<?php
    require('connection.php');
    session_start();
?>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container bg-light">
        <div class="container-fluid border-bottom"><!--topbar-->
            <div class="row p-3">
                <div class="col-sm-10">
                    <h2 class="pt-3"><a href="index.php" class=" text-dark text-decoration-none">Store Management System</a></h2>
                </div>
            </div>
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                Users_Email:<br>
                <input type="email" name="user_email"><br><br>
                Users_Password:<br>
                <input type="password" name="user_password"><br><br>
                Role:<br>
                <select name="user_role">
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select><br><br>
                <input type="submit" value="Login" class='btn btn-dark'>
            </form>
            <?php
            if(isset($_POST['user_email'])){
                $user_email = $_POST['user_email'];
                $user_password = $_POST['user_password'];
                $user_role = $_POST['user_role'];

                // Adjust the SQL query based on the role
                $sql = "SELECT * FROM users WHERE user_email='$user_email' AND user_password='$user_password' AND user_role='$user_role'";
                $query = $conn->query($sql);

                if(mysqli_num_rows($query) > 0){
                    $data = mysqli_fetch_array($query);
                    $user_first_name = $data['user_first_name'];
                    $user_last_name = $data['user_last_name'];

                    $_SESSION['user_first_name'] = $user_first_name;
                    $_SESSION['user_last_name'] = $user_last_name;
                    $_SESSION['user_role'] = $user_role;

                    if ($user_role == 'customer') {
                        header('location:customer_dashboard.php');
                    } elseif ($user_role == 'admin') {
                        header('location:index.php');
                    }
                } else {
                    echo "Unsuccessful";
                }
            }
            ?>
        </div>
    </body>
</html>
