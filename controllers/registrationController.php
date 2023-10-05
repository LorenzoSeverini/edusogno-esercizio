<?php
session_start();
// connection database
include "../config/database.php";

// Check if user is logged in  
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['surname'])) {

    // function to validate data
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // parameters generation
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $name = validate($_POST['name']);
    $surname = validate($_POST['surname']);

    // user data
    $user_data = '&name=' . $name . '&surname=' . $surname . '&email=' . $email;

    // check if inputs are empty
    if (empty($email)) {
        header("Location: ../views/registration.php?error=Email is required&$user_data");
        exit();
    } else if (empty($password)) {
        header("Location: ../views/registration.php?error=Password is required&$user_data");
        exit();
    } else if (empty($name)) {
        header("Location: ../views/registration.php?error=Name is required&$user_data");
        exit();
    } else if (empty($surname)) {
        header("Location: ../views/registration.php?error=Surname is required&$user_data");
        exit();
    } else {

        // hash password
        $password = md5($password);

        // query
        $sql = "SELECT * FROM users WHERE email='$email'";

        $result = mysqli_query($conn, $sql);

        // check if user exists
        if (mysqli_num_rows($result) > 0) {
            header("Location: ../views/registration.php?error=The email is already taken&$user_data");
            exit();
        } else {

            // query creation
            $sql2 = "INSERT INTO users(name, surname, email, password) VALUES('$name', '$surname', '$email', '$password')";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                header("Location: ../views/registration.php?success=Your account has been created successfully");
                exit();
            } else {
                header("Location: ../views/registration.php?error=unknown error occurred&$user_data");
                exit();
            }
        }
    }
} else {
    // redirect to registration page
    header("Location: ../views/registration.php");
    exit();
}
