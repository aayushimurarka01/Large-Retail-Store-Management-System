<?php
    session_start();
    $user_first_name=$_SESSION['user_first_name'];
    $user_last_name=$_SESSION['user_last_name'];

    if(!empty($user_first_name)&& !empty($user_last_name)){
?>

<?php
    } else{
        header('location:login.php');
    }
?>