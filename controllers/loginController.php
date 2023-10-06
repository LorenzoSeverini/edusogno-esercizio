<?php
session_start();
// connection database
include "../config/database.php";

// Check if user is logged in  
if (isset($_POST['email']) && isset($_POST['password'])) {

    // function to validate data
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    // check if inputs are empty
    if (empty($email)) {
        header("Location: ../public/index.php?error=L\"email è obbligatoria");
        exit();
    } else if (empty($password)) {
        header("Location: ../public/index.php?error=La password è obbligatoria");
        exit();
    } else {

        // hash password
        $password = md5($password);

        // query
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

        $result = mysqli_query($conn, $sql);

        // check if user exists
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['email']  === $email && $row['password']  === $password) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['surname'] = $row['surname'];
                $_SESSION['id'] = $row['id'];

                // Query to check admin privileges based on email
                $admin_privileges_sql = "SELECT user_id FROM admin_privileges WHERE user_id = " . $row['id'];
                $admin_privileges_result = mysqli_query($conn, $admin_privileges_sql);

                if (mysqli_num_rows($admin_privileges_result) === 1) {
                    // User has admin privileges, redirect to the admin dashboard
                    header("Location: ../views/admin/admin_dashboard.php");
                    exit();
                } else {
                    // User is not an admin, redirect to the regular user dashboard
                    header("Location: ../views/user/dashboard.php");
                    exit();
                }

                // header("Location: ../views/dashboard.php");
                // exit();
            } else {
                header("Location: ../public/index.php?error=Password o email errati");
                exit();
            }
        } else {
            header("Location: ../public/index.php?error=Password o email errati");
            exit();
        }
    }
} else {
    // redirect user to login page
    header("Location: ../public/index.php");
    exit();
}
