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

    // check if inputs are empty and check password strength ( min 8 characters, 1 uppercase, 1 number, 1 special character)
    if (empty($email)) {
        header("Location: ../views/registration.php?error=L\"email è obbligatoria&$user_data");
        exit();
    } else if (empty($password)) {
        header("Location: ../views/registration.php?error=La password è obbligatoria&$user_data");
        exit();
    } else if (strlen($password) < 8) {
        header("Location: ../views/registration.php?error=La password deve contenere almeno 8 caratteri&$user_data");
        exit();
    } else if (!preg_match('/[A-Z]/', $password)) {
        header("Location: ../views/registration.php?error=La password deve contenere almeno una lettera maiuscola&$user_data");
        exit();
    } else if (!preg_match('/[0-9]/', $password)) {
        header("Location: ../views/registration.php?error=La password deve contenere almeno un numero&$user_data");
        exit();
    } else if (!preg_match('/[^A-Za-z0-9]/', $password)) {
        header("Location: ../views/registration.php?error=La password deve contenere almeno un carattere speciale&$user_data");
        exit();
    } else if (empty($name)) {
        header("Location: ../views/registration.php?error=Il nome è obbligatoria&$user_data");
        exit();
    } else if (empty($surname)) {
        header("Location: ../views/registration.php?error=Cognome è obbligatoria&$user_data");
        exit();
    } else {

        // hash password
        $password = md5($password);

        // query
        $sql = "SELECT * FROM users WHERE email='$email'";

        $result = mysqli_query($conn, $sql);

        // check if user exists
        if (mysqli_num_rows($result) > 0) {
            header("Location: ../views/registration.php?error=Email già in uso&$user_data");
            exit();
        } else {

            // query creation
            $sql2 = "INSERT INTO users(name, surname, email, password) VALUES('$name', '$surname', '$email', '$password')";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                header("Location: ../views/registration.php?success=Il tuo account è stato creato con successo");
                exit();
            } else {
                header("Location: ../views/registration.php?error=Errore durante la registrazione, riprovad&$user_data");
                exit();
            }
        }
    }
} else {
    // redirect to registration page
    header("Location: ../views/registration.php");
    exit();
}
