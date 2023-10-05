<?php
// connect to database
include '../config/database.php';

// token post from form
$token = $_POST['token'];

// token hash
$token_hash = hash('sha256', $token);

// query
$sql = "SELECT * FROM users WHERE reset_token_hash = ? AND reset_token_expires_at > NOW()";

echo $sql;

$stmt = $conn->prepare($sql);

$stmt->bind_param('s', $token_hash);

// if ($stmt->execute()) {
//     echo "inviata";
// }

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

// check if token is valid
if ($user === null) {
    die("Token non valido");
}

// check if token is expired
if (strtotime($user['reset_token_expires_at']) <= time()) {
    die("Token scaduto");
}

// check if password is valid
if (strlen($_POST['password']) < 8) {
    die("La password deve essere di almeno 8 caratteri");
}

// check if password and confirm password are the same
if ($_POST['password'] !== $_POST['password_confirm']) {
    die("Le password non coincidono");
}

// hash password 
$password_hash = md5($_POST['password']);

// query update
$sql = "UPDATE users SET password = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param('ss', $password_hash, $user['id']);

$stmt->execute();

// redirect to login page
header('Location: ../public/index.php?success=Password-aggiornata-con-successo');
