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
        header("Location: ../public/index.php?error=Email is required");
        exit();
    } else if (empty($password)) {
        header("Location: ../public/index.php?error=Password is required");
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

                header("Location: ../views/dashboard.php");
                exit();
            } else {
                header("Location: ../public/index.php?error=Incorrect email or password");
                exit();
            }
        } else {
            header("Location: ../public/index.php?error=Incorrect email or password");
            exit();
        }
    }
} else {
    // redirect user to login page
    header("Location: ../public/index.php");
    exit();
}
